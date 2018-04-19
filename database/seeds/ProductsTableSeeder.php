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
            [
            'code' => '5006',
            'name' => 'EXTREME FORTE',
            'type' => 'BP',
            'stock' => '120',
            'price'=> [
                [
                'value' => '500',
                'price' => '38.62'
                ],
                [
                'value' => '1',
                'price' => '35.57'
                ],
                [
                'value' => '5',
                'price' => '32.36'
                ],
                [
                'value' => '25',
                'price' => '30.05'
                ]
            ],
            'currency' => 'USD',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'code' => '5007',
            'name' => 'EXTREME FORTE 2',
            'type' => 'BPK',
            'stock' => '100',
            'price'=> [
                [
                'value' => '500',
                'price' => '38.62'
                ],
                [
                'value' => '1',
                'price' => '35.57'
                ],
                [
                'value' => '5',
                'price' => '32.36'
                ],
                [
                'value' => '25',
                'price' => '30.05'
                ]
            ],
            'currency' => 'USD',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}