<?php

use Illuminate\Database\Seeder;

class PaymensMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            [
               'type' => 'Payment Gateway',
               'name' => 'BRI',
               'norek' => '907283748213343',
               'created_at' => date("Y-m-d H:i:s"),
               'updated_at' => date("Y-m-d H:i:s")
            ],
            [
               'type' => 'ATM Transfer',
               'name' => 'BRI',
               'norek' => '0928394038232393',
               'created_at' => date("Y-m-d H:i:s"),
               'updated_at' => date("Y-m-d H:i:s")
            ],
       ]);
    }
}
