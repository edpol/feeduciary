<?php

Route::get('/',                     'CasualController@index');

Route::get('/about',                'CasualController@about');

Route::get('/blog',                 'CasualController@blog');

Route::get('/contact',              'CasualController@contact');

Route::get('/advisors',             'AdvisorsController@index');

Route::get('/advisors/{advisor}',   'AdvisorsController@show'); 

Route::get('/advisors/page/{page}', 'AdvisorsController@page'); 

Route::post('/store',               'AdvisorsController@store'); 

Route::post('/edit/{advisor}',      'AdvisorsController@edit'); 

Route::post('/update/{advisor}',    'AdvisorsController@update'); 

Route::get('/calculateFee',         'AdvisorsController@calculateFee');

Route::post('/storeRates',          'RatesController@store'); 

Route::post('/newRate/{advisor}',   'RatesController@newRate'); 

Route::post('/rates/{advisor}',     'RatesController@edit'); 

Route::post('/done/{advisor}',      'RatesController@done'); 

Route::get('/finishedRates',        'RatesController@show'); 

Route::get('/ratesInfo',            'RatesController@index');

Route::get('/geocode',              'GeocodeController@index');

Route::get('/geocode/{advisor}',    'GeocodeController@store');

Auth::routes();

Route::get('/register',   'RegistrationController@index');

Route::post('/register', [ 'as' => 'register', 'uses' => 'RegistrationController@store']);

Route::get('/logout',     'SessionsController@destroy');

Route::get('/update',     'Auth\LoginController@update');

Route::get('/rss',        'Controller@rss');
