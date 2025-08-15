<x-mail::message>
    # Order Placed Successfully!

    Thank you for your order. Your order reference is {{ $order->reference}}

    <x-mail::button :url="$url">
        View Orders
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>