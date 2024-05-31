<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentCancelled extends Notification
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
        return $appointment->comment ?? null;
    }

    private function formatDate($appointment)
    {
        $date = Carbon::parse($appointment->date)->format('F j, Y');
        $time = Carbon::parse($appointment->time)->format('g:i A');

        return $date . ' at ' . $time;
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $fullName = $this->getFullName($notifiable->toArray());
        $reason = $this->formatNote($this->appointment);
        $appointmentDate = $this->formatDate($this->appointment);

        return (new MailMessage)
            ->greeting('Hello ' . $fullName . '!')
            ->line('We hope this message finds you well.')
            ->line('We regret to inform you that your upcoming dental appointment scheduled for ' . $appointmentDate . ' has been cancelled.')
            ->line('**Reason for cancellation:**')
            ->line('**' . $reason . '**')
            ->line('We apologize for any inconvenience this may cause. Please feel free to contact us to reschedule your appointment at a convenient time.')
            ->line('Your dental health is our top priority, and we are committed to providing you with the best possible care.')
            ->line('Thank you for your understanding.');
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
