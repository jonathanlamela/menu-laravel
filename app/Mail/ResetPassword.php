<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Asahasrabuddhe\LaravelMJML\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $resetLink;
    protected $user;

    public function __construct(User $user, $resetLink)
    {
        $this->resetLink = $resetLink;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->mjml('emails/reset_password')
            ->cc($this->user->email)
            ->subject("Reset della password")
            ->with([
                "link" => route("password.reset", ["token" => $this->resetLink])
            ]);
    }
}
