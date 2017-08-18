<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingProduct extends Model
{
	protected $table = 'booking_product';

	public $fillable = [
		'notes', 'returned_at', 'returned_by_id'
	];

	public function product() {
		return $this->belongsTo('App\Models\Product');
	}

	public function booking() {
		return $this->belongsTo('App\Models\Booking');
	}

	public function unit() {
		return $this->belongsTo('App\Models\Unit');
	}
}
