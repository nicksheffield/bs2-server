<?php

use Illuminate\Http\Request;

Route::resource('/user',               'UserController');
Route::resource('/group',              'GroupController');
Route::resource('/group-type',         'GroupTypeController');
Route::resource('/product',            'ProductController');
Route::resource('/product-type',       'ProductTypeController');
Route::resource('/unit',               'UnitController');
Route::resource('/kit',                'KitController');
Route::resource('/booking',            'BookingController');

// Route::resource('/tutor',              'TutorController');
// Route::resource('/booking_product',    'BookingProductController');
// Route::resource('/kit_product',        'KitProductController');
// Route::resource('/group_type_product', 'GroupTypeProductController');

Route::get('{all?}', function() {
	return response()->json(['error' => 'Something you\'re trying to load doesn\'t exist'], 404);
})->where('all', '.*');