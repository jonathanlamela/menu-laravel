<?php

namespace App\Listeners;

use App\Mail\OrderPaid;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookReceived;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Mail;
use App\Models\OrdiniSetting;
use App\Models\Settings;

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
            $order->order_state_id = Settings::first()->order_paid_state_id ?? null;
            $order->is_paid = true;
            $order->save();

            Mail::to($order->user)->send(new OrderPaid($order));
        }
    }
}
