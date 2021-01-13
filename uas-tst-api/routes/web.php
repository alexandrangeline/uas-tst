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

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    // API For Auth
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    // API For getting Symptom List
    $router->get('/symptoms', 'SymptomController@symptomList');

    // API For Log
    $router->post('/log', 'LogController@logSubmit');
    $router->put('/log/update/{logId}', 'LogController@logUpdate');
    $router->get('/log/history/{userId}', 'LogController@logHistory');
    $router->get('/log/history-detail/{logId}', 'LogController@logDetail');
    $router->get('/log/suggestion/{logId}', 'LogController@getSuggestion');
});