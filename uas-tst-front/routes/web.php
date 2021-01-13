<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});
Route::post('/login-account', 'AkunController@login')->name('login-account');
Route::post('/register-account', 'AkunController@register')->name('register-account');

Route::get('/home/{id}-{token}', 'PageController@home')->name('home');

Route::get('/log/{id}-{token}','PageController@log')->name('log');
Route::post('/log-post/{token}','PageController@logPost')->name('log-post');
Route::post('/log-edit/{logId}','PageController@logEdit')->name('log-edit');
Route::post('/log-update/{logId}','PageController@logUpdate')->name('log-update');
Route::get('/history/{id}-{token}','PageController@logHistory')->name('log-history');

Route::post('/suggestion/{logId}-{token}','PageController@suggestion')->name('suggestion');

