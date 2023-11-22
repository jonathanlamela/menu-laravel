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

class VerificaEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $verificationLink;
    protected $user;

    public function __construct(User $user, $verificationLink)
    {
        $this->verificationLink = $verificationLink;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $settings = Settings::first();

        return $this->mjml('emails/verify_email')
            ->cc($this->user->email)
            ->subject(__('emails.verify_email_subject'))
            ->with([
                "link" => $this->verificationLink,
                "site_title" => $settings->site_title,
                "site_subtitle" => $settings->site_subtitle
            ]);
    }
}
