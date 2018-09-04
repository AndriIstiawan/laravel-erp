<?php

namespace App\Http\Controllers\ProductionsManagement;

use Auth;
use App\MasterRejects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class MasterRejectController extends Controller
{
    //Protected module master-user by slug
    public function __construct()
    {
        $this->middleware('perm.acc:master-reject');
    }

    //find data email
    public function find(Request $request)
    {

        if ($request->id) {
            $type = MasterRejects::where('name', $request->name)->first();
            if ($type) {
                return ($request->id == $type->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (MasterRejects::where('name', $request->name)->first() ? 'false' : 'true');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.producer-management.master-reject.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.producer-management.master-reject.form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = collect($request->all())
        ->except(['_token'])
        ->merge([
          'created_by' => auth()->user()->_id
        ])
        ->all();

        $master = MasterRejects::create($data);
        
        if($master){
            return redirect()->route('master-reject.index')->with('toastr', 'master reject');
        }else{
            return redirect()->route('master-reject.index')->with('danger', 'master reject');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MasterReject  $masterReject
     * @return \Illuminate\Http\Response
     */
    //For getting datatable at index
    public function show(Request $request, $action)
    {
        $masterReject = MasterRejects::all();

        return Datatables::of($masterReject)
            ->addColumn('action', function ($masterReject) {
                return
                '<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#primaryModal"
                         onclick="funcModal($(this))" data-link="'.route('master-reject.edit',['id' => $masterReject->id]).'">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>'.
                    '<form style="display:inline;" method="POST" action="'.
                        route('master-reject.destroy',['id' => $masterReject->id]).'">'.method_field('DELETE').csrf_field().
                    '<button type="button" onclick="removeList($(this))" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MasterReject  $masterReject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = MasterRejects::find($id);
        return view('panel.producer-management.master-reject.form-edit')->with(['type'=>$type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterReject  $masterReject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = collect($request->all())
            ->except(['_token'])
            ->merge([
                'updated_by' => auth()->user()->_id
            ])
        ->all();
        
        $master = MasterRejects::find($id);
        if($master){
            $master->update($data);
            return redirect()->route('master-reject.index')->with('update', 'master reject');
        }else{
            return redirect()->route('master-reject.index')->with('danger', 'master reject');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MasterReject  $masterReject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [
            'deleted_by' => auth()->user()->id,
            'deleted_at' => thisday()
            ];
        
        $master = MasterRejects::find($id);
        if($master){
            $master->update($data);
            return redirect()->route('master-reject.index')->with('update', 'master reject');
        }else{
            return redirect()->route('master-reject.index')->with('danger', 'master reject');
        }
    }
}
