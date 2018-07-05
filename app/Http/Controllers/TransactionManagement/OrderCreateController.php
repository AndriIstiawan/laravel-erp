<?php

namespace App\Http\Controllers\TransactionManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Counter;
use App\Carriers;
use App\SalesOrder;
use App\User;
use App\Packaging;
use App\Member;
use App\Product;
use Auth;

class OrderCreateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $members = Member::all();
        $products = Product::all();
        $packaging = Packaging::all();
        $carrier = Carriers::where('status', 'on')->get();
        $member = Member::groupBy('code')->count('shipping_address');
        return view('panel.transaction-management.order-create.form-create')->with([
            'user' => $user,
            'members' => $members,
            'products' => $products,
            'memberssss' => $member,
            'carrier' => $carrier,
            'packaging' => $packaging
        ]);
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
        {
        $client = Member::find($request->client);
        $divisi = [];
        $sales = [
            'name' => $client['sales'][0]['name'],
            'detail' => $client['sales'][0]['detail'][count($client['sales'][0]['detail']) - 1],
        ];

        if (isset($request->divisi)) {
            $get_divisi = $client['divisi'][(int)$request->divisi];
            $get_divisi['index'] = (int)$request->divisi;
            $divisi = [
                $get_divisi,
            ];
            $sales = [
                '_id' => $client['divisi'][(int) $request->divisi]['sales'][0]['_id'],
                'name' => $client['divisi'][(int) $request->divisi]['sales'][0]['name'],
                'detail' => $client['divisi'][(int) $request->divisi]['sales'][0]['detail'][0],
            ];
        }

        $so = new SalesOrder();
        $so->code = $this->generateSO();
        $so->client = [
            $client->toArray(),
        ];
        $so->sales = [$sales];
        $so->divisi = $divisi;
        $so->billing = $request->billing;
        $so->shipping = $client['shipping_address'][(int) $request->shipping]['address'];
        $so->TOP = $request->TOP;

        if ($request->whiteLabel == ''){
            $so->white_label = 'Tidak';
        }else{
            $so->white_label = 'Ya';
        }

        $deliverys=Carriers::where('_id', $request->delivery)->get();
        $so->delivery = $deliverys->toArray();

        if ($request->packkayu == '') {
            $so->pack_kayu = 'Tidak';
        }else{
            $so->pack_kayu = 'Ya';
            /*$so->pack_kayu = $request->packkayu;*/
        }

        $so->notes = $request->notes;
        $arrProduct = [];
        $total_kg = 0;
        $total_realisasi = 0;
        foreach ($request->arrProduct as $key) {
            $product = Product::find($request->input('product' . $key));
            $total_kg = $total_kg + (((double) $request->input('total' . $key)) * 1000);
            $total_realisasi = $total_realisasi + (((double) $request->input('realisasi' . $key)) * 1000);
            $arrProduct[] = [
                "product_id" => $product['_id'],
                "name" => $product['name'] . " - " . $product['type'],
                "product_detail" => [$product->toArray()],
                "package" => $request->input('package' . $key),
                "quantity" => $request->input('quantity' . $key),
                "weight" => (double) $request->input('weight' . $key),
                "total" => ((double) $request->input('total' . $key)) * 1000,
                "realisasi" => ((double) $request->input('realisasi' . $key)) * 1000,
                "tunggu" => null,
                "petugas_produksi" => null,
                "petugas_qc" => null,
                "status_produksi" => null,
                "mulai_proses"=>null,
                "selesai_proses"=>null,
                "tgl_pass"=>null,
                "tgl_reject"=>null,
                "note_reject"=>null
            ];
        }
        $so->products = $arrProduct;
        $so->total_product = count($request->arrProduct);
        $so->total_kg = $total_kg;
        $so->total_realisasi = $total_realisasi;

        /*$checks=user::where('_id', $request->check)->get();
        $so->check=$checks->toArray();

        $produksis=user::where('_id', $request->produksi)->get();
        $so->produksi=$produksis->toArray();*/

        $so->status = "order";

        $so->save();

        if($request->targetUrl){
            return redirect('/')->with('toastr', 'order');
        }else{
            return redirect()->route('sales-order.index')->with('toastr', 'order');
        }

        /*return dd($so);*/
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function generateSO()
    {
        $id_counter = Counter::first()->generateSO('so_counter');
        return "SO-" . $id_counter;
    }
}
