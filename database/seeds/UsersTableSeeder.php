<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
        	'name' => env('ROOT_NAME', 'Root Fiture'),
        	'email' => env('ROOT_USERNAME', 'jx@fiture.id'),
        	'password' => bcrypt(env('ROOT_PASSWORD', 'fiture123$#')),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Sales',
            'email' => 'sales@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
        
        $parent = DB::table('roles')->whereIn('name',['Sales'])->get();
        DB::table('users')->whereIn('email', ['sales@gmail.com'])
			->update(['role' => $parent->toArray()]);
    }
}
