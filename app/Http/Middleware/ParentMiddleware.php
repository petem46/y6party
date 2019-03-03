<?php

namespace App\Http\Middleware;

use Closure;

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
        if ($request->user() && $request->user()->usergroup_id == 3)
        {
        // return new Response(view('unauthorized')->with('role', 'Pete'));
        return redirect(route('home'));
        }
        return $next($request);
    }
}
