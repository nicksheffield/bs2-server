<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;
	
	protected $table = 'products';
	
	protected $fillable = [
		'name', 'product_type_id', 'limitless'
	];

	protected $appends = [
		'unit_count'
	];
	
	public function units() {
		return $this->hasMany('App\Models\Unit', 'product_id');
	}
	
	public function type() {
		return $this->belongsTo('App\Models\Product_Type', 'product_type_id');
	}
	
	public function group_type_products() {
		return $this->hasMany('App\Models\Group_TypeProduc');
	}
	
	public function booking_products() {
		return $this->hasMany('App\Models\BookingProduct');
	}
	
	public function kit_products() {
		return $this->hasMany('App\Models\KitProduct');
	}

	public function getUnitCountAttribute() {
		return $this->units()->count();
	}
}
