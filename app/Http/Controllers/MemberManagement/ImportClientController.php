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

class ImportClientController extends Controller
{
    //Protected module product by slug
    public function __construct()
    {
        $this->middleware('perm.acc:master-client');
    }

    //public index import product
    public function index()
    {
        //return view('panel.product-management.product.import-panel.index');
    }

    //public index import product
    public function importData(Request $request)
    {
        $path = $request->file('import')
                        ->getRealPath();

        $member_excel       = Excel::selectSheetsByIndex(0)->load($path)->get();

        $member_collection = collect($member_excel->toArray());

       //\Log::info($this->checkCategory());
        
        // #function validation import
        $response = $this->validationImportProduct($member_collection);


        if($response['alert'] == 'success') {

           foreach ($member_collection->chunk(100) as  $valid_file) {

                foreach ($valid_file as  $value) {
                    $member = Member::firstOrCreate([ 'code' => $value['code']]);
                    $member->code = $value['code'];
                    $member->display_name = $value['displayname'];
                    $member->fullname = $value['fullname'];
                    $member->title = $value['title'];
                    $member->email = $value['email'];
                    $member->limit = $value['limit'];
                    $member->white_label = $value['white_label'];
                    $member->pack_kayu = $value['pack_kayu'];
                    $member->company = $value['companyname'];
                    $member->segmen_pasar = $value['segmenpasar'];
                    $member->negara = $value['negara'];
                    $member->provinsi = $value['provinsi'];
                    $member->kota = $value['kota'];
                    $member->remarks = $value['remarks'];
                    $member->divisi = [];
                    $member->billing_address = $value['billingaddress'];

                    $sales = User::where('role', 'elemMatch', array('name' => 'Sales'))->where('email', $value['salesemail'])->first();
                    if($sales) {
                        $member->sales = [[
                            '_id' => $sales['_id'],
                            'name' => $sales['name'],
                            'detail' => [$sales->toArray()],
                        ]];
                    }

                    $shippingaddress = explode(' / ', $value['shippingaddress']);
                    $arrAddr = [];
                    foreach($shippingaddress as $shipping_list){
                        $arrAddr[] = [
                            'address' => $shipping_list,
                        ];
                    }
                    $member->shipping_address = $arrAddr;

                    $mobile = explode(' / ', $value['mobile']);
                    $arrNumber = [];
                    foreach($mobile as $mobile_list){
                        $arrNumber[] = [
                            'number' => $mobile_list,
                        ];
                    }
                    $member->mobile = $arrNumber;

                    $phone = explode(' / ', $value['phone']);
                    $arrNumber = [];
                    foreach($phone as $phone_list){
                        $arrNumber[] = [
                            'number' => $phone_list,
                        ];
                    }
                    $member->phone = $arrNumber;

                    if($value['dateregister'] != ""){
                        $value['dateregister'] = date("Y-m-d H:i:s", strtotime($value['dateregister']));
                    }else{
                        $value['dateregister'] = date("Y-m-d H:i:s");
                    }
                    $member->created_at = $value['dateregister'];

                    $member->save();
                }
            }
        }
        return $response;
    }

    /**
     * this is function validation import file excel product
     * check field mandotary
     * check image extension only mime_type Image
     */
    private function validationImportProduct($collection)
    {
        #CHECK VALIDATION FILE
        #this is field mandotary
        $code               = $collection->pluck('code');
        $displayname        = $collection->pluck('displayname');
        $title              = $collection->pluck('title');
        $fullname           = $collection->pluck('fullname');
        $salesemail         = $collection->pluck('salesemail');
        $billingaddress     = $collection->pluck('billingaddress');
        $shippingaddress    = $collection->pluck('shippingaddress');
        $mobile             = $collection->pluck('mobile');
        $pack_kayu          = $collection->pluck('pack_kayu');
        $white_label        = $collection->pluck('white_label');
        $dateregister       = $collection->pluck('dateregister');

        #check if column mandotary is null return warning
        if( $code->contains(null) == true || $displayname->contains(null) == true || $title->contains(null) == true || $fullname->contains(null) == true || $salesemail->contains(null) == true || $billingaddress->contains(null) == true || $shippingaddress->contains(null) == true || $mobile->contains(null) == true || $pack_kayu->contains(null) == true || $white_label->contains(null) == true ) {

            $response = array(
                'alert' => 'warning',
                'message' => 'Please check again your file, column mandotary must field...'
            );

        }else{
            #Checking Category Master
            #if empty redirect back
            if( count($this->checkSales($salesemail)) > 0 ) {

                $sales_empty = implode(', ', $this->checkSales($salesemail));

                $response = array(
                    'alert'   => 'warning',
                    'message' => 'Sorry sales '. $sales_empty. ' not found in database, please check first your list categories in system'
                );

            }
            else
            {   
                /*if (($timestamp = strtotime($dateregister)) == false && $dateregister != ""){
                    $response = array(
                        'alert'   => 'warning',
                        'message' => 'error import => date register is not valid'
                    );
                } else {*/
                    #PROSES VALID
                    $response = array(
                        'alert'   => 'success',
                        'message' => 'Success Import Product...'
                    );
                //}
            }
        }

        return $response;
    }

    private function checkSales($sales_excel): array
    {

        $sales_empty = [];

        foreach ($sales_excel as $key => $data_sales) {

           $sales = User::where('role', 'elemMatch', array('name' => 'Sales'))->where('email', $data_sales)->first();
            
            if(!$sales)  {

                $sales_empty[] =  $data_sales;

            }

        }
        return $sales_empty;
        
    }
}
