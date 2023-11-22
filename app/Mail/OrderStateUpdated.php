<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Asahasrabuddhe\LaravelMJML\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings;

class OrderStateUpdated extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;

    protected $order_id;
    protected $user;
    protected $new_order_state_name;


    public function __construct(User $user, $orderId, $newOrderStateName)
    {

        $this->order_id = $orderId;
        $this->user = $user;
        $this->new_order_state_name = $newOrderStateName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $settings = Settings::first();

        return $this->mjml('emails/order_state_update')
            ->cc($this->user->email)
            ->subject(__('emails.order_updated_subject') . " NUM#" . $this->order_id)
            ->with([
                "order_id" => $this->order_id,
                "new_order_state_name" => $this->new_order_state_name,
                "site_title" => $settings->site_title,
                "site_subtitle" => $settings->site_subtitle
            ]);
    }
}
