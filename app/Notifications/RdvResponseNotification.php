<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RdvResponseNotification extends Notification
{
    use Queueable;

    public $rdvResponse;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rdvResponse)
    {
        //
        $this->rdvResponse = $rdvResponse;
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
        // dd($this->demande);
        if(!is_null($this->rdvResponse['rdv_request_date']))
        {
            return [
                'doctor_id'                 => $this->rdvResponse['doctor_id'],
                'patient_id'                => $this->rdvResponse['patient_id'],
                'doctor_name'               => $this->rdvResponse['doctor_name'],
                'patient_name'              => $this->rdvResponse['patient_name'],
                'doctor_phone'              => $this->rdvResponse['doctor_phone'],
                'doctor_profil_pic'         => $this->rdvResponse['doctor_profil_pic'],
                'rdv_response_subject'      => $this->rdvResponse['rdv_response_subject'],
                'rdv_response_content'      => $this->rdvResponse['rdv_response_content'],
                'rdv_response_date'         => $this->rdvResponse['rdv_response_date'],
                'rdv_time'                  => $this->rdvResponse['rdv_time'],
                'rdv_response_status'       => $this->rdvResponse['rdv_response_status'],
            ];
        }
        else {
            return [
                'doctor_id'                 => $this->rdvResponse['doctor_id'],
                'patient_id'                => $this->rdvResponse['patient_id'],
                'doctor_name'               => $this->rdvResponse['doctor_name'],
                'patient_name'              => $this->rdvResponse['patient_name'],
                'doctor_phone'              => $this->rdvResponse['doctor_phone'],
                'doctor_profil_pic'         => $this->rdvResponse['doctor_profil_pic'],
                'rdv_response_subject'      => $this->rdvResponse['rdv_response_subject'],
                'rdv_response_content'      => $this->rdvResponse['rdv_response_content'],
                'rdv_response_date'         => $this->rdvResponse['rdv_response_date'],
                'rdv_time'                  => $this->rdvResponse['rdv_time'],
                'rdv_response_status'       => $this->rdvResponse['rdv_response_status'],
            ];
        }
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
