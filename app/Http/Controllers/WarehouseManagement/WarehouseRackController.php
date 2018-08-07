<?php

namespace App\Http\Controllers\WarehouseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WarehouseRack;
use Yajra\Datatables\Datatables;

class WarehouseRackController extends Controller
{
    //Protected module footer by slug
    public function __construct()
    {
        $this->middleware('perm.acc:warehouse-rack');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public index footer
    public function index()
    {
        $footers = WarehouseRack::all();
        return view('panel.warehouse-management.warehouse-rack.index')->with(['footer'=>$footers]);
    }

    //find data categories
    public function find(Request $request)
    {
        if ($request->_id) {
            $wr = WarehouseRack::where('no', $request->no)->first();
            if ($wr) {
                return ($request->_id == $wr->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (WarehouseRack::where('no', $request->no)->first() ? 'false' : 'true');
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
        return view('panel.warehouse-management.warehouse-rack.form-create');
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
        $footer = new WarehouseRack();
        $footer->no = $request->no;
        $footer->type=$request->type;
        $footer->item_type=$request->item_type;
        $footer->assign_area=$request->assign_area;
        $footer->save();
        
        return redirect()->route('warehouse-rack.index')->with('toastr', 'new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
    public function show(Request $request, $action){
        $wr = WarehouseRack::all();
        
        return Datatables::of($wr)
            ->addColumn('action', function ($wr) {
                return 
                    '<a class="btn btn-success btn-sm"  href="'.route('warehouse-rack.edit',['id' => $wr->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('warehouse-rack.destroy',['id' => $wr->id]).'">'.method_field('DELETE').csrf_field().
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
        $wr = WarehouseRack::find($id);
        return view('panel.warehouse-management.warehouse-rack.form-edit')->with([
            'wr'=>$wr,
        ]);
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
        $wr = WarehouseRack::find($id);
        $wr->no = $request->no;
        $wr->type=$request->type;
        $wr->item_type=$request->item_type;
        $wr->assign_area=$request->assign_area;
        $wr->save();
        return redirect()->route('warehouse-rack.index')->with('update', 'warehouse rack updated!');
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
        $wr = WarehouseRack::find($id);
        $wr->delete();
        
        return redirect()->route('warehouse-rack.index')->with('dlt', 'Warehouse rack deleted!');
    }
}
