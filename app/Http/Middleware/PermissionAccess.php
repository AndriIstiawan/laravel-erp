<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class PermissionAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
		$count = User::where('_id', Auth::user()->id)
			->where('accessPermissions', 'elemMatch', array('slug' => $role))->count();
		if($count == 0){
			
			$count = User::where('_id', Auth::user()->id)
				->where('modulePermissions', 'elemMatch', array('slug' => $role))->count();
			
			if($count == 0){
				$count = User::where('_id', Auth::user()->id)
					->where('modulePermissions.child', 'elemMatch', array('slug' => $role))->count();
				

				if($count == 0){ 
					if(Auth::user()->email != env('ROOT_USERNAME')){
						return redirect('/');	
					} 
				}
			}
		}
		
        return $next($request);
    }
}
