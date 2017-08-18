<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
	use SoftDeletes;
	
	protected $table = 'units';
	
	protected $fillable = [
		'serial_number', 'asset_number', 'unit_number', 'product_id', 'notes'
	];
	
	public function booking_products() {
		return $this->hasMany('App\Models\BookingProduct');
	}
	
	public function product() {
		return $this->belongsTo('App\Models\Product', 'product_id');
	}
}
