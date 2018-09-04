<?php

namespace App\Http\Controllers\DiscountManagement;

use App\TipePromo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class TipePromoController extends Controller
{
    //Protected module discount by slug
    public function __construct()
    {
        $this->middleware('perm.acc:tipe-promosi');
    }

    //find data email
    public function find(Request $request)
    {

        if ($request->id) {
            $type = TipePromo::where('name', $request->name)->first();
            if ($type) {
                return ($request->id == $type->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (TipePromo::where('name', $request->name)->first() ? 'false' : 'true');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.master-deal.tipe-promosi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.master-deal.tipe-promosi.form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = new TipePromo();
        $type->name = $request->name;
        $type->satuan = $request->satuan;
        $type->save();
        
        return redirect()->route('tipe-promosi.index')->with('toastr', 'new');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipePromo  $tipePromo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $action)
    {
        $type = TipePromo::all();
        
        return Datatables::of($type)
            ->addColumn('action', function ($type) {
                return 
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('tipe-promosi.edit',['id' => $type->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit type</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('tipe-promosi.destroy',['id' => $type->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="button" onclick="removeList($(this))" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipePromo  $tipePromo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = TipePromo::find($id);
        return view('panel.master-deal.tipe-promosi.form-edit')->with(['type'=>$type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipePromo  $tipePromo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = TipePromo::find($id);
        $type->name = $request->name;
        $type->satuan = $request->satuan;
        
        $type->save();
        return redirect()->route('tipe-promosi.index')->with('update', 'Tipe Promosi updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipePromo  $tipePromo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = TipePromo::find($id);
        $type->delete();
        
        return redirect()->route('tipe-promosi.index')->with('dlt', 'Tipe Promosi deleted!');
    }
}
