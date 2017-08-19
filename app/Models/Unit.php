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

	protected $appends = [
		'status'
	];
	
	public function booking_products() {
		return $this->hasMany('App\Models\BookingProduct')->has('booking');
	}
	
	public function product() {
		return $this->belongsTo('App\Models\Product', 'product_id');
	}

	public function getStatusAttribute() {
		foreach ($this->booking_products as $bp) {
			if (!$bp->booking) continue;
			if (!$bp->returned_at) return 'Out';
		}

		return 'In Stock';
	}
}
