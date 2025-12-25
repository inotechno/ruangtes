<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetEmail extends Mailable
{
    use SerializesModels;

    public User $user;
    public string $resetUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->resetUrl = $this->generateResetUrl($token);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('emails.password_reset.subject', []),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.password_reset',
            with: [
                'user' => $this->user,
                'resetUrl' => $this->resetUrl,
            ],
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
     * Generate password reset URL
     */
    private function generateResetUrl(string $token): string
    {
        return route('password.reset', [
            'token' => $token,
            'email' => $this->user->getEmailForPasswordReset(),
        ]);
    }
}
