<?php

namespace App\Http\Controllers\TransactionManagement;

use App\Counter;
use App\Http\Controllers\Controller;
use App\Member;
use App\Product;
use App\SalesOrder;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

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
        return view('panel.transaction-management.sales-order.form-create')->with([
            'members' => $members,
            'products' => $products,
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
        $so->white_label = $request->whiteLabel;
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
            ];
        }
        $so->products = $arrProduct;
        $so->total_product = count($request->arrProduct);
        $so->total_kg = $total_kg;
        $so->total_realisasi = $total_realisasi;
        $so->status = "order";

        $so->save();
        return redirect()->route('sales-order.index')->with('toastr', 'order');
    }

    //list data
    public function list_data()
    {
        $orders = SalesOrder::all();
        return Datatables::of($orders)
            ->addColumn('conv_total_kg', function ($order) {
                return ((double)$order->total_kg/1000)." KG";
            })
            ->addColumn('status', function ($order) {
                switch($order->status){
                    case "order":
                        return '<span class="badge badge-success" style="padding:9px;">&nbsp;&nbsp;'.$order->status.'&nbsp;&nbsp;</span>';
                        break;
                    default:
                        return '<span class="badge badge-success" style="padding:9px;">&nbsp;&nbsp;'.$order->status.'&nbsp;&nbsp;</span>';
                }
            })
            ->addColumn('action', function ($order) {
                return '';
                /*'<a class="btn btn-success btn-sm"  href="'.route('sales-order.edit',['id' => $order->id]).'" '.($order->status!='order'?$order->status:'').'>
                <i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>'.
                '<form style="display:inline;" method="POST" action="' .
                route('sales-order.destroy', ['id' => $order->id]) . '">' . method_field('DELETE') . csrf_field() .
                    '<button type="button" class="btn btn-danger btn-sm" onclick="removeList($(this))" '.($order->status!='order'?$order->status:'').'><i class="fa fa-remove"></i>&nbsp;Remove</button></form>';*/
            })
            ->rawColumns(['status', 'action', 'conv_total_kg'])
            ->make(true);
    }

    //for getting datatable at index
    public function show(Request $request, $action)
    {
        switch ($action) {
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
        $order = SalesOrder::find($id);
        $client = Member::find($order['client'][0]['_id']);
        $members = Member::all();
        $products = Product::all();
        return view('panel.transaction-management.sales-order.form-edit')->with([
            'order' => $order,
            'client' => $client,
            'members' => $members,
            'products' => $products,
        ]);
    }

    //update data
    public function update(Request $request, $id)
    {
        $order = SalesOrder::find($id);
        $order->sono = $request->sono;
        $order->date = $request->date;

        $clients = Member::where('_id', $request->client)->get();
        $order->client = $clients->toArray();

        /*$sales=user::where('_id', $request->sales)->get();
        $order->sales=$sales->toArray();*/

        $productss = [];
        for ($i = 0; $i < count($request->total); $i++) {
            $products = Product::where('_id', $request->product[$i])->first();
            $productss[] = [
                'id' => $products['id'],
                'name' => $products['name'],
                'type' => $products['type'],
                'code' => $products['code'],
                'total' => $request->total[$i],
                'packaging' => $request->packaging[$i],
                'amount' => $request->amount[$i],
                'package' => $request->package[$i],
                'realisasi' => $request->realisasi[$i],
                'stockk' => $request->stockk[$i],
                'pending' => $request->pending[$i],
                'balance' => $request->balance[$i],
                'pendingpr' => $request->pendingpr[$i],
            ];
        }
        $order->productattr = $productss;

        $order->catatan = $request->catatan;
        $order->tunggu = $request->tunggu;

        $checks = user::where('_id', $request->check)->get();
        $order->check = $checks->toArray();

        $produksis = user::where('_id', $request->produksi)->get();
        $order->produksi = $produksis->toArray();

        $order->status = $request->status;

        $order->save();
        return redirect()->route('sales-order.index')->with('update', 'sales-order');
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
        $order->delete();
        return redirect()->route('sales-order.index')->with('dlt', 'sales-order');
    }

    public function generateSO()
    {
        $id_counter = Counter::first()->generateSO('so_counter');
        return "SO-" . $id_counter;
    }

    public function orderExport(Request $request)
    {
        $order = SalesOrder::select('sono', 'created_at', 'client', 'sales', 'catatan', 'productattr')->get();
        $orderarr = [];

        for ($i = 0; $i < count($order); $i++) {
            for ($j = 0; $j < count($order[$i]->productattr); $j++) {
                $orderarr[] = [
                    'SO No' => $order[$i]->sono,
                    'created_at' => $order[$i]->created_at,
                    'Client' => $order[$i]->client[0]['name'],
                    'Sales' => $order[$i]->sales[0]['name'],
                    'Type' => $order[$i]->productattr[$j]['type'],
                    'Code' => $order[$i]->productattr[$j]['code'],
                    'Total' => $order[$i]->productattr[$j]['total'],
                    'Package' => $order[$i]->productattr[$j]['package'],
                    'Final Total' => $order[$i]->productattr[$j]['amount'],
                    'Note' => $order[$i]->catatan,

                ];
            }
        }
        return dd($orderarr);

    }
}
