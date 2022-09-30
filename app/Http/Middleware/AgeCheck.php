<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$age=15)
    {
        
        // if($age<=15){
        //     abort(Response::HTTP_UNAUTHORIZED);
        // }
        // return $next($request);
        $response=$next($request);
        if($age<18){
            abort(Response::HTTP_UNAUTHORIZED);
            echo "win 3";
        }
        return $response;
    }
}
