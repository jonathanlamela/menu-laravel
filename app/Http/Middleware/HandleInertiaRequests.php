<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $cart = session('cart', [
            "items" => [],
            "total" => 0,
        ]);




        $message = [];

        if ($request->session()->get('success_message')) {
            $message['type'] = "success";
            $message['text'] = $request->session()->get('success_message');
        }

        if ($request->session()->get('info_message')) {
            $message['type'] = "info";
            $message['text'] = $request->session()->get('info_message');
        }

        if ($request->session()->get('error_message')) {
            $message['type'] = "error";
            $message['text'] = $request->session()->get('error_message');
        }

        if ($request->session()->get('status')) {
            $message['type'] = "info";

            switch ($request->session()->get('status')) {
                case "verification-link-sent":
                    $message['text'] = "Email di verifica inviata";
                    break;
                case "profile-information-updated":
                    $message['text'] = "Informazioni profilo aggiornate";
                    break;
                default:
                    $message['text'] = $request->session()->get('status');
                    break;
            }
        }

        return array_merge(parent::share($request), [
            "cart" => $cart,
            "user" => fn () => $request->user()
                ? $request->user()->only(['id', 'firstname', 'lastname', 'role', 'email'])
                : null,
            "general_settings" => GeneralSetting::all()->first(),
            "categories" => Category::all(["id", "name", "slug"]),
            "message" => $message,
            "tipoConsegna" => session('tipoConsegna', 'ASPORTO')
        ]);
    }
}
