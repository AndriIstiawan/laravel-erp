<?php

namespace App\Http\Controllers\MasterhomeManagement;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Brand;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class BrandController extends Controller
{
    //Protected module brands by slug
    public function __construct()
    {
        $this->middleware('perm.acc:brands');
    }
    
    //public index brands
    public function index()
    {
        return view('panel.master-home.brands.index');
    }

    

    public function find(Request $request){
        
        if($request->id){
            $brand = brand::where('slug', $request->slug)->first();
            if(count($brand) > 0){
                return ($request->id == $brand->id ? 'true' : 'false');
            }else{
                return 'true';
            }
        }else{
            return (brand::where('slug', $request->slug)->first() ? 'false' : 'true' );    
        }
    }
    //view form create

    public function create()
    {
        return view('panel.master-home.brands.form-create');
    }

    //store data brands
    public function store(Request $request)
    {
        $brand = new brand();
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->save();
        
        if ($request->file('picture')) {
                $pictureFile = $request->file('picture');
                $extension = $pictureFile->getClientOriginalExtension();
                $destinationPath = public_path('/img/brands');
                if ($brand->picture != '' || $brand->picture != null) {
                    File::delete(public_path('/img/brands/' . $brand->picture));
                }
                $pictureFile->move($destinationPath, $brand->id . '.' . $extension);
                $brand->picture = $brand->id . '.' . $extension;
        }
        $brand->save();
        return $brand->id;
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $brands = brand::select(['id', 'name','slug', 'created_at']);
        
        return Datatables::of($brands)
            ->addColumn('action', function ($brand) {
                return 
                    '<a class="btn btn-success btn-sm"  href="'.route('brands.edit',['id' => $brand->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit Brands</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('brands.destroy',['id' => $brand->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    //view form edit
    public function edit($id)
    {
        $brand = brand::find($id);
        return view('panel.master-home.brands.form-edit')->with(['brand'=>$brand]);
    }

    //update data brands
    public function update(Request $request, $id)
    {
        $brand = brand::find($id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->save();

        if($request->file('picture')){
            $pictureFile = $request->file('picture');
            $extension = $pictureFile->getClientOriginalExtension();
            $destinationPath = public_path('/img/brands');
            if($brand->picture != '' || $brand->picture != null){
                File::delete(public_path('/img/brands/'.$brand->picture));
            }
            $pictureFile->move($destinationPath, $brand->id.'.'.$extension);
            $brand->picture = $brand->id.'.'.$extension;
        }
        
        $brand->save();
        return $brand->id;
    }

    //delete data brands
    public function destroy($id)
    {
        $brand = brand::find($id);
        $brand->delete();
        return redirect()->route('brands.index')->with('dlt', 'brand');
    }
}
