<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DonorRegistered extends Notification
{
    use Queueable;

    private $donor;

    /**
     * Create a new notification instance.
     *
     * @param mixed $donor The donor information.
     */
    public function __construct($donor)
    {
        $this->donor = $donor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param object $notifiable The notifiable entity.
     * @return array<int, string> The array of delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification for the database.
     *
     * @param object $notifiable The notifiable entity.
     * @return array<string, mixed> The array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'donor' => $this->donor,
            'message' => 'A new donor <b>'. $this->donor->name .'</b>, has registered and awaits approval.'
        ];
    }
}
