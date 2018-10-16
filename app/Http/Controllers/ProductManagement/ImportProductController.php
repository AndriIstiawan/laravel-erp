<?php

namespace App\Http\Controllers\ProductManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

//use App\Jobs\ProductUpdatePrice;
use App\Categories;
use App\Product;
use App\Types;
use App\CommercialStatus;
use App\Variant;
use Auth;

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
        $file = $request->file('import');
        $filename = 'product-log-import['.date("H-i-s d-m-Y")."][".Auth::user()->email."].xlsx";
        $file->move(storage_path('exports'), $filename);

        $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
        $reader->open(storage_path('exports/'.$filename));
        $sheet1[] = ['Code', 'Product', 'Type', 'Category', 'CommercialStatus', 'Currency'/*, '250g Plastik Price', '250g Aluminium Price', '500g Plastik Price','500g Aluminium Price', '1kg Plastik Price','1kg Aluminium Price', '5kg Jerigen Price', '25kg Jerigen Price', '25kg Drum Price', '30kg Jerigen Price','250g Plastik Stock', '250g Aluminium Stock', '500g Plastik Stock', '500g Aluminium Stock', '1kg Plastik Stock', '1kg Aluminium Stock', '5kg Jerigen Stock', '25kg Jerigen Stock', '25kg Drum Stock', '30kg Jerigen Stock'*/];

        // loop semua sheet dan dapatkan sheet orders
        foreach ($reader->getSheetIterator() as $sheet) {
             //if ($sheet->getName() === 'Product'){
                $i = 0;
                $total_valid_row = 0;
                $total_invalid_row = 0;
                $total_product_create = 0;
                $total_product_update = 0;
                $total_product_proccess_invalid = 0;
                foreach ($sheet->getRowIterator() as $idx) {
                    $i++;
                    if($i > 2){
                        $statusValidasi = $this->validasiDataRow($idx);
                        $data_feedback = $statusValidasi['data'];

                        //jika valid baru masukkan data
                        if($statusValidasi['status']){
                            $total_valid_row++;
                            $product = Product::where('code', (string)trim($idx[0]))->first();
                            if(isset($product->id)){
                                $total_product_update++;
                                $product_status = 'update';
                            }else{
                                $total_product_create++;
                                $product_status = 'create';
                                $product = new Product();
                            }

                            $product->code = (string)trim($idx[0]);
                            $product->name = $idx[1];
                            $product->type = $idx[2];
                            $product->category = $idx[3];
                            $product->commercialstatus = $idx[4];
                            $product->currency = $idx[5];
                            /*$product->price = [
                                [
                                    'name' => '250g Plastik',
                                    'price' => (double)trim($idx[6]),
                                ],
                                [
                                    'name' => '250g Aluminium',
                                    'price' => (double)trim($idx[7]),
                                ],
                                [
                                    'name' => '500g Plastik',
                                    'price' => (double)trim($idx[8]),
                                ],
                                [
                                    'name' => '500g Aluminium',
                                    'price' => (double)trim($idx[9]),
                                ],
                                [
                                    'name' => '1kg Plastik',
                                    'price' => (double)trim($idx[10]),
                                ],
                                [
                                    'name' => '1kg Aluminium',
                                    'price' => (double)trim($idx[11]),
                                ],
                                [
                                    'name' => '5kg Jerigen',
                                    'price' => (double)trim($idx[12]),
                                ],
                                [
                                    'name' => '25kg Jerigen',
                                    'price' => (double)trim($idx[13]),
                                ],
                                [
                                    'name' => '25kg Drum',
                                    'price' => (double)trim($idx[14]),
                                ],
                                [
                                    'name' => '30kg Jerigen',
                                    'price' => (double)trim($idx[15]),
                                ],
                            ];
                            $product->stock = [
                                [
                                    'name' => '250g Plastik',
                                    'quantity' => ((double) trim($idx[16])) * 1000,
                                ],
                                [
                                    'name' => '250g Aluminium',
                                    'quantity' => ((double) trim($idx[17])) * 1000,
                                ],
                                [
                                    'name' => '500g Plastik',
                                    'quantity' => ((double) trim($idx[18])) * 1000,
                                ],
                                [
                                    'name' => '500g Aluminium',
                                    'quantity' => ((double) trim($idx[19])) * 1000,
                                ],
                                [
                                    'name' => '1kg Plastik',
                                    'quantity' => ((double) trim($idx[20])) * 1000,
                                ],
                                [
                                    'name' => '1kg Aluminium',
                                    'quantity' => ((double) trim($idx[21])) * 1000,
                                ],
                                [
                                    'name' => '5kg Jerigen',
                                    'quantity' => ((double) trim($idx[22])) * 1000,
                                ],
                                [
                                    'name' => '25kg Jerigen',
                                    'quantity' => ((double) trim($idx[23])) * 1000,
                                ],
                                [
                                    'name' => '25kg Drum',
                                    'quantity' => ((double) trim($idx[24])) * 1000,
                                ],
                                [
                                    'name' => '30kg Jerigen',
                                    'quantity' => ((double) trim($idx[25])) * 1000,
                                ],
                            ];*/
                            $exec = $product->save();
                            if($exec){
                                if($product_status == 'update'){
                                    $data_feedback[] = 'Update product successfully';
                                }else{
                                    $data_feedback[] = 'Create product successfully';
                                }
                            }else{
                                $total_product_proccess_invalid++;
                                $data_feedback[] = 'product process invalid';
                            }
                            //$this->dispatch(new ProductImageUpload('main-image', $product->id));
                        }else{
                            $total_invalid_row++;
                        }
                        $sheet1[] = $data_feedback;
                    }
                }
                $sheet1[] = [' '];
                $sheet1[] = ['total row : '.($total_valid_row+$total_invalid_row)];
                $sheet1[] = ['total valid data row : '.$total_valid_row];
                $sheet1[] = ['total invalid data row : '.$total_invalid_row];
                $sheet1[] = ['total product process : '.($total_product_create+$total_product_update+$total_product_proccess_invalid)];
                $sheet1[] = ['total product create  : '.$total_product_create];
                $sheet1[] = ['total product update  : '.$total_product_update];
                $sheet1[] = ['total product invalid proccess  : '.$total_product_proccess_invalid];
            //}
        }
        $reader->close();

        $writer = WriterFactory::create(Type::XLSX); // for XLSX files
        $writer->openToFile(storage_path('exports/'.$filename)); // stream data directly to the browser
        $firstSheet = $writer->getCurrentSheet();
        $writer->addRows($sheet1);
        $writer->close();
        return $filename;
    }

    //validasi data
    public function validasiDataRow($idx){
        $data = [$idx[0], $idx[1], $idx[2], $idx[3], $idx[4], $idx[5]/*, $idx[6], $idx[7], $idx[8], $idx[9], $idx[10], $idx[11], $idx[12], $idx[13], $idx[14], $idx[15], $idx[16], $idx[17], $idx[18], $idx[19], $idx[20], $idx[21], $idx[22], $idx[23], $idx[24], $idx[25]*/];

        $msg = '';
        $statusValidasi = false;

        //validasi empty value
        if(trim($idx[0]) == ''||trim($idx[1]) == ''||trim($idx[2]) == ''||trim($idx[3]) == ''||trim($idx[4]) == ''
        ||trim($idx[5]) == ''){
            $msg = '[ rows require is empty ]';
        }

        //validasi number
        /*if(!(double)trim($idx[6])){ $msg .= '[ price min value not valid ]'; }
        if(!(double)trim($idx[7])){ $msg .= '[ price max value not valid ]'; }
        if(!(double)trim($idx[8])){ $msg .= '[ price min value not valid ]'; }
        if(!(double)trim($idx[9])){ $msg .= '[ price max value not valid ]'; }
        if(!(double)trim($idx[10])){ $msg .= '[ price min value not valid ]'; }
        if(!(double)trim($idx[11])){ $msg .= '[ price max value not valid ]'; }
        if(!(double)trim($idx[12])){ $msg .= '[ price min value not valid ]'; }
        if(!(double)trim($idx[13])){ $msg .= '[ price max value not valid ]'; }
        if(!(double)trim($idx[14])){ $msg .= '[ price max value not valid ]'; }
        if(!(double)trim($idx[15])){ $msg .= '[ price max value not valid ]'; }
        if(!(double)trim($idx[16])){ $msg .= '[ product weight stock value not valid ]'; }
        if(!(double)trim($idx[17])){ $msg .= '[ product weight stock value not valid ]'; }
        if(!(double)trim($idx[18])){ $msg .= '[ product weight stock value not valid ]'; }
        if(!(double)trim($idx[19])){ $msg .= '[ product weight stock value not valid ]'; }
        if(!(double)trim($idx[20])){ $msg .= '[ product weight stock value not valid ]'; }
        if(!(double)trim($idx[21])){ $msg .= '[ product weight stock value not valid ]'; }
        if(!(double)trim($idx[22])){ $msg .= '[ product weight stock value not valid ]'; }
        if(!(double)trim($idx[23])){ $msg .= '[ product weight stock value not valid ]'; }
        if(!(double)trim($idx[24])){ $msg .= '[ product weight stock value not valid ]'; }
        if(!(double)trim($idx[25])){ $msg .= '[ product weight stock value not valid ]'; }*/

        //validasi brand and category
        if(!$this->checkCategory($idx[3])){ $msg .= '[ Category product not found ]'; }
        if(!$this->checkType($idx[2])){ $msg .= '[ Type product not found ]'; }
        if(!$this->checkCommercial($idx[4])){ $msg .= '[ Commercial Status Product not found ]'; }

        if($msg == ''){
            $statusValidasi = true;
        }else{
            $data[] = $msg;
        }
        return ['status' => $statusValidasi, 'data' => $data];
    }

    private function checkCategory($category){
        $category = Categories::where('name', ($category))->first();
        if(!$category){
            return false;
        }else{
            return true;
        }
        
    }

    private function checkType($type){
        $type = Types::where('name', ($type))->first();
        if(!$type){
            return false;
        }else{
            return true;
        }
        
    }

    private function checkCommercial($commercial){
        $commercial = CommercialStatus::where('name', ($commercial))->first();
        if(!$commercial){
            return false;
        }else{
            return true;
        }
        
    }
}
