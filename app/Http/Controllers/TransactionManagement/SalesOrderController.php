<?php

namespace App\Http\Controllers\TransactionManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Variant;
use App\Member;
use App\SalesOrder;
use App\User;
use Auth;
use Yajra\Datatables\Datatables;
use File;
use Image;
use Excel;
use datetime;

class SalesOrderController extends Controller
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
        return view('panel.transaction-management.sales-order.index');
    }
    // public function details()
    // {
    //     return view('panel.transaction-management.sales-order.index');
    // }

    //view form create
    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');

        $order=SalesOrder::all();
        $product= Product::all();
        $member= Member::all();
        $products= Product::all();
        $sales=user::where('name',Auth::user()->name)->get();
        $modUser = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        $user= User::where('role', 'elemMatch', array('name' => 'Tim Operational'))->get();
        $users= User::where('role', 'elemMatch', array('name' => 'Tim Operational'))->get();
        return view('panel.transaction-management.sales-order.form-create')->with([
            'so_id' => $this->generateSO(),
            'order' => $order, 
            'product' => $product,
            'sales'=> $sales,
            'member' => $member,
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

        $clients=Member::where('_id', $request->client)->get();
        $order->client = $clients->toArray();

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

        $order->status = $request->status;

        $order->save();

        return redirect()->route('sales-order.index')->with('toastr', 'new');
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $orders = SalesOrder::all();
        
        return Datatables::of($orders)
            ->addColumn('status', function ($order) {
                return ($order->status == 1 ?
                    '<span class="badge badge-success">'.$order->sales[0]['name'].'&nbsp;(Sales Executive)</span>' :
                    '<span class="badge badge-success">'.$order->produksi[0]['name'].'&nbsp;(Production)</span>');
            })
            
            ->addColumn('action', function ($order) {
                return 
                    // '<a class="btn btn-success btn-sm"  href="'.route('sales-order.edit',['id' => $order->id]).'">
                    //     <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>'.
                    '<a class="btn btn-success btn-sm"  href="'.route('sales-order.edit',['id' => $order->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('sales-order.destroy',['id' => $order->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    //view form edit
    public function edit($id)
    {
        $order = SalesOrder::find($id);
        $product= Product::whereNotIn('name', array_column($order->productattr,'name'))->get();
        $member= Member::whereNotIn('name', array_column($order->client,'name'))->get(); 
        $products= Product::all(); 
        $att = SalesOrder::whereIn('name', array_column($order->productattr,'name'))->get();
        $user= User::where('role', 'elemMatch', array('name' => 'Production'))->get();
        $users= User::where('role', 'elemMatch', array('name' => 'Production'))->get();
        return view('panel.transaction-management.sales-order.form-edit')->with([
            'order'=>$order,
            'order' => $order,
            'member' => $member, 
            'product' => $product,
            'products' => $products,
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

        $clients=Member::where('_id', $request->client)->get();
        $order->client = $clients->toArray();

        /*$sales=user::where('_id', $request->sales)->get();
        $order->sales=$sales->toArray();*/

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

        $order->status = $request->status;
        
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

    public function generateSO(){
        return "SO-".date('H:i:s-d-m-Y');
    }

    public function orderExport(){
       $order=SalesOrder::select('sono','client','sales','catatan','productattr')->get();
       

       

      
        for($i=0; $i < count($order); $i++){
            $orderarr=[];
            for($j=0; $j < count($order[$i]->productattr); $j++){
                $orderarr[]=[
                    'SO No'=>$order[$i]->sono,
                    'Client'=>$order[$i]->client[0]['name'],
                    'Sales'=>$order[$i]->sales[0]['name'],
                    'Type'=>$order[$i]->productattr[$j]['type'],
                    'Code'=>$order[$i]->productattr[$j]['code'],
                    'Total'=>$order[$i]->productattr[$j]['total'],
                    'Package'=>$order[$i]->productattr[$j]['package'],
                    'Final Total'=>$order[$i]->productattr[$j]['amount'],
                    'Note'=>$order[$i]->catatan,

                ];
            }
        }
            


        

        return Excel::create('salesorder-list', function ($excel) use ($orderarr) {
            $excel->sheet('sales-order list', function ($sheet) use ($orderarr) {
                $sheet->fromArray($orderarr);
            });

        })->download('xlsx');
        return dd($orderarr);

    }
}