<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use DB;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
{
    //Protected module permission by slug
    public function __construct()
    {
        $this->middleware('perm.acc:permission');
    }

    //public index permission
    public function index()
    {
        return view('panel.user-management.permission.index');
    }
	
    //find permission
    public function find(Request $request){
		
		if($request->id){
			$permission = Permission::where('slug', $request->slug)->first();
			if(count($permission) > 0){
				return ($request->id == $permission->id ? 'true' : 'false');
			}else{
				return 'true';
			}
		}else{
			return (Permission::where('slug', $request->slug)->first() ? 'false' : 'true' );	
		}
	}
	
    //view form create 
    public function create()
    {
		$permissions = Permission::where('type', 'module-menu')->where('parent', null)->get();
        return view('panel.user-management.permission.form-create')->with(['permissions' => $permissions]);
    }

    //store data permission
    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
		$permission->slug = $request->slug;
		$permission->type = $request->type;
		if($request->type == 'module-menu'){
			$permission->icon = $request->icon;
			$permission->parent = $request->parent;
		}
        $permission->description = $request->description;
        $permission->guard_name = 'web';
        $permission->save();
        
        return redirect()->route('permission.index')->with('toastr', 'permission');
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $permissions = Permission::select(['id', 'name', 'slug', 'type', 'created_at']);
        
        return Datatables::of($permissions)
            ->addColumn('action', function ($permission) {
                return 
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('permission.edit',['id' => $permission->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit permission</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('permission.destroy',['id' => $permission->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="button" onclick="removeList($(this))"  class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    //view form edit
    public function edit($id)
    {
        $permission = Permission::find($id);
		$permissions = Permission::where('type', 'module-menu')->where('parent', null)->get();
        return view('panel.user-management.permission.form-edit')->with(['permission'=>$permission,'permissions'=>$permissions]);
    }

    //update data permission
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->name = $request->name;
		$permission->slug = $request->slug;
		$permission->type = $request->type;
		if($request->type == 'module-menu'){
			$permission->icon = $request->icon;
			$permission->parent = $request->parent;
		}
        $permission->description = $request->description;
        
        $permission->save();
        return redirect()->route('permission.index')->with('update', 'permission');
    }

    //delete data permission
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        
        return redirect()->route('permission.index')->with('dlt', 'permission');
    }
}
