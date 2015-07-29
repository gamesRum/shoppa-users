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
$app->group(['prefix' => '/api/v1', 'namespace' => 'App\Http\Controllers'], function() use($app) {
    define('HTTP_OK', 200);
    define('HTTP_BAD_REQUEST', 400);
    define('HTTP_UNAUTHORIZED', 401);
    define('HTTP_NOT_FOUND', 404);
    define('HTTP_SERVER_ERROR', 500);

    $app->get('/', function () use ($app) {
        return $app->welcome();
    });

    $app->get('user', 'UserController@index');
    $app->post('user', 'UserController@create');
    $app->get('user/{id}', 'UserController@read');
    $app->put('user/{id}', 'UserController@update');
    $app->delete('user/{id}', 'UserController@delete');

    $app->get('log', 'LogController@index');
    $app->post('log', 'LogController@create');
    $app->get('log/{id}', 'LogController@read');

});
