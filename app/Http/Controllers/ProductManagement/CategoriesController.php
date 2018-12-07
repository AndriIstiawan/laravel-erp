<?php

namespace App\Http\Controllers\ProductManagement;

use App\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CategoriesController extends Controller
{   
    //Protected module categories by slug
    public function __construct()
    {
        $this->middleware('perm.acc:category');
    }

    //public index categories
    public function index()
    {
        return view('panel.product-management.categories.index');
    }

    //find data categories
    public function find(Request $request)
    {

        if ($request->id) {
            $category = Categories::where('name', $request->name)->first();
            if ($category) {
                return ($request->id == $category->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (Categories::where('name', $request->name)->first() ? 'false' : 'true');
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
        return view('panel.product-management.categories.form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store data categories
    public function store(Request $request)
    {
        $category = new Categories();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.index')->with('toastr', 'category');
    }

    //for getting datatable at index
    public function show(Request $request, $action)
    {
        $type = Categories::all();
        
        return Datatables::of($type)
            ->addColumn('action', function ($type) {
                return 
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('category.edit',['id' => $type->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit type</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('category.destroy',['id' => $type->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="button" onclick="removeList($(this))" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    //view form edit
    public function edit($id)
    {
        $category = Categories::find($id);
        return view('panel.product-management.categories.form-edit')->with(['category' => $category]);
    }

    //update data categories
    public function update(Request $request, $id)
    {
        $category = Categories::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        return redirect()->route('category.index')->with('update', 'category');
    }

    //delete data categories
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();

        return redirect()->route('category.index')->with('dlt', 'category');
    }
}
