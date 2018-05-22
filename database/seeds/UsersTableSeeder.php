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
            'email' => 'dede@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'ALAMSYAH',
            'email' => 'alamsyah@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'WONDO',
            'email' => 'wondo@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'JULIAWAN',
            'email' => 'juliawan@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'MGT',
            'email' => 'mgt@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'INDRA',
            'email' => 'indra@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'DRAJAT',
            'email' => 'drajat@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Afif',
            'email' => 'Afif@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Anang',
            'email' => 'Anang@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Rohim',
            'email' => 'Rohim@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Rudi',
            'email' => 'Rudi@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Sarah',
            'email' => 'Sarah@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'Heru',
            'email' => 'Heru@macbrame.com',
            'password' => bcrypt('asdasd'),
            'role' => [],
            'accessPermissions' => [],
            'modulePermissions' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);

        $parent = DB::table('roles')->whereIn('name',['Sales'])->get();
        DB::table('users')->whereIn('email', ['dede@macbrame.com','alamsyah@macbrame.com','wondo@macbrame.com','juliawan@macbrame.com','mgt@macbrame.com','indra@macbrame.com','drajat@macbrame.com'])
            ->update(['role' => $parent->toArray()]);

        $parent = DB::table('roles')->whereIn('name',['Production'])->get();
        DB::table('users')->whereIn('email', ['Afif@macbrame.com','Anang@macbrame.com','Rohim@macbrame.com','Rudi@macbrame.com','Sarah@macbrame.com','Heru@macbrame.com'])
            ->update(['role' => $parent->toArray()]);

        //add sales permission
        $parent = DB::table('permissions')->whereIn('name',['Transaction'])->get();
        $parent = $parent->toArray();
        $child = DB::table('permissions')->whereIn('slug',['order-create'])->get();
        $parent[0]['_id'] = (string)$parent[0]['_id'];
        $child = $child->toArray();
        $child[0]['_id'] = (string)$child[0]['_id'];
        $parent[0]['child'] = $child;
        DB::table('users')->whereIn('email', ['dede@macbrame.com','alamsyah@macbrame.com','wondo@macbrame.com','juliawan@macbrame.com','mgt@macbrame.com','indra@macbrame.com','drajat@macbrame.com'])
            ->update(['modulePermissions' => $parent]);

    }
}
