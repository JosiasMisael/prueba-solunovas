<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredencialesMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

       return $this->from('supervisorA@gmail.com')->markdown('email.credenciales')->subject('Tus credenciales de acceso a ' . config('app.name'));
    }
}
