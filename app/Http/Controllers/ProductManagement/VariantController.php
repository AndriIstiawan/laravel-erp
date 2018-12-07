<?php

namespace App\Http\Controllers\ProductManagement;

use App\Http\Controllers\Controller;
use App\Variant;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class VariantController extends Controller
{
    //Protected module variant by slug
    public function __construct()
    {
        $this->middleware('perm.acc:variant');
    }

    //find variant by slug
    public function find(Request $request)
    {

        if ($request->id) {
            $variant = Variant::where('slug', $request->slug)->first();
            if (count($variant) > 0) {
                return ($request->id == $variant->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (Variant::where('slug', $request->slug)->first() ? 'false' : 'true');
        }
    }

    // Index view
    public function index()
    {
        return view('panel.product-management.variant.index');
    }

    // Create view
    public function create()
    {
        return view('panel.product-management.variant.form-create');
    }

    // store data create
    public function store(Request $request)
    {
        $variant = new Variant();
        $variant->name = $request->name;
        $variant->slug = $request->slug;
        $variant->type = $request->type;
        $arrOpt = [];

        for($i=0; $i < count($request->option); $i++){
            $arrOpt[] = [
                'color' => $request->color[$i],
                'text' => $request->option[$i]
            ];
        }
        $variant->option = $arrOpt;
        $variant->save();

        return "success";
    }

    //reorder data categories
    public function reorder()
    {
        $variants = Variant::all();
        $variants = $variants->toArray();
        $varParent = Variant::where('parent', 'size', 0)->get();
        $varParent = $varParent->toArray();

        return view('panel.product-management.variant.reorder')->with(['variants' => $variants,'varParent' => $varParent]);
    }

    //update reorder data
    public function updateReorder(Request $request){
        return "reorder update";
    }

    //get datatables list data
    public function listData()
    {
        $variants = Variant::all();
        return Datatables::of($variants)
            ->addColumn('action', function ($variants) {
                return
                '<a class="btn btn-success btn-sm" href="' . route('variant.edit', ['id' => $variants->id]) . '">
                    <i class="fa fa-pencil-square-o"></i>&nbsp;Edit variant</a>' .
                '<form style="display:inline;" method="POST" action="' .
                route('variant.destroy', ['id' => $variants->id]) . '">' . method_field('DELETE') . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    // show view
    public function show(Request $request, $action)
    {
        switch ($action) {
            case "list-data":
                return $this->listData();
                break;
            case "reorder":
                return $this->reorder();
                break;
            case "reorder-update":
                return $this->updateReorder($request);
                break;
            default:
                return $this->index();
        }
    }

    // Edit view
    public function edit($id)
    {
        $variant = Variant::find($id);
        return view('panel.product-management.variant.form-edit')->with(['variant' => $variant]);
    }

    // store data edit
    public function update(Request $request, $id)
    {
        $variant = Variant::find($id);
        $variant->name = $request->name;
        $variant->slug = $request->slug;
        $variant->type = $request->type;
        $arrOpt = [];

        for($i=0; $i < count($request->option); $i++){
            $arrOpt[] = [
                'color' => $request->color[$i],
                'text' => $request->option[$i]
            ];
        }
        $variant->option = $arrOpt;
        $variant->save();

        return "success";
    }

    // delete data
    public function destroy($id)
    {
        $variant = Variant::find($id);
        $variant->delete();
        
        return redirect()->route('variant.index')->with('dlt', 'variant');
    }
}
