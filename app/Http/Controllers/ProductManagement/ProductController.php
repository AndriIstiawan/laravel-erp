<?php

namespace App\Http\Controllers\ProductManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Product;
use App\Categories;
use App\Variant;
use App\Brand;
use Yajra\Datatables\Datatables;
use File;
use Image;

class ProductController extends Controller
{
    //Protected module product by slug
    public function __construct()
    {
        $this->middleware('perm.acc:product');
    }

    //find product sku
    public function find(Request $request){

        if($request->id){
            $product = Product::where('_id', '<>', $request->id)->where('sku', $request->slug)->count();
            $variant = Product::where('_id', '<>', $request->id)->where('variant', 'elemMatch', array('sku' => $request->slug))->count();
        }else{
            $product = Product::where('sku', $request->slug)->count();
            $variant = Product::where('variant', 'elemMatch', array('sku' => $request->slug))->count();
        }
        
        return ($product > 0 || $variant > 0 ? 'false' : 'true');
    }

    //public index product
    public function index()
    {
        return view('panel.product-management.product.index');
    }

    //view form create
    public function create()
    {
        $categories=Categories::all();
        $categories = $categories->toArray();
        return view('panel.product-management.product.form-create',['categories' => $categories]);
    }
    public function form()
    {
        return view('panel.product-management.product.form');
    }


    //store data product
    public function store(Request $request)
    {   
        $product = new Product();
        $product->name = $request->name;
        $product->type = $request->type;
        $product->code = $request->code;
        $product->stock = $request->stock;
        $product->price = [
            [
                "price" => $request->satu
            ], 
            [
                "price" => $request->dua
            ],
            [
                "price" => $request->tiga
            ],
            [
                "price" => $request->empat
            ],
            [
                "price" => $request->lima
            ],
            [
                "price" => $request->enam
            ]
        ];
        $product->currency = $request->currency;
        $product->save();

        return redirect()->route('product.index')->with('toastr', 'new');

    }

    //for getting datatable at index
    public function listData(){
        $products = product::all();
        
        return Datatables::of($products)
            ->addColumn('action', function ($products) {
                return 
                    '<a class="btn btn-success btn-sm"  href="'.route('product.edit',['id' => $products->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit product</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('product.destroy',['id' => $products->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->addColumn('variants', function ($products) {
                if($products->variant){
                    return count($products->variant);
                }else{
                    return "0";
                }
            })
            ->addColumn('satu', function ($products) {
                return $products->price[0]['price'];
            })
            ->addColumn('dua', function ($products) {
                return $products->price[1]['price'];
            })
            ->addColumn('tiga', function ($products) {
                return $products->price[2]['price'];
            })
            ->addColumn('empat', function ($products) {
                return $products->price[3]['price'];
            })
            ->addColumn('lima', function ($products) {
                return $products->price[4]['price'];
            })
            ->addColumn('enam', function ($products) {
                return $products->price[5]['price'];
            })
            ->make(true);
    }

    //download import form
    public function downloadImportForm(){
        $file= public_path(). "/files/product/product-form-import.xlsx";
        return response()->download($file);
    }

    public function show(Request $request, $action)
    {
        switch($action){
            case "list-data": return $this->listData();
            case "download-import-form": return $this->downloadImportForm();
            break;
        }
    }

    //view form edit
    public function edit($id)
    {
        $product = product::find($id);
        $categories=Categories::all();
        $categories = $categories->toArray();
        return view('panel.product-management.product.form-edit')->with(['product'=>$product,'categories'=>$categories]);
    }

    //update data product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->type = $request->type;
        $product->code = $request->code;
        $product->stock = $request->stock;
        $product->price = [
            [
                "price" => $request->satu
            ], 
            [
                "price" => $request->dua
            ],
            [
                "price" => $request->tiga
            ],
            [
                "price" => $request->empat
            ],
            [
                "price" => $request->lima
            ],
            [
                "price" => $request->enam
            ]
        ];
        $product->currency = $request->currency;
        $product->save();

        return redirect()->route('product.index')->with('update',  'product');
    }

    //delete data product
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        
        return redirect()->route('product.index')->with('dlt', 'Products updated!');
    }
}
