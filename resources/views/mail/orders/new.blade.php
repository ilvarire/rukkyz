@component('mail::message')
# New Order Notification

A new order has been placed.

**Order ID:** {{ $order->reference }}
**Customer:** {{ $order->user->name }}
**Email:** {{ $order->user->email }}
**Phone:** {{ $order->shippingAddress->phone_number }}
**Shipping Address:**
{{ $order->shippingAddress->address }},
{{ $order->shippingAddress->city }},
{{ $order->shippingAddress->shippingFee->state }},
{{ $order->shippingAddress->country->name }}
**Zip:** {{ $order->shippingAddress->zip_code }}
**Note:** {{ $order->note }}

---

## Order Items
@component('mail::table')
| Item | Size | Quantity | Unit Price | Total |
|-------------|------|----------|------------|-------|
@foreach($order->items as $item)
    | {{ $item->food->name }} | {{ $item->size->label ?? '-' }} | {{ $item->quantity }} |
    {{ number_format($item->unit_price, 2) }} | {{ number_format($item->total, 2) }} |
@endforeach
@endcomponent

---

**Total:** {{ number_format($order->total_price, 2) }}

@component('mail::button', ['url' => url('/admin/orders/')])
View Order in Admin
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent