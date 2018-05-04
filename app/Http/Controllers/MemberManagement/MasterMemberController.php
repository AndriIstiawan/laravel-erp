<?php

namespace App\Http\Controllers\MemberManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use App\Levels;
use App\User;
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
		
		$level= Levels::orderBy('point', 'ASC')->first();
        $modUser = User::where('role', 'elemMatch', array('name' => 'Sales'))->get();
        return view('panel.member-management.master-member.form-create')->with(['modUser' => $modUser, 'level' => $level]);
    }

    //Store data member 
    public function store(Request $request){

		$member = new Member();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        /*$member->point = $request->point;
        $level=Levels::where('_id', $request->level)->get();
        $member->level=$level->toArray();
        */$member->status = $request->status;
        $member->address = $request->address;
        /*$member->dompet = $request->dompet;
        $member->koin = $request->koin;
        */$member->password = bcrypt($request->password);
        $sales=user::whereIn('_id', $request->sales)->get();
        $member->sales=$sales->toArray();
		$member->save();

        if ($request->hasFile('picture')) {
			$pictureFile = $request->file('picture');
			$extension = $pictureFile->getClientOriginalExtension();
			$destinationPath = public_path('/img/avatars');
			$pictureFile->move($destinationPath, $member->id.'.'.$extension);
			$member->picture = $member->id.'.'.$extension;
		}

		$member->save();

		return redirect()->route('master-client.index')->with('toastr', 'new');
    }

    //For getting datatable at index
    public function show(Request $request, $action){
		$members = Member::all();
		
		return Datatables::of($members)
			->addColumn('action', function ($member) {
				return 
					'<a class="btn btn-success btn-sm" href="'.route('master-client.edit',['id' => $member->id]).'">
						<i class="fa fa-pencil-square-o"></i>&nbsp;Edit member</a>'.
					'<form style="display:inline;" method="POST" action="'.
						route('master-client.destroy',['id' => $member->id]).'">'.method_field('DELETE').csrf_field().
					'<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))"><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';
			})
			->rawColumns(['status', 'action'])
			->make(true);
    }

    //view form edit
    public function edit($id){
		$member = Member::find($id);
        $modUser = User::where('role', 'elemMatch', array('name' => 'Sales'))->whereNotIn('name', array_column($member->sales,'name'))->get();/*
        $level = Levels::where('name', array_column($member->level,'name'))->get();*/
        return view('panel.member-management.master-member.form-edit')
        ->with([
        	'member'=>$member, 
        	'modUser' => $modUser
        ]);
	}

	//Update data setting
    public function update(Request $request, $id){

    	$member = Member::find($id);
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        /*$member->sales = $request->sales;
        $level=Levels::where('_id', $request->level)->get();
        $member->level=$level->toArray();
        */$member->address = $request->address;
        $member->status = $request->status;
        $sales=user::whereIn('_id', $request->sales)->get();
        $member->sales=$sales->toArray();
		$member->save();

        if ($request->hasFile('picture')) {
			$pictureFile = $request->file('picture');
			$extension = $pictureFile->getClientOriginalExtension();
			$destinationPath = public_path('/img/avatars');
			if($member->picture != '' || $member->picture != null){
					File::delete(public_path('/img/avatars/'.$member->picture));
				}
			$pictureFile->move($destinationPath, $member->id.'.'.$extension);
			$member->picture = $member->id.'.'.$extension;
		}

		$member->save();

		return redirect()->route('master-client.index')->with('update', 'client');
    }

    //Delete data setting
    public function destroy($id){
		$member = Member::find($id);
		$member->delete();
		
		return redirect()->route('master-client.index')->with('dlt', 'client');
    }
    public function clientExport()
    {
        $product = Meber::select('code', 'name', 'type', 'stock', 'currency', 'price')->get();
        for($i=0; $i < count($product); $i++){
            $product[$i]['Price 250 gr'] = $product[$i]['price'][0]['price'];
            $product[$i]['Price 500 gr'] = $product[$i]['price'][1]['price'];
            $product[$i]['Price 1 Kg'] = $product[$i]['price'][2]['price'];
            $product[$i]['Price 5 Kg'] = $product[$i]['price'][3]['price'];
            $product[$i]['Price 25 Kg'] = $product[$i]['price'][4]['price'];
            $product[$i]['Price 30 Kg'] = $product[$i]['price'][5]['price'];
            unset($product[$i]['price']);
            unset($product[$i]['_id']);
        }

        return Excel::create('product-list', function ($excel) use ($product) {
            $excel->sheet('product list', function ($sheet) use ($product) {
                $sheet->fromArray($product);
            });
        })->download('xlsx');
        return dd($product);

    }

    public function clientImport(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file->getRealPath();
            $filename = "import-product[".date("Y-m-d H:i:s")."]";
            $excel = Excel::load($path, function ($reader) {
                $results = $reader->get();
                $data = [];
                //read sheet 1
                foreach($results as $listData){ //result[0] if load multiple sheet selectSheetsByIndex(0,1)
                    //check parent column value
                    if(!isset($listData['code'])||!isset($listData['name'])||!isset($listData['type'])
                    ||!isset($listData['stock'])||!isset($listData['currency'])||!isset($listData['price_250_gr'])
                    ||!isset($listData['price_500_gr'])||!isset($listData['price_1_kg'])||!isset($listData['price_5_kg'])
                    ||!isset($listData['price_25_kg'])||!isset($listData['price_30_kg'])){
                        
                        $data[] = array('parent column not valid');

                    }else{
                        $code = $listData['code'];
                        $name = $listData['name'];
                        $type = $listData['type'];
                        $stock = $listData['stock'];
                        $currency = $listData['currency'];
                        $price_250_gr = $listData['price_250_gr'];
                        $price_500_gr = $listData['price_500_gr'];
                        $price_1_kg = $listData['price_1_kg'];
                        $price_5_kg = $listData['price_5_kg'];
                        $price_25_kg = $listData['price_25_kg'];
                        $price_30_kg = $listData['price_30_kg'];
                        if( trim($code) == "" || trim($name) == "" || trim($type) == "" || trim($stock) == ""
                        || trim($currency) == "" || trim($price_250_gr) == "" || trim($price_500_gr) == "" 
                        || trim($price_1_kg) == "" || trim($price_5_kg) == "" || trim($price_25_kg) == ""|| trim($price_30_kg) == "" ){
                            $data[] = array('error import => data value not valid');
                        }else{
                            $product = Product::where('code', $code)->first();
                            if($product){
                                $product['code'] = $code;
                                $product['name'] = $name;
                                $product['type'] = $type;
                                $product['stock'] = $stock;
                                $product['currency'] = $currency;
                                $product['price'] = [
                                    ['price' => $price_250_gr],
                                    ['price' => $price_500_gr],
                                    ['price' => $price_1_kg],
                                    ['price' => $price_5_kg],
                                    ['price' => $price_25_kg],
                                    ['price' => $price_30_kg],                                 
                                ];
                                $product->save();
                                $data[] = array('product edit successfuly');
                            }else{
                                $product = new Product();
                                $product['code'] = $code;
                                $product['name'] = $name;
                                $product['type'] = $type;
                                $product['stock'] = $stock;
                                $product['currency'] = $currency;
                                $product['price'] = [
                                    ['price' => $price_250_gr],
                                    ['price' => $price_500_gr],
                                    ['price' => $price_1_kg],
                                    ['price' => $price_5_kg],
                                    ['price' => $price_25_kg],
                                    ['price' => $price_30_kg],                                 
                                ];
                                $product->save();
                                $data[] = array('product create successfuly');
                            }
                        }
                    }
                }

                //editing sheet 1
                $sheet0 = $reader->setActiveSheetIndex(0);
                $reader->getActiveSheet()->fromArray($data, null, 'L2', false, false); //L2 is note columns
                //$reader->getActiveSheet()->setAutoSize(true);
            })->setFilename($filename)->download('xlsx');
        }

    }
}
