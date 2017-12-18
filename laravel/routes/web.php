<?php

Route::get('/',                     'CasualController@index');

Route::get('/about',                'CasualController@about');

Route::get('/blog',                 'CasualController@blog');

Route::get('/contact',              'CasualController@contact');

Route::get('/advisors',             'AdvisorsController@index');

Route::get('/advisors/{advisor}',   'AdvisorsController@show'); 

Route::get('/advisors/page/{page}', 'AdvisorsController@page'); 

Route::post('/store',               'AdvisorsController@store'); 

Route::get('/edit/{advisor}',       'AdvisorsController@edit'); 

Route::post('/update/{advisor}',    'AdvisorsController@update'); 

Route::get('/calculateFee',         'AdvisorsController@calculateFee');

Route::post('/storeRates',          'RatesController@store'); 

// validator fail is a GET, but we used POST because we are POSTing
Route::get('/newRate/{advisor}',   'RatesController@newRate'); 

Route::get('/rates/{advisor}',     'RatesController@edit'); 

Route::match(['get', 'post'], '/done/{advisor}',      'RatesController@done'); 

Route::get('/finishedRates',        'RatesController@show'); 

Route::get('/ratesInfo',            'RatesController@index');

Route::post('/destroy/{advisor}',   'RatesController@destroy');

Route::get('/geocode',              'GeocodeController@index');

Route::get('/geocode/{advisor}',    'GeocodeController@store');

Route::get('/rss',                  'Controller@rss');

/* Login */
Auth::routes();

Route::get('/update',     'Auth\LoginController@update');

/* Register */
Route::get('/register',   'RegistrationController@index');

Route::post('/register', [ 'as' => 'register', 'uses' => 'RegistrationController@store']);

Route::get('/logout',     'SessionsController@destroy');

