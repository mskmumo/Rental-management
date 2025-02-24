<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactMessage extends Notification implements ShouldQueue
{
    use Queueable;

    protected $contactMessage;

    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Contact Message from ' . $this->contactMessage->name)
            ->line('You have received a new contact message from ' . $this->contactMessage->name)
            ->line('Subject: ' . $this->contactMessage->subject)
            ->line('Message:')
            ->line($this->contactMessage->message)
            ->action('View Message', route('admin.contact-messages.show', $this->contactMessage))
            ->line('Thank you for using our application!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'New contact message from ' . $this->contactMessage->name,
            'contact_message_id' => $this->contactMessage->id,
            'subject' => $this->contactMessage->subject,
            'description' => 'You have received a new contact message regarding ' . $this->contactMessage->subject
        ];
    }
} 