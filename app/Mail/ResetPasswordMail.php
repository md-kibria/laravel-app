<?php

namespace App\Mail;

use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $user;
    public $site = [];

    /**
     * Create a new message instance.
     */
    public function __construct($token, $user)
    {
        $this->token = $token;
        $this->user = $user;

        $siteSettings = SiteSetting::first();

        $this->site['email'] = $siteSettings->email;
        $this->site['phone'] = $siteSettings->phone;
        $this->site['title'] = $siteSettings->title;
        $this->site['address'] = $siteSettings->street.', '. $siteSettings->city.', '.$siteSettings->country;

        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');

        $this->from($fromAddress, $fromName);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reset_password',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
