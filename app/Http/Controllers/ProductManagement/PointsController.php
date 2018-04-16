<?php

namespace App\Http\Controllers\ProductManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Points;
use App\Product;
use Yajra\Datatables\Datatables;

class PointsController extends Controller
{
    //Protected module points by slug
    public function __construct()
    {
        $this->middleware('perm.acc:point');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public index taxes
    public function index()
    {
        return view('panel.product-management.point.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view form create
    public function create()
    {
        $product= Product::all();
        return view('panel.product-management.point.form-create')->with(['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store data taxes
    public function store(Request $request)
    {
        $point = new Points();
        $products= Product::whereIn('_id', $request->product)->get();
        $point->product=$products->toArray();
        $point->point = $request->point;
        $point->save();
        
        return redirect()->route('point.index')->with('toastr', 'new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
    public function show(Request $request, $action){
        $taxes = Points::all();
        
        return Datatables::of($taxes)
            ->addColumn('action', function ($taxes) {
                return 
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('point.edit',['id' => $taxes->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit point</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('point.destroy',['id' => $taxes->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
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
        $point = Points::find($id);
        return view('panel.product-management.point.form-edit')->with([
            'point'=>$point
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update data taxes
    public function update(Request $request, $id)
    {
        $points = Points::find($id);
        $points->product = $request->product;
        $points->point = $request->point;
        
        $points->save();
        return redirect()->route('point.index')->with('update', 'Points updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete data taxes
    public function destroy($id)
    {
        $point = Points::find($id);
        $point->delete();
        
        return redirect()->route('point.index')->with('dlt', 'Points deleted!');
    }
}
