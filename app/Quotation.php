<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{


    /**
     * Sets table name.
     *
     * @var string
     */
    protected $table = 'quotation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'quotation_number',
        'phases_id',
        'features',
    ];

    public function getFeaturesAttribute($features)
    {
        return json_decode($features);
    }

    public function project()
    {
    	return $this->belongsTo(Project::class);
    }
}
