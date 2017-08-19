<?php

/**
 * Middlewares
 * 
 * 'auth:api' means any user sending a valid oauth token can use the route
 * 'all'      means any user can use the route
 * 'student'  means only students can use the route
 * 'staff'    means only staff can use the route
 * 'manager'  means only managers can use the route
 * 'employed' means staff and managers can use the route
 **/

Route::middleware(['auth:api'])->group(function() {
	Route::get('/user',         'UserController@index'  )->middleware('all');
	Route::get('/user/{id}',    'UserController@show'   )->middleware('all');
	Route::post('/user',        'UserController@store'  )->middleware('employed');
	Route::put('/user/{id}',    'UserController@update' )->middleware('all');
	Route::delete('/user/{id}', 'UserController@destroy')->middleware('employed');

	Route::get('/group',         'GroupController@index'  )->middleware('manager');
	Route::get('/group/{id}',    'GroupController@show'   )->middleware('manager');
	Route::post('/group',        'GroupController@store'  )->middleware('manager');
	Route::put('/group/{id}',    'GroupController@update' )->middleware('manager');
	Route::delete('/group/{id}', 'GroupController@destroy')->middleware('manager');

	Route::get('/group-type',         'GroupTypeController@index'  )->middleware('manager');
	Route::get('/group-type/{id}',    'GroupTypeController@show'   )->middleware('manager');
	Route::post('/group-type',        'GroupTypeController@store'  )->middleware('manager');
	Route::put('/group-type/{id}',    'GroupTypeController@update' )->middleware('manager');
	Route::delete('/group-type/{id}', 'GroupTypeController@destroy')->middleware('manager');

	Route::get('/product',         'ProductController@index'  )->middleware('manager');
	Route::get('/product/{id}',    'ProductController@show'   )->middleware('manager');
	Route::post('/product',        'ProductController@store'  )->middleware('manager');
	Route::put('/product/{id}',    'ProductController@update' )->middleware('manager');
	Route::delete('/product/{id}', 'ProductController@destroy')->middleware('manager');

	Route::get('/product-type',         'ProductTypeController@index'  )->middleware('manager');
	Route::get('/product-type/{id}',    'ProductTypeController@show'   )->middleware('manager');
	Route::post('/product-type',        'ProductTypeController@store'  )->middleware('manager');
	Route::put('/product-type/{id}',    'ProductTypeController@update' )->middleware('manager');
	Route::delete('/product-type/{id}', 'ProductTypeController@destroy')->middleware('manager');

	Route::get('/unit',         'UnitController@index'  )->middleware('manager');
	Route::get('/unit/{id}',    'UnitController@show'   )->middleware('manager');
	Route::post('/unit',        'UnitController@store'  )->middleware('manager');
	Route::put('/unit/{id}',    'UnitController@update' )->middleware('manager');
	Route::delete('/unit/{id}', 'UnitController@destroy')->middleware('manager');

	Route::get('/kit',         'KitController@index'  )->middleware('manager');
	Route::get('/kit/{id}',    'KitController@show'   )->middleware('manager');
	Route::post('/kit',        'KitController@store'  )->middleware('manager');
	Route::put('/kit/{id}',    'KitController@update' )->middleware('manager');
	Route::delete('/kit/{id}', 'KitController@destroy')->middleware('manager');

	Route::get('/booking',         'BookingController@index'  )->middleware('all');
	Route::get('/booking/{id}',    'BookingController@show'   )->middleware('all');
	Route::post('/booking',        'BookingController@store'  )->middleware('all');
	Route::put('/booking/{id}',    'BookingController@update' )->middleware('all');
	Route::delete('/booking/{id}', 'BookingController@destroy')->middleware('all');
});

Route::post('/logout', 'AccessController@logout');

Route::get('{all?}', function() {
	return response()->json(['error' => 'Something you\'re trying to load doesn\'t exist'], 404);
})->where('all', '.*');