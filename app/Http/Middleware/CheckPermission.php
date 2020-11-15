<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $per
     * @return mixed
     */
    public function handle($request, Closure $next, $per)
    {
        //dd($per);
        //dd($role = $request->user()->role->role_id);
        $role = $request->user()->role->role_id;
        if($role == $per){
            return $next($request);
        }
        abort(403);
    }
}
