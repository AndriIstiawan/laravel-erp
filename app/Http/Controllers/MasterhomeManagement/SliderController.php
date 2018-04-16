<?php

namespace App\Http\Controllers\MasterhomeManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\slider;
use App\Product;
use File;
use Yajra\Datatables\Datatables;

class SliderController extends Controller
{
    //Protected module slider by slug
    public function __construct()
    {
        $this->middleware('perm.acc:slider');
    }
    
    //public index slider
    public function index()
    {
        return view('panel.master-home.slider.index');
    }

    public function find(Request $request)
    {
        
        if ($request->id){
            $slider = slider::where('name', $request->name)->first();
            if (count($slider) > 0){
                return ($request->id == $slider->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (slider::where('name', $request->name)->first() ? 'false' : 'true' );    
        }
    }

    //view form create
    public function create()
    {
        $products = product::all();
        return view('panel.master-home.slider.form-create')->with([
            'products' => $products
        ]);
    }

    //store data slider
    public function store(Request $request)
    {
        $slider = new slider;
        $slider->name = $request->name;
        $slider->save();

        if($request->file('picture')){
            $pictureFile = $request->file('picture');
            $extension = $pictureFile->getClientOriginalExtension();
            $destinationPath = public_path('/img/slider');
            if($slider->picture != '' || $slider->picture != null){
                File::delete(public_path('/img/slider/'.$slider->picture));
            }
            $pictureFile->move($destinationPath, $slider->id.'.'.$extension);
            $slider->picture = $slider->id.'.'.$extension;
        }
        $slider->save();
        // //return view('panel.master-home.slider.index')->with('toastr', 'slider');
        return $slider->id;
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $sliders = slider::select(['id', 'name', 'created_at']);
        
        return Datatables::of($sliders)
            ->addColumn('action', function ($slider) {
                return 
                    '<a class="btn btn-success btn-sm"  href="'.route('slider.edit',['id' => $slider->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit Slider</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('slider.destroy',['id' => $slider->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    //view form edit
    public function edit($id)
    {
        $slider = slider::find($id);
        return view('panel.master-home.slider.form-edit')->with(['slider'=>$slider]);
    }

    //update data slider
    public function update(Request $request, $id)
    {
        $slider = slider::find($id);
        $slider->name = $request->name;
        $slider->save();

        if($request->file('picture')){
            $pictureFile = $request->file('picture');
            $extension = $pictureFile->getClientOriginalExtension();
            $destinationPath = public_path('/img/slider');
            if($slider->picture != '' || $slider->picture != null){
                File::delete(public_path('/img/slider/'.$slider->picture));
            }
            $pictureFile->move($destinationPath, $slider->id.'.'.$extension);
            $slider->picture = $slider->id.'.'.$extension;
        }
        $slider->save();
        // //return view('panel.master-home.slider.index')->with('toastr', 'slider');
        return $slider->id;
    }

    //delete data slider
    public function destroy($id)
    {
        $slider = slider::find($id);
        $slider->delete();
        return redirect()->route('slider.index')->with('dlt', 'slider');
    }
}
