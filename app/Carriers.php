<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Carriers extends Moloquent
{
    use Notifiable;
	use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'carriers';
  protected $fillable = [
    'name', 'price','status','currency',
    'created_at', 'updated_at', 'deleted_at'
  ];
  protected $hidden = [
    'updated_at', 'deleted_at'
  ];
}
