<?php

namespace App\Http\Controllers\ProductManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Taxes;
use Yajra\Datatables\Datatables;

class TaxesController extends Controller
{
    //Protected module taxes by slug
    public function __construct()
    {
        $this->middleware('perm.acc:taxes');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public index taxes
    public function index()
    {
        return view('panel.product-management.taxes.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view form create
    public function create()
    {
        return view('panel.product-management.taxes.form-create');
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
        $taxes = new Taxes();
        $taxes->name = $request->name;
        $taxes->value = $request->value;
        $taxes->save();
        
        return redirect()->route('taxes.index')->with('toastr', 'new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
    public function show(Request $request, $action){
        $taxes = taxes::select(['name', 'value', 'created_at']);
        
        return Datatables::of($taxes)
            ->addColumn('action', function ($taxes) {
                return 
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('taxes.edit',['id' => $taxes->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit taxes</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('taxes.destroy',['id' => $taxes->id]).'">'.method_field('DELETE').csrf_field().
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
        $taxes = Taxes::find($id);
        return view('panel.product-management.taxes.form-edit')->with(['taxes'=>$taxes]);
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
        $taxes = Taxes::find($id);
        $taxes->name = $request->name;
        $taxes->value = $request->value;
        
        $taxes->save();
        return redirect()->route('taxes.index')->with('update', 'Taxes updated!');
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
        $taxes = Taxes::find($id);
        $taxes->delete();
        
        return redirect()->route('taxes.index')->with('dlt', 'Taxes deleted!');
    }
}
