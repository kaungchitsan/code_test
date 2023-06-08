<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class AuthApi
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
        $access_key = $request->header('Authorization');
        if($access_key)
        {
            $user = User::where('access_key', $access_key)->active()->first();
            if($user)
            {
                return $next($request);
            }else{
                return sendError(null, 'Unauthorized'); 
            }
            
        }
        return sendError(null, 'Unauthorized');

    }
}
