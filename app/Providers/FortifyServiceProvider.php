<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Inertia\Inertia;

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
            return Inertia::render('account/LoginPage');
        });

        Fortify::registerView(function () {
            return Inertia::render('account/SigninPage');
        });

        Fortify::verifyEmailView(function () {
            return Inertia::render('account/VerificaAccountPage');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return Inertia::render('account/ResetPasswordPage');
        });

        Fortify::resetPasswordView(function ($request) {
            return Inertia::render('account/ResetPasswordPageToken', ['request' => $request]);
        });
    }
}
