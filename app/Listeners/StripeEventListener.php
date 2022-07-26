<?php

namespace App\Listeners;

use App\Mail\OrderPaid;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookReceived;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Mail;

class StripeEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(WebhookReceived $event)
    {


        if ($event->payload['type'] === "checkout.session.completed") {
            $metadata = $event->payload["data"]["object"]["metadata"];
            $order_sku = $metadata["order_sku"];
            $order = Order::find($order_sku);
            $order->order_status = setting('order_state_paid', "Pagato");
            $order->is_paid = true;
            $order->save();

            Mail::to($order->user)->send(new OrderPaid($order));
        }
    }
}
