<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\User;

class ParentMiddleware
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
        $usergroups = array(1,2);
        if (null !== Auth::id())
        {
            $user = User::where('id', Auth::id())->first();
            if (in_array($user->usergroup_id, $usergroups))
            {
                return $next($request);
            }
        }
        return redirect(route('home'));
    }
}
