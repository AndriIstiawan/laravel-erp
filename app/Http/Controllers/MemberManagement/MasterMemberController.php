<?php

namespace App\Http\Controllers\MemberManagement;

use App\Counter;
use App\Http\Controllers\Controller;
use App\Member;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Excel;
use Auth;
use Session;
use App\SalesOrder;
use RajaOngkir;


class MasterMemberController extends Controller
{
    //Protected module master-member by slug
    public function __construct()
    {
        $this->middleware('perm.acc:master-client');
    }

    //Public index master-member
    public function index()
    {
        return view('panel.member-management.master-member.index');
    }

    //find data email
    public function find(Request $request)
    {

        if ($request->id) {
            $email = Member::where('email', $request->email)->first();
            if (count($email) > 0) {
                return ($request->id == $email->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (Member::where('email', $request->email)->first() ? 'false' : 'true');
        }
    }

    //View Form create
    public function create()
    {
        $sales = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        $product = Product::all();
        $province = RajaOngkir::Provinsi()->all();
        return view('panel.member-management.master-member.form-create')->with([
            'sales' => $sales,
            'province' => $province
        ]);
    }

    public function getCityList($province)
    {
        $cities = RajaOngkir::Kota()->byProvinsi($province)->get();
        return response()->json($cities);
    }

    //Store data member
    public function store(Request $request)
    {
        $member = new Member();
        $member->code = $this->generateClient();
        $member->display_name = $request->displayName;
        $member->fullname = $request->fullname;
        $member->title = $request->title;
        $member->email = $request->email;
        $member->limit = $request->limit;

        if ($request->whiteLabel == ''){
            $member->white_label = 'Tidak';
        }else{
            $member->white_label = 'Ya';
        }

        if ($request->packkayu == ''){
            $member->pack_kayu = 'Tidak';
        }else{
            $member->pack_kayu = 'Ya';
        }

        $mobile = [];
        if ($request->mobile != null) {
            foreach ($request->mobile as $mobile_list) {
                $mobile[] = [
                    'number' => $mobile_list,
                ];
            }
        }
        $member->mobile = $mobile;
        $member->company = $request->company;
        $member->segmen_pasar = $request->segmenPasar;
        $member->negara = $request->negara;
        $member->provinsi = $request->provinsi;
        $member->kota = $request->kota;
        $phone = [];
        if ($request->phone != null) {
            foreach ($request->phone as $phone_list) {
                $phone[] = [
                    'number' => $phone_list,
                ];
            }
        }
        $member->phone = $phone;
        $sales = User::where('_id', $request->sales)->first();
        $member->sales = [[
            '_id' => $sales['_id'],
            'name' => $sales['name'],
            'detail' => [
                $sales->toArray(),
            ],
        ]];
        $member->remarks = $request->remarks;
        $member->billing_address = $request->billingAddress;
        $shipping_address = [];
        foreach ($request->shippingAddress as $shipping_list) {
            $shipping_address[] = [
                'address' => $shipping_list,
            ];
        }
        $member->shipping_address = $shipping_address;
        $divisi = [];
        if (isset($request->arrDiv)) {
            foreach ($request->arrDiv as $divisi_id) {
                $divisi_name = $request->input('divisiName' . $divisi_id);
                $divisi_type = $request->input('divisiType' . $divisi_id);
                $divisi_sales = User::where('_id', $request->input('divisiSales' . $divisi_id))->first();

                $divisi[] = [
                    'divisi_name' => $divisi_name,
                    'divisi_type' => $divisi_type,
                    'sales' => [[
                        'name' => $divisi_sales['name'],
                        'detail' => [
                            $divisi_sales->toArray(),
                        ],
                    ]],
                ];
            }
        }
        $member->divisi = $divisi;
        $member->save();
        return redirect()->route('master-client.index')->with('toastr', 'client');

        /*return dd($member);*/
    }

    public function list_data()
    {
        $members = Member::all();
        return Datatables::of($members)
            ->addColumn('action', function ($member) {
                return
                '<div class="button-group"><a class="btn btn-success btn-sm" href="' . route('master-client.edit', ['id' => $member->id]) . '">
                        <i class="fa fa-pencil-square-o"></i>&nbsp;Edit member</a>' .
                '<form style="display:inline;" method="POST" action="' .
                route('master-client.destroy', ['id' => $member->id]) . '">' . method_field('DELETE') . csrf_field() .
                    '<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))"><i class="fa fa-remove"></i>&nbsp;Remove</button></form></div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    //For getting datatable at index
    public function show(Request $request, $action)
    {
        switch ($action) {
            case "list-data":
                return $this->list_data();
                break;
            case "export":
                return $this->clientExport();
                break;
            case "import":
                return $this->clientImport();
                break;
            default:
                return $this->list_data();
        }
    }

    //view form edit
    public function edit($id)
    {
        $member = Member::find($id);
        $province = RajaOngkir::Provinsi()->all();
        $kota = RajaOngkir::Kota()->search('province', $member->provinsi)->get();
        $sales = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        return view('panel.member-management.master-member.form-edit')->with([
            'member' => $member,
            'sales' => $sales,
            'province'=>$province,
            'kota' => $kota
        ]);
    }

    //Update data setting
    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        $member->display_name = $request->displayName;
        $member->fullname = $request->fullname;
        $member->title = $request->title;
        $member->email = $request->email;
        $member->limit = $request->limit;

        if ($request->whiteLabel == ''){
            $member->white_label = 'Tidak';
        }else{
            $member->white_label = 'Ya';
        }

        if ($request->packkayu == ''){
            $member->pack_kayu = 'Tidak';
        }else{
            $member->pack_kayu = 'Ya';
        }

        $mobile = [];
        if ($request->mobile != null) {
            foreach ($request->mobile as $mobile_list) {
                $mobile[] = [
                    'number' => $mobile_list,
                ];
            }
        }
        $member->mobile = $mobile;
        $member->company = $request->company;
        $member->segmen_pasar = $request->segmenPasar;
        $member->negara = $request->negara;
        $member->provinsi = $request->provinsi;
        $member->kota = $request->kota;
        $phone = [];
        if ($request->phone != null) {
            foreach ($request->phone as $phone_list) {
                $phone[] = [
                    'number' => $phone_list,
                ];
            }
        }
        $member->phone = $phone;
        $detail_sales = $member->sales[0]['detail'];
        $sales = User::where('_id', $request->sales)->first();
        $detail_sales[] = $sales->toArray();
        $member->sales = [[
            '_id' => $sales['_id'],
            'name' => $sales['name'],
            'detail' => $detail_sales,
        ]];
        $member->remarks = $request->remarks;
        $member->billing_address = $request->billingAddress;
        $shipping_address = [];
        foreach ($request->shippingAddress as $shipping_list) {
            $shipping_address[] = [
                'address' => $shipping_list,
            ];
        }
        $member->shipping_address = $shipping_address;
        $divisi = [];
        if (isset($request->arrDiv)) {
            foreach ($request->arrDiv as $divisi_id) {
                $divisi_name = $request->input('divisiName' . $divisi_id);
                $divisi_type = $request->input('divisiType' . $divisi_id);
                $divisi_sales = User::where('_id', $request->input('divisiSales' . $divisi_id))->first();

                $divisi[] = [
                    'divisi_name' => $divisi_name,
                    'divisi_type' => $divisi_type,
                    'sales' => [[
                        'name' => $divisi_sales['name'],
                        'detail' => [
                            $divisi_sales->toArray(),
                        ],
                    ]],
                ];
            }
        }
        $member->divisi = $divisi;
        $member->save();
        return redirect()->route('master-client.index')->with('update', 'client');
        /*return dd($member);*/
    }

    public function clientExport()
    {
        $file = storage_path('exports/client-form-format.xlsx');
        $members = Member::all();

        $orders = SalesOrder::all();

        //load excel form and editing row
      $excel = Excel::selectSheetsByIndex(0,1)->load($file, function($reader) use ($members, $orders) {
            $data = [];
            foreach($members as $key=>$member){
              $total_weight = 0;
              $total_order = 0;
              $orders = SalesOrder::all();
              foreach($orders as $key=>$order_detail){
                if($member->_id== $order_detail->client[0]['_id']){
                  $total_weight = $total_weight + $order_detail->total_kg;
                  $total_order = $total_order + 1;
                }
              }
                $data_mobile = implode(' / ', array_column($member->mobile, 'number'));
                //if(is_numeric($data_mobile)){ $data_mobile = "`".$data_mobile; }
                $data_phone = implode(' / ', array_column($member->phone, 'number'));
                //if(is_numeric($data_phone)){ $data_phone = "`".$data_phone; }
                $data[] = [
                    $member->code,
                    $member->display_name,
                    $member->company,
                    $member->title,
                    $member->fullname,
                    $member->sales[0]['detail'][count($member->sales[0]['detail'])-1]['email'],
                    $member->billing_address,
                    implode(' / ', array_column($member->shipping_address, 'address')),
                    $member->email,
                    $member->limit,
                    $member->white_label,
                    /*'="'.$data_mobile.'"',
                    '="'.$data_phone.'"',*/
                    $data_mobile,
                    $data_phone,
                    $member->remarks,
                    $member->kota,
                    $member->provinsi,
                    $member->negara,
                    $member->segmen_pasar,
                    $member->created_at,
                    $member->pack_kayu,
                    $total_weight/1000/12,
                    $total_order/12
                ];
            }
            //editing sheet 1
            $reader->setActiveSheetIndex(0);
            $sheet1 = $reader->getActiveSheet();
            $sheet1->fromArray($data, null, 'A3', false, false);
            //$reader->getActiveSheet()->setAutoSize(true);

        })->setFilename('client-form-export['.date("H-i-s d-m-Y")."]")->download('xlsx');
    }

    //view form import
    public function clientImport()
    {
        return view('panel.member-management.master-member.form-import')->with([
            'uriLink' => 'import',
        ]);
    }

    //import data
    public function ImportData(Request $request)
    {
        $limit_chunk = 1000000000000000;
        $file = $request->import->getRealPath();
        $filename = 'client-form-import['.date("H-i-s d-m-Y")."][".Auth::user()->email."]";
        $excel = Excel::selectSheetsByIndex(0)->load($file)->setFilename($filename)->store('xlsx', false, true);
        $file = storage_path('exports/'.$filename.".xlsx");
        $excel = Excel::filter('chunk')->selectSheetsByIndex(0)->load($file)->chunk($limit_chunk, function($results){
            $data = 'array(';
            foreach($results as $listData){ //result[0] if load multiple sheet selectSheetsByIndex(0,1)
                //check parent column value
                if(!isset($listData['code'])||!isset($listData['displayname'])||!isset($listData['companyname'])||!isset($listData['title'])
                ||!isset($listData['fullname'])||!isset($listData['salesemail'])||!isset($listData['billingaddress'])||!isset($listData['shippingaddress'])
                ||!isset($listData['email'])||!isset($listData['limit'])||!isset($listData['white_label'])||!isset($listData['pack_kayu'])
                ||!isset($listData['mobile'])||!isset($listData['phone'])||!isset($listData['remarks'])||!isset($listData['kota'])
                ||!isset($listData['provinsi'])||!isset($listData['negara'])||!isset($listData['segmenpasar'])||!isset($listData['dateregister'])){
                    $data .= 'array("parent column not valid"),';
                }else{
                    $data .= 'array(';
                    $code = trim($listData['code']);
                    $displayname = trim($listData['displayname']);
                    $companyname = trim($listData['companyname']);
                    $title = trim($listData['title']);
                    $fullname = trim($listData['fullname']);
                    $salesemail = trim($listData['salesemail']);
                    $billingaddress = trim($listData['billingaddress']);
                    $shippingaddress = trim($listData['shippingaddress']);
                    $email = trim($listData['email']);
                    $limit = trim($listData['limit']);
                    $white_label = trim($listData['white_label']);
                    $pack_kayu = trim($listData['pack_kayu']);
                    $mobile = trim($listData['mobile']);
                    $phone = trim($listData['phone']);
                    $remarks = trim($listData['remarks']);
                    $kota = trim($listData['kota']);
                    $provinsi = trim($listData['provinsi']);
                    $negara = trim($listData['negara']);
                    $segmenpasar = trim($listData['segmenpasar']);
                    $dateregister = trim($listData['dateregister']);
                    $data .= '"'.$code.'","'.$displayname.'","'.$companyname.'","'.$title.'","'.$fullname.'","'.$salesemail.'",';
                    $data .= '"'.$billingaddress.'","'.$shippingaddress.'","'.$email.'","'.$limit.'","'.$white_label.'","'.$pack_kayu.'","'.$mobile.'","'.$phone.'","'.$remarks.'",';
                    $data .= '"'.$kota.'","'.$provinsi.'","'.$negara.'","'.$segmenpasar.'","'.$dateregister.'",';

                    if($code==""||$displayname==""||$title==""||$fullname==""||$salesemail==""||$billingaddress==""||$shippingaddress==""||$mobile==""){
                        $data .= '"error import => require data is empty [code,displayname,titlefullname,salesemail,billingaddress,shippingaddress,mobile]"),';
                    }else{
                        $sales = User::where('role', 'elemMatch', array('name' => 'Sales'))->where('email', $salesemail)->first();
                        if(!$sales){
                            $data .= '"error import => sales email is not valid"),';
                        }else{
                            if (($timestamp = strtotime($dateregister)) == false && $dateregister != "") {
                                $data .= '"error import => date register is not valid"),';
                            } else {
                                $member = Member::where('code', $code)->first();
                                if($member){
                                    $data .= '"edit client successfuly."),';
                                }else{
                                    $data .= '"new client successfuly insert."),';
                                    $member = new Member();
                                }
                                $member['code'] = $code;
                                $member['display_name'] = $displayname;
                                $member['fullname'] = $fullname;
                                $member['title'] = $title;
                                $member['email'] = $email;
                                $member['limit'] = $limit;
                                $member['white_label'] = $white_label;
                                $member['pack_kayu'] = $pack_kayu;
                                $member['company'] = $companyname;
                                $member['segmen_pasar'] = $segmenpasar;
                                $member['negara'] = $negara;
                                $member['provinsi'] = $provinsi;
                                $member['kota'] = $kota;
                                $member['remarks'] = $remarks;
                                $member['divisi'] = [];
                                $member['billing_address'] = $billingaddress;
                                $member['sales'] = [[
                                    '_id' => $sales['_id'],
                                    'name' => $sales['name'],
                                    'detail' => [$sales->toArray()],
                                ]];
                                $shippingaddress = explode(' / ', $shippingaddress);
                                $arrAddr = [];
                                foreach($shippingaddress as $shipping_list){
                                    $arrAddr[] = [
                                        'address' => $shipping_list,
                                    ];
                                }
                                $member['shipping_address'] = $arrAddr;
                                $mobile = explode(' / ', $mobile);
                                $arrNumber = [];
                                foreach($mobile as $mobile_list){
                                    $arrNumber[] = [
                                        'number' => $mobile_list,
                                    ];
                                }
                                $member['mobile'] = $arrNumber;
                                $phone = explode(' / ', $phone);
                                $arrNumber = [];
                                foreach($phone as $phone_list){
                                    $arrNumber[] = [
                                        'number' => $phone_list,
                                    ];
                                }
                                $member['phone'] = $arrNumber;
                                if($dateregister != ""){
                                    $dateregister = date("Y-m-d H:i:s", strtotime($dateregister));
                                }else{
                                    $dateregister = date("Y-m-d H:i:s");
                                }
                                $member['created_at'] = $dateregister;
                                $member->save();
                            }
                        }
                    }
                }
            }
            $data .= ')';
            Session::put('result_status',$data);
        });

        $result_status = eval('return ' . Session::get('result_status') . ';');
        /*for($i=0; $i < count($result_status); $i++){
            $result_status[$i][12] = '="'.$result_status[$i][12].'"';
            $result_status[$i][13] = '="'.$result_status[$i][13].'"';
        }*/
        Session::forget('result_status');
        $excel = Excel::selectSheetsByIndex(0)->load($file, function($reader) use ($filename,$result_status) {
            //editing sheet 1
            $sheet0 = $reader->setActiveSheetIndex(0);
            $reader->getActiveSheet()->fromArray($result_status, null, 'A3', false, false);
        })->setFilename($filename)->store('xlsx', false, true);
        return $filename.'.xlsx';
    }

    //Delete data setting
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();

        return redirect()->route('master-client.index')->with('dlt', 'client');
    }

    //Generate Code
    public function generateClient()
    {
        $id_counter = Counter::first()->generateClient('client_counter');
        return "CLT-" . $id_counter;
    }

}
