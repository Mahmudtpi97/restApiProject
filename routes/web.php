<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->post('registration','RegistrationController@register');
$router->post('login','LoginController@login');


// Single Router Use by Middleware
$router->get('select',['middleware'=>'auth', 'uses'=>'DetailsController@allData']);
// Group Router Use by Middleware
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('ADbyData','DetailsController@ADbyData');
    $router->post('dataInsert','DetailsController@dataInsert');
    $router->put('dataUpdate/{name}','DetailsController@dataUpdate');
    $router->delete('dataDelete','DetailsController@dataDelete');
});

// random key generate
$router->get('key', function(){
    return \Illuminate\Support\Str::random(32);
});
