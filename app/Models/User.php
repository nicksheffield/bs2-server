<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
	use SoftDeletes;

	protected $fillable = [
		'name', 'email', 'phone', 'group_id', 'admin', 'id_number', 'can_book', 'can_book_reason', 'dob', 'active'
	];

	protected $appends = [
		'role'
	];

	protected $hidden = [
		'password', 'remember_token',
	];
	
	public function group() {
		return $this->belongsTo('App\Models\Group', 'group_id');
	}
	
	public function bookings() {
		return $this->hasMany('App\Models\Booking', 'user_id');
	}
	
	public function notes() {
		return $this->hasMany('App\Models\Note', 'user_id')->orderBy('created_at', 'DESC');
	}
	
	public function tutors() {
		return $this->hasMany('App\Models\Tutor');
	}

	public function getRoleAttribute() {
		switch($this->admin) {
			case 1:
				return 'Staff';
				break;
			case 2:
				return 'Manager';
				break;
			default:
				return 'Student';
				break;
		}
	}
}
