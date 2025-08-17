@component('mail::message')
# Order Delivered

Your order {{$ref}} has been marked as delivered.
You can now rate the products you have received to help us improve our services.<br>
Thank you for your patronage. We look forward to serving you again!
<br><br>

Thanks, <br>
{{ config('app.name') }}
@endcomponent