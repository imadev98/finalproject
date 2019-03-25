<?php
use Illuminate\Support\Facades\Schema;
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
$router->post('/auth/login', 'AuthController@Login');

//$router->post('/auth/login', 'AuthController@register');


$router->get('/', function () use ($router) {
    $res['success'] = true;
    $res['result'] = 'Hello world with lumen';
    return response($res);
});


$router->get('foo', function () {
    return 'Hello World';
});



 
$router->post('/login', 'LoginController@login');
$router->post('/register', 'UserController@register');


$router->post('/reservation', 'ResrvationsController@reserver');
$router->get('/reservation', 'ResrvationsController@reserver');
$router->put('/reservation', 'ResrvationsController@reserver');
$router->delete('/reservation', 'ResrvationsController@annuler');


$router->post('/demande', 'ResrvationsController@demande');


$router->group(['prefix' => 'admin'], function () use ($router) {
    $router->get('users', function ()    {
        $router->put('/hello', 'TestController@a');
         $router->get('/test', 'TestController@b'); 
    });
});


$router->post('/gestion', 'GestionsController@show');
$router->get('/gestion', 'GestionsController@showall');
$router->put('/gestion/{id}', 'GestionsController@update');
$router->get('/gestion/{id}', 'GestionsController@show');
$router->delete('/gestion', 'GestionsController@ajouter');
$router->get('/user/{id}', ['middleware' => 'auth', 'uses' =>  'UserController@get_user']);

$router->post('/test', 'TestController@addmesimpay'); 



