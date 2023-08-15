<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Asahasrabuddhe\LaravelMJML\Mail\Mailable;



use App\Models\Order;


class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->mjml('emails/order_created')->subject("Ordine creato #NUM-" . $this->order->id)->with([
            "order" => $this->order
        ]);
    }
}
