<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
        	
	        	'email' => 'member@ecommerce.com',
	        	'status' => 'Pending',
	        	'type' => 'ATM Transfer',
	        	'name' => 'Mandiri',
	        	'total' => '42.680.000',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			
		]);
    }
}
