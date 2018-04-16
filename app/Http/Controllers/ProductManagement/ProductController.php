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

    //store data product
    public function store(Request $request)
    {   
        //for edit product
        $arrPic = [];
        $i = 0;
        
        //detect if create or edit product
        if($request->id != ''){ 
            $product = Product::find($request->id);
            foreach($product->image as $prodImage){
                if(isset($request->fileImage)){
                    if(in_array($prodImage['filename'],$request->fileImage)){
                        $prodImg = explode('.',$prodImage['filename']);
                        $prodImg = "[".$i."]".$product->id.'.'.$prodImg[count($prodImg)-1];
                        $arrPic[] = [
                            'filename' => $prodImg,
                            'size' => $prodImage['size']
                        ];
                        $i++;
                        File::move(public_path('/img/products/' . $prodImage['filename']), public_path('/img/products/' . $prodImg));
                    }else{
                        File::delete(public_path('/img/products/' . $prodImage['filename']));
                    }
                }else{
                    File::delete(public_path('/img/products/' . $prodImage['filename']));
                }
            }
            if(isset($product->variant)){
                foreach($product->variant as $prodvariant){
                    if(isset($request->fileVars)){
                        if(!in_array($prodvariant['image'],$request->fileVars)){
                            File::delete(public_path('/img/products/' . $prodvariant['image']));
                        }
                    }else{
                        File::delete(public_path('/img/products/' . $prodvariant['image']));
                    }
                }
            }
        }else{
            $product = new Product();
        }
        
        $product->name = $request->name;
        $product->categories = Categories::whereIn('slug', $request->category)->get()->toArray();
        $product->description = $request->description;
        $product->weight = [
            [
                "unit" => $request->weightUnit,
                "weight" => (double)$request->weight
            ]
        ];
        $product->stock = (double)$request->stock;
        $product->sku = $request->sku;
        $product->save();

        //add picture product
        $j = count($arrPic);
        if ($request->hasFile('image')) {
            $pictureFiles = $request->file('image');
            for($i=0; $i < count($pictureFiles); $i++){
                $extension = $pictureFiles[$i]->getClientOriginalExtension();
                $destinationPath = public_path('/img/products/['. $j . ']'.$product->id . '.' . $extension);
                //$pictureFiles[$i]->move($destinationPath, '['. $j . ']' . $product->id . '.' . $extension);
                Image::make($pictureFiles[$i]->getRealPath())->resize(300, 300)->save($destinationPath);
                $arrPic[] = [
                    'filename' => '['. $j . ']' . $product->id . '.' . $extension,
                    'size' => $pictureFiles[$i]->getClientSize()
                ];
                $j++;
            }
        }
        $product->image = $arrPic;
        $product->save();

        //if detect add variant
        if($request->variants && count($request->variants) > 0){
            $arrVar = [];
            for($i=0; $i < count($request->variants); $i++){
                $varImage = null;
                
                if(isset($request->varsPicture[$i])){
                    $extension = $request->varsPicture[$i]->getClientOriginalExtension();
                    $destinationPath = public_path('/img/products/'.$request->variants[$i] . '.' . $extension);
                    //$request->varsPicture[$i]->move($destinationPath, $request->variants[$i] . '.' . $extension);
                    Image::make($request->varsPicture[$i]->getRealPath())->resize(300, 300)->save($destinationPath);
                    $varImage = $request->variants[$i] . '.' . $extension;
                }
                if(isset($request->fileVars)){
                    if($request->fileVars[$i] != ''){
                        $varExt = explode('.',$request->fileVars[$i]);
                        $varExt = $varExt[count($varExt)-1];
                        $varImage = $request->variants[$i] . '.' . $varExt;
                        File::move(public_path('/img/products/' . $request->fileVars[$i]), public_path('/img/products/' . $varImage));
                    }
                }
                $arrVar[] = [
                    'key' => $request->variants[$i],
                    'image' => $varImage,
                    'price' => (double)str_replace(',', '.',str_replace('.', '',$request->varPrice[$i])),
                    'sku' => $request->varSku[$i],
                    'varStock' => (double)$request->varStock[$i]
                ];
            }
            $product->variant = $arrVar;
            $product->price = [
                [
                    "min" => (double)str_replace(',', '.',str_replace('.', '',$request->minPrice)),
                    "max" => (double)str_replace(',', '.',str_replace('.', '',$request->maxPrice)),
                ]
            ];
            $product->save();
        }else{
            $product->unset('variant');
            $product->price = [
                [
                    "min" => (double)str_replace(',', '.',str_replace('.', '',$request->prodPrice)),
                    "max" => (double)str_replace(',', '.',str_replace('.', '',$request->prodPrice)),
                ]
            ];
            $product->save();
        }

        return $product->id;
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
            ->addColumn('priceCol', function ($products) {
                if($products->price[0]['min'] == $products->price[0]['max']){
                    return "Rp. ". number_format($products->price[0]['min']);
                }else{
                    return "Rp. ". number_format($products->price[0]['min']).' - Rp. '. number_format($products->price[0]['max']);
                }
            })
            ->addColumn('variants', function ($products) {
                if($products->variant){
                    return count($products->variant);
                }else{
                    return "0";
                }
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
        
    }

    //delete data product
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        
        return redirect()->route('product.index')->with('dlt', 'Products updated!');
    }
}
