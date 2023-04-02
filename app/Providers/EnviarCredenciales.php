<?php

namespace App\Providers;

use App\Mail\CredencialesMail;
use App\Providers\UserCreado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EnviarCredenciales
{

    /**
     * Handle the event.
     *
     * @param  \App\Providers\UserCreado  $event
     * @return void
     */
    public function handle(UserCreado $event)
    {

        //dd($event->user->toArray(), $event->password);
    Mail::to($event->user)->queue(new CredencialesMail($event->user, $event->password));

    }
}
