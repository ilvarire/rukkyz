<?php

namespace App\Livewire\Customer;

use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Uri;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Layout('components.layouts.guest')]
class Success extends Component
{
    #[Uri]
    public $session_id;
    public function render()
    {
        $latest_order = Order::with('shippingAddress', 'payment')
            ->where('user_id', auth()->user()->id)
            ->where('reference', $this->session_id)
            ->latest()->first();

        if (!$latest_order) {
            throw new NotFoundHttpException();
        }

        if ($this->session_id) {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session_info = Session::retrieve($this->session_id);
            if ($session_info->payment_status != 'paid') {
                $latest_order->payment_status = 'failed';
                $latest_order->save();
                $latest_order->payment->payment_status = 'failed';
                $latest_order->payment->status = 'cancelled';
                $latest_order->payment->save();
                return redirect() - route('cancel');
            } else if ($session_info->payment_status == 'paid') {
                $latest_order->payment_status = 'completed';
                $latest_order->save();
                $latest_order->payment->payment_status = 'paid';
                $latest_order->payment->status = 'processed';
                $latest_order->payment->save();
                $admin = User::where('role', 1)->value('email');
                Mail::to(request()->user())->send(new OrderPlaced($latest_order));
                if ($admin) {
                    Mail::to($admin)->send(new OrderPlaced($latest_order));
                }
            }
        }
        return view('livewire.customer.success');
    }
}
