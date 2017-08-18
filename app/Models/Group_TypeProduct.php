<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group_TypeProduct extends Model
{
	protected $table = 'group_type_product';

	public $fillable = [
		'quantity', 'days_allowed'
	];

	public function group_type() {
		return $this->belongsTo('App\Models\GroupType');
	}

	public function product() {
		return $this->belongsTo('App\Models\Product');
	}
}
