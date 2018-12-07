<?php

namespace App\Http\Controllers\OrderManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Custom;
use App\Member;
use App\User;
use Yajra\Datatables\Datatables;

class CustomPoController extends Controller
{
    public function index()
    {
        return view('panel.order-management.custompo.index');
    }
    
    public function create()
    {
        $customs = custom::all();
        $member = member::all();
        $modUser = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        return view('panel.order-management.custompo.form-create')->with([
            'customs' => $customs,
            'member' => $member,
            'modUser' => $modUser
        ]);
    }

    public function store(Request $request)
    {
        $custom = new custom();
        $member= Member::whereIn('_id', $request->member)->get();
        $custom->member=$member->toArray();
        $custom->name_product = $request->name_product;
        $custom->description_product = $request->description_product;
        $custom->quantity_product = $request->quantity_product;
        $custom->comment = $request->comment;

        if ($request->hasFile('picture')) {
            $pictureFile = $request->file('picture');
            $extension = $pictureFile->getClientOriginalExtension();
            $destinationPath = public_path('/img/avatars');
            $pictureFile->move($destinationPath, $custom->name_product.'.'.$extension);
            $custom->picture = $custom->name_product.'.'.$extension;
        }
		$custom->save();

		return redirect()->route('custompo.index')->with('toastr', 'custom');
    }

    public function show(Request $request, $action){
        $customs = custom::all();
        
        return Datatables::of($customs)
            ->addColumn('action', function ($custom) {
                return 
                    '<a class="btn btn-success btn-sm" href="'.route('custompo.edit',['id' => $custom->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Comment</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('custompo.destroy',['id' => $custom->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    public function edit($id)
    {
        $custom = custom::find($id);
        $member = Member::where('name', array_column($custom->member,'name'))->get();
        return view('panel.order-management.custompo.form-edit')->with(['custom'=>$custom]);
    }

    public function update(Request $request, $id)
    {
        $custom = custom::find($id);
        $custom->comment = $request->comment;
        $custom->save();
		
		return redirect()->route('custompo.index')->with('toastr', 'custom');
    }

    public function destroy($id)
    {
        $custom = custom::find($id);
        $custom->delete();
        return redirect()->route('custompo.index')->with('dlt', 'custom');
    }
}
