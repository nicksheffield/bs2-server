<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
	protected $table = 'tutor';

	public function user() {
		return $this->belongsTo('App\Models\User');
	}
	
	public function group() {
		return $this->belongsTo('App\Models\Group');
	}
}
