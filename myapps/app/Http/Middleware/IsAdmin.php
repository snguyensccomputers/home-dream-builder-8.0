<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $user_id = Auth::id();

        // Check if the authenticated user own the url
        // Get the user id attached to the url
        $user =
            DB::table('users')
                ->where('id', '=', $user_id)
                ->first();
        ;

        if ($user->role != 'admin') {
            Auth::logout();
            return redirect('admin/login');
        }

        return $next($request);
    }
}
