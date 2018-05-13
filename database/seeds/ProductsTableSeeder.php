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
            'category' => 'VFM',
            'commercial' => 'Reguler',
            'stock' => '120',
            'price'=> [
                [
                'price' => '38.62'
                ],
                [
                'price' => '38.62'
                ],
                [
                'price' => '35.57'
                ],
                [
                'price' => '32.36'
                ],
                [
                'price' => '30.05'
                ],
                [
                'price' => '29.05'
                ]
            ],
            'currency' => 'USD',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'code' => '5007',
            'name' => 'EXTREME FORTE 2',
            'type' => 'LC',
            'category' => 'VFM',
            'commercial' => 'Reguler',
            'stock' => '100',
            'price'=> [
                [
                'price' => '38.62'
                ],
                [
                'price' => '35.57'
                ],
                [
                'price' => '32.36'
                ],
                [
                'price' => '30.05'
                ],
                [
                'price' => '30.05'
                ],
                [
                'price' => '29.05'
                ]
            ],
            'currency' => 'USD',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}