<?php

namespace App\Http\Controllers\SettingManagement;

use App\Http\Controllers\Controller;
use App\Setting;
use App\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use File;

class MasterSettingController extends Controller
{

    //Protected module master-setting by slug
    public function __construct()
    {
        $this->middleware('perm.acc:master-setting');
    }
    
    public function index()
    {
        $setting = Setting::first();
        return view('panel.setting-management.master-setting.form')->with([
            'setting'=> $setting,
        ]);
    }
    
    public function show()
    {
        //
    }

    public function update(Request $request, $id)
    {
        //Update setting data
        $setting = Setting::first();
        $setting->site_title = $request->siteTitle;
        $setting->kurs = $request->kurs;
        $setting->ppn = $request->ppn;
        $setting->site_status = ($request->siteStatus == 'on'?true:false);
        $setting->phone_number = $request->phoneNumber;
        $setting->phone_wa = $request->phoneWa;
        $setting->email_info = $request->emailInfo;
        $setting->order_expire = $request->odExpire;
        $setting->transaction_price = str_replace(',', '.',str_replace('.', '',$request->transPrice));
        $setting->transaction_point = $request->transPoint;
        $setting->member_log_expire = $request->memberExpire;
        $arrProduct = [];
        foreach ($request->arrProduct as $key) {
            $arrProduct[] = [
            "name" => $request->input('name' . $key),
            "norek" => $request->input('norek' . $key),
            "cabang" => $request->input('cabang' . $key),
            "pemilik" => $request->input('pemilik' . $key),
            ];
        }
        $setting->bank = $arrProduct;

        //Check has logo
        if ($request->hasFile('logo')) {
            $pictureFile = $request->file('logo');
            $extension = $pictureFile->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            File::delete(public_path('/img/'. $setting->logo));
            $pictureFile->move($destinationPath, 'site-logo.' . $extension);
            $setting->logo = 'site-logo.' . $extension;
        }

        //Check has favicon
        if ($request->hasFile('favicon')) {
            $pictureFile = $request->file('favicon');
            $extension = $pictureFile->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            File::delete(public_path('/img/'. $setting->favicon));
            $pictureFile->move($destinationPath, 'site-favicon.' . $extension);
            $setting->favicon = 'site-favicon.' . $extension;
        }
        $setting->save();
        return "ok";
    }
}
