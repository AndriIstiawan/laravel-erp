<?php

namespace App\Http\Controllers\WarehouseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SegmentAttributes;
use App\WarehouseBranch;
use Yajra\Datatables\Datatables;
use File;

class WarehouseBranchController extends Controller
{
    //Protected module segment by slug
    public function __construct()
    {
        $this->middleware('perm.acc:warehouse-branch');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public index segment
    public function index()
    {
        return view('panel.warehouse-management.warehouse-branch.index');
    }
    
    //find data categories
    public function find(Request $request)
    {

        if ($request->id) {
            $footer = WarehouseBranch::where('slug', $request->slug)->first();
            if (count($footer) > 0) {
                return ($request->id == $footer->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (WarehouseBranch::where('slug', $request->slug)->first() ? 'false' : 'true');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view form create
    public function create()
    {
        
        $attr=SegmentAttributes::all();
        return view('panel.warehouse-management.warehouse-branch.form-create',['attr' => $attr]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store data segment
    public function store(Request $request)
    {
        $segment = new WarehouseBranch();
        $segment->name = $request->name;
        
        if ($request->hasFile('picture')) {
            $pictureFile = $request->file('picture');
            $extension = $pictureFile->getClientOriginalExtension();
            $destinationPath = public_path('/img/avatars');
            $pictureFile->move($destinationPath, $segment->id.'.'.$extension);
            $segment->picture = $segment->id.'.'.$extension;
        }

        $segment->save();
        
        return redirect()->route('warehouse-branch.index')->with('toastr', 'new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
    public function show(Request $request, $action){
        $carriers = WarehouseBranch::all();
        
        return Datatables::of($carriers)
            ->addColumn('action', function ($carriers) {
                return 
                    '<a class="btn btn-success btn-sm"  href="'.route('warehouse-branch.edit',['id' => $carriers->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('warehouse-branch.destroy',['id' => $carriers->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
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
        $segment = WarehouseBranch::find($id);
        return view('panel.warehouse-management.warehouse-branch.form-edit')->with(['segment'=>$segment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update data courier
    public function update(Request $request, $id)
    {
        $segment = WarehouseBranch::find($id);
        $segment->name = $request->name;
        if ($request->hasFile('picture')) {
            $pictureFile = $request->file('picture');
            $extension = $pictureFile->getClientOriginalExtension();
            $destinationPath = public_path('/img/avatars');
            if ($segment->picture != '' || $segment->picture != null) {
                File::delete(public_path('/img/avatars/' . $segment->picture));
            }
            $pictureFile->move($destinationPath, $segment->id . '.' . $extension);
            $segment->picture = $segment->id . '.' . $extension;
        }
        
        $segment->save();
        return redirect()->route('warehouse-branch.index')->with('update', 'warehouse branch updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete data carriers
    public function destroy($id)
    {
        $segment = WarehouseBranch::find($id);
        $segment->delete();
        
        return redirect()->route('warehouse-branch.index')->with('dlt', 'warehouse branch deleted!');
    }
}
