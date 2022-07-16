<?php

namespace App\Http\Middleware;

use App\Models\Category;
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
            "subTotal" => 0
        ]);
        return array_merge(parent::share($request), [
            "cart" => $cart,
            "user" => fn () => $request->user()
                ? $request->user()->only(['id', 'firstname', 'lastname', 'role', 'email'])
                : null,
            "categories" => Category::all(["id", "name", "slug"]),
            'flash' => [
                'success_message' => fn () => $request->session()->get('success_message'),
                'error_message' => fn () => $request->session()->get('error_message'),
                'info_message' => fn () => $request->session()->get('info_message'),
                'status_message' => fn () => $request->session()->get('status'),
            ],
        ]);
    }
}
