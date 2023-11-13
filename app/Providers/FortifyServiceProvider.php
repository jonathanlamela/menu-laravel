<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Mail\ResetPassword as MailResetPassword;
use App\Mail\VerificaEmail;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {
                session()->flash("success_message", "Bentornato " . $request->user()->firstname . " " . $request->user()->lastname);

                return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(Fortify::redirects('login'));
            }
        });


        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse
        {
            public function toResponse($request)
            {
                session()->flash("info_message", "Sei stato disconnesso con successo");

                return $request->wantsJson()
                    ? new JsonResponse('', 204)
                    : redirect(Fortify::redirects('logout', '/'));
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        Fortify::loginView(function () {
            return view("account.login");
        });

        Fortify::registerView(function () {
            return view("account.signin");
        });

        Fortify::verifyEmailView(function () {
            return view("account.confirm_email");
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view("account.reset_password");
        });


        VerifyEmail::toMailUsing(function ($notifiable, $verificationUrl) {
            return new VerificaEmail($notifiable, $verificationUrl);
        });

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return new MailResetPassword($notifiable, $token);
        });

        Fortify::resetPasswordView(function ($request) {
            return view("account.reset_password_token", [
                "token" => $request->token,
                "email" => $request->email
            ]);
        });
    }
}
