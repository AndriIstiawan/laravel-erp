<?php

use Illuminate\Database\Seeder;

class MasterSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();
        DB::table('settings')->insert([
            'kurs' => 14.645,
            'ppn' => 1,
            'site_title' => env('SITE_TITLE', 'FE-B2B-Backend-WEB'),
            'site_status' => env('SITE_STATUS', true),
            'phone_number' => env('PHONE_NUMBER', '(021) 2939123'),
            'phone_wa' => '0813 6363 9393',
            'email_info' => env('EMAIL_INFO', 'info@hoky.com'),
            'meta_title' => env('META_TITLE', 'FE-B2B-Backend-WEB'),
            'meta_description' => env('META_DESCRIPTION', 'FE-B2B-Backend-WEB'),
            'order_expire' => env('ORDER_EXPIRE', 1),
            'transaction_price' => env('TRANSACTION_PRICE', 100000000.00),
            'transaction_point' => env('TRANSACTION_POINT', 1000),
            'member_log_expire' => env('MEMBER_LOG_EXPIRED', 3),
            'created_at' => date("Y-m-d H:i:s"),
            'bank'=>[
                [
                    'name'=>'BCA',
                    'norek'=>'581 068 8817',
                    'cabang'=>'KCP Pluit Megamal',
                    'pemilik'=>'PT. Macbrameindo Harum Abadi'
                ],
                [
                    'name'=>'BRI',
                    'norek'=>'1767.01.000075.30.1',
                    'cabang'=>'KCP City Park',
                    'pemilik'=>'PT. Macbrameindo Harum Abadi'
                ]
            ],
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
