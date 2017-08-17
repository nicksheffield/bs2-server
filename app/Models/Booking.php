<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Booking extends Model
{
	use SoftDeletes;
	
	protected $table = 'bookings';
	
	protected $fillable = [
		'user_id', 'due_at', 'pickup_at', 'taken_at', 'closed_at', 'created_by_id', 'issued_by_id', 'closed_by_id'
	];

	protected $appends = [
		'status'
	];
	
	public function products() {
		return $this->belongsToMany('App\Models\Product', 'booking_product')->withPivot('id', 'unit_id', 'notes', 'returned_at')->withTimestamps();
	}

	public function user() {
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function created_by() {
		return $this->belongsTo('App\Models\User', 'created_by_id');
	}

	public function issued_by() {
		return $this->belongsTo('App\Models\User', 'issued_by_id');
	}

	public function closed_by() {
		return $this->belongsTo('App\Models\User', 'closed_by_id');
	}

	public function getStatusAttribute() {
		// Closed, Overdue, Issued, Booked
		if ($this->closed_at) {
			return 'Closed';
		}
		if ($this->taken_at) {
			if (Carbon::parse($this->due_at)->lt(Carbon::now())) {
				return 'Overdue';
			}
			return 'Issued';
		}
		return 'Booked';
	}
}
