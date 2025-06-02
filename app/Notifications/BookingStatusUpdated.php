<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingStatusUpdated extends Notification
{
    use Queueable;

    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function via($notifiable)
    {
        // يمكنك إرسال الإشعار عبر البريد الإلكتروني أو طرق أخرى
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your booking status has been updated.')
            ->line('New status: ' . ucfirst($this->status))
            ->action('View Booking', url('/bookings'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'status' => $this->status,
        ];
    }
}