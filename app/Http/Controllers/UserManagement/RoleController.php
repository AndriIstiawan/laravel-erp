<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
{
    //Protected module role by slug
    public function __construct()
    {
        $this->middleware('perm.acc:role');
    }
    
    //public index role
    public function index()
    {
        return view('panel.user-management.role.index');
    }
    
    //view form create
    public function create()
    {
        return view('panel.user-management.role.form-create');
    }

    //store data role
    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->guard_name = 'web';
        $role->save();
        
        return redirect()->route('role.index')->with('toastr', 'role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
   public function show(Request $request, $action){
        $roles = role::select(['id', 'name', 'description', 'created_at']);
        
        return Datatables::of($roles)
            ->addColumn('action', function ($role) {
                return 
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('role.edit',['id' => $role->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit role</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('role.destroy',['id' => $role->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="button" onclick="removeList($(this))" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //view form edit
    public function edit($id)
    {
        $role = Role::find($id);
        return view('panel.user-management.role.form-edit')->with(['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update data role
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->description = $request->description;
        
        $role->save();
        return redirect()->route('role.index')->with('update', 'role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete data role
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        
        return redirect()->route('role.index')->with('dlt', 'role');
    }
}
