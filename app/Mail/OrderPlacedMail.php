<?php

namespace App\Mail;

use App\Models\SiteSetting;
use App\Models\SocialMedia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $site = [];
    public $socials = [];

    /**
     * Create a new message instance.
     */
    public function __construct($order)
    {
        $this->order = $order;

        $siteSettings = SiteSetting::first();

        $this->site['email'] = $siteSettings->email;
        $this->site['phone'] = $siteSettings->phone;
        $this->site['title'] = $siteSettings->title;
        $this->site['address'] = $siteSettings->street.', '. $siteSettings->city.', '.$siteSettings->country;

        $this->socials = SocialMedia::all();

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
            subject: 'Order Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order_placed',
        );
    }

    /**
     * Build the message.
     */
    // public function build()
    // {
    //     // this function add by suggesion of chatgpt
    //     return $this->subject('Order Confirmation')
    //         ->view('emails.order_placed')
    //         ->with(['order' => $this->order]);
    // }

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
