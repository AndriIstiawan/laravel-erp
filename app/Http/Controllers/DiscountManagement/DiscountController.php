<?php

namespace App\Http\Controllers\DiscountManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\DiscountSetting;
use App\Discounts;
use App\Product;
use App\Levels;
use App\Member;
use App\Type;
use Yajra\Datatables\Datatables;

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

    //find data email
    public function find(Request $request)
    {

        if ($request->id) {
            $type = Discounts::where('kode', $request->kode)->first();
            if ($type) {
                return ($request->id == $type->id ? 'true' : 'false');
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

        $discount = new Discounts();
        $discount->title = $request->title;
        $discount->description = $request->description;
        $discount->status = ($request->status == 'on' ? 'on' : 'off');
        $discount->value = $request->value;
        $discount->type = $request->type;
        $discount->expired_date = $request->expiredDate;


        if (isset($request->category)) {
        $categorys=Type::whereIn('_id', $request->category)->get()->toArray();
        }
        $discount->categories=$categorys;

        /*if (isset($request->level)) {
        $levels=Levels::whereIn('_id', $request->level)->get()->toArray();
        }
        $discount->level=$levels;*/

        if (isset($request->member)) {
        $members=Member::whereIn('_id', $request->member)->get()->toArray();
        }
        $discount->members=$members;

        if (isset($request->product)) {
        $products=Product::whereIn('_id', $request->product)->get()->toArray();
        }
        $discount->products=$products;

        $discount->disExpire = $request->disExpire;
        $discount->save();

        //set discount if status on
        if (isset($request->status)) {
            $this->dispatch(new DiscountSetting('start', $discount->id));

            $delay = strtotime($discount->expired_date) - strtotime(date("Y-m-d H:i:s"));
            if($delay > 0){
                $this->dispatch((new DiscountSetting('stop', $discount->id))->delay($delay));
            }
        }

        return redirect()->route('discount.index')->with('new', 'Discount');
    }

    //for getting datatable at index
    public function list_data(){
        $discounts = Discounts::all();

        return Datatables::of($discounts)
            ->addColumn('value_set', function ($discount) {
                $value = $discount->value;
                if ($discount->type == 'price') {
                    $value = 'Rp. ' . str_replace(',00', '', number_format($discount->value, 2, ',', '.'));
                } else {
                    $value = $value . " % ";
                }
                return $value;
            })
            ->addColumn('unique_modifier', function ($discount) {
                $value = '';
                if (count($discount->categories) > 0) {
                    $value .= '<span class="badge badge-secondary">Category : ' . count($discount->categories) . '</span>';
                }
                if (count($discount->products) > 0) {
                    $value .= '<span class="badge badge-success">Product : ' . count($discount->products) . '</span>';
                }
                if (count($discount->members) > 0) {
                    $value .= '<span class="badge badge-dark">Member : ' . count($discount->members) . '</span>';
                }
                return $value;
            })
            ->addColumn('status_set', function ($discount) {
                $value = '<label class="switch switch-text switch-pill switch-success">
                    <input type="checkbox" class="switch-input" id="siteStatus" name="siteStatus" ' . ($discount->status == 'on' ? 'checked' : '') . ' tabindex="-1"
                    onchange="discountSetting($(this));" data-id="' . $discount->id . '">
                    <span class="switch-label" data-on="On" data-off="Off"></span>
                    <span class="switch-handle"></span>
                </label>';
                return $value;
            })
            ->addColumn('action', function ($discount) {
                return
                '<a class="btn btn-success btn-sm"  href="' . route('discount.edit', ['id' => $discount->id]) . '">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>' .
                '<form style="display:inline;" method="POST" action="' .
                route('discount.destroy', ['id' => $discount->id]) . '">' . method_field('DELETE') . csrf_field() .
                    '<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['value_set', 'unique_modifier', 'status_set', 'action'])
            ->make(true);
    }

    //setting discount status
    public function discount_setting(Request $request){
        $action = ($request->action == 'true'?'on':'off');
        $discount = Discounts::find($request->id);
        $discount->status = $action;
        $discount->save();

        $this->dispatch(new DiscountSetting(($action == 'on'?'start':'stop'), $request->id));

        if($action == 'on'){
            $delay = strtotime($discount->expired_date) - strtotime(date("Y-m-d H:i:s"));
            if($delay > 0){
                $this->dispatch((new DiscountSetting('stop', $discount->id))->delay($delay));
            }
        }
        return 'success';
    }

    //for getting datatable at index
    public function show(Request $request, $action)
    {
        switch ($action) {
            case "list-data":
                return $this->list_data();
                break;
            case "discount-setting":
                return $this->discount_setting($request);
                break;
        }
    }

    //view form edit
    public function edit($id)
    {
        $discount = Discounts::find($id);
        $category = Type::all();
        $member = Member::all();
        $product = Product::all();
        return view('panel.master-deal.discount.form-edit')->with([
            'discount'=>$discount,
            'categories'=>$category,
            'members'=>$member,
            'products'=>$product
        ]);
    }

    //update data discount
    public function update(Request $request, $id)
    {
        $members=[];
        $categorys=[];
        $products=[];

        $discount = Discounts::find($id);
        $discount->title = $request->title;
        $discount->description = $request->description;
        $discount->status = ($request->status == 'on' ? 'on' : 'off');
        $discount->value = $request->value;
        $discount->type = $request->type;
        $discount->expired_date = $request->expiredDate;

        if (isset($request->category)) {
        $categorys=Type::whereIn('_id', $request->category)->get()->toArray();
        }
        $discount->categories=$categorys;

        /*if (isset($request->level)) {
        $levels=Levels::whereIn('_id', $request->level)->get()->toArray();
        }
        $discount->level=$levels;*/

        if (isset($request->member)) {
        $members=Member::whereIn('_id', $request->member)->get()->toArray();
        }
        $discount->members=$members;

        if (isset($request->product)) {
        $products=Product::whereIn('_id', $request->product)->get()->toArray();
        }
        $discount->products=$products;

        $discount->save();

        //stop discount
        $products = Product::where('_id', '<>', $id);
        $products = $products->pull('discounts', ['_id' => $id]);

        //set discount if status on
        if (isset($request->status)) {
            $this->dispatch(new DiscountSetting('start', $discount->id));

            $delay = strtotime($discount->expired_date) - strtotime(date("Y-m-d H:i:s"));
            if($delay > 0){
                $this->dispatch((new DiscountSetting('stop', $discount->id))->delay($delay));
            }
        }
        return redirect()->route('discount.index')->with('edit', 'Discount');
    }

    //delete data discount
    public function destroy($id)
    {
        //stop discount
        $products = Product::where('_id', '<>', $id);
        $products = $products->pull('discounts', ['_id' => $id]);

        $discount = Discounts::find($id);
        $discount->delete();
        return redirect()->route('discount.index')->with('dlt', 'discount');
    }
}
