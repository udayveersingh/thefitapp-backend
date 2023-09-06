<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SendOTPEmailNotification extends Mailable
{
    use Queueable, SerializesModels;
    public array $user;
    public array $OTPCode;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $OTPCode)
    {
        $this->user = $user;
        $this->OTPCode = $OTPCode;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'users.email',
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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from(config('mail.from.address'), env('APP_NAME', 'TheFitApp'))
            ->subject(env('APP_NAME', 'TheFitApp').": OTP")
            ->markdown('email.otp-notification');
    }
}
