<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;
use App\Models\Settings;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $response = parent::render($request, $exception);


        if ($response->status() === 404) {

            return Inertia::render("Error404Page", [
                "settings" => Settings::all()->first(),
            ])->toResponse($request)->setStatusCode(404);
        }

        if ($response->status() === 403) {
            return Inertia::render("Error403Page", [[
                "settings" => Settings::all()->first(),
            ]])->toResponse($request)->setStatusCode(403);
        }

        return parent::render($request, $exception);
    }
}
