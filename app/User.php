<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

use Illuminate\Auth\Authenticatable;
use Moloquent;
use App\SalesOrder;
use App\Permission;
use Auth;

class User extends Moloquent implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable;
	use SoftDeletes;
	use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	protected $dates = ['deleted_at'];
	
	public function modPermissions(){
	    $module_permisssion = Permission::where('type','module-menu')->where('parent',null)->get();
	    for($i=0; $i < $module_permisssion->count(); $i++){
		    $module_permisssion[$i]->child = Permission::where('parent',$module_permisssion[$i]->id)->get();
        }
        return $module_permisssion;
	}
	public function accPermissions(){
		$access_permisssion = Permission::where('type','access')->get();
		return $access_permisssion;
	}
	
	public function hasAcc($slug){
        $status = false;

        if(Auth::user()->email == env('ROOT_USERNAME')){
            $status = true;
        }else{
            $key = array_search($slug, array_column(Auth::user()->accessPermissions, 'slug'));
            if($key > -1 ){ $status = true; }
        }
		return $status;
	}

    public function countPOPending(){
        return SalesOrder::where('status','order')->count();
    }
}
