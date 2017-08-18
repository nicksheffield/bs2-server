<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KitProduct extends Model
{
	protected $table = 'kit_product';

	public $fillable = [
		'quantity'
	];

	public function kit() {
		return $this->belongsTo('App\Models\Kit');
	}

	public function product() {
		return $this->belongsTo('App\Models\Product');
	}
}
