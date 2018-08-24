<?php

Route::get('/cookie/set/{email}',        'CookieController@setCookie');
Route::get('/cookie/set/{email}/{name}', 'CookieController@setCookie');
Route::get('/cookie/get/{cookie}',       'CookieController@getCookie');
Route::get('/cookie/clear/{cookie}',     'CookieController@clear');
Route::get('/getall',                    'CookieController@getAll');

Route::get('/',                          'SignupsController@index');
Route::get('/signup/store',              'SignupsController@store')->middleware('guest');
Route::get('/signup/thankyou',           'SignupsController@thankyou')->middleware('guest');
Route::get('/signup/verify/{token}',     'SignupsController@update')->middleware('guest');

Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('/advisors/download',             'DownloadsController@getAdvisors');
    Route::get('/signup/download',               'DownloadsController@index');
    Route::post('/signup/download/{key}/{done}', 'DownloadsController@index');
    Route::post('/signup/csv/list',              'DownloadsController@list');
    Route::get('/signup/csv/create/{update}',    'DownloadsController@create');
});

Route::get('/about',                  'CasualController@about');
Route::get('/blog',                   'CasualController@blog');

Route::get('/contact',                'EmailController@contact');      // this is the form for contacting company
Route::post('/contact',               'EmailController@contactUs');    // this sends the email

Route::post('/contact/{advisor}',     'EmailController@contactAdvisor');// contact advisor form
Route::post('/send/{advisor}',        'EmailController@send');          // send email to advisor

Route::get('/search',                 'AdvisorsController@search');

Route::view('/terms',                 'casual.terms');
Route::view('/privacy',               'casual.privacy');

Route::prefix('advisors')->group(function () {
    Route::get('/',                   'AdvisorsController@index');
    Route::get('/results',            'AdvisorsController@facebookPixel');
    Route::get('/{advisor}',          'AdvisorsController@show'); 
    Route::get('/page/{page}',        'AdvisorsController@page');   // this also works for /page/search
    Route::get('/resort/{order}',     'AdvisorsController@resort'); 
    Route::get('/range/{miles}',      'AdvisorsController@range'); 
    Route::get('/feeRange/{fee}',     'AdvisorsController@feeRange'); 
});

Route::get('/welcome/{user}',         'AdvisorsController@welcome'); 
Route::post('/store',                 'AdvisorsController@store'); 
Route::get('/calculateFee',           'AdvisorsController@calculateFee');

// not using, but good example
Route::get('/list/{page}', function($page) {
	return view('advisors.calculateFee', compact('page'));
});

Route::get('/geocode',                'GeocodeController@index');
Route::get('/geocode/{advisor}',      'GeocodeController@store');

Route::get('/rss',                    'RssController@index');

/* Login */
Auth::routes();

/* Register */
Route::post('/register',              'Auth\RegisterController@store')->middleware('guest');
Route::get('/claim/{advisor}',        'Auth\RegisterController@claim');
Route::post('/connect/{advisor}',     'Auth\RegisterController@connect');

Route::get('/home',                   'HomeController@index');  

// this page requires that you be logged in 
Route::group(['middleware' => ['auth']], function () {
    Route::get('/update',                    'Auth\LoginController@update');
    Route::get('/update/{advisor}',          'AdvisorsController@display');
    
    Route::get('/logout',                    'SessionsController@destroy')->name('logout');

    Route::get('/edit/{advisor}',            'AdvisorsController@edit'); 
    Route::get('/update/advisor/{advisor}',  'AdvisorsController@update'); 
    Route::get('/advisor/entry/{user}',      'AdvisorsController@entryForm');

    Route::post('/storeRate/{advisor}',      'RatesController@store'); 
    Route::get('/rates/{advisor}',           'RatesController@edit'); 
    Route::post('/done/{advisor}',           'RatesController@done'); 
    Route::get('/finishedRates',             'RatesController@show'); 
    Route::post('/destroy/{advisor}',        'RatesController@destroy');

    Route::post('/upload/{advisor}',         'ImportController@upload')->name('upload');
    Route::get('/import', function () {
        return view('import.picture');
    });
});

// this page requires that you be logged in AND be an Admin
Route::group(['middleware' => ['auth','admin']], function () {
    // validator fail is a GET, but we used POST because we are POSTing
    Route::get('/admin/advisors/list',          'AdvisorsController@index');

    Route::get('/admin/create', function() {
    	return view('advisors.entry');
    });

    Route::get('/admin/advisor/{id}',           'AdminController@show');
    Route::post('/admin/advisor/{id}/inactive', 'AdminController@inactive');
    Route::post('/admin/advisor/{id}/delete',   'AdvisorsController@delete');

});
