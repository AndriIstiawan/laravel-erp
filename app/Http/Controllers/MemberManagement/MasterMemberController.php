<?php

namespace App\Http\Controllers\MemberManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use App\Levels;
use App\Product;
use App\User;
use Yajra\Datatables\Datatables;

class MasterMemberController extends Controller
{
    //Protected module master-member by slug
    public function __construct()
    {
        $this->middleware('perm.acc:master-member');
    }
    
    //Public index master-member
    public function index(){
        return view('panel.member-management.master-member.index');
    }

    //find data email
    public function find(Request $request)
    {

        if ($request->id) {
            $email = Member::where('email', $request->email)->first();
            if (count($email) > 0) {
                return ($request->id == $email->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (Member::where('email', $request->email)->first() ? 'false' : 'true');
        }
    }
	
    //View Form create
    public function create(){
		
		$level= Levels::orderBy('point', 'ASC')->first();
        $modUser = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        $product = Product::all();
        return view('panel.member-management.master-member.form-create')->with([
            'modUser' => $modUser, 
            'level' => $level,
            'product' => $product
        ]);
    }

    //Store data member 
    public function store(Request $request){

		$member = new Member();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;/*
        $member->point = $request->point;
        $level=Levels::where('_id', $request->level)->get();
        $member->level=$level->toArray();
        $member->status = $request->status;*/
        $member->address = $request->address;
        $member->title = $request->title;
        /*$member->dompet = $request->dompet;
        $member->koin = $request->koin;
        $member->password = bcrypt($request->password);*/
        $subDiv =[];
        for($i=0; $i < count($request->nameSub); $i++){
            $products=Product::where('_id', $request->type[$i])->first();
            $sales=user::where('_id', $request->sales[$i])->first();
            $subDiv[] =[
                'proId'=>$products['id'],
                'name'=>$products['name'],
                'type'=>$products['type'],
                'code'=>$products['code'],
                'sales'=>$sales['name'],
                'email'=>$sales['email'],
                'salId'=>$sales['id'],
                'nameSub' => $request->nameSub[$i],
            ];
        }
        $member->subDivision=$subDiv;
/*
        $sales=user::whereIn('_id', $request->sales)->get();
        $member->sales=$sales->toArray();*/
		$member->save();

        if ($request->hasFile('picture')) {
			$pictureFile = $request->file('picture');
			$extension = $pictureFile->getClientOriginalExtension();
			$destinationPath = public_path('/img/avatars');
			$pictureFile->move($destinationPath, $member->id.'.'.$extension);
			$member->picture = $member->id.'.'.$extension;
		}

		$member->save();
/*        return dd($member);*/
		return redirect()->route('master-client.index')->with('toastr', 'new');
    }

    //For getting datatable at index
    public function show(Request $request, $action){
		$members = Member::all();
		
		return Datatables::of($members)
			->addColumn('action', function ($member) {
				return 
					'<a class="btn btn-success btn-sm" href="'.route('master-client.edit',['id' => $member->id]).'">
						<i class="fa fa-pencil-square-o"></i>&nbsp;Edit member</a>'.
					'<form style="display:inline;" method="POST" action="'.
						route('master-client.destroy',['id' => $member->id]).'">'.method_field('DELETE').csrf_field().
					'<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
			})
			->rawColumns(['status', 'action'])
			->make(true);
    }

    //view form edit
    public function edit($id){
		$member = Member::find($id);
        $modUser = User::where('role', 'elemMatch', array('name' => 'Sales'))->whereNotIn('email', array_column($member->subDivision,'email'))->get();
        $modUsers = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        $product= Product::whereNotIn('_id', array_column($member->subDivision,'proId'))->get();
        $products = Product::all();/*
        $level = Levels::where('name', array_column($member->level,'name'))->get();*/
        return view('panel.member-management.master-member.form-edit')
        ->with([
        	'member'=>$member, 
        	'modUser' => $modUser,
            'modUsers' => $modUsers,
            'product' => $product,
            'products' => $products
        ]);
	}

	//Update data setting
    public function update(Request $request, $id){

    	$member = Member::find($id);
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        /*$member->sales = $request->sales;
        $level=Levels::where('_id', $request->level)->get();
        $member->level=$level->toArray();*/
        $member->address = $request->address;
        $member->title = $request->title;
        /*$member->status = $request->status;*/
        $subDiv =[];
        for($i=0; $i < count($request->nameSub); $i++){
            $products=Product::where('_id', $request->type[$i])->first();
            $sales=user::where('_id', $request->sales[$i])->first();
            $subDiv[] =[
                'proId'=>$products['id'],
                'name'=>$products['name'],
                'type'=>$products['type'],
                'code'=>$products['code'],
                'sales'=>$sales['name'],
                'email'=>$sales['email'],
                'salId'=>$sales['id'],
                'nameSub' => $request->nameSub[$i],
            ];
        }
        $member->subDivision=$subDiv;

		$member->save();

        if ($request->hasFile('picture')) {
			$pictureFile = $request->file('picture');
			$extension = $pictureFile->getClientOriginalExtension();
			$destinationPath = public_path('/img/avatars');
			if($member->picture != '' || $member->picture != null){
					File::delete(public_path('/img/avatars/'.$member->picture));
				}
			$pictureFile->move($destinationPath, $member->id.'.'.$extension);
			$member->picture = $member->id.'.'.$extension;
		}

		$member->save();

		return redirect()->route('master-client.index')->with('update', 'client');
    }

    //Delete data setting
    public function destroy($id){
		$member = Member::find($id);
		$member->delete();
		
		return redirect()->route('master-client.index')->with('dlt', 'client');
    }
    
}
