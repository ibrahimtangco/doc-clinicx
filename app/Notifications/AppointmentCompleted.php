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
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
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
        return $appointment->comment ?? false;
    }

    public function toMail(object $notifiable)
    {
        $fullName = $this->getFullName($notifiable->toArray());
        $comment = $this->formatNote($this->appointment);

        return (new MailMessage)
            ->greeting('Hello ' . $fullName . '!')
            ->line('We hope this message finds you well.')
            ->line('We are pleased to inform you that your recent dental appointment has been successfully completed.')
            ->line('Here is a comment from your dentist about the consultation:')
            ->line('**"' . $comment . '"**')
            ->line('Your dental health is our top priority, and we are glad to have been able to assist you.')
            ->line('Thank you for choosing our clinic. We look forward to seeing you at your next visit.')
            ->line('If you have any further questions or need additional support, please don’t hesitate to contact us.');
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
