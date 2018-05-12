<?php

namespace App\Http\Controllers\MemberManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use App\Levels;
use App\Product;
use Excel;
use App\User;
use App\Counter;
use Yajra\Datatables\Datatables;

class MasterMemberController extends Controller
{
    //Protected module master-member by slug
    public function __construct()
    {
        $this->middleware('perm.acc:master-member');
    }
    
    //Public index master-member
    public function index(){
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
    public function create(){
        $sales = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        $product = Product::all();
        return view('panel.member-management.master-member.form-create')->with([
            'sales' => $sales, 
        ]);
    }

    //Store data member 
    public function store(Request $request){
        $member = new Member();
        $member->code = $this->generateClient();
        $member->display_name = $request->displayName;
        $member->fullname = $request->fullname;
        $member->title = $request->title;
        $member->email = $request->email;
        $mobile = [];
        if($request->mobile != null){
            foreach($request->mobile as $mobile_list){
                $mobile[] = [
                    'number' => $mobile_list
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
        if($request->phone != null){
            foreach($request->phone as $phone_list){
                $phone[] = [
                    'number' => $phone_list
                ];
            }   
        }
        $member->phone = $phone;
        $sales = User::where('_id',$request->sales)->first();
        $member->sales = [[
            'name' => $sales['name'],
            'detail' => [
                $sales->toArray()
            ]
        ]];
        $member->remarks = $request->remarks;
        $member->billing_address = $request->billingAddress;
        $shipping_address = [];
        foreach($request->shippingAddress as $shipping_list){
            $shipping_address[] = [
                'address' => $shipping_list
            ];
        }
        $member->shipping_address = $shipping_address;
        $divisi = [];
        if(isset($request->arrDiv)){
            foreach($request->arrDiv as $divisi_id){
                $divisi_name = $request->input('divisiName'.$divisi_id);
                $divisi_type = $request->input('divisiType'.$divisi_id);
                $divisi_sales = User::where('_id',$request->input('divisiSales'.$divisi_id))->first();

                $divisi[] = [
                    'divisi_name' => $divisi_name,
                    'divisi_type' => $divisi_type,
                    'sales' => [[
                        'name' => $divisi_sales['name'],
                        'detail' => [
                            $divisi_sales->toArray()
                        ]
                    ]],
                ];
            }
        }
        $member->divisi = $divisi;
        $member->save();
        return redirect()->route('master-client.index')->with('toastr', 'client');
    }

    //For getting datatable at index
    public function show(Request $request, $action){
		$members = Member::all();
		
        return Datatables::of($members)
			->addColumn('action', function ($member) {
				return 
					'<div class="button-group"><a class="btn btn-success btn-sm" href="'.route('master-client.edit',['id' => $member->id]).'">
						<i class="fa fa-pencil-square-o"></i>&nbsp;Edit member</a>'.
					'<form style="display:inline;" method="POST" action="'.
						route('master-client.destroy',['id' => $member->id]).'">'.method_field('DELETE').csrf_field().
					'<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))"><i class="fa fa-remove"></i>&nbsp;Remove</button></form></div>';
			})
			->rawColumns(['action'])
			->make(true);
    }

    //view form edit
    public function edit($id){
        $member = Member::find($id);
        $sales = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        return view('panel.member-management.master-member.form-edit')->with(['member'=>$member,'sales'=>$sales]);
	}

	//Update data setting
    public function update(Request $request, $id){
        $member = Member::find($id);
        $member->display_name = $request->displayName;
        $member->fullname = $request->fullname;
        $member->title = $request->title;
        $member->email = $request->email;
        $mobile = [];
        if($request->mobile != null){
            foreach($request->mobile as $mobile_list){
                $mobile[] = [
                    'number' => $mobile_list
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
        if($request->phone != null){
            foreach($request->phone as $phone_list){
                $phone[] = [
                    'number' => $phone_list
                ];
            }   
        }
        $member->phone = $phone;
        $detail_sales = $member->sales[0]['detail'];
        $sales = User::where('_id',$request->sales)->first();
        $detail_sales[] = $sales->toArray();
        $member->sales = [[
            'name' => $sales['name'],
            'detail' => $detail_sales
        ]];
        $member->remarks = $request->remarks;
        $member->billing_address = $request->billingAddress;
        $shipping_address = [];
        foreach($request->shippingAddress as $shipping_list){
            $shipping_address[] = [
                'address' => $shipping_list
            ];
        }
        $member->shipping_address = $shipping_address;
        $divisi = [];
        if(isset($request->arrDiv)){
            foreach($request->arrDiv as $divisi_id){
                $divisi_name = $request->input('divisiName'.$divisi_id);
                $divisi_type = $request->input('divisiType'.$divisi_id);
                $divisi_sales = User::where('_id',$request->input('divisiSales'.$divisi_id))->first();

                $divisi[] = [
                    'divisi_name' => $divisi_name,
                    'divisi_type' => $divisi_type,
                    'sales' => [[
                        'name' => $divisi_sales['name'],
                        'detail' => [
                            $divisi_sales->toArray()
                        ]
                    ]],
                ];
            }
        }
        $member->divisi = $divisi;
        $member->save();
        return redirect()->route('master-client.index')->with('edit', 'client');
    }

    public function generateSO(){
        $id_counter = CodeMember::first()->generateSO('code_member');
        return ($id_counter);
    }

    public function clientExport(Request $request){
       $member=Member::select('code','name','phone','email','fax','title','address','pasar','subDivision','shipaddress')->get();
            $members=[];
       
        for($i=0; $i < count($member); $i++){
            for($j=0; $j < count($member[$i]->subDivision); $j++){
                $members[]=[
                    'Code'=>$member[$i]->code,
                    'Dispaly Name'=>$member[$i]->name,
                    'Mobile'=>$member[$i]->phone,
                    'Email'=>$member[$i]->email,
                    'Fax'=>$member[$i]->fax,
                    'Billing Address'=>$member[$i]->address,
                    'Title'=>$member[$i]->title,
                    'Pasar'=>$member[$i]->pasar,
                    'Sales'=>$member[$i]->subDivision[$j]['sales'],
                    'Type'=>$member[$i]->subDivision[$j]['type'],
                    'Shipping Address'=>$member[$i]->shipaddress[$j]['shipaddress'],

                ];
            }
        }
        return Excel::create('client-list', function ($excel) use ($members) {
            $excel->sheet('client list', function ($sheet) use ($members) {
                $sheet->fromArray($members);
            });

        })->download('xlsx');
        return dd($members);

    }
    //Delete data setting
    public function destroy($id){
		$member = Member::find($id);
		$member->delete();
		
		return redirect()->route('master-client.index')->with('dlt', 'client');
    }

    //Generate Code
    public function generateClient(){
		$id_counter = Counter::first()->generateClient('client_counter');
        return "CLT-".$id_counter;
    }
    
}
