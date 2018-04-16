<?php

use Illuminate\Database\Seeder;

class CarriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('carriers')->insert([
             [
	        	'type' => 'COD',
	        	'to' => 'JAKARTA SELATAN',
	        	'price' => '200000',
	        	'name' => null,
	        	'api' => null,
	        	'status' => 'on',
				'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
             ],
             [
	        	'type' => 'Courier',
	        	'to' => null,
	        	'price' => null,
	        	'name' => 'JNE',
	        	'api' => 'your-api-key',
	        	'status' => 'on',
				'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
             ],
		]);
    }
}
