<?php

use Illuminate\Database\Seeder;

class PointsPerformanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points_performances')->truncate();
        DB::table('points_performances')->insert([
            [
            'name' => 'afif',
            'email' => 'afif@macbrame.com',
            'points' => 0,
            'role' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'anang',
            'email' => 'anang@macbrame.com',
            'points' => 0,
            'role' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'rohim',
            'email' => 'rohim@macbrame.com',
            'points' => 0,
            'role' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'rudi',
            'email' => 'rudi@macbrame.com',
            'points' => 0,
            'role' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'sarah',
            'email' => 'sarah@macbrame.com',
            'points' => 0,
            'role' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ],
            [
            'name' => 'heru',
            'email' => 'heru@macbrame.com',
            'points' => 0,
            'role' => [],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);

        $parent = DB::table('roles')->whereIn('name',['Production'])->get();
        DB::table('points_performances')->whereIn('email', ['afif@macbrame.com','anang@macbrame.com','rohim@macbrame.com','rudi@macbrame.com','sarah@macbrame.com','heru@macbrame.com'])
            ->update(['role' => $parent->toArray()]);

    }
}
