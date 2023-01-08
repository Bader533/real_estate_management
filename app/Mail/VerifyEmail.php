<?php

namespace App\Mail;

use App\Models\PropertyOwner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected String $code;
    protected PropertyOwner $owner;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PropertyOwner $owner, String $code)
    {
        $this->owner = $owner;
        $this->code = $code;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Verify Email',
        );
    }

    public function content()
    {
        return new Content(
            markdown: 'mail.verify-email',
            with: [
                'code' => $this->code,
                'name' => $this->owner->name
            ]
        );
    }
}
