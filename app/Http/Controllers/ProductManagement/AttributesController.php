<?php

namespace App\Http\Controllers\ProductManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attributes;
use Yajra\Datatables\Datatables;

class AttributesController extends Controller
{
    
    //Protected module attributes by slug
    public function __construct()
    {
        $this->middleware('perm.acc:attributes');
    }
    
    //public index attributes
    public function index()
    {
        return view('panel.product-management.attributes.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view form create
    public function create()
    {
        return view('panel.product-management.attributes.form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store data attributes
    public function store(Request $request)
    {
        return "sip";
        // $attributes = new Attributes();
        // $attributes->name= $request->name;
        // $attributes->type= $request->type;
        // $attributes->subtype =$request->addmore;
        // $attributes->save();

        // return redirect()->route('attributes.index')->with('toastr', 'attributes');
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $attributes = attributes::all();
        
        return Datatables::of($attributes)
            ->addColumn('action', function ($attributes) {
                return 
                    '<a class="btn btn-success btn-sm"  href="'.route('attributes.edit',['id' => $attributes->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('attributes.destroy',['id' => $attributes->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    //view form edit
    public function edit($id)
    {
        $attributes = Attributes::find($id);
        return view('panel.product-management.attributes.form-edit')->with(['attributes'=>$attributes]);
    }

    //update date attributes
    public function update(Request $request, $id)
    {
        $attributes = Attributes::find($id);
        $attributes->name = $request->name;
        $attributes->type = $request->type;
        $attributes->subtype =$request->addmore;
        
        $attributes->save();
        return redirect()->route('attributes.index')->with('update', 'attributes');
    }

    //delete date atributes
    public function destroy($id)
    {
        $attributes = Attributes::find($id);
        $attributes->delete();
        
        return redirect()->route('attributes.index')->with('dlt', 'attributes');
    }
}
