<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RdvRequest extends Notification
{
    use Queueable;

    public $rdv;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rdv)
    {
        $this->rdv = $rdv;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    public function toDatabase($notifiable)
    {
        return [
            'patient_id'            => $this->rdv['patient_id'],
            'doctor_id'             => $this->rdv['doctor_id'],
            'patient_phone'         => $this->rdv['patient_phone'],
            'patient_name'          => $this->rdv['patient_name'],
            'doctor_name'           => $this->rdv['doctor_name'],
            'patient_profil_pic'    => $this->rdv['patient_profil_pic'],
            'rdv_request_subject'   => $this->rdv['rdv_request_subject'],
            'rdv_request_content'   => $this->rdv['rdv_request_content'],
            'rdv_request_date'      => $this->rdv['rdv_request_date'],
            'rdv_time'              => $this->rdv['rdv_time'],
            'rdv_status'            => $this->rdv['rdv_status'],
        ];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
