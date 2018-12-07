<?php

use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->truncate();
        DB::table('members')->insert([
                'code' => 1,
                'display_name' => 'member',
                'fullname' => 'member',
                'title' => 'Bapak',
                'email' => 'member@ecommerce.com',
                'limit' => '100.000.000.000',
                'white_label' => 'Tidak',
                'pack_kayu' => 'Tidak',
                'mobile' => [
                    [
                        'number' => '081363916262',
                    ],
                ],
                'company' => null,
                'segmen_pasar' => null,
                'negara' => null,
                'provinsi' => null,
                'kota' => null,
                'phone'=>[],
                'sales'=>[
                    [
                        '_id' => null,
                        'name'=> null,
                        'detail' => [],
                    ]
                ],
                'remarks' => null,
                'billing_address' => 'Test',
                'shipping_address' => [
                    [
                        'address' => 'Test'
                    ]
                ],
                'divisi' => [],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        ]);

        $parents = DB::table('users')->where('email','wondo@macbrame.com')->first();
        $parent = DB::table('users')->whereIn('email',['wondo@macbrame.com'])->get();
        DB::table('members')->whereIn('email', ['member@ecommerce.com'])
            ->update(['sales'=> [[
                '_id' => (string)$parents['_id'],
                'name'=> (string)$parents['name'],
                'detail' => $parent->toArray()
                ]]
            ]);        
    }
}
