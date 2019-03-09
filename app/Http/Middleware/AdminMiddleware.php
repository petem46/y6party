<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (null !== Auth::id())
        {
            $user = User::where('id', Auth::id())->first();
            if ($user->usergroup_id == 1)
            {
                return $next($request);
            }
        }
        return redirect(route('home'));
    }
}
