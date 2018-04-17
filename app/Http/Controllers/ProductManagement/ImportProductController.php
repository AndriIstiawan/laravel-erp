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
    public function store(Request $request)
{
        $upload=$request->file('upload-file');
        $filePath=$upload->getRealPath();
        $file=fopen($filePath,'r');
        $header=fgetcsv($file);

        $escapedHeader=[];
        foreach ($header as $key => $value) {
        $header=strtolower($value);

        $escapedItem=preg_replace('/[^a-z]/','', $header);
        array_push($escapedHeader, $escapedItem);

        }
        while($columns=fgetcsv($file)){
          if($columns[0]=="")
          {
            continue;
        }
            foreach ($columns as $key => $value) {
            $value=preg_replace('/\D/','', $value);
        }

        $data=array_combine($escapedHeader, $columns);
        $id=$data['id'];
        $details=$data['details'];
        $postingdate=$data['postingdate'];
        $description=$data['description'];
        $amount=$data['amount'];
        $type=$data['type'];
        $slip=$data['slip'];
        $name=$data['name'];
        $job=$data['job'];
        $addchecks=Checks::firstOrNew(['id'=>$id,'details'=>$details]);
        $addchecks->postingdate=$postingdate;
        $addchecks->description=$description;
        $addchecks->amount=$amount;
        $addchecks->type=$type;
        $addchecks->slip=$slip;
        $addchecks->name=$name;
        $addchecks->job=$job;
        $addchecks->save();
    }
             
    }
}
