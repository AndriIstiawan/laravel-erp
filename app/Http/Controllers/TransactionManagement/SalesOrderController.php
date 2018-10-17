<?php

namespace App\Http\Controllers\TransactionManagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Counter;
use App\Member;
use App\Product;
use App\SalesOrder;
use App\Carriers;
use App\Packaging;
use App\User;
use Excel;
use DateTime;

class SalesOrderController extends Controller
{
    //Protected module product by slug
    public function __construct()
    {
        $this->middleware('perm.acc:sales-order');
    }
    //find sales order
    public function find(Request $request)
    {
        if ($request->id) {
            $order = SalesOrder::where('name', $request->name)->first();
            if (count($order) > 0) {
                return ($request->id == $order->id ? 'true' : 'false');
            } else {
                return 'true';
            }
        } else {
            return (SalesOrder::where('name', $request->name)->first() ? 'false' : 'true');
        }
    }

    //public index sales order
    public function index()
    {
        return view('panel.transaction-management.sales-order.index');
    }

    //view form create
    public function create()
    {
        $members = Member::all();
        $products = Product::all();
        $carrier = Carriers::where('status', 'on')->get();
        $member = Member::all();
        $packaging = Packaging::all();
        return view('panel.transaction-management.sales-order.form-create')->with([
            'members' => $members,
            'products' => $products,
            'memberssss' => $member,
            'carrier' => $carrier,
            'packaging' => $packaging
        ]);
    }

    //store data sales order
    public function store(Request $request)
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
                /*'_id' => $client['divisi'][(int) $request->divisi]['sales'][0]['_id'],*/
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

    //list data
    public function list_data(Request $request)
    {
        if($request->dateStart == null){
            $orders = SalesOrder::select('_id', 'code','client','sales','TOP','notes','status','created_at');
        }else{
            $orders = SalesOrder::where('created_at','>=',new DateTime($request->dateStart))
                ->where('created_at','<=',new DateTime($request->dateEnd." 23:59:59"))->get();
        }
        
        return Datatables::of($orders)
            ->addColumn('checkbox', function ($order) {
                return '<input id="'.$order->id.'" class="data-list" value="'.$order->id.'" type="checkbox" onchange="selected(this)"/>';
            })
            ->addColumn('conv_total_kg', function ($order) {
                return ((double)$order->total_kg/1000)." KG";
            })
            ->addColumn('status', function ($order) {
                switch($order->status){
                    case "order":
                        return '<span class="badge badge-success" style="padding:9px;">&nbsp;&nbsp;'.$order->status.'&nbsp;&nbsp;</span>';
                        break;
                    case "production":
                        return '<span class="badge badge-warning" style="padding:9px;">&nbsp;&nbsp;'.$order->status.'&nbsp;&nbsp;</span>';
                        break;
                    default:
                        return '<span class="badge badge-success" style="padding:9px;">&nbsp;&nbsp;'.$order->status.'&nbsp;&nbsp;</span>';
                }
            })
            ->addColumn('action', function ($order) {
                $edit = '';
                if($order->status == 'order'){
                    $edit = '<a class="btn btn-success btn-sm"  href="'.route('sales-order.edit',['id' => $order->id]).'" '.($order->status!='order'?$order->status:'').'>
                <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>'.
                '<form style="display:inline;" method="POST" action="' .route('sales-order.destroy', ['id' => $order->id]) . '">' . method_field('DELETE') . csrf_field().
                    '<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))" '.($order->status!='order'?$order->status:'').'><i class="fa fa-remove"></i>&nbsp;Remove
                </button></form>';
                }
                return $edit;
            })
            ->rawColumns(['status','action','conv_total_kg','checkbox'])
            ->make(true);
    }

    //for getting datatable at index
    public function show(Request $request, $action)
    {
        switch ($action) {
            case "export":
                return $this->soExport($request);
                break;
            default:
                return $this->list_data($request);
        }
    }

    //view form edit
    public function edit($id)
    {
        $order = SalesOrder::find($id);
        $client = Member::find($order['client'][0]['_id']);
        $members = Member::all();
        $member = Member::groupBy('code')->count('shipping_address');
        $products = Product::all();
        $packaging = Packaging::all();
        $delivery = Carriers::find($order['delivery'][0]['_id']);
        $carrier = Carriers::where('status', 'on')->get();
        return view('panel.transaction-management.sales-order.form-edit')->with([
            'order' => $order,
            'client' => $client,
            'members' => $members,
            'products' => $products,
            'carrier' => $carrier,
            'memberssss' => $member,
            'delivery' => $delivery,
            'packaging' => $packaging
        ]);
    }

    //update data
    public function update(Request $request, $id)
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

        $so = SalesOrder::find($id);
        $so['client'] = [
            $client->toArray(),
        ];
        $so['sales'] = [$sales];
        $so['divisi'] = $divisi;
        $so['billing']= $request->billing;
        $so['shipping'] = $client['shipping_address'][(int) $request->shipping]['address'];
        $so['TOP'] = $request->TOP;

        if ($request->whiteLabel == ''){
            $so['white_label'] = 'Tidak';
        }else{
            $so['white_label'] = 'Ya';
        }
        
        $deliverys=Carriers::where('_id', $request->delivery)->get();
        $so['delivery'] = $deliverys->toArray();
        
        if ($request->packkayu == '') {
            $so['pack_kayu'] = 'Tidak';
        }else{
            $so->pack_kayu = 'Ya';
            /*$so['pack_kayu'] = $request->packkayu;*/
        }

        $so['notes'] = $request->notes;
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
        $so['products'] = $arrProduct;
        $so['total_product'] = count($request->arrProduct);
        $so['total_kg'] = $total_kg;
        $so['total_realisasi'] = $total_realisasi;
        $so['status'] = "order";

        /*$checks=user::where('_id', $request->check)->get();
        $so['check']=$checks->toArray();

        $produksis=user::where('_id', $request->produksi)->get();
        $so['produksi']=$produksis->toArray();*/

        $so->save();
        return redirect()->route('sales-order.index')->with('update', 'sales-order');

        /*return dd($so);*/
    }

    //delete data discount
    public function destroy($id)
    {
        $order = SalesOrder::find($id);
        $order->delete();
        return redirect()->route('sales-order.index')->with('dlt', 'sales-order');
    }

    public function display($id)
    {
        $order = SalesOrder::find($id);
        if($order['status'] == 'order'){
            $order->delete();
        }
        return redirect()->route('sales-order.index')->with('dlt', 'sales-order');
    }

    public function generateSO()
    {
        $id_counter = Counter::first()->generateSO('so_counter');
        return "SO-" . $id_counter;
    }

    public function soExport(Request $request)
    {
        $file = storage_path('exports/so-form-format.xlsx');
        $filename = 'so-form-export['.date("H-i-s d-m-Y")."]";
        if(isset($request->arrList)){
            $salesorders = SalesOrder::whereIn('_id',$request->arrList)->get();
        }else{
            $salesorders = SalesOrder::all();
        }
        //load excel form and editing row
        $excel = Excel::selectSheetsByIndex(0)->load($file, function($reader) use ($filename,$salesorders) {
            $data = [];
            $code = "";
            $id_client = "";
            $client = "";
            $sales = "";
            foreach($salesorders as $salesorder){
                foreach($salesorder->products as $so_product){
                    $so_code = "";
                    $so_idclient = "";
                    $so_client = "";
                    $so_sales = "";
                    if($code != $salesorder->code){
                        $code = $salesorder->code;
                        $id_client = $salesorder->client[0]['code'];
                        $client = $salesorder->client[0]['display_name'];
                        $sales = $salesorder->sales[0]['name'];
                        $so_code = $salesorder->code;
                        $so_idclient = $salesorder->client[0]['code'];
                        $so_client = $salesorder->client[0]['display_name'];
                        $so_sales = $salesorder->sales[0]['name'];
                    }
                    switch($so_product['weight']){
                        case 30000:
                        case 25000:
                        case 5000:
                        case 1000:
                            $so_product['weight'] = ((double)$so_product['weight']/1000)." kg";
                        break;
                        default:
                            $so_product['weight'] = $so_product['weight']." gr";
                    }

                    $data[] = [
                        $so_code,
                        $so_idclient,
                        $so_client,
                        $so_sales,
                        $so_product['product_detail'][0]['type'],
                        $so_product['product_detail'][0]['code'],
                        $so_product['product_detail'][0]['name'],
                        $so_product['quantity'],
                        "X",
                        $so_product['weight'],
                        $so_product['package'],
                        ((double)$so_product['total']/1000),
                        $so_product['quantity']." ".$so_product['package']." ".$so_product['weight'],
                        $salesorder->white_label,
                        $salesorder->pack_kayu,
                        $salesorder['delivery'][0]['name'],
                        "",
                        $salesorder->TOP,
                        ((double)$salesorder['client'][0]['limit']),
                        $salesorder->shipping,
                        $salesorder->created_at,
                        $salesorder->status,
                    ];
                }
            }

            //editing sheet 1
            $reader->setActiveSheetIndex(0);
            $sheet1 = $reader->getActiveSheet();
            $sheet1->fromArray($data, null, 'A3', false, false);
            //$reader->getActiveSheet()->setAutoSize(true);
        });
        
        if(isset($request->arrList)){
            $excel->setFilename($filename)->store('xlsx', false, true);
            return $filename.".xlsx";
        }else{
            $excel->setFilename($filename)->download('xlsx');
        }
    }
}
