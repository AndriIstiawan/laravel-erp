<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Discounts extends Moloquent
{
    use Notifiable;
	use SoftDeletes;
    
    protected $fillable = [
        'code','price','discount','time','priceafter',
    ];
}
