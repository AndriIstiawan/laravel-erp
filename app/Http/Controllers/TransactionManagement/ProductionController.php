<?php

namespace App\Http\Controllers\TransactionManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Variant;
use App\SalesOrder;
use App\User;
use Yajra\Datatables\Datatables;
use File;
use Image;
use datetime;
use App\Counter;
use App\Member;

class ProductionController extends Controller
{
    //Protected module product by slug
    public function __construct()
    {
        $this->middleware('perm.acc:production');
    }
    //find sales order
    public function find(Request $request){

        if($request->id){
            $order = SalesOrder::where('name', $request->name)->first();
            if(count($order) > 0){
                return ($request->id == $order->id ? 'true' : 'false');
            }else{
                return 'true';
            }
        }else{
            return (SalesOrder::where('name', $request->name)->first() ? 'false' : 'true' );    
        }
    }

    //public index sales order
    public function index()
    {
        return view('panel.transaction-management.production.index');
    }

    //view form create
    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $order=SalesOrder::all();
        $product= Product::all();
        $products= Product::all();
        $modUser = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        $user= User::where('role', 'elemMatch', array('name' => 'Production'))->get();
        $users= User::where('role', 'elemMatch', array('name' => 'Production'))->get();
        return view('panel.transaction-management.sales-order.form-create')->with([
            'order' => $order, 
            'product' => $product,
            'products' => $products,
            'user' => $user,
            'users' => $users,
            'modUser' => $modUser,
        ]);
    }

    //store data sales order
    public function store(Request $request)
    {   
        $order = new SalesOrder();
        $order->sono = $request->sono;
        $order->date = $request->date;
        $order->client = $request->client;

        $sales=user::where('_id', $request->sales)->get();
        $order->sales=$sales->toArray();

        

        $productss =[];
        for($i=0; $i < count($request->total); $i++){
            $products=Product::where('_id', $request->product[$i])->first();
            $productss[] =[
                'id'=> $products['id'],
                'name'=>$products['name'],
                'type'=>$products['type'],
                'code'=>$products['code'],
                'total' => $request->total[$i],
                'packaging' => $request->packaging[$i],
                'amount' => $request->amount[$i],
                'package' => $request->package[$i],
                'realisasi' => $request->realisasi[$i],
                'stockk' => $request->stockk[$i],
                'pending' => $request->pending[$i],
                'balance' => $request->balance[$i],
                'pendingpr' => $request->pendingpr[$i],
            ];
        }
        $order->productattr=$productss;

        $order->catatan = $request->catatan;
        $order->tunggu = $request->tunggu;

        /*$checks=user::where('_id', $request->check)->get();
        $order->check=$checks->toArray();

        $produksis=user::where('_id', $request->produksi)->get();
        $order->produksi=$produksis->toArray();*/

        $order->status = "production";

        return dd($order);
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $orders = SalesOrder::all();
        
        return Datatables::of($orders)
            ->addColumn('status', function ($order) {
                switch($order->status){
                    case "order":
                        return '<span class="badge badge-success" style="padding:9px;">&nbsp;&nbsp;'.$order->status.'&nbsp;&nbsp;</span>';
                        break;
                    case "production":
                        return '<span class="badge badge-warning" style="padding:9px;">&nbsp;&nbsp;'.$order->status.'&nbsp;&nbsp;</span>';
                        break;
                    default:
                        return '<span class="badge badge-success" style="padding:9px;">&nbsp;&nbsp;'.$order->status.'&nbsp;&nbsp;</span>';
                }
            })
            ->addColumn('action', function ($order) {
                return 
                    '<a class="btn btn-success btn-sm" href="'.route('production.edit',['id' => $order->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    //view form edit
    public function edit($id)
    {
        $order = SalesOrder::find($id);
        $client = Member::find($order['client'][0]['_id']);
        $members = Member::all();
        $products = Product::all();
        $user= User::where('role', 'elemMatch', array('name' => 'Production'))->get();
        $users= User::where('role', 'elemMatch', array('name' => 'Production'))->get();
        return view('panel.transaction-management.production.form-edit')->with([
            'order' => $order,
            'client' => $client,
            'members' => $members,
            'products' => $products,
            'user' => $user,
            'users' => $users,
        ]);
    }

    //update data
    public function update(Request $request, $id)
    {
        $order = SalesOrder::find($id);

        $arrProduct = [];
        $total_kg = 0;
        $total_realisasi = 0;
        foreach ($request->arrProduct as $key) {
            $product = Product::find($request->input('product' . $key));
            $total_kg = $total_kg + (((double) $request->input('total' . $key)) * 1000);
            $total_realisasi = $total_realisasi + (((double) $request->input('realisasi' . $key)) * 1000);
            $arrProduct[] = [
                "product_id" => $product['_id'],
                "name" => $product['name'] . " - " . $product['type'],
                "product_detail" => [$product->toArray()],
                "package" => $request->input('package' . $key),
                "quantity" => $request->input('quantity' . $key),
                "weight" => (double) $request->input('weight' . $key),
                "total" => ((double) $request->input('total' . $key)) * 1000,
                "realisasi" => ((double) $request->input('realisasi' . $key)) * 1000,
                "tunggu" => $request->input('tunggu' . $key),
                "check" => $request->input('check' . $key),
                "produksi" => $request->input('produksi' . $key),
            ];
        }
        $order['products'] = $arrProduct;
        
        $order->tunggu = $request->tunggu;

        /*$checks=user::where('_id', $request->check)->get();
        $order->check=$checks->toArray();

        $produksis=user::where('_id', $request->produksi)->get();
        $order->produksi=$produksis->toArray();*/

        $order['status'] = "production";

        $order->save();
        
        return redirect()->route('production.index')->with('update', 'sales-order');

        /*return dd($order);*/
    }

    //delete data discount
    public function destroy($id)
    {
        $order = SalesOrder::find($id);
        $order->delete();
        return redirect()->route('production.index')->with('dlt', 'sales-order');
    }
}