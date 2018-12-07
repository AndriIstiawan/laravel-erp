<?php

namespace App\Http\Controllers\MemberManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Levels;
use Yajra\Datatables\Datatables;

class LevelController extends Controller
{
    //Protected module level by slug
    public function __construct()
    {
        $this->middleware('perm.acc:level');
    }
    
    //Public index level
    public function index(){
        return view('panel.member-management.level.index');
    }
	
    //View Form level
    public function create(){
		
        return view('panel.member-management.level.form-create');
    }

    //Store data level 
    public function store(Request $request){

		$level = new Levels();
        $level->name = $request->name;
        $level->point = (int)$request->point;
        $level->save();
		return redirect()->route('level.index')->with('toastr', 'new');
    }

    //For getting datatable at index
    public function show(Request $request, $action){
		$levels = Levels::all();
		
		return Datatables::of($levels)
			->addColumn('action', function ($level) {
				return 
					'<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('level.edit',['id' => $level->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>'.
					'<form style="display:inline;" method="POST" action="'.
						route('level.destroy',['id' => $level->id]).'">'.method_field('DELETE').csrf_field().
					'<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
			})
			->rawColumns(['status', 'action'])
			->make(true);
    }

    //view form edit
    public function edit($id){
		$level = Levels::find($id);
        return view('panel.member-management.level.form-edit')
        ->with([
        	'level'=>$level
        ]);
	}

	//Update data level
    public function update(Request $request, $id){

    	$level = Levels::find($id);
        $level->name = $request->name;
        $level->point = $request->point;
		$level->save();

		return redirect()->route('level.index')->with('update', 'level');
    }

    //Delete data level
    public function destroy($id){
		$level = Levels::find($id);
		$level->delete();
		
		return redirect()->route('level.index')->with('dlt', 'level');
    }
}
