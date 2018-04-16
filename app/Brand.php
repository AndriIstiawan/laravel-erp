<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class Brand extends Moloquent
{
    use Notifiable;
	use SoftDeletes;
    protected $fillable = [
        'name', 'slug',
    ];
}
