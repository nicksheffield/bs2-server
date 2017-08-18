<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Kit extends Model
{
	use SoftDeletes;
	
	protected $table = 'kits';

	protected $fillable = [
		'name'
	];

	protected $appends = [
		'product_count'
	];

	public function kit_products() {
		return $this->hasMany('App\Models\KitProduct');
	}

	public function getProductCountAttribute() {
		return $this->kit_products()->count();
	}
}
