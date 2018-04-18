<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'code' => '5006',
            'name' => 'EXTREME FORTE',
            'type' => 'BP',
            'stock' => '120',
            'price'=> [
                [
                'price' => '500 mg $38.62'
                ],
                [
                'price' => '1 kg $35.57'
                ],
                [
                'price' => '5 kg $32.36/kg'
                ],
                [
                'price' => '25 kg $30.05/kg'
                ]
            ],
            'currency' => 'USD',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
    ]);
    }
}