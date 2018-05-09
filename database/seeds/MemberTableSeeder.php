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
        DB::table('members')->insert([
	        	'name' => 'Member',
                'email' => 'member@ecommerce.com',
                'phone' => '081363916262',/*
                'point' => null,
	        	'level' => [],
                'status' => 'on',*/
                'address' => [
                    '0' => 'jl bedugul 14',
                ],/*
                'dompet' => null,
                'koin' => null,*/
                'subDivision' => [
                    [
                        'type' => 'BP',
                        'code' => '5006',
                        'sales' => 'Sales',
                        'email' => 'sales@gmail.com',
                        'nameSub' => 'HR',
                    ]

                ],
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        ]);

        /*$parent = DB::table('users')->whereIn('email',['sales@gmail.com'])->get();
        DB::table('members')->whereIn('email', ['member@ecommerce.com'])
            ->update(['sales' => $parent->toArray()]);
        
        $kk = DB::table('levels')->whereIn('point',[1000])->get();
        DB::table('members')->whereIn('email', ['member@ecommerce.com'])
            ->update(['level' => $kk->toArray()]);*/
    }
}
