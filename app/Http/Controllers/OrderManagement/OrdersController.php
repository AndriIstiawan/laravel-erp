<?php

namespace App\Http\Controllers\OrderManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderStatuses;
use App\Orders;
use App\User;
use Yajra\Datatables\Datatables;

class OrdersController extends Controller
{
    //Protected module orderstatuses by slug
    public function __construct()
    {
        $this->middleware('perm.acc:orders');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public index orderstatus
    public function index()
    {
        return view('panel.order-management.orders.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view form create
    public function create()
    {   
        $modUser = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        return view('panel.order-management.orders.form-create')->with(['modUser' => $modUser]);
    }

    public function store(Request $request)
    {
        $taxes = new OrderStatuses();
        $taxes->name = $request->name;
        $taxes->notification = $request->notification;
        $taxes->save();
        
        return redirect()->route('orderstatuses.index')->with('toastr', 'new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
    public function show(Request $request, $action){
        $taxes = Orders::all();
        
        return Datatables::of($taxes)
            ->addColumn('action', function ($taxes) {
                return 
                    '<a class="btn btn-success btn-sm" href="'.route('orders.create'/*,['id' => $payment->id]*/).'">
                        <i class="fa fa-search"></i>&nbsp;View</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('orderstatuses.destroy',['id' => $taxes->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //view form edit
    public function edit($id)
    {
        $taxes = OrderStatuses::find($id);
        return view('panel.order-management.orders.form-edit')->with(['orderstatuses'=>$taxes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update dataorderstatus
    public function update(Request $request, $id)
    {
        $taxes = OrderStatuses::find($id);
        $taxes->name = $request->name;
        $taxes->notification = $request->notification;
        
        $taxes->save();
        return redirect()->route('orderstatuses.index')->with('update', 'Order Statuses updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete data orderstatus
    public function destroy($id)
    {
        $taxes = OrderStatuses::find($id);
        $taxes->delete();
        
        return redirect()->route('orderstatuses.index')->with('dlt', 'Order Statuses deleted!');
    }
}
