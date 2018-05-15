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
            'stock' => [
                [
                    'name' => '250g Plastik',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '250g Aluminium',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '500g Plastik',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '500g Aluminium',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '1kg Plastik',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '1kg Aluminium',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '5kg Jerigen',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '25kg Jerigen',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '25kg Drum',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '30kg Jerigen',
                    'quantity' => (double)'0'
                ],
            ],
            'price'=> [
                [
                    'name' => '250g Plastik',
                    'price' => (double)'0'
                ],
                [
                    'name' => '250g Aluminium',
                    'price' => (double)'0'
                ],
                [
                    'name' => '500g Plastik',
                    'price' => (double)'0'
                ],
                [
                    'name' => '500g Aluminium',
                    'price' => (double)'0'
                ],
                [
                    'name' => '1kg Plastik',
                    'price' => (double)'0'
                ],
                [
                    'name' => '1kg Aluminium',
                    'price' => (double)'0'
                ],
                [
                    'name' => '5kg Jerigen',
                    'price' => (double)'0'
                ],
                [
                    'name' => '25kg Jerigen',
                    'price' => (double)'0'
                ],
                [
                    'name' => '25kg Drum',
                    'price' => (double)'0'
                ],
                [
                    'name' => '30kg Jerigen',
                    'price' => (double)'0'
                ],
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
            'stock' => [
                [
                    'name' => '250g Plastik',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '250g Aluminium',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '500g Plastik',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '500g Aluminium',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '1kg Plastik',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '1kg Aluminium',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '5kg Jerigen',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '25kg Jerigen',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '25kg Drum',
                    'quantity' => (double)'0'
                ],
                [
                    'name' => '30kg Jerigen',
                    'quantity' => (double)'0'
                ],
            ],
            'price'=> [
                [
                    'name' => '250g Plastik',
                    'price' => (double)'0'
                ],
                [
                    'name' => '250g Aluminium',
                    'price' => (double)'0'
                ],
                [
                    'name' => '500g Plastik',
                    'price' => (double)'0'
                ],
                [
                    'name' => '500g Aluminium',
                    'price' => (double)'0'
                ],
                [
                    'name' => '1kg Plastik',
                    'price' => (double)'0'
                ],
                [
                    'name' => '1kg Aluminium',
                    'price' => (double)'0'
                ],
                [
                    'name' => '5kg Jerigen',
                    'price' => (double)'0'
                ],
                [
                    'name' => '25kg Jerigen',
                    'price' => (double)'0'
                ],
                [
                    'name' => '25kg Drum',
                    'price' => (double)'0'
                ],
                [
                    'name' => '30kg Jerigen',
                    'price' => (double)'0'
                ],
            ],
            'currency' => 'USD',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}