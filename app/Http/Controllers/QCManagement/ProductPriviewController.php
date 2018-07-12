<?php

namespace App\Http\Controllers\QCManagement;

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

class ProductPriviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('perm.acc:product-review');
    }
    public function index()
    {
          return view('panel.qc-management.product-review.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = SalesOrder::where('_id',$request->id)->update(array('products.'.$request->index.'.tgl_reject' =>thisday(),
                                  'products.'.$request->index.'.status_produksi' => 'reject',
                                  'products.'.$request->index.'.note_reject' => $request->note_reject,'products.'.$request->index.'.petugas_qc' => auth()->user()->id));
      if($data){
        return redirect()->route('qc.index')->with('update', 'Quality Controll');
      }else{
        return redirect()->route('qc.index')->with('danger', 'Quality Controll');
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
      $orders = SalesOrder::all();

      $arrProductList = [];
      foreach($orders as $order_detail){
          foreach($order_detail->products as $key => $product_detail){
              if($product_detail['status_produksi'] == 'selesai' || $product_detail['status_produksi'] == 'pass' || $product_detail['status_produksi'] == 'reject' || $product_detail['status_produksi'] == 'proses_ulang'){
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
                    'tgl_pass'=>$product_detail['tgl_pass'],
                    'tgl_reject'=>$product_detail['tgl_reject'],
                    'selesai_proses'=>$product_detail['selesai_proses'],
                    'petugas_produksi'=>$product_detail['petugas_produksi'],
                    'petugas_qc'=>$product_detail['petugas_qc'],
                    'note_reject'=>$product_detail['note_reject'],
                    'index'=>$key
                ];
              }
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
                if($arrProduct['status_produksi'] == 'selesai' || $arrProduct['status_produksi'] == 'proses_ulang'){
                  return
                      '<center><a class="btn btn-primary btn-sm" href="'.route('qc.pass',['id' => $arrProduct['id'], 'user_id' => auth()->user()->_id,'petugas_qc'=>$arrProduct['petugas_qc'], 'index' => $arrProduct['index']]).'">
                          &nbsp;Pass?</a> <a class="btn btn-danger btn-sm" href="'.route('qc.reject',['id' => $arrProduct['id'], 'user_id' => auth()->user()->_id, 'petugas_qc'=>$arrProduct['petugas_qc'], 'index' => $arrProduct['index'], 'realisasi'=> $arrProduct['realisasi'],
                          'product_name' => $arrProduct['product_name'], 'package'=>$arrProduct['package'],
                          'quantity'=>$arrProduct['quantity'], 'weight'=>$arrProduct['weight'], 'total'=>$arrProduct['total'], 'white_label'=>$arrProduct['white_label']]).'">
                              &nbsp;Reject?</a></center>';
                }elseif($arrProduct['status_produksi'] == 'reject'){
                  return
                      '<center><a class="btn btn-primary btn-sm" href="'.route('qc.pass',['id' => $arrProduct['id'], 'user_id' => auth()->user()->_id,'petugas_qc'=>$arrProduct['petugas_qc'], 'index' => $arrProduct['index']]).'">
                          &nbsp;Pass?</a></center>';
                }else{
                  return "<center> -- </center>";
                }
              }else{
                return
                    '<center><a class="btn btn-primary btn-sm"  href="'.route('production.proses',['id' => $arrProduct['id'], 'user_id' => auth()->user()->_id, 'index' => $arrProduct['index']]).'">
                        <i class="fa fa-refresh"></i>&nbsp;Proses</a></center>';
              }
          })
          ->addColumn('status', function($arrProduct){
              $user['name']= User::where('_id',$arrProduct['petugas_qc'])->pluck('name');
              if($arrProduct['status_produksi']){
                if($arrProduct['status_produksi'] == 'selesai'){
                  $tag = "<center><a class='btn btn-danger btn-sm'>Belum QC</a></center>";
                  return $tag;
                }elseif($arrProduct['status_produksi'] == 'pass'){
                  //$user['name']= User::where('_id',$arrProduct['petugas_produksi'])->pluck('name');
                  return ucwords($arrProduct['status_produksi'].' oleh '.$user['name']);
                }elseif($arrProduct['status_produksi'] == 'reject'){
                  //$user['name']= User::where('_id',$arrProduct['petugas_produksi'])->pluck('name');
                  return ucwords($arrProduct['status_produksi'].' oleh '.$user['name']);
                }
                elseif($arrProduct['status_produksi'] == 'proses_ulang'){
                  //$user['name']= User::where('_id',$arrProduct['petugas_produksi'])->pluck('name');
                  $tag = "<center><a class='btn btn-warning btn-sm'>QC Ulang</a></center>";
                  return $tag;
                }
              }
          })
          ->addColumn('tgl_pass', function($arrProduct){
              if($arrProduct['tgl_pass']){
                //$waktu = Carbon::parse($arrProduct['selesai_proses'])->diffForHumans(Carbon::parse($arrProduct['mulai_proses']));
                return $arrProduct['tgl_pass'];
              }else{
                return '--:--:--';
              }
          })
          ->addColumn('tgl_reject', function($arrProduct){
              if($arrProduct['tgl_reject']){
                //$waktu = Carbon::parse($arrProduct['selesai_proses'])->diffForHumans(Carbon::parse($arrProduct['mulai_proses']));
                return $arrProduct['tgl_reject'];
              }else{
                return '--:--:--';
              }
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function pass(Request $request){
      if($request->petugas_qc){
        if($request->petugas_qc == auth()->user()->id){
          $data = SalesOrder::where('_id',$request->id)->update(array('products.'.$request->index.'.petugas_qc' => $request->user_id,
                                'products.'.$request->index.'.status_produksi' => 'pass',
                                'products.'.$request->index.'.tgl_pass' =>thisday() ));
        }
        else{
          return redirect()->route('qc.index')->with('danger', 'Quality Controll');
        }
      }else{
        $data = SalesOrder::where('_id',$request->id)->update(array('products.'.$request->index.'.petugas_qc' => $request->user_id,
                              'products.'.$request->index.'.status_produksi' => 'pass',
                              'products.'.$request->index.'.tgl_pass' =>thisday() ));
      }
      if($data){
        return redirect()->route('qc.index')->with('update', 'Quality Controll');
      }else{
        return redirect()->route('qc.index')->with('danger', 'Quality Controll');
      }
      return view('panel.transaction-management.production.index');
    }

    public function reject(Request $request){
      //dd($request->petugas_qc);exit();
      $data['id'] = $request->id;
      $data['index'] = $request->index;
      $data['product_name'] = $request->product_name;
      $data['package'] = $request->package;
      $data['quantity'] = $request->quantity;
      $data['weight'] = $request->weight/1000;
      $data['total'] = $request->total/1000;
      $data['white_label'] = $request->white_label;
      $data['realisasi'] = $request->realisasi/1000;
      if($request->petugas_qc){
        if($request->petugas_qc == auth()->user()->id){
          return view('panel.transaction-management.qc.reject',$data);
        }
        else{
          return redirect()->route('qc.index')->with('error', 'Proses');
        }
      }else{
        return view('panel.transaction-management.qc.reject',$data);
      }
    }
}
