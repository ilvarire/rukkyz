<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderNotification;
use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Webhook;

class CallbackController extends Controller
{
    public function webhook()
    {
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            //throw $th;
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            http_response_code(400);
            exit();
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $sessionId = $session->id;

                $order = Order::where('reference', $session->id)->first();
                if ($order && $order->status === 'pending') {
                    $order->status = 'completed';
                    $order->save();

                    // send email to customer
                    $admin = User::where('role', 1)->value('email');
                    Mail::to(request()->user())->send(new OrderPlaced($order));
                    if ($admin) {
                        Mail::to($admin)->send(new NewOrderNotification($order));
                    }
                }
                break;

            default:
                # code...
                break;
        }
    }
}
