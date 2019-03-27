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

$router->post('/aut/login', 'AuthController@register');





$router->post('/at/login', 'AuthController@updateProfile');

$router->group(['middleware' => 'auth'], function ($router) {

     $router->get('/test5', 'AuthController@test');
     $router->post('/reservation', 'ResrvationsController@reserver');
   
    
    });
    


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



$router->get('/reservation', 'ResrvationsController@reserver');
$router->put('/reservation', 'ResrvationsController@reserver');
$router->delete('/reservation', 'ResrvationsController@annuler');


$router->post('/demande', 'ResrvationsController@demande');





$router->post('/gestion', 'GestionsController@show');
$router->get('/gestion', 'GestionsController@showall');
$router->put('/gestion/{id}', 'GestionsController@update');
$router->get('/gestion/{id}', 'GestionsController@show');
$router->delete('/gestion', 'GestionsController@ajouter');
$router->get('/user/{id}', ['middleware' => 'auth', 'uses' =>  'UserController@get_user']);

$router->post('/test', 'TestController@addmesimpay'); 



