<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;

class LoginEventListener
{
    private $request;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {

        $this->request = $request;
    }


    public function handle(Failed $event)
    {
        //Ascolto qui l'evento di login fallito per poter aggiungere un messaggio flash
        session()->flash("error_message", "Email o password errata");
    }
}
