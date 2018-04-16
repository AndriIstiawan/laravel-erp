<?php

namespace App\Http\Controllers\ProductManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AttributeSets;
use App\Attributes;
use Yajra\Datatables\Datatables;

class AttributeSetsController extends Controller
{
    //Protected module attribute-sets by slug
    public function __construct()
    {
        $this->middleware('perm.acc:attribute-sets');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public index attributsets
    public function index()
    {
        return view('panel.product-management.attribute-sets.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view form create 
    public function create()
    {
        $attributes=attributes::all();
        return view('panel.product-management.attribute-sets.form-create',['attributes' => $attributes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store data attributsets
    public function store(Request $request)
    {
        $attribute = new AttributeSets();
        $attribute->name = $request->name;
        $attributes=attributes::whereIn('_id', $request->attribute)->get();
        $attribute->attributes=$attributes->toArray();
        $attribute->save();

        return redirect()->route('attribute-sets.index')->with('toastr', 'attribute-sets');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
    public function show(Request $request, $action){
        $attributes = attributesets::select(['name','attributes.name','created_at']);
        
        return Datatables::of($attributes)
            ->addColumn('action', function ($attributes) {
                return 
                    '<center><button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('attribute-sets.edit',['id' => $attributes->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit </button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('attribute-sets.destroy',['id' => $attributes->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form></center>';
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
        $attributeSets= AttributeSets::find($id);
        $attribute = attributes::whereNotIn('name', array_column($attributeSets->attributes,'name'))->get();
        return view('panel.product-management.attribute-sets.form-edit',[
            'attributeSets' => $attributeSets,
            'attribute' => $attribute
        ]);
        //return dd($attribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update data attributsets
    public function update(Request $request, $id)
    {
        $attributeSets = AttributeSets::find($id);
        $attributeSets->name = $request->name;
        $attributeSets->attributes = $request->attribute;
        $attributeSets->save();    

        return redirect()->route('attribute-sets.index')->with('update', 'attribute-sets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete data attributesets
    public function destroy($id)
    {
        $taxes = AttributeSets::find($id);
        $taxes->delete();
        
        return redirect()->route('attribute-sets.index')->with('dlt', 'Attribute Sets deleted!');
    }
}
