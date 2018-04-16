<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
			[
	        	'name' => 'Admin',
	        	'description' => 'Administer roles & permissions',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
			[
	        	'name' => 'Sales',
	        	'description' => 'Sales promotion & event',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
			[
	        	'name' => 'Warehouse',
	        	'description' => 'Warehouse roles',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
			[
	        	'name' => 'E-Shop 1',
	        	'description' => 'Admin Shop 1 roles',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
			[
	        	'name' => 'E-Shop 2',
	        	'description' => 'Admin Shop 2 roles',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
		]);
    }
}
