<?php

use Illuminate\Database\Seeder;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->truncate();
        DB::table('discounts')->insert([
            [
                'title' => 'Promo Percentage',
                'description' => 'Promo Percentage',
                'status' => 'off',
                'currency' => 'USD',
                'tipe_promosi' => [],
                'value' => '20',
                'type' => 'percent',
                'start_date' => '2018-10-31 00:00:00',
                'expired_date' => '2019-07-31 00:00:00',
                'categories' => [],
                'products' => [],
                'members' => [],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Promo cut price',
                'description' => 'Promo cut price',
                'status' => 'off',
                'currency' => 'USD',
                'tipe_promosi' => [],
                'value' => '100000',
                'type' => 'price',
                'start_date' => '2018-10-31 00:00:00',
                'expired_date' => '2019-07-31 00:00:00',
                'categories' => [],
                'products' => [],
                'members' => [],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);

        $parent = DB::table('tipe_promos')->whereIn('name',['DISCOUNT KHUSUS'])->get();
        DB::table('discounts')->whereIn('title', ['Promo Percentage'])
        ->update(['tipe_promosi' => $parent->toArray()]);

        $parent = DB::table('tipe_promos')->whereIn('name',['ITEM TERTENTU HARGA KHUSUS'])->get();
        DB::table('discounts')->whereIn('title', ['Promo cut price'])
        ->update(['tipe_promosi' => $parent->toArray()]);

        $parent = DB::table('members')->whereIn('email', ['member@ecommerce.com'])->get();
        DB::table('discounts')->whereIn('title', ['Promo cut price'])
        ->update(['members' => $parent->toArray()]);

        $parent = DB::table('members')->whereIn('email', ['member@ecommerce.com'])->get();
        DB::table('discounts')->whereIn('title', ['Promo Percentage'])
        ->update(['members' => $parent->toArray()]);

    }
}
