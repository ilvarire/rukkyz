<?php

namespace App\Livewire\Customer;

use App\Helpers\CartManagement;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ShippingAddress;
use App\Models\ShippingFee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Layout('components.layouts.guest')]
class Checkout extends Component
{
    public $delivery_type = 'door';
    public $country_id = null;
    public $state = null;
    public $address = null;
    public $city = null;
    public $zip_code = null;
    public $phone_number = null;
    public $coupon = null;
    public $coupon_id = null;
    public $note = null;
    public $payment = null;
    public $cart_items = [];
    public $countries = [];
    public $states = [];
    public $state_id = null;
    public $grand_total = 0;
    public $cart_total = 0;
    public $discount = 0;
    public $shippingFee = 0;
    public function mount()
    {
        $this->loadCartItems();
        $this->updateTotal();
    }
    public function loadCartItems()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->countries = Country::orderBy('name')->get();
    }

    public function updated($property, $value)
    {
        if ($property == 'country_id') {
            $this->states = ShippingFee::where('country_id', $value)->get();
            $this->state_id = null;
            $this->calculateShipping();
        } elseif ($property == 'state_id') {
            if ($this->country_id && $this->state_id) {
                $this->calculateShipping();
            }
        } elseif ($property === 'delivery_type') {
            if ($value === 'door') {
                $this->reset(['country_id', 'state_id', 'address', 'city', 'zip_code',]);
                $this->calculateShipping();
            } else if ($value === 'pickup') {
                $this->country_id = 1;
                $this->state_id = 1;
                $this->address = 'Pick up address to be communicated';
                $this->city = 'Pick up';
                $this->zip_code = 'pick up';
                $this->calculateShipping();
            }
        }
    }

    public function updatedStateId()
    {
        $this->calculateShipping();
    }

    private function calculateShipping()
    {

        if (!$this->country_id || !$this->state_id) return;

        $shippingRule = ShippingFee::where('country_id', $this->country_id)
            ->where('id', $this->state_id)
            ->first();

        if ($shippingRule) {
            $this->shippingFee = $shippingRule->base_fee;
        } else {
            $this->shippingFee = 0;
        }

        $this->updateTotal();
    }

    public function applyCoupon()
    {
        $this->validate([
            'coupon' => 'required'
        ]);

        $coupon = Coupon::where('code', $this->coupon)
            ->whereDate('end_date', '>=', now())
            ->first();

        if (!$coupon) {
            $this->coupon_id = null;
            LivewireAlert::title('invalid')
                ->text('invalid or expired coupon.')
                ->error()
                ->toast()
                ->timer(3000)
                ->position('center')
                ->show();
            $this->discount = 0;
        } else {
            $this->coupon_id = $coupon->id;
            $this->discount = $this->grand_total * ($coupon->discount_percentage / 100);
            LivewireAlert::title('Added')
                ->text('coupon added successfully.')
                ->success()
                ->toast()
                ->timer(3000)
                ->position('center')
                ->show();
        }

        $this->updateTotal();
    }

    private function  updateTotal()
    {
        $this->cart_total = max(0, $this->grand_total + $this->shippingFee - $this->discount);
    }

    public function placeOrder()
    {
        $this->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:40',
            'phone_number' => 'required|string|max:20',
            'zip_code' => 'required|string|max:10',
            'country_id' => 'required|integer|exists:countries,id',
            'state_id' => 'required|max:30|exists:shipping_fees,id',
            'note' => 'nullable|max:600',
            'delivery_type' => 'required|in:door,pickup',
        ]);

        if ($this->delivery_type === 'pickup') {
            $this->country_id = 1;
            $this->state_id = 1;
            $this->address = 'Pick up address to be communicated';
            $this->city = 'Pick up';
            $this->zip_code = 'pick up';
            $this->calculateShipping();
        }

        $this->loadCartItems();
        if (!$this->coupon) {
            $this->coupon_id = null;
            $this->discount = 0;
        } else {
            $coupon = Coupon::where('code', $this->coupon)
                ->whereDate('end_date', '>=', now())
                ->first();

            if (!$coupon) {
                $this->coupon_id = null;
                $this->discount = 0;
            } else {
                $this->coupon_id = $coupon->id;
                $this->discount = $this->grand_total * ($coupon->discount_percentage / 100);
            }
        }
        $this->calculateShipping();

        if (empty($this->cart_items)) {
            return redirect()->route('cart');
        }


        $line_items[] = [
            'price_data' => [
                'currency' => 'gbp',
                'unit_amount' => $this->cart_total * 100,
                'product_data' => [
                    'name' => 'Order Total (with Discount + Shipping)',
                ]
            ],
            'quantity' => 1,
        ];

        $redirect_url = '';

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionCheckout = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => Auth::user()->email,
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel'),
        ]);

        $redirect_url = $sessionCheckout->url;
        $session_id = $sessionCheckout->id;

        DB::transaction(function () use ($session_id) {
            //create order
            $shippingAddress = ShippingAddress::create([
                'user_id' => Auth::user()->id,
                'country_id' => $this->country_id,
                'shipping_fee_id' => $this->state_id,
                'city' => $this->city,
                'address' => $this->address,
                'phone_number' => $this->phone_number,
                'zip_code' => $this->zip_code
            ]);

            $order = Order::create([
                'reference' => 'ord-' . Auth::user()->id . date('Ymd') . Str::random(6),
                'session_id' => $session_id,
                'user_id' => Auth::user()->id,
                'shipping_address_id' => $shippingAddress->id,
                'total_price' => $this->cart_total,
                'note' => $this->note ?? null,
                'coupon_id' => $this->coupon_id ?? null
            ]);

            foreach ($this->cart_items as $item) {
                $order->items()->create([
                    'food_id' => $item['food_id'],
                    'size_id' => $item['size_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['total_amount']
                ]);
            }

            Payment::create([
                'order_id' => $order->id,
                'gateway' => 'stripe',
                'amount' => $this->cart_total,
                'transaction_reference' => $order->reference,
                'payment_method' => 'card'
            ]);
        });
        CartManagement::clearCartItems();
        return redirect($redirect_url);
    }
    public function render()
    {
        return view('livewire.customer.checkout');
    }
}
