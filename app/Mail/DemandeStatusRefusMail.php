<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandeStatusRefusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $etat;
    public $raison;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $etat, $raison)
    {
        //

        $this->name = $name;
        $this->etat = $etat;
        $this->raison = $raison;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mise à jour de votre demande')
                    ->view('emails.refuser_status');
    }
}
