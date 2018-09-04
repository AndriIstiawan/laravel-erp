<?php

use Illuminate\Database\Seeder;

class TipePromosiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipe_promos')->truncate();
        DB::table('tipe_promos')->insert([
            [
                'name' => 'ITEM TERTENTU HARGA KHUSUS',
                'satuan' => '.00',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'HARGA LIST',
                'satuan' => '.00',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'DISCOUNT KHUSUS',
                'satuan' => '%',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'TOP KHUSUS',
                'satuan' => 'hari',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'FREE ONGKIR',
                'satuan' => 'free-ongkir',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]
        ]);
    }
}
