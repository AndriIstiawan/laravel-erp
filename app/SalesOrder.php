<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class SalesOrder extends Moloquent
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'date','client','product','type','code','total','packaging','amount','package','realisasi','stockk','pending','balance','pendingpr','note','productattr',
    ];
}
