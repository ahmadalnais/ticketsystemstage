<?php

namespace App;

use App\Quotation;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
	protected $fillable = [
		'description',
		'price',
	];
    protected $table = 'features';

    // public function phases()
    // {
    // 	return $this->belongsTo(Phase::class);
    // }
}
