<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
	        	'email' => 'member@ecommerce.com',
	        	'member' => 'Member',
	        	'status' => 'Processed',
	        	'type' => 'ATM Transfer',
	        	'name' => 'Mandiri',
	        	'product' => 'Trafometer 10.000 V',
	        	'deliveries' => 'Courier',
	        	'quantity' => '1',
	        	'price' => '42.530.000',
	        	'total' => '42.680.000',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			
		]);
    }
}
