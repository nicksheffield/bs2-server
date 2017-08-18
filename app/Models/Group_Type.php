<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group_Type extends Model
{
	use SoftDeletes;
	
	protected $table = 'group_types';
	
	protected $fillable = [
		'code', 'name', 'group_type_id'
	];

	protected $appends = [
		'class_count'
	];
	
	public function groups() {
		return $this->hasMany('App\Models\Group', 'group_type_id');
	}
	
	public function group_type_products() {
		return $this->hasMany('App\Models\Group_TypeProduct');
	}

	public function getClassCountAttribute() {
		return $this->groups()->count();
	}
}
