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

        $products=Product::whereIn('_id', $request->product)->get();
        $order->product=$products->toArray();

        $totals =[];
        for($i=0; $i < count($request->total); $i++){
            $totals[] =[
                'total' => $request->total[$i],
            ];
        }
        $order->total=$totals;

        $packagings =[];
        for($i=0; $i < count($request->packaging); $i++){
            $packagings[] =[
                'packaging' => $request->packaging[$i],
            ];
        }
        $order->packaging=$packagings;

        $amounts =[];
        for($i=0; $i < count($request->amount); $i++){
            $amounts[] =[
                'amount' => $request->amount[$i],
            ];
        }
        $order->amount=$amounts;

        $packages =[];
        for($i=0; $i < count($request->package); $i++){
            $packages[] =[
                'package' => $request->package[$i],
            ];
        }
        $order->package=$packages;

        $realisasis =[];
        for($i=0; $i < count($request->realisasi); $i++){
            $realisasis[] =[
                'realisasi' => $request->realisasi[$i],
            ];
        }
        $order->realisasi=$realisasis;

        $stockks =[];
        for($i=0; $i < count($request->stockk); $i++){
            $stockks[] =[
                'stockk' => $request->stockk[$i],
            ];
        }
        $order->stockk=$stockks;

        $pendings =[];
        for($i=0; $i < count($request->pending); $i++){
            $pendings[] =[
                'pending' => $request->pending[$i],
            ];
        }
        $order->pending=$pendings;

        $balances =[];
        for($i=0; $i < count($request->balance); $i++){
            $balances[] =[
                'balance' => $request->balance[$i],
            ];
        }
        $order->balance=$balances;

        $pendingprs =[];
        for($i=0; $i < count($request->pendingpr); $i++){
            $pendingprs[] =[
                'pendingpr' => $request->pendingpr[$i]
            ];
        }
        $order->pendingpr=$pendingprs;

        $order->catatan = $request->catatan;
        $order->tunggu = $request->tunggu;

        $checks=user::where('_id', $request->check)->get();
        $order->check=$checks->toArray();

        $produksis=user::where('_id', $request->produksi)->get();
        $order->produksi=$produksis->toArray();

        $order->save();

        return redirect()->route('sales-order.index')->with('toastr', 'new');
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $orders = SalesOrder::all();
        
        return Datatables::of($orders)
            ->addColumn('status', function ($order) {
                return ($order->status == 1 ?
                    '<span class="badge badge-success">Sales Executive</span>' :
                    '<span class="badge badge-success">Production</span>');
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
        $att = SalesOrder::whereIn('name', array_column($order->productattr,'name'))->get();
        $user= User::where('role', 'elemMatch', array('name' => 'Production'))->get();
        $users= User::where('role', 'elemMatch', array('name' => 'Production'))->get();
        return view('panel.transaction-management.production.form-edit')->with([
            'order'=>$order,
            'order' => $order, 
            'user' => $user,
            'users' => $users
        ]);
    }

    //update data
    public function update(Request $request, $id)
    {
        $order = SalesOrder::find($id);
        $order->sono = $request->sono;
        $order->date = $request->date;
        $order->client = $request->client;

        $sales=user::where('_id', $request->sales)->get();
        $order->sales=$sales->toArray();

        $products=Product::where('_id', $request->product)->get();
        $order->product=$products->toArray();

        $order->total = $request->total;
        $order->packaging = $request->packaging;
        $order->catatan = $request->catatan;
        $order->tunggu = $request->tunggu;

        $checks=user::where('_id', $request->check)->get();
        $order->check=$checks->toArray();

        $produksis=user::where('_id', $request->produksi)->get();
        $order->produksi=$produksis->toArray();

        $order->amount = $request->amount;
        $order->package = $request->package;
        $order->realisasi = $request->realisasi;
        $order->stockk = $request->stockk;
        $order->pending = $request->pending;
        $order->balance = $request->balance;
        $order->pendingpr = $request->pendingpr;
        $order->note = $request->note;

        $order->save();
        return redirect()->route('sales-order.index')->with('update', 'sales-order');
    }

    //delete data discount
    public function destroy($id)
    {
        $order = SalesOrder::find($id);
        $order->delete();
        return redirect()->route('sales-order.index')->with('dlt', 'sales-order');
    }
}