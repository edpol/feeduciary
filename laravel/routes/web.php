<?php
use feeduciary\Advisor;

Route::get('/',                       'CasualController@index');
Route::get('/about',                  'CasualController@about');
Route::get('/blog',                   'CasualController@blog');

Route::get('/contact',                'EmailController@contact');      // this is the form for contacting company
Route::post('/contact',               'EmailController@contactUs');    // this sends the email

Route::post('/contact/{advisor}',     'EmailController@contactAdvisor');// contact advisor form
Route::post('/send/{advisor}',        'EmailController@send');          // send email to advisor

Route::view('/terms',   'casual.terms');
Route::view('/privacy', 'casual.privacy');

Route::prefix('advisors')->group(function () {
    Route::get('/',                   'AdvisorsController@index');
    Route::get('/{advisor}',          'AdvisorsController@show'); 
    Route::get('/page/{page}',        'AdvisorsController@page'); 
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
    Route::get('/update',                  'Auth\LoginController@update');

    Route::get('/logout',                  'SessionsController@destroy');

    Route::get('/edit/{advisor}',          'AdvisorsController@edit'); 
    Route::get('/update/{advisor}',        'AdvisorsController@update'); 
    Route::get('/advisor/entry/{user}',    'AdvisorsController@entryForm');

    Route::post('/storeRate/{advisor}',    'RatesController@store'); 
    Route::get('/rates/{advisor}',         'RatesController@edit'); 
    Route::post('/done/{advisor}',         'RatesController@done'); 
    Route::get('/finishedRates',           'RatesController@show'); 

    Route::post('/upload/{advisor}',       'ImportController@upload')->name('upload');
    Route::get('/import', function () {
        return view('import.picture');
    });
});

// this page requires that you be logged in AND be an Admin
Route::group(['middleware' => ['auth','admin']], function () {
    // validator fail is a GET, but we used POST because we are POSTing
    Route::post('/destroy/{advisor}',      'RatesController@destroy');

    Route::get('/admin/advisors/list', function() {
        $advisors = feeduciary\Advisor::orderBy('name','asc')->paginate(100); //all();
        return view('advisors.index', compact('advisors'));
    });

    Route::get('/admin/create', function() {
    	return view('advisors.entry');
    });

    Route::get('/admin/advisor/{id}',   'AdminController@show');
    Route::post('/admin/advisor/{id}',  'AdvisorsController@delete');
    Route::post('/admin/inactive/{id}', 'AdminController@inactive');

});
