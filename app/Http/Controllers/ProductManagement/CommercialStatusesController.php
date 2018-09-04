<?php

namespace App\Http\Controllers\ProductManagement;

use App\CommercialStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CommercialStatusesController extends Controller
{
    //Protected module type by slug
    public function __construct()
    {
        $this->middleware('perm.acc:commercial-status');
    }
    
    //find data email
    public function find(Request $request)
    {

        if ($request->id) {
            $type = CommercialStatus::where('name', $request->name)->first();
            if ($type) {
                return ($request->id == $type->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (CommercialStatus::where('name', $request->name)->first() ? 'false' : 'true');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public index type
    public function index()
    {
        return view('panel.product-management.commercial-status.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view form create
    public function create()
    {
        return view('panel.product-management.commercial-status.form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store data type
    public function store(Request $request)
    {
        $type = new CommercialStatus();
        $type->name = $request->name;
        $type->save();
        
        return redirect()->route('commercial-status.index')->with('toastr', 'new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //for getting datatable at index
    public function show(Request $request, $action){
        $type = CommercialStatus::all();
        
        return Datatables::of($type)
            ->addColumn('action', function ($type) {
                return 
                    '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('commercial-status.edit',['id' => $type->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit type</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('commercial-status.destroy',['id' => $type->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="button" onclick="removeList($(this))" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
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
        $type = CommercialStatus::find($id);
        return view('panel.product-management.commercial-status.form-edit')->with(['type'=>$type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update data type
    public function update(Request $request, $id)
    {
        $type = CommercialStatus::find($id);
        $type->name = $request->name;
        
        $type->save();
        return redirect()->route('commercial-status.index')->with('update', 'commercial status updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete data type
    public function destroy($id)
    {
        $type = CommercialStatus::find($id);
        $type->delete();
        
        return redirect()->route('commercial-status.index')->with('dlt', 'commercial status deleted!');
    }
}
