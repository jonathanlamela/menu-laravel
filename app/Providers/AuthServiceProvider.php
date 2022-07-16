<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;
use Illuminate\Auth\Notifications\ResetPassword;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("isAdmin", function (User $user) {
            return $user->role == "admin";
        });

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailMessage)
                ->subject('Recupera la tua password')
                ->greeting("Ciao!")
                ->line('Clicca sul seguente bottone per cambiare la password')
                ->action('Cambia password', route("password.reset", ["token" => $token]))
                ->line("Se non hai fatto tu la richiesta, ignora questa email")
                ->salutation("Saluti il team Pizzeria Fittizio");
        });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verifica la tua email')
                ->greeting("Ciao!")
                ->line('Clicca sul seguente bottone per verificare la tua email')
                ->action('Verifica', $url)
                ->line("Se non hai creato tu l'account ignora questa email")
                ->salutation("Saluti il team Pizzeria Fittizio");
        });
    }
}
