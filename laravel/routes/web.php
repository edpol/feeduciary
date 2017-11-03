<?php

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

Route::get('/',                     'CasualController@index');

Route::get('/about',                'CasualController@about');

Route::get('/blog',                 'CasualController@blog');

Route::get('/contact',              'CasualController@contact');

Route::get('/advisors',             'AdvisorsController@index');

Route::get('/advisors/{advisor}',   'AdvisorsController@show'); 

Route::get('/advisors/page/{page}', 'AdvisorsController@page'); 

Route::get('/geocode',              'GeocodeController@index');

Route::get('/geocode/{advisor}',    'GeocodeController@store');

Route::get('/calculateFee',         'AdvisorsController@calculateFee');
