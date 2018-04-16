<?php

namespace App\Http\Controllers\DiscountManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promo;
use Yajra\Datatables\Datatables;

class PromoController extends Controller
{
    //Protected module promo by slug
    public function __construct()
    {
        $this->middleware('perm.acc:promo');
    }
    
    //public index promo
    public function index()
    {
        return view('panel.master-deal.promo.index');
    }
    
    //view form create
    public function create()
    {
        return view('panel.master-deal.promo.form-create');
    }

    //store data promo
    public function store(Request $request)
    {
        $promo = new Promo();
        $promo->code = $request->code;
        $promo->promo = $request->promo;
        $promo->time = $request->time;
        $promo->save();
        
        return redirect()->route('promo.index')->with('toastr', 'promo');
    }

    //for getting datatable at index
    public function show(Request $request, $action){
        $promos = Promo::select(['id', 'code', 'promo', 'time', 'created_at']);
        
        return Datatables::of($promos)
            ->addColumn('action', function ($promo) {
                return 
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('promo.edit',['id' => $promo->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit Promo</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('promo.destroy',['id' => $promo->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    //view form edit
    public function edit($id)
    {
        $promo = Promo::find($id);
        return view('panel.master-deal.promo.form-edit')->with(['promo'=>$promo]);
    }

    //update data promo
    public function update(Request $request, $id)
    {
        $promo = Promo::find($id);
        $promo->code = $request->code;
        $promo->promo = $request->promo;
        $promo->time = $request->time;
        
        $promo->save();
        return redirect()->route('promo.index')->with('update', 'promo');
    }

    //delete data promo
    public function destroy($id)
    {
        $promo = Promo::find($id);
        $promo->delete();
        return redirect()->route('promo.index')->with('dlt', 'promo');
    }
}

