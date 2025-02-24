<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageReply extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;
    public $replyMessage;

    public function __construct(ContactMessage $contactMessage, string $replyMessage)
    {
        $this->contactMessage = $contactMessage;
        $this->replyMessage = $replyMessage;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Re: ' . $this->contactMessage->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact.reply',
            with: [
                'name' => $this->contactMessage->name,
                'originalMessage' => $this->contactMessage->message,
                'replyMessage' => $this->replyMessage,
            ],
        );
    }
} 