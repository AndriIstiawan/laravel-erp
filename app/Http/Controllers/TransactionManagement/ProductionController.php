<?php

namespace App\Http\Controllers\TransactionManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Variant;
use App\SalesOrder;
use App\User;
use Yajra\Datatables\Datatables;
use File;
use Image;
use datetime;
use App\Counter;
use App\Member;
use Carbon\Carbon;

class ProductionController extends Controller
{
    //Protected module product by slug
    public function __construct()
    {
        $this->middleware('perm.acc:production');
    }
    //find sales order
    public function find(Request $request){

        if($request->id){
            $order = SalesOrder::where('name', $request->name)->first();
            if(count($order) > 0){
                return ($request->id == $order->id ? 'true' : 'false');
            }else{
                return 'true';
            }
        }else{
            return (SalesOrder::where('name', $request->name)->first() ? 'false' : 'true' );
        }
    }

    //public index sales order
    public function index()
    {
        return view('panel.transaction-management.production.index');
    }

    //view form create
    public function create()
    {

    }

    //store data sales order
    public function store(Request $request)
    {
      //dd($request->all());
      if($request->realisasi){
        $data = SalesOrder::where('_id',$request->id)->update(array('products.'.$request->index.'.selesai_proses' =>thisday(),
                                  'products.'.$request->index.'.status_produksi' => 'selesai',
                                  'products.'.$request->index.'.realisasi' => (double)$request->realisasi *1000));
      }else{
        $data = SalesOrder::where('_id',$request->id)->update(array('products.'.$request->index.'.selesai_proses' =>thisday(),
                                  'products.'.$request->index.'.status_produksi' => 'selesai'));
      }

      if($data){
        return redirect()->route('production.index')->with('update', 'Production');
      }else{
        return redirect()->route('production.index')->with('danger', 'Production');
      }
    }

    //for getting datatable at index
    public function show(Request $request, $action){

        $orders = SalesOrder::all();

        $arrProductList = [];
        foreach($orders as $order_detail){
            foreach($order_detail->products as $key => $product_detail){
                $arrProductList[] = [
                    'so' => $order_detail['code'],
                    'product_name' => $product_detail['name'],
                    'created_at' => $order_detail->created_at->format('d-m-Y'),
                    'id' => $order_detail['id'],
                    'white_label' =>$order_detail['white_label'],
                    'package'=>$product_detail['package'],
                    'quantity'=>$product_detail['quantity'],
                    'weight'=>$product_detail['weight'],
                    'total'=>$product_detail['total'],
                    'realisasi'=>$product_detail['realisasi'],
                    'product_id'=>$product_detail['product_id'],
                    'status_produksi'=>$product_detail['status_produksi'],
                    'mulai_proses'=>$product_detail['mulai_proses'],
                    'selesai_proses'=>$product_detail['selesai_proses'],
                    'petugas_produksi'=>$product_detail['petugas_produksi'],
                    'index'=>$key
                ];
            }
        }
        $arrProduct = collect($arrProductList);
            return Datatables::of($arrProduct)
            ->editColumn('white_label', function($arrProduct){
              if($arrProduct['white_label']){
                return ucwords($arrProduct['white_label']);
              }else{
                return '--';
              }
            })
            ->editColumn('weight', function($arrProduct){
                $temp = ((double)$arrProduct['weight'])/1000;
                return $temp.' Kg';
            })
            ->editColumn('total', function($arrProduct){
                $temp = ((double)$arrProduct['total'])/1000;
                return $temp.' Kg';
            })
            ->editColumn('realisasi', function($arrProduct){
                $temp = ((double)$arrProduct['realisasi'])/1000;
                return $temp.' Kg';
            })
            ->addColumn('action', function($arrProduct){
                if($arrProduct['status_produksi']){
                  if($arrProduct['status_produksi'] == 'sedang diproses'){
                    return
                        '<center><a class="btn btn-success btn-sm" href="'.route('production.selesai',['id' => $arrProduct['id'],'index' => $arrProduct['index'], 'petugas_produksi' => $arrProduct['petugas_produksi'], 'product_name' => $arrProduct['product_name'], 'package'=>$arrProduct['package'],
                        'quantity'=>$arrProduct['quantity'], 'weight'=>$arrProduct['weight'], 'total'=>$arrProduct['total'], 'white_label'=>$arrProduct['white_label']]).'">
                            <i class="fa fa-check-circle"></i>&nbsp;Selesai?</a></center>';
                  }elseif($arrProduct['status_produksi'] == 'selesai'){
                    return
                        '<center><a class="btn btn-warning btn-sm">
                            &nbsp;ProsesQC</a></center>';
                  }
                }else{
                  return
                      '<center><a class="btn btn-primary btn-sm"  href="'.route('production.proses',['id' => $arrProduct['id'], 'user_id' => auth()->user()->_id, 'index' => $arrProduct['index']]).'">
                          <i class="fa fa-refresh"></i>&nbsp;Proses</a></center>';
                }
            })
            ->addColumn('status', function($arrProduct){
                $user['name']= User::where('_id',$arrProduct['petugas_produksi'])->pluck('name');
                if($arrProduct['status_produksi']){
                  if($arrProduct['status_produksi'] == 'sedang diproses'){
                    return ucwords($arrProduct['status_produksi'].' oleh '.$user['name']);
                  }elseif($arrProduct['status_produksi'] == 'selesai'){
                    return ucwords($arrProduct['status_produksi'].' diproses oleh '.$user['name']);
                  }
                }else{
                  /*$tag = "<center><a class='btn btn-danger btn-sm'>
                      <i class='fa fa-refresh'></i>Belum Diproses</a></center>";
                  return $tag;*/
                  return 'Belum Diproses';
                }
            })
            ->addColumn('waktu', function($arrProduct){
                if($arrProduct['selesai_proses']){
                  $waktu = Carbon::parse($arrProduct['selesai_proses'])->diffForHumans(Carbon::parse($arrProduct['mulai_proses']));
                  return str_replace('setelah','', $waktu);
                }else{
                  return '--';
                }
            })
            ->make(true);
    }

    //view form edit
    public function edit($id)
    {

    }

    //update data
    public function update(Request $request, $id)
    {

    }

    //delete data discount
    public function destroy($id)
    {

    }

    public function proses(Request $request){

      $data = SalesOrder::where('_id',$request->id)->update(array('products.'.$request->index.'.petugas_produksi' => $request->user_id,
                            'products.'.$request->index.'.status_produksi' => 'sedang diproses',
                            'products.'.$request->index.'.mulai_proses' =>thisday() ));
      if($data){
        return redirect()->route('production.index')->with('update', 'Production');
      }else{
        return redirect()->route('production.index')->with('danger', 'Production');
      }
      return view('panel.transaction-management.production.index');
    }

    public function selesai(Request $request){
      /*
      return view('panel.transaction-management.production.index');*/
      //dd($request->all());
      if($request->petugas_produksi == auth()->user()->id){
        $data['id'] = $request->id;
        $data['index'] = $request->index;
        $data['product_name'] = $request->product_name;
        $data['package'] = $request->package;
        $data['quantity'] = $request->quantity;
        $data['weight'] = $request->weight/1000;
        $data['total'] = $request->total/1000;
        $data['white_label'] = $request->white_label;
        return view('panel.transaction-management.production.proses',$data);
      }else{
        return redirect()->route('production.index')->with('error', 'Proses');
      }
    }
}
