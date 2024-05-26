<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentCompleted extends Notification
{
    use Queueable;
    protected $appointment;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    private function getFullName($patient)
    {
        if ($patient['middle_name']) {
            $middleInitial = Str::ucfirst(substr($patient['middle_name'], 0, 1));
            return $patient['first_name'] . ' ' . $middleInitial . '. ' . $patient['last_name'];
        } else {
            return $patient['first_name'] . ' ' . $patient['last_name'];
        }
    }

    private function formatNote($appointment)
    {
    }

    public function toMail(object $notifiable)
    {
        $fullName = $this->getFullName($notifiable->toArray());

        return (new MailMessage)
            ->greeting('Hello ' . $fullName . '!')
            ->line('Your appointment has been completed')
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
