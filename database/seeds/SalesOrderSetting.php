<?php

use Illuminate\Database\Seeder;

class SalesOrderSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $so = DB::table('sales_orders')->get();
        foreach($so as $sales_order){
            $products = [];
            foreach($sales_order["products"] as $so_product){
                $products[] = [
                    "product_id" => (isset($so_product["product_id"])?$so_product["product_id"]:null),
                    "name" => (isset($so_product["name"])?$so_product["name"]:null),
                    "product_detail" => (isset($so_product["product_detail"])?$so_product["product_detail"]:null),
                    "package" => (isset($so_product["package"])?$so_product["package"]:null),
                    "quantity" => (isset($so_product["quantity"])?$so_product["quantity"]:null),
                    "weight" => (isset($so_product["weight"])?$so_product["weight"]:null),
                    "total" => (isset($so_product["total"])?$so_product["total"]:null),
                    "realisasi" => (isset($so_product["realisasi"])?$so_product["realisasi"]:null),
                    "tunggu" => (isset($so_product["tunggu"])?$so_product["tunggu"]:null),
                    "petugas_produksi" => (isset($so_product["petugas_produksi"])?$so_product["petugas_produksi"]:null),
                    "petugas_qc" => (isset($so_product["petugas_qc"])?$so_product["petugas_qc"]:null),
                    "status_produksi" => (isset($so_product["status_produksi"])?$so_product["status_produksi"]:null),
                    "mulai_proses" => (isset($so_product["mulai_proses"])?$so_product["mulai_proses"]:null),
                    "selesai_proses" => (isset($so_product["selesai_proses"])?$so_product["selesai_proses"]:null),
                    "tgl_pass" => (isset($so_product["tgl_pass"])?$so_product["tgl_pass"]:null),
                    "tgl_reject" => (isset($so_product["tgl_reject"])?$so_product["tgl_reject"]:null),
                    "note_reject" => (isset($so_product["note_reject"])?$so_product["note_reject"]:null),
                ];
            }
            DB::table('sales_orders')->where('_id', $sales_order["_id"])->update(['products' => $products]);
        }
    }
}
