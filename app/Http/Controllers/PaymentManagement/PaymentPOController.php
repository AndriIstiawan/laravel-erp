<?php

namespace App\Http\Controllers\PaymentManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use Yajra\Datatables\Datatables;

class PaymentPOController extends Controller
{
    //Protected module paymentpo by slug
    public function __construct()
    {
        $this->middleware('perm.acc:po');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public index paymentpo
    public function index()
    {
        return view('panel.payment-management.po.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view form create
    public function create()
    {
        return view('panel.payment-management.po.form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store data carriers
    public function store(Request $request)
    {
        $payment = new PaymentMethod();
        $payment->name = $request->name;
        $payment->norek = $request->norek;
        $payment->save();
        
        return redirect()->route('payment-method.index')->with('toastr', 'new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
    public function show(Request $request, $action){
        $payments = payment::all();
        
        return Datatables::of($payments)
            ->addColumn('action', function ($payment) {
                return 
                    '<a class="btn btn-success btn-sm" href="'.route('paymentpo.create'/*,['id' => $payment->id]*/).'">
                        <i class="fa fa-search"></i>&nbsp;View </a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('payment-method.destroy',['id' => $payment->id]).'">'.method_field('DELETE').csrf_field().
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
    public function edit()
    {
        return view('panel.order-management.payment.form-edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update data payment
    public function update(Request $request, $id)
    {
        $payment = PaymentMethod::find($id);
        $payment->name = $request->name;
        $payment->norek = $request->norek;
        
        $payment->save();
        return redirect()->route('payment-method.index')->with('update', 'Payment Method updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete data payment
    public function destroy($id)
    {
        $payment = PaymentMethod::find($id);
        $payment->delete();
        
        return redirect()->route('payment-method.index')->with('dlt', 'Payment Method deleted!');
    }
}
