<?php

use Illuminate\Http\Request;

Route::resource('/user', 'UserController');
Route::resource('/group', 'GroupController');
Route::resource('/group-type', 'GroupTypeController');
Route::resource('/product', 'ProductController');
Route::resource('/product-type', 'ProductTypeController');
Route::resource('/unit', 'UnitController');
Route::resource('/kit', 'KitController');

Route::get('{all?}', function() {
	return response()->json(['error' => 'Something you\'re trying to load doesn\'t exist'], 404);
})->where('all', '.*');