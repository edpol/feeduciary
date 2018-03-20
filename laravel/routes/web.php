<?php
Route::get('/',                        'CasualController@index');
Route::get('/about',                   'CasualController@about');
Route::get('/blog',                    'CasualController@blog');
Route::get('/contact',                 'CasualController@contact');

Route::view('/terms',   'casual.terms');
Route::view('/privacy', 'casual.privacy');

Route::post('/send',                   'EmailController@send');

Route::post('/contact/{advisor}',      'AdvisorsController@contact');

Route::prefix('advisors')->group(function () {
    Route::get('/',               'AdvisorsController@index');
    Route::get('/{advisor}',      'AdvisorsController@show'); 
    Route::get('/page/{page}',    'AdvisorsController@page'); 
    Route::get('/resort/{order}', 'AdvisorsController@resort'); 
    Route::get('/range/{miles}',  'AdvisorsController@range'); 
    Route::get('/feeRange/{fee}', 'AdvisorsController@feeRange'); 
});

Route::post('/store',                  'AdvisorsController@store'); 
Route::get('/edit/{advisor}',          'AdvisorsController@edit'); 
Route::get('/update/{advisor}',        'AdvisorsController@update'); 
Route::get('/calculateFee',            'AdvisorsController@calculateFee');

// not using, but good example
Route::get('/list/{page}', function($page) {
	return view('advisors.calculateFee', compact('page'));
});


// validator fail is a GET, but we used POST because we are POSTing
Route::post('/storeRate/{advisor}',    'RatesController@store'); 
Route::get('/rates/{advisor}',         'RatesController@edit'); 
Route::post('/done/{advisor}',         'RatesController@done'); 
Route::get('/finishedRates',           'RatesController@show'); 
Route::post('/destroy/{advisor}',      'RatesController@destroy');

Route::get('/geocode',                 'GeocodeController@index');
Route::get('/geocode/{advisor}',       'GeocodeController@store');

Route::get('/rss',                     'RssController@index');

/* Login */
Auth::routes();

Route::get('/update',                  'Auth\LoginController@update');

/* Register */
Route::post('/register',               'Auth\RegisterController@store');
Route::get('/claim/{advisor}',         'Auth\RegisterController@claim');
Route::post('/connect/{advisor}',      'Auth\RegisterController@connect');

Route::get('/logout',                  'SessionsController@destroy');

Route::get('/home',                    'HomeController@index');  

// this page requires that you be logged in AND be an Admin
Route::get('/admin/advisors', ['middleware' => ['auth', 'admin'], function() {
    $advisors = feeduciary\Advisor::paginate(10); //all();
	return view('advisors.index', compact('advisors'));
}]);
Route::post('/admin/create', ['middleware' => ['auth', 'admin'], function() {
    $state = optionState();
	return view('advisors.entry', compact('state'));
}]);
Route::post('/admin/advisor/{id}', 'AdvisorsController@delete');

Route::get('/admin/advisors/{id}', 'AdminController@show');
Route::post('/admin/inactive/{id}','AdminController@inactive');

/*
// here we don't need a controller checking if we are logged in and admin, we just go to the view
Route::get('/admin/advisors/{id}', ['middleware' => ['auth', 'admin'], function($id) {
    $advisor = feeduciary\Advisor::find($id);
	$rates = $advisor->rates;
	return view('advisors.edit', compact('advisor','rates'));
}]);

Route::get('/admin/advisors', 'AdminController@index')->middleware('auth', 'admin');
*/
