<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Couriers extends Moloquent
{
  use Notifiable;
  use SoftDeletes;

  protected $table = 'couriers';
  protected $fillable = [
    'name', 'price','status','currency',
    'created_at', 'updated_at', 'deleted_at'
  ];
  protected $hidden = [
    'updated_at', 'deleted_at'
  ];
}
