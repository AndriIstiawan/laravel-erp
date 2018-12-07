<?php

namespace App\Http\Controllers\MemberManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Levels;
use App\Archievement;
use Yajra\Datatables\Datatables;

class ArchievementController extends Controller
{
    //Protected module archievement by slug
    public function __construct()
    {
        $this->middleware('perm.acc:archievement');
    }
    
    //Public index archievement
    public function index(){
        return view('panel.member-management.archievement.index');
    }
	
    //View Form archievement
    public function create(){
		
        $level= Levels::all();
        return view('panel.member-management.archievement.form-create')->with(['level' => $level]);
    }

    //Store data archievement 
    public function store(Request $request){

		$archievement = new archievement();
        $archievement->name = $request->name;
        $archievement->type = $request->type;
        $archievement->frompcs = $request->frompcs;
        $archievement->from = $request->from;
        $archievement->topcs = $request->topcs;
        $archievement->to = $request->to;
        $archievement->start = $request->start;
        $archievement->to = $request->to;
        $level=Levels::whereIn('_id', $request->level)->get();
        $archievement->level=$level->toArray();
        $archievement->save();
		return redirect()->route('archievement.index')->with('toastr', 'new');
    }

    //For getting datatable at index
    public function show(Request $request, $action){
		$levels = Archievement::all();
		
		return Datatables::of($levels)
			->addColumn('action', function ($level) {
				return 
					'<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('level.edit',['id' => $level->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>'.
					'<form style="display:inline;" method="POST" action="'.
						route('archievement.destroy',['id' => $level->id]).'">'.method_field('DELETE').csrf_field().
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
        
		$level->save();

		return redirect()->route('level.index')->with('update', 'level');
    }

    //Delete data level
    public function destroy($id){
		$level = Archievement::find($id);
		$level->delete();
		
		return redirect()->route('archievement.index')->with('dlt', 'archievement');
    }
}
