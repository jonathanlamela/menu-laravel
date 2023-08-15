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
        if ($request->route('orderId')) {
            if (Order::find($request->route('orderId'))->is_paid) {
                return redirect(route('checkout.pagamento-completato', ["orderId" => $request->route('orderId')]));
            }
        }
        return $next($request);
    }
}
