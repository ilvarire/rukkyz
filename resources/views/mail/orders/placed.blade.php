@component('mail::message')
# Order Placed Successfully!

Thank you for your order. Your payment of {{ Number::currency($order->total_price, 'GBP') }} is successful and your
order reference is {{ $order->reference}},<br>
We will keep you updated on your order.

@component('mail::button', ['url' => $url])
See details
@endcomponent

Thanks, <br>
{{ config('app.name') }}
@endcomponent