<?php

namespace App\Http\Controllers\DiscountManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Discounts;
use Yajra\Datatables\Datatables;
use Mail;
use Auth;

class DiscountController extends Controller
{
    //Protected module discount by slug
    public function __construct()
    {
        $this->middleware('perm.acc:discount');
    }
    
    //public index discount
    public function index()
    {
        return view('panel.master-deal.discount.index');
    }
    
    //view form create
    public function create()
    {   
        return view('panel.master-deal.discount.form-create');
        
    }

    //store data discount
    public function store(Request $request)
    {
        $discount = new Discounts();
        $discount->code = $request->code;
        $discount->discount = $request->discount;
        $discount->time = $request->time;
        $discount->price = $request->price;
        $discount->save();

        
        return redirect()->route('discount.index')->with('toastr', 'discount');
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $discounts = Discounts::select(['id', 'code', 'discount', 'time','price', 'created_at']);
        
        return Datatables::of($discounts)
            ->addColumn('action', function ($discount) {
                return 
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('discount.edit',['id' => $discount->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit Discount</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('discount.destroy',['id' => $discount->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    //view form edit
    public function edit($id)
    {
        $discount = Discounts::find($id);
        return view('panel.master-deal.discount.form-edit')->with(['discount'=>$discount]);
    }

    //update data discount
    public function update(Request $request, $id)
    {
        $discount = Discounts::find($id);
        $discount->code = $request->code;
        $discount->discount = $request->discount;
        $discount->time = $request->time;
        $discount->price = $request->price;
        $discount->save();
        return redirect()->route('discount.index')->with('update', 'discount');
    }

    //delete data discount
    public function destroy($id)
    {
        $discount = Discounts::find($id);
        $discount->delete();
        return redirect()->route('discount.index')->with('dlt', 'discount');
    }
}