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
            'name' => env('ROOT_NAME'),
            'email' => env('ROOT_USERNAME'),
            'password' => bcrypt(env('ROOT_PASSWORD')),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'DEDE',
            'email' => 'dede@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'ALAMSYAH',
            'email' => 'alamsyah@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'WONDO',
            'email' => 'wondo@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'JULIAWAN',
            'email' => 'juliawan@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'MGT',
            'email' => 'mgt@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'INDRA',
            'email' => 'indra@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'DRAJAT',
            'email' => 'drajat@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Afif',
            'email' => 'Afif@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Anang',
            'email' => 'Anang@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Rohim',
            'email' => 'Rohim@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Rudi',
            'email' => 'Rudi@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Sarah',
            'email' => 'Sarah@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Heru',
            'email' => 'Heru@gmail.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);

        $parent = DB::table('roles')->whereIn('name',['Sales'])->get();
        DB::table('users')->whereIn('email', ['dede@gmail.com','alamsyah@gmail.com','wondo@gmail.com','juliawan@gmail.com','mgt@gmail.com','indra@gmail.com','drajat@gmail.com'])
            ->update(['role' => $parent->toArray()]);

        $parent = DB::table('roles')->whereIn('name',['Production'])->get();
        DB::table('users')->whereIn('email', ['Afif@gmail.com','Anang@gmail.com','Rohim@gmail.com','Rudi@gmail.com','Sarah@gmail.com','Heru@gmail.com'])
            ->update(['role' => $parent->toArray()]);

        //add sales permission
        $parent = DB::table('permissions')->whereIn('name',['Transaction'])->get();
        $parent = $parent->toArray();
        $child = DB::table('permissions')->whereIn('slug',['order-create'])->get();
        $parent[0]['_id'] = (string)$parent[0]['_id'];
        $child = $child->toArray();
        $child[0]['_id'] = (string)$child[0]['_id'];
        $parent[0]['child'] = $child;
        DB::table('users')->whereIn('email', ['dede@gmail.com','alamsyah@gmail.com','wondo@gmail.com','juliawan@gmail.com','mgt@gmail.com','indra@gmail.com','drajat@gmail.com'])
            ->update(['modulePermissions' => $parent]);

    }
}
