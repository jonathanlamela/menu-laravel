<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Asahasrabuddhe\LaravelMJML\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Settings;

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
        $settings = Settings::first() ?? new Settings();

        return $this->mjml('emails/reset_password')
            ->cc($this->user->email)
            ->subject(__('emails.password_reset_subject'))
            ->with([
                "link" => route("password.reset", ["token" => $this->resetLink]),
                "site_title" => $settings->site_title,
                "site_subtitle" => $settings->site_subtitle
            ]);
    }
}
