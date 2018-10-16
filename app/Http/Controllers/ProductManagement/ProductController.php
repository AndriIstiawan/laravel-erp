<?php

namespace App\Http\Controllers\ProductManagement;

use App\Categories;
use App\Http\Controllers\Controller;
use App\Product;
use App\Types;
use App\Variant;
use App\CommercialStatus;
use Auth;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use Session;

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
        $status = 'true';
        $product = Product::where('code', $request->code)->first();
        if ($product) {
            if (isset($request->id)) {
                if ($request->id == $product['_id']) {
                    $status = 'true';
                } else {
                    $status = 'false';
                }
            } else {
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
    public function tampil($id)
    {
        $product = product::find($id);
        $categories = Categories::all();
        $categories = $categories->toArray();
        return view('panel.product-management.product.form-edit')->with(['product' => $product, 'categories' => $categories]);
    }

    //view form create
    public function create()
    {
        $types = Types::all();
        $category = Categories::all();
        $commercialstatus = CommercialStatus::all();
        return view('panel.product-management.product.form-create', [
            'types' => $types,
            'category' => $category,
            'commercialstatus' => $commercialstatus
        ]);
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
        $product->code = $request->code;
        $product->type = $request->type;
        $product->category = $request->category;
        $product->commercialstatus = $request->commercial;
        $product->currency = $request->currency;
        $product->price = [
            [
                'name' => '250g Plastik',
                'price' => rollbackPrice($request->input('250gPlastik')),
            ],
            [
                'name' => '250g Aluminium',
                'price' => rollbackPrice($request->input('250gAluminium')),
            ],
            [
                'name' => '500g Plastik',
                'price' => rollbackPrice($request->input('500gPlastik')),
            ],
            [
                'name' => '500g Aluminium',
                'price' => rollbackPrice($request->input('500gAluminium')),
            ],
            [
                'name' => '1kg Plastik',
                'price' => rollbackPrice($request->input('1kgPlastik')),
            ],
            [
                'name' => '1kg Aluminium',
                'price' => rollbackPrice($request->input('1kgAluminium')),
            ],
            [
                'name' => '5kg Jerigen',
                'price' => rollbackPrice($request->input('5kgJerigen')),
            ],
            [
                'name' => '25kg Jerigen',
                'price' => rollbackPrice($request->input('25kgJerigen')),
            ],
            [
                'name' => '25kg Drum',
                'price' => rollbackPrice($request->input('25kgDrum')),
            ],
            [
                'name' => '30kg Jerigen',
                'price' => rollbackPrice($request->input('30kgJerigen')),
            ],
        ];
        $product->stock = [
            [
                'name' => '250g Plastik',
                'quantity' => ((double) $request->input('250gPlastiks')) * 1000,
            ],
            [
                'name' => '250g Aluminium',
                'quantity' => ((double) $request->input('250gAluminiums')) * 1000,
            ],
            [
                'name' => '500g Plastik',
                'quantity' => ((double) $request->input('500gPlastiks')) * 1000,
            ],
            [
                'name' => '500g Aluminium',
                'quantity' => ((double) $request->input('500gAluminiums')) * 1000,
            ],
            [
                'name' => '1kg Plastik',
                'quantity' => ((double) $request->input('1kgPlastiks')) * 1000,
            ],
            [
                'name' => '1kg Aluminium',
                'quantity' => ((double) $request->input('1kgAluminiums')) * 1000,
            ],
            [
                'name' => '5kg Jerigen',
                'quantity' => ((double) $request->input('5kgJerigens')) * 1000,
            ],
            [
                'name' => '25kg Jerigen',
                'quantity' => ((double) $request->input('25kgJerigens')) * 1000,
            ],
            [
                'name' => '25kg Drum',
                'quantity' => ((double) $request->input('25kgDrums')) * 1000,
            ],
            [
                'name' => '30kg Jerigen',
                'quantity' => ((double) $request->input('30kgJerigens')) * 1000,
            ],
        ];

        $product->save();
        return redirect()->route('product.index')->with('toastr', 'product');
    }

    //for getting datatable at index
    public function listData()
    {
        $products = product::select('id', 'code', 'name', 'type', 'stock', 'created_at');
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
            case "import":
                return $this->productImport();
                break;
            default:return $this->listData();
        }
    }

    //view form edit
    public function edit($id)
    {
        $product = product::find($id);
        $types = Types::all();
        $category = Categories::all();
        $commercialstatus = CommercialStatus::all();
        return view('panel.product-management.product.form-edit')->with([
            'product' => $product, 
            'types' => $types,
            'category' => $category,
            'commercialstatus' => $commercialstatus
        ]);
    }

    //update data product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->type = $request->type;
        $product->category = $request->category;
        $product->commercialstatus = $request->commercial;
        $product->currency = $request->currency;
        $product->price = [
            [
                'name' => '250g Plastik',
                'price' => (double) str_replace(',', '', $request->input('250gPlastik')),
            ],
            [
                'name' => '250g Aluminium',
                'price' => (double) str_replace(',', '', $request->input('250gAluminium')),
            ],
            [
                'name' => '500g Plastik',
                'price' => (double) str_replace(',', '', $request->input('500gPlastik')),
            ],
            [
                'name' => '500g Aluminium',
                'price' => (double) str_replace(',', '', $request->input('500gAluminium')),
            ],
            [
                'name' => '1kg Plastik',
                'price' => (double) str_replace(',', '', $request->input('1kgPlastik')),
            ],
            [
                'name' => '1kg Aluminium',
                'price' => (double) str_replace(',', '', $request->input('1kgAluminium')),
            ],
            [
                'name' => '5kg Jerigen',
                'price' => (double) str_replace(',', '', $request->input('5kgJerigen')),
            ],
            [
                'name' => '25kg Jerigen',
                'price' => (double) str_replace(',', '', $request->input('25kgJerigen')),
            ],
            [
                'name' => '25kg Drum',
                'price' => (double) str_replace(',', '', $request->input('25kgDrum')),
            ],
            [
                'name' => '30kg Jerigen',
                'price' => (double) str_replace(',', '', $request->input('30kgJerigen')),
            ],
        ];
        $product->stock = [
            [
                'name' => '250g Plastik',
                'quantity' => ((double) $request->input('250gPlastiks')) * 1000,
            ],
            [
                'name' => '250g Aluminium',
                'quantity' => ((double) $request->input('250gAluminiums')) * 1000,
            ],
            [
                'name' => '500g Plastik',
                'quantity' => ((double) $request->input('500gPlastiks')) * 1000,
            ],
            [
                'name' => '500g Aluminium',
                'quantity' => ((double) $request->input('500gAluminiums')) * 1000,
            ],
            [
                'name' => '1kg Plastik',
                'quantity' => ((double) $request->input('1kgPlastiks')) * 1000,
            ],
            [
                'name' => '1kg Aluminium',
                'quantity' => ((double) $request->input('1kgAluminiums')) * 1000,
            ],
            [
                'name' => '5kg Jerigen',
                'quantity' => ((double) $request->input('5kgJerigens')) * 1000,
            ],
            [
                'name' => '25kg Jerigen',
                'quantity' => ((double) $request->input('25kgJerigens')) * 1000,
            ],
            [
                'name' => '25kg Drum',
                'quantity' => ((double) $request->input('25kgDrums')) * 1000,
            ],
            [
                'name' => '30kg Jerigen',
                'quantity' => ((double) $request->input('30kgJerigens')) * 1000,
            ],
        ];

        $product->save();
        return redirect()->route('product.index')->with('update', 'product');
    }

    //delete data product
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('dlt', 'Products deleted!');
    }

    public function productExport()
    {
        $file = storage_path('exports/product-form-format.xlsx');
        $products = Product::all();

        //load excel form and editing row
        $excel = Excel::selectSheetsByIndex(0, 1)->load($file, function ($reader) use ($products) {
            $data = [];
            foreach ($products as $product) {
                $data[] = [
                    $product->code,
                    $product->name,
                    $product->type,
                    $product->category,
                    $product->commercialstatus,
                    $product->currency,
                    /*$product->price[0]['price'],
                    $product->price[1]['price'],
                    $product->price[2]['price'],
                    $product->price[3]['price'],
                    $product->price[4]['price'],
                    $product->price[5]['price'],
                    $product->price[6]['price'],
                    $product->price[7]['price'],
                    $product->price[8]['price'],
                    $product->price[9]['price'],
                    ((double) $product->stock[0]['quantity'] / 1000 != 0 ? (double) $product->stock[0]['quantity'] / 1000 : ''),
                    ((double) $product->stock[1]['quantity'] / 1000 != 0 ? (double) $product->stock[1]['quantity'] / 1000 : ''),
                    ((double) $product->stock[2]['quantity'] / 1000 != 0 ? (double) $product->stock[2]['quantity'] / 1000 : ''),
                    ((double) $product->stock[3]['quantity'] / 1000 != 0 ? (double) $product->stock[3]['quantity'] / 1000 : ''),
                    ((double) $product->stock[4]['quantity'] / 1000 != 0 ? (double) $product->stock[4]['quantity'] / 1000 : ''),
                    ((double) $product->stock[5]['quantity'] / 1000 != 0 ? (double) $product->stock[5]['quantity'] / 1000 : ''),
                    ((double) $product->stock[6]['quantity'] / 1000 != 0 ? (double) $product->stock[6]['quantity'] / 1000 : ''),
                    ((double) $product->stock[7]['quantity'] / 1000 != 0 ? (double) $product->stock[7]['quantity'] / 1000 : ''),
                    ((double) $product->stock[8]['quantity'] / 1000 != 0 ? (double) $product->stock[8]['quantity'] / 1000 : ''),
                    ((double) $product->stock[9]['quantity'] / 1000 != 0 ? (double) $product->stock[9]['quantity'] / 1000 : ''),*/
                ];
            }

            //editing sheet 1
            $reader->setActiveSheetIndex(0);
            $sheet1 = $reader->getActiveSheet();
            $sheet1->fromArray($data, null, 'A3', false, false);
        })->setFilename('product-form-export[' . date("H-i-s d-m-Y") . "]")->download('xlsx');
    }

    //view form import
    public function productImport()
    {
        return view('panel.product-management.product.form-import')->with([
            'uriLink' => 'import',
        ]);
    }

    //import data
    public function ImportData(Request $request)
    {
        $limit_chunk = 1000000000000000;
        $file = $request->import->getRealPath();
        $filename = 'product-form-import[' . date("H-i-s d-m-Y") . "][" . Auth::user()->email . "]";
        $excel = Excel::selectSheetsByIndex(0)->load($file)->setFilename($filename)->store('xlsx', false, true);
        $file = storage_path('exports/'.$filename.".xlsx");
        $excel = Excel::filter('chunk')->selectSheetsByIndex(0)->load($file)->chunk($limit_chunk, function($results){
            $data = 'array(';
            foreach($results as $listData){ //result[0] if load multiple sheet selectSheetsByIndex(0,1)
                //check parent column value
                if (!isset($listData['code']) || !isset($listData['product']) || !isset($listData['type']) || !isset($listData['category'])
                    || !isset($listData['commercialstatus']) || !isset($listData['currency']) || !isset($listData['250g_plastik_price'])
                    || !isset($listData['250g_aluminium_price']) || !isset($listData['500g_plastik_price']) || !isset($listData['500g_aluminium_price'])
                    || !isset($listData['1kg_plastik_price']) || !isset($listData['1kg_aluminium_price']) || !isset($listData['5kg_jerigen_price'])
                    || !isset($listData['25kg_jerigen_price']) || !isset($listData['25kg_drum_price']) || !isset($listData['30kg_jerigen_price'])
                    || !isset($listData['250g_plastik_stock']) || !isset($listData['250g_aluminium_stock']) || !isset($listData['500g_plastik_stock'])
                    || !isset($listData['500g_aluminium_stock']) || !isset($listData['1kg_plastik_stock']) || !isset($listData['1kg_aluminium_stock'])
                    || !isset($listData['5kg_jerigen_stock']) || !isset($listData['25kg_jerigen_stock']) || !isset($listData['25kg_drum_stock'])
                    || !isset($listData['30kg_jerigen_stock'])) {
                    $data .= 'array("parent column not valid"),';
                }else{
                    $data .= 'array(';
                    $code = trim($listData['code']);
                    $product_name = trim($listData['product']);
                    $type = trim($listData['type']);
                    $category = trim($listData['category']);
                    $commercialstatus = trim($listData['commercialstatus']);
                    $currency = trim($listData['currency']);
                    $data .= '"'.$code.'","'.$product_name.'","'.$type.'","'.$category.'","'.$commercialstatus.'","'.$currency.'",';
                    $data .= '"'.$listData['250g_plastik_price'].'","'.$listData['250g_aluminium_price'].'","'.$listData['500g_plastik_price'].'",';
                    $data .= '"'.$listData['500g_aluminium_price'].'","'.$listData['1kg_plastik_price'].'","'.$listData['1kg_aluminium_price'].'",';
                    $data .= '"'.$listData['5kg_jerigen_price'].'","'.$listData['25kg_jerigen_price'].'","'.$listData['25kg_drum_price'].'",';
                    $data .= '"'.$listData['30kg_jerigen_price'].'","'.$listData['250g_plastik_stock'].'","'.$listData['250g_aluminium_stock'].'",';
                    $data .= '"'.$listData['500g_plastik_stock'].'","'.$listData['500g_aluminium_stock'].'","'.$listData['1kg_plastik_stock'].'",';
                    $data .= '"'.$listData['1kg_aluminium_stock'].'","'.$listData['5kg_jerigen_stock'].'","'.$listData['25kg_jerigen_stock'].'",';
                    $data .= '"'.$listData['25kg_drum_stock'].'","'.$listData['30kg_jerigen_stock'].'",';

                    if ($code == "" || $product_name == "" || $type == "" /*|| $commercialstatus == ""*/ || $currency == "") {
                        $data .= '"error import => require data is empty [code,product,type,commercialstatus,currency]"),';
                    }else{
                        $type = Types::where('name', $type)->first();
                        if (!$type) {
                            $data .= '"error import => type product not found"),';
                        }else{
                            $product = Product::where('code', $code)->first();
                            if ($product) {
                                $data .= '"edit product successfuly."),';
                            } else {
                                $data .= '"new product successfuly insert."),';
                                $product = new Product();
                            }
                            $product['code'] = $code;
                            $product['name'] = $product_name;
                            $product['type'] = $type['name'];
                            $product['category'] = $category;
                            $product['commercialstatus'] = $commercialstatus;
                            $product['currency'] = $currency;
                            $product['price'] = [
                                [
                                    'name' => '250g Plastik',
                                    'price' => (double) str_replace(',', '', $listData['250g_plastik_price']),
                                ],
                                [
                                    'name' => '250g Aluminium',
                                    'price' => (double) str_replace(',', '', $listData['250g_aluminium_price']),
                                ],
                                [
                                    'name' => '500g Plastik',
                                    'price' => (double) str_replace(',', '', $listData['500g_plastik_price']),
                                ],
                                [
                                    'name' => '500g Aluminium',
                                    'price' => (double) str_replace(',', '', $listData['500g_aluminium_price']),
                                ],
                                [
                                    'name' => '1kg Plastik',
                                    'price' => (double) str_replace(',', '', $listData['1kg_plastik_price']),
                                ],
                                [
                                    'name' => '1kg Aluminium',
                                    'price' => (double) str_replace(',', '', $listData['1kg_aluminium_price']),
                                ],
                                [
                                    'name' => '5kg Jerigen',
                                    'price' => (double) str_replace(',', '', $listData['5kg_jerigen_price']),
                                ],
                                [
                                    'name' => '25kg Jerigen',
                                    'price' => (double) str_replace(',', '', $listData['25kg_jerigen_price']),
                                ],
                                [
                                    'name' => '25kg Drum',
                                    'price' => (double) str_replace(',', '', $listData['25kg_drum_price']),
                                ],
                                [
                                    'name' => '30kg Jerigen',
                                    'price' => (double) str_replace(',', '', $listData['30kg_jerigen_price']),
                                ],
                            ];

                            $product['stock'] = [
                                [
                                    'name' => '250g Plastik',
                                    'quantity' => ((double) $listData['250g_plastik_stock']) * 1000,
                                ],
                                [
                                    'name' => '250g Aluminium',
                                    'quantity' => ((double) $listData['250g_aluminium_stock']) * 1000,
                                ],
                                [
                                    'name' => '500g Plastik',
                                    'quantity' => ((double) $listData['500g_plastik_stock']) * 1000,
                                ],
                                [
                                    'name' => '500g Aluminium',
                                    'quantity' => ((double) $listData['500g_aluminium_stock']) * 1000,
                                ],
                                [
                                    'name' => '1kg Plastik',
                                    'quantity' => ((double) $listData['1kg_plastik_stock']) * 1000,
                                ],
                                [
                                    'name' => '1kg Aluminium',
                                    'quantity' => ((double) $listData['1kg_aluminium_stock']) * 1000,
                                ],
                                [
                                    'name' => '5kg Jerigen',
                                    'quantity' => ((double) $listData['5kg_jerigen_stock']) * 1000,
                                ],
                                [
                                    'name' => '25kg Jerigen',
                                    'quantity' => ((double) $listData['25kg_jerigen_stock']) * 1000,
                                ],
                                [
                                    'name' => '25kg Drum',
                                    'quantity' => ((double) $listData['25kg_drum_stock']) * 1000,
                                ],
                                [
                                    'name' => '30kg Jerigen',
                                    'quantity' => ((double) $listData['30kg_jerigen_stock']) * 1000,
                                ],
                            ];
                            $product->save();
                        }
                    }
                }
            }
            $data .= ')';
            Session::put('result_status',$data);
        });

        $result_status = eval('return ' . Session::get('result_status') . ';');
        Session::forget('result_status');
        $excel = Excel::selectSheetsByIndex(0)->load($file, function($reader) use ($filename,$result_status) {
            //editing sheet 1
            $sheet0 = $reader->setActiveSheetIndex(0);
            $reader->getActiveSheet()->fromArray($result_status, null, 'A3', false, false);
        })->setFilename($filename)->store('xlsx', false, true);
        return $filename.'.xlsx';
    }
}
