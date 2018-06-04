<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Packaging extends Moloquent
{
  use Notifiable;
  use SoftDeletes;

  protected $table = 'packagings';
  protected $fillable = [
    'code', 'name', 'description', 'price', 'currency', 'created_by', 'updated_by',
    'deleted_by', 'created_at', 'updated_at', 'deleted_at'
  ];
  protected $hidden = [
    'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'
  ];
}
