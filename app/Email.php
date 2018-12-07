<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Email extends Moloquent
{
    use Notifiable;
	use SoftDeletes;
    
    protected $fillable = [
        'adminId','memberEmail','subject','content','comment',
    ];
}
