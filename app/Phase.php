<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected $fillable = [
		'name',
	];

	protected $table = 'phase';

	// public function features()
	// {
	// 	return $this->hasMany(Feature::class);
	// }
}
