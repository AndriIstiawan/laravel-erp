<?php

namespace App\Http\Controllers\DiscountManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Discounts;
use App\Product;
use App\Levels;
use App\Member;
use App\Type;
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

    //find data categories
    public function find(Request $request)
    {

        if ($request->id) {
            $discount = Discounts::where('kode', $request->kode)->first();
            if (count($discount) > 0) {
                return ($request->id == $discount->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (Discounts::where('kode', $request->kode)->first() ? 'false' : 'true');
        }
    }

    //view form create
    public function create()
    {   
        $product=Product::all();
        $level=Levels::all();
        $member=Member::all();
        $category=Type::all();
        return view('panel.master-deal.discount.form-create')->with([
            'product'=>$product,
            'level'=>$level,
            'member'=>$member,
            'category'=>$category
            ]);
        
    }

    //store data discount
    public function store(Request $request)
    {
        $members=[];
        $categorys=[];
        $products=[];
        $levels=[];
        $discount = new Discounts();
        $discount->type = $request->type;
        $discount->kode = $request->kode;
        $discount->value = $request->value;

        if (isset($request->category)) {
        $categorys=Type::whereIn('_id', $request->category)->get()->toArray();
        }
        $discount->type_product=$categorys;

        /*if (isset($request->level)) {
        $levels=Levels::whereIn('_id', $request->level)->get()->toArray();
        }
        $discount->level=$levels;*/

        if (isset($request->member)) {
        $members=Member::whereIn('_id', $request->member)->get()->toArray();
        }
        $discount->client=$members;

        if (isset($request->product)) {
        $products=Product::whereIn('_id', $request->product)->get()->toArray();
        }
        $discount->product=$products;

        $discount->disExpire = $request->disExpire;
        $discount->save();

        return redirect()->route('discount.index')->with('toastr', 'new');
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $discounts = Discounts::all();
        
        return Datatables::of($discounts)
            ->addColumn('action', function ($discount) {
                return 
                    '<a class="btn btn-success btn-sm"  href="'.route('discount.edit',['id' => $discount->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('discount.destroy',['id' => $discount->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    //view form edit
    public function edit($id)
    {
        $discount = Discounts::find($id);
        $category = Type::whereNotIn('name', array_column($discount->type_product,'name'))->get();
        $member = Member::whereNotIn('display_name', array_column($discount->client,'display_name'))->get();
        $product = Product::whereNotIn('name', array_column($discount->product,'name'))->get();
        return view('panel.master-deal.discount.form-edit')->with([
            'discount'=>$discount,
            'category'=>$category,
            'member'=>$member,
            'product'=>$product
        ]);
    }

    //update data discount
    public function update(Request $request, $id)
    {
        $members=[];
        $categorys=[];
        $products=[];
        $levels=[];
        $discount = Discounts::find($id);
        $discount->type = $request->type;
        $discount->kode = $request->kode;
        $discount->value = $request->value;

        if (isset($request->category)) {
        $categorys=Type::whereIn('_id', $request->category)->get()->toArray();
        }
        $discount->type_product=$categorys;

        /*if (isset($request->level)) {
        $levels=Levels::whereIn('_id', $request->level)->get()->toArray();
        }
        $discount->level=$levels;*/

        if (isset($request->member)) {
        $members=Member::whereIn('_id', $request->member)->get()->toArray();
        }
        $discount->client=$members;

        if (isset($request->product)) {
        $products=Product::whereIn('_id', $request->product)->get()->toArray();
        }
        $discount->product=$products;

        $discount->disExpire = $request->disExpire;

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