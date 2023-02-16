<?php

namespace App\Http\Middleware;

use App\Models\Category;
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
            "subTotal" => 0,
        ]);

        $settings = [];

        foreach (Setting::all() as $row) {
            $settings[$row->key] = $row->value;
        }

        $message = [];

        if ($request->session()->get('success_message')) {
            $message['tag'] = "success";
            $message['text'] = $request->session()->get('success_message');
        }

        if ($request->session()->get('info_message')) {
            $message['tag'] = "info";
            $message['text'] = $request->session()->get('info_message');
        }

        if ($request->session()->get('error_message')) {
            $message['tag'] = "error";
            $message['text'] = $request->session()->get('error_message');
        }

        if ($request->session()->get('status')) {
            $message['tag'] = "info";

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
            "settings" => $settings,
            "categories" => Category::all(["id", "name", "slug"]),
            "message" => $message,
            "tipoConsegna" => session('tipoConsegna', 'ASPORTO')
        ]);
    }
}
