<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('auth/login',['uses' => 'AuthController@authenticate']);

$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
        $router->get('users', function() {
            $users = \App\User::all();
            return response()->json($users);
        });
    }
);

$router->post('register' , 'UserController@register');
$router->get('profile' , 'UserController@profile');


// example routes
// $app->get('/login', function (Request $request) {
//     $token = app('auth')->attempt($request->only('email', 'password'));

//     return response()->json(compact('token'));
// });

// $app->get('/me', function (Request $request) {
//     return $request->user();
// });
