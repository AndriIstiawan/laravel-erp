<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class MasterRejects extends Moloquent
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'master_rejects';
    protected $fillable = [
        'name','type','created_by', 'updated_by',
        'deleted_by', 'created_at', 'updated_at', 'deleted_at', 'created_at'
    ];
    protected $hidden = [
        'created_by', 'updated_by', 'deleted_by', 'updated_at', 'deleted_at'
    ];
}
