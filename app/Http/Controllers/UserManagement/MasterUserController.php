<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\User;
use App\PointsPerformance;
use App\Member;
use App\SalesOrder;
use Auth;
use File;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class MasterUserController extends Controller
{
    //Protected module master-user by slug
    public function __construct()
    {
        $this->middleware('perm.acc:master-user');
    }

    //Public index master-user
    public function index()
    {
        return view('panel.user-management.master-user.index');
    }

    //For find email if already use
    public function find(Request $request)
    {

        if ($request->id) {
            $user = User::where('email', $request->email)->first();
            if (count($user) > 0) {
                return ($request->id == $user->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (User::where('email', $request->email)->first() ? 'false' : 'true');
        }
    }

    //View Form create
    public function create()
    {
        $list_ap = (Auth::user()->email == env('ROOT_USERNAME') ? Auth::user()->accPermissions() : Auth::user()->accessPermissions);
        $list_mp = (Auth::user()->email == env('ROOT_USERNAME') ? Auth::user()->modPermissions() : Auth::user()->modulePermissions);
        $roles = Role::all();
        return view('panel.user-management.master-user.form-create')->with([
            'list_ap' => $list_ap,
            'list_mp' => $list_mp,
            'roles' => $roles,
        ]);
    }

    //Store data user Create & Edit
    public function store(Request $request)
    {
        //if id != '' => user edit, else => user create new
        if ($request->id != '') {
            $user = User::find($request->id);
            Member::where('sales', 'elemMatch', array('_id' => $request->id))->update(array('sales.0.name' => $request->name));
            /*$arrKemasan = [];
            if ($request->kemasan != null) {
                foreach ($request->kemasan as $kemasan_list){
                    $arrKemasan[] = [
                        'jenis_kemasan' => $kemasan_list,
                    ];  
                }
            }
            $user->kemasan = $arrKemasan;*/
            // SalesOrder::where('sales', 'elemMatch', array('_id' => $request->id))->update(array('sales.0.name' => $request->name));
        } else {
            $user = new User();
            if ($request->production != '') {
                    $point = new PointsPerformance();
                    $roles = Role::find($request->role);
                    $point->name = $request->name;
                    $point->email = $request->email;
                    $point->points = 0;
                    $point->role = [$roles->toArray()];
                    $point->save();
            }

            /*$arrKemasan = [];
            if ($request->kemasan != null) {
                foreach ($request->kemasan as $kemasan_list){
                    $arrKemasan[] = [
                        'jenis_kemasan' => $kemasan_list,
                    ];  
                }
            }
            $user->kemasan = $arrKemasan;*/
        }

        if ($request->email) {
            //INSERT USER GENERAL ( TAB GENERAL )
            $role = Role::find($request->role);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;

            if ($request->hasFile('picture')) {
                $pictureFile = $request->file('picture');
                $extension = $pictureFile->getClientOriginalExtension();
                $destinationPath = public_path('/img/avatars');
                if ($user->picture != '' || $user->picture != null) {
                    File::delete(public_path('/img/avatars/' . $user->picture));
                }
                $pictureFile->move($destinationPath, $user->id . '.' . $extension);
                $user->picture = $user->id . '.' . $extension;
            }
            $user->role = [$role->toArray()];
            if ($request->password != '') {
                $user->password = bcrypt($request->password);
            }
            /*return dd($role->name);*/
            $user->save();

            return $user->id;
        } else {
            //INSERT USER PERMISSION ( TAB PERMISSION )
            if(!$request->access){ $request->access = []; }
            if(!$request->module){ $request->module = []; }

            $accessPermissions = Permission::whereIn('_id', $request->access)->get();
            $accessPermissions = $accessPermissions->toArray();
            $user->accessPermissions = $accessPermissions;
            $modulePermissions = Permission::whereIn('_id', $request->module)->where('parent', null)->get();

            for ($i = 0; $i < $modulePermissions->count(); $i++) {
                $modulePermissions[$i]->child = Permission::where('parent', $modulePermissions[$i]->id)
                    ->whereIn('_id', $request->module)->get()->toArray();
            }
            $user->modulePermissions = $modulePermissions->toArray();

            $user->save();
            return "data permisssion saved";
        }
    }

    //For getting datatable at index
    public function show(Request $request, $action)
    {
        $users = User::whereNotIn('email', [env('ROOT_USERNAME')])->get();

        return Datatables::of($users)
            ->addColumn('status', function ($user) {
                return ($user->remember_token == null ?
                    '<span class="badge badge-secondary">Inactive</span>' :
                    '<span class="badge badge-success">Active</span>');
            })
            ->addColumn('action', function ($user) {
                return
                '<a class="btn btn-success btn-sm" href="' . route('master-user.edit', ['id' => $user->id]) . '">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit User</a>' .
                '<form style="display:inline;" method="POST" action="' .
                route('master-user.destroy', ['id' => $user->id]) . '">' . method_field('DELETE') . csrf_field() .
                    '<button type="button" onclick="removeList($(this))"  class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    //View Form edit
    public function edit($id)
    {
        $user = User::find($id);

        //if user => root getting all module & access, else => getting user has module & access (admin who access master-user)
        $list_ap = (Auth::user()->email == env('ROOT_USERNAME') ? Auth::user()->accPermissions() : Auth::user()->accessPermissions);
        $list_mp = (Auth::user()->email == env('ROOT_USERNAME') ? Auth::user()->modPermissions() : Auth::user()->modulePermissions);
        $roles = Role::where('_id', '<>', $user->role[0]['_id'])->get();

        for ($i = 0; $i < count($list_ap); $i++) {
            $modUser = User::where('_id', $user->id)
                ->where('accessPermissions', 'elemMatch', array('_id' => $list_ap[$i]['_id']))->count();
            if ($modUser > 0) {
                $list_ap[$i]['checked'] = true;
            }
        }

        for ($i = 0; $i < count($list_mp); $i++) {
            $modUser = User::where('_id', $user->id)
                ->where('modulePermissions', 'elemMatch', array('_id' => $list_mp[$i]['_id']))->count();
            if ($modUser > 0) {
                $list_mp[$i]['checked'] = true;
            }

            for ($j = 0; $j < count($list_mp[$i]['child']); $j++) {
                $modUser = User::where('_id', $user->id)
                    ->where('modulePermissions.child', 'elemMatch', array('_id' => $list_mp[$i]['child'][$j]['_id']))->count();
                if ($modUser > 0) {
                    $list_mp[$i]['child'][$j]['checked'] = true;
                }
            }
        }

        return view('panel.user-management.master-user.form-edit')->with([
            'user' => $user,
            'list_ap' => $list_ap,
            'list_mp' => $list_mp,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {
    }

    //Delete data user by id
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('master-user.index')->with('dlt', 'user');
    }
}
