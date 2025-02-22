<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmation extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Booking Confirmation - #' . $this->booking->id)
            ->line('Thank you for your booking!')
            ->line('Booking Details:')
            ->line('Room: ' . $this->booking->room->name)
            ->line('Check-in: ' . $this->booking->check_in_date->format('Y-m-d'))
            ->line('Check-out: ' . $this->booking->check_out_date->format('Y-m-d'))
            ->line('Total Amount: $' . number_format($this->booking->total_price, 2))
            ->action('View Booking', route('my.bookings'))
            ->line('We look forward to hosting you!');
    }
} 