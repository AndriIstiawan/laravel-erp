<?php

namespace App\Http\Controllers\MasterPackagings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Packaging;
use DataTables;
use Mail;
use Auth;
use Currency;
use Carbon\Carbon;


class PackagingController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function __construct()
  {
    $this->middleware('perm.acc:packaging');
  }
  public function index()
  {
    $data['title'] = 'Packaging Table';
    return view('panel.master-packaging.packaging.index',$data);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $data['title'] = 'Add New Packaging';
    $data['code'] = $this->codegen();
    return view('panel.master-packaging.packaging.create',$data);
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
      'created_by' => auth()->user()->_id,
      'price' => rollbackPrice($request->price)
    ])
    ->all();

    $packaging = Packaging::create($data);

    if($packaging){
      return redirect()->route('packaging.index')->with('toastr', 'packaging');
    }else{
      return redirect()->route('packaging.index')->with('danger', 'packaging');
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(Request $request)
  {
    if($request->ajax()){
      $index = Packaging::select([
        'id',
        'code',
        'name',
        'description',
        'price',
        'currency'
        ])->get();

        return DataTables::of($index)
        ->editColumn('name', function($index){
          return ucwords($index->name);
        })
        ->editColumn('description', function($index){
          return ucwords($index->description);
        })
        ->editColumn('price', function($index){
          return formatPrice($index->price);
        })
        ->editColumn('currency', function($index){
          if($index->currency){
            return $index->currency;
          }else{
            return '--';
          }
        })
        ->addColumn('action', function($index){
          return
              '<center><a class="btn btn-success btn-sm"  href="'.route('packaging.edit',['id' => $index->id]).'">
                  <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a> '.
              '<form style="display:inline;" method="POST" action="'.
                  route('packaging.destroy',['id' => $index->id]).'">'.method_field('DELETE').csrf_field().
              '<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))"><i class="fa fa-remove"></i>&nbsp;Remove</button></form></center>';
        })
        ->make(true);
      }
    }


    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
      $data['title'] = 'Edit Packaging';
      $data['packaging'] = Packaging::find($id);
      return view('panel.master-packaging.packaging.edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
      $data = collect($request->all())
      ->except(['_token'])
      ->merge([
        'updated_by' => auth()->user()->_id,
        'price' => rollbackPrice($request->price)
      ])
      ->all();
      $packaging = Packaging::find($id);
      if($packaging){
        $packaging->update($data);
        return redirect()->route('packaging.index')->with('update', 'packaging');
      }else{
        return redirect()->route('packaging.index')->with('danger', 'packaging');
      }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
      $data = [
          'deleted_by' => auth()->user()->id,
          'deleted_at' => thisday()
          ];
      $packaging = Packaging::find($id);
      if($packaging){
        $packaging->update($data);
        return redirect()->route('packaging.index')->with('dlt', 'packaging');
      }else{
        return redirect()->route('packaging.index')->with('danger', 'packaging');
      }

    }

    private function codegen(){
      $code = Packaging::max('code');
      if($code){
        $temp = explode('-',$code);
        $number = $temp[1];
        $number = $number + 1;
        $autocode = 'PKG-'.$number;
      }else{
        $autocode = 'PKG-1';
      }
      return $autocode;
    }
    public function find(Request $request)
    {
        if ($request->id) {
            $type = Packaging::where('code', $request->code)->first();
            if ($type) {
                return ($request->id == $type->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (Packaging::where('code', $request->kode)->first() ? 'false' : 'true');
        }
    }
}
