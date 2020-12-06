<?php

namespace App\Notifications;

use App\Solicitud;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SolicitudNotificacion extends Notification
{
    use Queueable;
    protected $solicitud;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;
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
            'solicitud' => $this->solicitud->id,
            'estudiante' => $this->solicitud->user_id,
            'existencia' => $this->solicitud->existencia_id,
            'fecha_inicio' => $this->solicitud->fecha_inicio,
            'fecha_fin' => $this->solicitud->fecha_fin,
            'nombre' => $this->solicitud->user_name,
            'apellido' => $this->solicitud->user_lastname,
            'equipo' => $this->solicitud->equipo,
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
