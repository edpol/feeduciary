<?php

Route::get('/',                     'CasualController@index');

Route::get('/about',                'CasualController@about');

Route::get('/blog',                 'CasualController@blog');

Route::get('/contact',              'CasualController@contact');

Route::post('/send',                'EmailController@send');
//Route::post('/send/{advisor}',      'AdvisorsController@send');

Route::post('/contact/{advisor}',   'AdvisorsController@contact');

Route::get('/advisors',             'AdvisorsController@index');

Route::get('/advisors/{advisor}',   'AdvisorsController@show'); 

Route::get('/advisors/page/{page}', 'AdvisorsController@page'); 

Route::post('/store',               'AdvisorsController@store'); 

Route::get('/edit/{advisor}',       'AdvisorsController@edit'); 

Route::post('/update/{advisor}',    'AdvisorsController@update'); 

Route::get('/calculateFee',         'AdvisorsController@calculateFee');

// validator fail is a GET, but we used POST because we are POSTing
Route::post('/storeRate/{advisor}', 'RatesController@store'); 

Route::get('/rates/{advisor}',      'RatesController@edit'); 

Route::post('/done/{advisor}',      'RatesController@done'); 

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
Route::post('/register',  'Auth\RegisterController@store');

Route::get('/logout',     'SessionsController@destroy');

