<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Custom extends Moloquent
{
    use Notifiable;
	use SoftDeletes;
    
    protected $fillable = [
        'id_customer','name_customer','name','total',
    ];
}
