<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Asahasrabuddhe\LaravelMJML\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\Settings;

class OrderPaid extends Mailable
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
        $settings = Settings::first();

        return $this->mjml('emails/order_paid')
            ->subject(__('emails.order_paid_subject') . " #NUM-" . $this->order->id)
            ->with([
                "order" => $this->order,
                "site_title" => $settings->site_title,
                "site_subtitle" => $settings->site_subtitle
            ]);
    }
}
