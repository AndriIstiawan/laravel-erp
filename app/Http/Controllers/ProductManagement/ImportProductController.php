<?php

namespace App\Http\Controllers\ProductManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

use App\Categories;
use App\Product;
use App\Type;
use App\CommercialStatus;
use App\Variant;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use Session;

class ImportProductController extends Controller
{
    //Protected module product by slug
    public function __construct()
    {
        $this->middleware('perm.acc:product');
    }

    //public index import product
    public function index()
    {
        //return view('panel.product-management.product.import-panel.index');
    }

    //public index import product
    public function importData(Request $request)
    {
        $path = $request->file('import')
                        ->getRealPath();

        $product_excel       = Excel::selectSheetsByIndex(0)->load($path)->get();
        $product_variation   = Excel::selectSheetsByIndex(1)->load($path)->get();

        $product_collection = collect($product_excel->toArray());
        $product_variation_collection = collect($product_variation->toArray());

       //\Log::info($this->checkCategory());
        
        // #function validation import
        $response = $this->validationImportProduct($product_collection);


        if($response['alert'] == 'success') {

           foreach ($product_collection->chunk(100) as  $valid_file) {

                foreach ($valid_file as  $value) {
                    $product = Product::firstOrNew([ 'code' => $value['code']]);
                    $product->name = $value['product'];
                    $product->type = $value['type'];
                    $product->category = $value['category'];
                    $product->commercial = $value['commercialstatus'];
                    $product->currency = $value['currency'];
                    $product->price = [
                            [
                                'name' => '250g Plastik',
                                'price' => (double)$value['250g_plastik_price'],
                            ],
                            [
                                'name' => '250g Aluminium',
                                'price' => (double)$value['250g_aluminium_price'],
                            ],
                            [
                                'name' => '500g Plastik',
                                'price' => (double)$value['500g_plastik_price'],
                            ],
                            [
                                'name' => '500g Aluminium',
                                'price' => (double)$value['500g_aluminium_price'],
                            ],
                            [
                                'name' => '1kg Plastik',
                                'price' => (double)$value['1kg_plastik_price'],
                            ],
                            [
                                'name' => '1kg Aluminium',
                                'price' => (double)$value['1kg_aluminium_price'],
                            ],
                            [
                                'name' => '5kg Jerigen',
                                'price' => (double)$value['5kg_jerigen_price'],
                            ],
                            [
                                'name' => '25kg Jerigen',
                                'price' => (double)$value['25kg_jerigen_price'],
                            ],
                            [
                                'name' => '25kg Drum',
                                'price' => (double)$value['25kg_drum_price'],
                            ],
                            [
                                'name' => '30kg Jerigen',
                                'price' => (double)$value['30kg_jerigen_price'],
                            ],
                        ];
                        $product->stock = [
                            [
                                'name' => '250g Plastik',
                                'quantity' => ((double) $value['250g_plastik_stock']) * 1000,
                            ],
                            [
                                'name' => '250g Aluminium',
                                'quantity' => ((double) $value['250g_aluminium_stock']) * 1000,
                            ],
                            [
                                'name' => '500g Plastik',
                                'quantity' => ((double) $value['500g_plastik_stock']) * 1000,
                            ],
                            [
                                'name' => '500g Aluminium',
                                'quantity' => ((double) $value['500g_aluminium_stock']) * 1000,
                            ],
                            [
                                'name' => '1kg Plastik',
                                'quantity' => ((double) $value['1kg_plastik_stock']) * 1000,
                            ],
                            [
                                'name' => '1kg Aluminium',
                                'quantity' => ((double) $value['1kg_aluminium_stock']) * 1000,
                            ],
                            [
                                'name' => '5kg Jerigen',
                                'quantity' => ((double) $value['5kg_jerigen_stock']) * 1000,
                            ],
                            [
                                'name' => '25kg Jerigen',
                                'quantity' => ((double) $value['25kg_jerigen_stock']) * 1000,
                            ],
                            [
                                'name' => '25kg Drum',
                                'quantity' => ((double) $value['25kg_drum_stock']) * 1000,
                            ],
                            [
                                'name' => '30kg Jerigen',
                                'quantity' => ((double) $value['30kg_jerigen_stock']) * 1000,
                            ],
                        ];
                    $product->save();
                }
            }
        }
        return $response;
    }

    /**
     * this is function validation import file excel product
     * check field mandotary
     * check image extension only mime_type Image
     */
    private function validationImportProduct($collection)
    {
        #CHECK VALIDATION FILE
        #this is field mandotary
        $code         = $collection->pluck('code');
        $name         = $collection->pluck('product');
        $type         = $collection->pluck('type');
        $category     = $collection->pluck('category');
        $commercial   = $collection->pluck('commercialstatus');
        $currency     = $collection->pluck('currency');

        #check if column mandotary is null return warning
        if( $code->contains(null) == true || $name->contains(null) == true || $category->contains(null) == true || $type->contains(null) == true || $commercial->contains(null) == true || $currency->contains(null) == true  ) {

            $response = array(
                'alert' => 'warning',
                'message' => 'Please check again your file, column mandotary must field...'
            );

        }else{
            #Checking Category Master
            #if empty redirect back
            if( count($this->checkCategory($category)) > 0 ) {

                $category_empty = implode(', ', $this->checkCategory($category));

                $response = array(
                    'alert'   => 'warning',
                    'message' => 'Sorry category '. $category_empty. ' not found in database, please check first your list categories in system'
                );

            }
            else
            {

                #Checking Brand Master
                #if empty redirect back
                if( count($this->checkType($type)) > 0 ) {

                    $type_empty = implode(', ', $this->checkType($type));

                    $response = array(
                        'alert'   => 'warning',
                        'message' => 'Sorry type '. $type_empty. ' not found in database, please check first your list brand in system'
                    );

                } else {

                    if( count($this->checkCommercial($commercial)) > 0 ) {

                    $commercial_empty = implode(', ', $this->checkCommercial($commercial));

                    $response = array(
                        'alert'   => 'warning',
                        'message' => 'Sorry commercial status '. $commercial_empty. ' not found in database, please check first your list brand in system'
                    );

                }else{


                    #PROSES VALID
                    $response = array(
                        'alert'   => 'success',
                        'message' => 'Success Import Product...'
                    );
                    }
                }
            }
        }

        return $response;
    }

    private function checkCategory($category_excel): array
    {

        $category_empty = [];

        foreach ($category_excel as $key => $data_cat) {

           $categories = Categories::where('name', ($data_cat))->first();
            
            if(!$categories)  {

                $category_empty[] =  $data_cat;

            }

        }

        return $category_empty;
        
    }

    private function checkType($type_excel): array
    {

        $type_empty = [];
        
        foreach ($type_excel as $key => $data_type) {

           $types = Type::where('name', ($data_type))->first();
            
            if(!$types)  {

                $type_empty[] =  $data_type;

            }

        }

        return $type_empty;
        
    }

    private function checkCommercial($commercial_excel): array
    {

        $commercial_empty = [];
        
        foreach ($commercial_excel as $key => $data_commercial) {

           $brands = CommercialStatus::where('name', ($data_commercial))->first();
            
            if(!$brands)  {

                $commercial_empty[] =  $data_commercial;

            }

        }

        return $commercial_empty;
        
    }
}
