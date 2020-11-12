<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
	protected $fillable = [
		'name',
		'choose',
	];
    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($project) {
    //         $project->user_id = auth()->user()->id;
    //     });
    // }
    
    
	public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function tickets()
    {
    	return $this->hasMany(Ticket::class);
    }
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
