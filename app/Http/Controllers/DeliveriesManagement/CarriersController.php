<?php

namespace App\Http\Controllers\DeliveriesManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Carriers;
use App\Taxes;
use Yajra\Datatables\Datatables;

class CarriersController extends Controller
{
  //Protected module courier by slug
  public function __construct()
  {
    $this->middleware('perm.acc:courier');
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  //public index courier
  public function index()
  {
    return view('panel.deliveries-management.courier.index');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  //view form create
  public function create()
  {
    return view('panel.deliveries-management.courier.form-create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  //store data courier
  public function store(Request $request)
  {
    if($request->status){
      $data = collect($request->all())
      ->except(['_token'])
      ->merge([
        'price' => rollbackPrice($request->price),

      ])
      ->all();
    }else{
      $data = collect($request->all())
      ->except(['_token'])
      ->merge([
        'price' => rollbackPrice($request->price),
        'status' => 'off'
      ])
      ->all();
    }

    //dd($data);exit();
    if($request->id){
      $carriers = Carriers::find($request->id);
      if($carriers){
        $carriers->update($data);
        return redirect()->route('courier.index')->with('update', 'courier');
      }else{
        return redirect()->route('courier.index')->with('danger', 'courier');
      }
    }else{
      $carriers = Carriers::create($data);

      if($carriers){
        return redirect()->route('courier.index')->with('toastr', 'new');
      }else{
        return redirect()->route('courier.index')->with('danger', 'courier');
      }
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  //for getting datatable at index
  public function show(Request $request, $action){
    $carriers = Carriers::orderBy('created_at','ASC')->get();

    return Datatables::of($carriers)
    ->editColumn('name', function($index){
      return ucwords($index->name);
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
    ->editColumn('status', function($index){
        return ucwords($index->status);
    })
    ->addColumn('action', function ($carriers) {
      return
      '<center><button class="btn btn-success btn-sm edit" idt="'.$carriers->id.'">
      <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button> '.
      '<form style="display:inline;" method="POST" action="'.
      route('courier.destroy',['id' => $carriers->id]).'">'.method_field('DELETE').csrf_field().
      '<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))"><i class="fa fa-remove"></i>&nbsp;Remove</button></form></center>';
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
    return Carriers::find($id);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  //update data courier
  public function update(Request $request, $id)
  {
   /* $taxes = Carriers::find($id);
    $taxes->name = $request->name;
    $taxes->prices = $request->prices;
    $taxes->status = $request->status;

    $taxes->save();
    return redirect()->route('courier.index')->with('update', 'Courier updated!');*/
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  //delete data carriers
  public function destroy($id)
  {
    $taxes = Carriers::find($id);
    $taxes->delete();

    return redirect()->route('courier.index')->with('dlt', 'Courier deleted!');
  }
}
