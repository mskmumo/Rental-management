<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewContactMessage extends Notification
{
    use Queueable;

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Contact Form Submission')
            ->line('You have received a new contact form submission from ' . $this->contact->name)
            ->line('Subject: ' . $this->contact->subject)
            ->line('Message: ' . $this->contact->message)
            ->action('View Message', route('admin.contacts.show', $this->contact));
    }

    public function toArray($notifiable)
    {
        return [
            'contact_id' => $this->contact->id,
            'name' => $this->contact->name,
            'subject' => $this->contact->subject
        ];
    }
} 