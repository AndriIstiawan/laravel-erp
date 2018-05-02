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
    public function find(Request $request)
    {

        if ($request->id) {
            $product = Product::where('_id', '<>', $request->id)->where('sku', $request->slug)->count();
            $variant = Product::where('_id', '<>', $request->id)->where('variant', 'elemMatch', array('sku' => $request->slug))->count();
        } else {
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
        $product->code = $request->code;
        $product->stock = $request->stock;
        $product->price = [
            [
                "price" => $request->satu,
            ],
            [
                "price" => $request->dua,
            ],
            [
                "price" => $request->tiga,
            ],
            [
                "price" => $request->empat,
            ],
            [
                "price" => $request->lima,
            ],
            [
                "price" => $request->enam,
            ],
        ];
        $product->currency = $request->currency;
        $product->save();

        return redirect()->route('product.index')->with('toastr', 'new');

    }

    //for getting datatable at index
    public function listData()
    {
        $products = product::all();

        return Datatables::of($products)
            ->addColumn('action', function ($products) {
                return
                '<a class="btn btn-success btn-sm"  href="' . route('product.edit', ['id' => $products->id]) . '">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit product</a>' .
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
            case "list-data":return $this->listData();
            case "download-import-form":return $this->downloadImportForm();
                break;
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
        $product->code = $request->code;
        $product->stock = $request->stock;
        $product->price = [
            [
                "price" => $request->satu,
            ],
            [
                "price" => $request->dua,
            ],
            [
                "price" => $request->tiga,
            ],
            [
                "price" => $request->empat,
            ],
            [
                "price" => $request->lima,
            ],
            [
                "price" => $request->enam,
            ],
        ];
        $product->currency = $request->currency;
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
        $product = Product::select('code', 'name', 'type', 'stock', 'currency', 'price')->get();
        for($i=0; $i < count($product); $i++){
            $product[$i]['Price 250 gr'] = $product[$i]['price'][0]['price'];
            $product[$i]['Price 500 gr'] = $product[$i]['price'][1]['price'];
            $product[$i]['Price 1 Kg'] = $product[$i]['price'][2]['price'];
            $product[$i]['Price 5 Kg'] = $product[$i]['price'][3]['price'];
            $product[$i]['Price 25 Kg'] = $product[$i]['price'][4]['price'];
            $product[$i]['Price 30 Kg'] = $product[$i]['price'][5]['price'];
            unset($product[$i]['price']);
            unset($product[$i]['_id']);
        }

        return Excel::create('product-list', function ($excel) use ($product) {
            $excel->sheet('product list', function ($sheet) use ($product) {
                $sheet->fromArray($product);
            });
        })->download('xlsx');
        return dd($product);

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
                    ||!isset($listData['stock'])||!isset($listData['currency'])||!isset($listData['price_250_gr'])
                    ||!isset($listData['price_500_gr'])||!isset($listData['price_1_kg'])||!isset($listData['price_5_kg'])
                    ||!isset($listData['price_25_kg'])||!isset($listData['price_30_kg'])){
                        
                        $data[] = array('parent column not valid');

                    }else{
                        $code = $listData['code'];
                        $name = $listData['name'];
                        $type = $listData['type'];
                        $stock = $listData['stock'];
                        $currency = $listData['currency'];
                        $price_250_gr = $listData['price_250_gr'];
                        $price_500_gr = $listData['price_500_gr'];
                        $price_1_kg = $listData['price_1_kg'];
                        $price_5_kg = $listData['price_5_kg'];
                        $price_25_kg = $listData['price_25_kg'];
                        $price_30_kg = $listData['price_30_kg'];
                        if( trim($code) == "" || trim($name) == "" || trim($type) == "" || trim($stock) == ""
                        || trim($currency) == "" || trim($price_250_gr) == "" || trim($price_500_gr) == "" 
                        || trim($price_1_kg) == "" || trim($price_5_kg) == "" || trim($price_25_kg) == ""|| trim($price_30_kg) == "" ){
                            $data[] = array('error import => data value not valid');
                        }else{
                            $data[] = array('next steep');
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
