<?php

namespace App\Http\Controllers\ProductManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

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
        // $file = public_path(). "/files/product/product-form-import.xlsx";
        // // $productsImportData = Excel::selectSheetsByIndex(0)->load($file)->all();
        // // foreach ($productsImportData->toArray() as $row) {
        // //     print_r($row);
        // //     echo "<hr>";
        // // }
        // $productsImportData = Excel::selectSheetsByIndex(0)->load($file, function($reader) {
        //     $results = $reader->all();
        // })->get();
        // foreach ($productsImportData as $row) {
        //     print_r($row);
        //     echo "<hr>";
        // }
        // return $productsImportData->select(array('SKU', 'Category'))->dd();
        return view('panel.product-management.product.import-panel.index');
    }

    //public index import product
    public function importData(Request $request)
    {
        $file = $request->import;
        $results = 'asu';

        $excel = Excel::load($file->getRealPath(), function($reader) {
            //$results = $reader->get();
        });//->store('xlsx', false, true);
        
        // Get the file to use it as attachment
        //$file = $excel['full'];
        //return response()->download($file);
    }
}
