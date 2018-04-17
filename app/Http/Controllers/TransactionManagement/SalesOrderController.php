<?php

namespace App\Http\Controllers\TransactionManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Variant;
use App\SalesOrder;
use Yajra\Datatables\Datatables;
use File;
use Image;
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

    //view form create
    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $order=SalesOrder::all();
        $product= Product::all();
        return view('panel.transaction-management.sales-order.form-create')->with([
            'order' => $order, 
            'product' => $product
        ]);
    }

    //store data sales order
    public function store(Request $request)
    {   
        $order = new SalesOrder();
        $order->name = $request->name;
        $order->save();
        
        return redirect()->route('sales-order.index')->with('toastr', 'sales-order');
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $orders = SalesOrder::select(['id', 'name', 'created_at']);
        
        return Datatables::of($orders)
            ->addColumn('action', function ($order) {
                return 
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('sales-order.edit',['id' => $order->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit Sales Order</button>'.
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
        $order->name = $request->name;
        $order->save();
        return redirect()->route('discount.index')->with('update', 'discount');
    }

    //delete data discount
    public function destroy($id)
    {
        $order = SalesOrder::find($id);
        $order->delete();
        return redirect()->route('sales-order.index')->with('dlt', 'sales-order');
    }
}