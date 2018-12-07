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

class SalesAdminController extends Controller
{
    //Protected module product by slug
    public function __construct()
    {
        $this->middleware('perm.acc:sales-order');
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
        return view('panel.transaction-management.sales-admin.index');
    }

    //view form create
    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $product= Product::all();
        $products= Product::all();
        $modUser = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        $user= User::where('role', 'elemMatch', array('name' => 'Tim Operational'))->get();
        $users= User::where('role', 'elemMatch', array('name' => 'Tim Operational'))->get();
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

        $productss =[];
        for($i=0; $i < count($request->total); $i++){
            $productss[] =[
                'total' => $request->total[$i],
                'packaging' => $request->packaging[$i],
                'amount' => $request->amount[$i],
                'package' => $request->package[$i],
                'realisasi' => $request->realisasi[$i],
                'stockk' => $request->stockk[$i],
                'pending' => $request->pending[$i],
                'balance' => $request->balance[$i],
                'pendingpr' => $request->pendingpr[$i]
            ];
        }
        $order->productattr=$productss;

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
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('sales-order.edit',['id' => $order->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('sales-order.destroy',['id' => $order->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    //view form edit
    public function edit($id)
    {
        $order = SalesOrder::find($id);
        return view('panel.transaction-management.sales-order.form-edit')->with(['order'=>$order]);
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