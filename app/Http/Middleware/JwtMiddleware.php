<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;


class ExampleMiddleware
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
        $token = $request->get('token');

        if(!$token){
            //unauthorized response if token not there
            return response()->json([
                'error' => 'Token not Provided.'
            ],401);
        }
        try{
            $credentials = JWT::decode($token,env('JWT_SECRET'),['HS256']);
        }catch(ExpiredException $e){
            return response()->json([
                'error' => 'provided token is expired.'
            ],400);
        }catch(ExpiredException $e){
            return response()->json([
                'error' => 'An error while decoding token.'
            ],400);
        }
        $user = User::find($credentials->sub);
        //now let's put the user in the request class so that you can grab it from there 
        $request->auth = $user;
        return $next($request);
    }
}
