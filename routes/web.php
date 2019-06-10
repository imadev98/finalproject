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
$router->get('/',function(){
  return 'hello im here';
});

$router->post('/register', 'AuthController@register');
$router->post('/login1', 'AuthController@Login');
$router->post('/AddRole', 'AuthController@AddRole');
$router->get('/ShowRoles', 'AuthController@ShowRoles');

$router->get('/ShowRole/{id}', 'AuthController@ShowRole');
$router->put('/updateRole/{id}', 'AuthController@updateRole');
$router->get('/ShowUsers', 'AuthController@ShowUsers');
$router->get('/ShowUser/{id}', 'AuthController@ShowUser');
$router->put('/updateUser/{id}', 'AuthController@updateUser');
$router->put('/updateUserRole/{id}', 'AuthController@updateUserRole');





$router->group(['middleware' => 'auth'], function ($router) {

     $router->get('/test5', 'AuthController@test');
     $router->post('/reservation', 'ResrvationsController@reserver');
   
    
    });
 /*
  |--------------------------------------------------------------------------
  | DeliveryController
  |--------------------------------------------------------------------------
  |
  */

  $router->post('/demandeDelivery', 'DeliveryController@demandeDelivery');
  $router->get('/showAll', 'DeliveryController@showAll');
  $router->get('/ShowOne/{id}', 'DeliveryController@ShowOne');
  $router->put('/updateDelivery/{id}', 'DeliveryController@updateDelivery');
  $router->put('/updateAddress/{id}', 'DeliveryController@updateAddress');
  $router->delete('/annulerDel/{id}', 'DeliveryController@annulerDel');
  $router->get('/showReqestsDel', 'DeliveryController@showReqestsDel');
  $router->get('/showReqestDel/{id}', 'DeliveryController@showReqestDel');
  $router->put('/updateReqestDel/{id}', 'DeliveryController@updateReqestDel');
  $router->delete('/annulerReqestDel/{id}', 'DeliveryController@annulerReqestDel');
  



 
$router->post('/login', 'LoginController@login');




$router->get('/reservation', 'ResrvationsController@reserver');
$router->put('/reservation', 'ResrvationsController@reserver');
$router->delete('/reservation', 'ResrvationsController@annuler');

$router->get('/sortdate', 'ResrvationsController@filterReqest');
$router->get('/sorttoday', 'ResrvationsController@filterReqestToday');
$router->post('/demande', 'ResrvationsController@demande');

$router->post('/reduction', 'PaymentControllersController@reductions');



$router->post('/gestion', 'GestionsController@ajouter');
$router->get('/gestion', 'GestionsController@showall');
$router->put('/gestion/{id}', 'GestionsController@update');
$router->get('/gestion/{id}', 'GestionsController@edit');
$router->delete('/gestion', 'GestionsController@ajouter');

$router->post('/test', 'TestController@addmesimpay'); 



$router->post('/delivery', 'DeliveryController@delivery_now');



