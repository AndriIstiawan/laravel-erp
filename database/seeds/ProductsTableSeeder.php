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
            '500' => '38.62',
            '1' => '35.57',
            '5' => '32.36',
            '25' => '30.05',
            'currency' => 'USD',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
    ]);
    }
}