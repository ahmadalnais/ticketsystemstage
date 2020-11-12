<?php

namespace App;

use App\Observers\TicketObserver;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Ticket extends Model
{

    //protected $guard_name = 'web';

    protected $fillable = [
        'description',
        'device' ,
        'url',
        'Status',
        'project_id',
        'browser_id',
        'title',
        'attachment',
        'attachment_name',
    ];
    
    public function project()
    {
    	return $this->belongsTo(Project::class);
    }
    public function reply()
    {
        return $this->hasMany(Reply::class);
    }
}
