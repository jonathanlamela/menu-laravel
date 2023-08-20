<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Asahasrabuddhe\LaravelMJML\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

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
        return $this->mjml('emails/order_state_update')
            ->cc($this->user->email)
            ->subject("Il tuo ordine #" . $this->order_id)
            ->with([
                "order_id" => $this->order_id,
                "new_order_state_name" => $this->new_order_state_name
            ]);
    }
}
