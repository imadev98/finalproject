<?php
use Illuminate\Support\Facades\Schema;
/*
|--------------------------------------------------------------------------
| routerlication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an routerlication.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/',function(){
  return 'hello im here';
});
$router->get('/showReqests/{id}', 'ResrvationsController@showReqests');
$router->get('/Count', 'ResrvationsController@Count');


/*
|--------------------------------------------------------------------------
| AuthController Routes
|--------------------------------------------------------------------------
|
*/
$router->post('/demande', 'ResrvationsController@demande');

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@Login');


$router->post('/showAvilable', 'ResrvationsController@showAvilable');
$router->get('/ShowDishes', 'GestionFoodController@ShowDishes');
$router->get('/showAllres', 'ResrvationsController@showAll');
$router->get('/showConfRes', 'ResrvationsController@showConfirmed');
$router->get('/showCancRes', 'ResrvationsController@showCanceled');

$router->post('/contact', 'GestionsController@Contact');


$router->group(['middleware' => 'auth'], function ($router) {
  $router->get('/Countclient', 'ResrvationsController@Count_client');
 
  $router->get('/showConfClient', 'ResrvationsController@showConfClient');
$router->get('/showCanClient', 'ResrvationsController@showCanClient');
  /*
|--------------------------------------------------------------------------
| AuthController Routes
|--------------------------------------------------------------------------
|
*/

 $router->post('/reservation', 'ResrvationsController@reserver');

  $router->post('/AddRole', 'AuthController@AddRole');
  $router->get('/ShowRoles', 'AuthController@ShowRoles');
   $router->get('/ShowRole/{id}', 'AuthController@ShowRole');
   $router->put('/updateRole/{id}', 'AuthController@updateRole');
   $router->get('/ShowUsers', 'AuthController@ShowUsers');
   $router->get('/ShowUser/{id}', 'AuthController@ShowUser');
    $router->put('/updateUser/{id}', 'AuthController@updateUser');
    $router->put('/updateUserRole/{id}', 'AuthController@updateUserRole');
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

/*
  |--------------------------------------------------------------------------
  | GestionsController
  |--------------------------------------------------------------------------
  |
  */

  
$router->post('/addtime', 'GestionsController@add_time');
$router->get('/showallWork', 'GestionsController@showall_Work');
$router->put('/updatetime/{id}', 'GestionsController@update_time');
$router->post('/addexception', 'GestionsController@add_exception');

/**
 * Routes for resource Tables
 */
$router->post('/gestion', 'GestionsController@ajouter');
$router->get('/gestion', 'GestionsController@showall');
$router->put('/gestion/{id}', 'GestionsController@update');
$router->get('/gestion/{id}', 'GestionsController@show');
$router->delete('/gestion/{id}', 'GestionsController@delete');

$router->put('/restore/{id}', 'GestionsController@restore');
/*
  |--------------------------------------------------------------------------
  | ReservationController
  |--------------------------------------------------------------------------
  |
  */

  
  $router->delete('/reservation/{id}', 'ResrvationsController@annuler');
  
  $router->get('/Showreservation/{id}', 'ResrvationsController@ShowOne');
  $router->get('/sortdate', 'ResrvationsController@filterReqest');
  $router->get('/sorttoday', 'ResrvationsController@filterReqestToday');
  
  $router->put('/updateReservation/{id}', 'ResrvationsController@updateReservation');






/*
  |--------------------------------------------------------------------------
  | GestionFoodController
  |--------------------------------------------------------------------------
  |
  */
/**
 * Routes for resource dishes
 */

$router->get('ShowDishes/{id}', 'GestionFoodsController@ShowDishe');
$router->post('AddDishe', 'GestionFoodsController@AddDishe');
$router->put('updatedish/{id}', 'GestionFoodsController@update');

$router->delete('/deletedish/{id}', 'GestionFoodController@deletedish');


/**
 * Routes for resource Addition
 **/
$router->get('ShowAdditions', 'GestionFoodsController@ShowAdditions');
$router->get('ShowAdditions/{id}', 'GestionFoodsController@ShowAddition');
$router->post('AddAddition', 'GestionFoodsController@AddAddition');
$router->put('updateAddition/{id}', 'GestionFoodsController@updateAddition');
$router->delete('GestionFood/{id}', 'GestionFoodsController@remove');
/**
 * Routes for resource Vehicle
 */
$router->get('ShowVehicles', 'GestionFoodsController@ShowVehicles');
$router->get('ShowVehicles/{id}', 'GestionFoodsController@ShowVehicle');
$router->post('AddVehicle', 'GestionFoodsController@AddVehicle');
$router->put('updateVehicle/{id}', 'GestionFoodsController@updateVehicle');
$router->delete('GestionFood/{id}', 'GestionFoodsController@remove');
   
  /**
  * Routes for resource Payment
  */

$router->post('/reduction', 'PaymentControllersController@reductions');
    });
 
  



 



























