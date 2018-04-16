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
        $this->middleware('perm.acc:categories');
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
            $category = Categories::where('slug', $request->slug)->first();
            if (count($category) > 0) {
                return ($request->id == $category->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (Categories::where('slug', $request->slug)->first() ? 'false' : 'true');
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
        $category = Categories::all();
        return view('panel.product-management.categories.form-create')->with(['category' => $category]);
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
        $category->slug = $request->slug;
        $category->parent = Categories::whereIn('slug',($request->parent == null ? [] : $request->parent))->get()->toArray();
        $category->save();

        return redirect()->route('category.index')->with('toastr', 'category');
    }
    
    //reorder data categories
    public function reorder()
    {
        $categories = categories::all();
        $categories = $categories->toArray();
        $catParent = Categories::where('parent.slug', 'exists', false)->get();
        $catParent = $catParent->toArray();
        return view('panel.product-management.categories.reorder')->with(['categories' => $categories,'catParent' => $catParent]);
    }

    //get datatables list data
    public function listData(){
        $categories = categories::all();

        return Datatables::of($categories)
            ->addColumn('action', function ($categories) {
                return
                '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="' . route('category.edit', ['id' => $categories->id]) . '">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit category</button>' .
                '<form style="display:inline;" method="POST" action="' .
                route('category.destroy', ['id' => $categories->id]) . '">' . method_field('DELETE') . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    //for getting datatable at index
    public function show(Request $request, $action)
    {
        switch($action){
            case "list-data" : 
                return $this->listData();
                break;
            case "reorder" : 
                return $this->reorder();
                break;
            default :
                return $this->index();
        }
    }

    //view form edit
    public function edit($id)
    {
        $category = Categories::find($id);
        $arrSlug = [];

        //get list array slug parent
        foreach($category->parent as $catParent){
            array_push($arrSlug,$catParent['slug']);
        }

        $categories = Categories::whereNotIn('slug', $arrSlug)->get();
        return view('panel.product-management.categories.form-edit')->with(['category' => $category, 'categories' => $categories]);
    }

    //update data categories
    public function update(Request $request, $id)
    {
        if($id == 'reorder'){
            return $this->updateReorder($request);
        }else{
            $category = Categories::find($id);
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->parent = Categories::whereIn('slug',($request->parent == null ? [] : $request->parent))->get()->toArray();
            $category->save();
            return redirect()->route('category.index')->with('update', 'category');
        }
    }

    //update reorder categories
    public function updateReorder(Request $request)
    {
        $data = $request->nestableOutput;
        $data = json_decode($data, true);

        $slugs = array_column($data, 'slug');
        Categories::where('parent.slug', 'exists', true)->update(['parent' => []]);

        function updateNested($listArr){
            foreach($listArr as $la){
                if(isset($la['children'])){
                    $parent = Categories::where('slug', $la['slug'])->first()->toArray();
                    $slugs = array_column($la['children'], 'slug');
                    Categories::whereIn('slug', $slugs)->push('parent', $parent);
                    updateNested($la['children']);
                }
            }
        }

        updateNested($data);
        return var_dump($slugs);
    }

    //delete data categories
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();

        return redirect()->route('category.index')->with('dlt', 'category');
    }
}
