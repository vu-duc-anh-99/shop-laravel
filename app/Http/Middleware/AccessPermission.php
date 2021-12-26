<?php

namespace App\Http\Middleware;

use Session;
use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->hasAnyRoles(['admin', 'author'])) {
                return $next($request);
            } else {
                Session::put('message', "Bạn chưa được cấp quyền");
                return redirect('/admin');
            }
        } else {
            return redirect('/admin');
        }
    }
}
