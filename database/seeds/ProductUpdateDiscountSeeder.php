<?php

use Illuminate\Database\Seeder;

class ProductUpdateDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = DB::table('products')->where('code', '<>', '0')->update(['discount_price' => 0 ,'discount_percent' => 0]);
    }
}
