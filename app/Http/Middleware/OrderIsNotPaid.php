<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderIsNotPaid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('order_id')) {
            if (Order::find($request->route('order_id'))->isPaid) {
                return redirect(route('checkout.pagamento-completato', ["order_id" => $request->route('order_id')]));
            }
        }
        return $next($request);
    }
}
