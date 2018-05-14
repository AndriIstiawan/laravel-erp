<?php

namespace App\Http\Controllers\ProductManagement;

use App\Categories;
use App\Http\Controllers\Controller;
use App\Product;
use App\Variant;
use Excel;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    //Protected module product by slug
    public function __construct()
    {
        $this->middleware('perm.acc:product');
    }

    //find product sku
    public function find(Request $request){
        $status = 'true';
        $product = Product::where('code', $request->code)->first();
        if($product){
            if(isset($request->id)){
                if($request->id == $product['_id']){
                    $status = 'true';
                }else{
                    $status = 'false';
                }
            }else{
                $status = 'false';
            }
        }
        return $status;
    }

    //public index product
    public function index()
    {
        return view('panel.product-management.product.index');
    }
    public function tampil($id){
        $product = product::find($id);
        $categories = Categories::all();
        $categories = $categories->toArray();
        return view('panel.product-management.product.form-edit')->with(['product' => $product, 'categories' => $categories]);
    }


    //view form create
    public function create()
    {
        $categories = Categories::all();
        $categories = $categories->toArray();
        return view('panel.product-management.product.form-create', ['categories' => $categories]);
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
        $product->category = $request->category;
        $product->commercial = $request->commercial;
        $product->code = $request->code;
        $product->stock = $request->stock;
        $product->save();
        return redirect()->route('product.index')->with('new', 'product');
    }

    //for getting datatable at index
    public function listData()
    {
        $products = product::select('id','code','name','type','stock','created_at');
        return Datatables::of($products)
            ->addColumn('action', function ($products) {
                return
                '<a class="btn btn-success btn-sm"  href="' . route('product.edit', ['id' => $products->id]) . '">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>' .
                '<form style="display:inline;" method="POST" action="' .
                route('product.destroy', ['id' => $products->id]) . '">' . method_field('DELETE') . csrf_field() .
                    '<button type="button" onclick="removeList($(this))" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->addColumn('variants', function ($products) {
                if ($products->variant) {
                    return count($products->variant);
                } else {
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
    public function downloadImportForm()
    {
        $file = public_path() . "/files/product/product-form-import.xlsx";
        return response()->download($file);
    }

    public function show(Request $request, $action)
    {
        switch ($action) {
            case "export":
                return $this->productExport();
                break;
            default : return $this->listData();
        }
    }

    //view form edit
    public function edit($id)
    {
        $product = product::find($id);
        $categories = Categories::all();
        $categories = $categories->toArray();
        return view('panel.product-management.product.form-edit')->with(['product' => $product, 'categories' => $categories]);
    }

    //update data product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->type = $request->type;
        $product->category = $request->category;
        $product->commercial = $request->commercial;
        $product->code = $request->code;
        $product->stock = $request->stock;
        $product->save();
        return redirect()->route('product.index')->with('update', 'product');
    }

    //delete data product
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('dlt', 'Products updated!');
    }

    public function productExport()
    {
        $file = storage_path('exports/product-form-format.xlsx');
        $products = Product::all();

        //load excel form and editing row
        $excel = Excel::selectSheetsByIndex(0,1)->load($file, function($reader) use ($products) {
            $data = [];
            foreach($products as $product){
                $data[] = [
                    $product->code,
                    $product->name,
                    $product->type,
                    $product->category,
                    $product->commercial,
                    $product->currency,
                ];
            }

            //editing sheet 1
            $reader->setActiveSheetIndex(0);
            $sheet1 = $reader->getActiveSheet();
            $sheet1->fromArray($data, null, 'A3', false, false);
        })->setFilename('client-form-export['.date("H-i-s d-m-Y")."]")->download('xlsx');
    }

    public function productImport(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file->getRealPath();
            $filename = "import-product[".date("Y-m-d H:i:s")."]";
            $excel = Excel::load($path, function ($reader) {
                $results = $reader->get();
                $data = [];
                //read sheet 1
                foreach($results as $listData){ //result[0] if load multiple sheet selectSheetsByIndex(0,1)
                    //check parent column value
                    if(!isset($listData['code'])||!isset($listData['name'])||!isset($listData['type'])
                    ||!isset($listData['category'])||!isset($listData['commercial'])
                    ){
                        
                        $data[] = array('parent column not valid');

                    }else{
                        $code = $listData['code'];
                        $name = $listData['name'];
                        $type = $listData['type'];
                        $category = $listData['category'];
                        $commercial = $listData['commercial'];
                        if( trim($code) == "" || trim($name) == "" || trim($type) == "" || trim($category) == ""|| trim($commercial) == ""
                    ){
                            $data[] = array('error import => data value not valid');
                        
                        }else{
                            $product = Product::where('code', $code)->first();
                            if($product){
                                $product['code'] = $code;
                                $product['name'] = $name;
                                $product['type'] = $type;
                                $product['category'] = $category;
                                $product['commercial'] = $commercial;
                                $product->save();
                                $data[] = array('product edit successfuly');
                            }else{
                                $product = new Product();
                                $product['code'] = $code;
                                $product['name'] = $name;
                                $product['type'] = $type;
                                $product['category'] = $category;
                                $product['commercial'] = $commercial;
                                $product->save();
                                $data[] = array('product create successfuly');
                            }
                        }
                    }
                }

                //editing sheet 1
                $sheet0 = $reader->setActiveSheetIndex(0);
                $reader->getActiveSheet()->fromArray($data, null, 'L2', false, false); //L2 is note columns
                //$reader->getActiveSheet()->setAutoSize(true);
            })->setFilename($filename)->download('xlsx');
        }

    }
}