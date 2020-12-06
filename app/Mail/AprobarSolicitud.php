<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AprobarSolicitud extends Mailable
{
    use Queueable, SerializesModels;
    public $info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->info = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Solicitud Aprobada Laboratorio Diseño Gráfico')->view('mails.aprobarSolicitud');
    }
}
