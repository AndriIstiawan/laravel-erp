<?php

use Illuminate\Database\Seeder;

class CounterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('counter')->insert([
            [
                '_id' => 'so_counter',
                'seq' => 1
            ],
            [
                '_id' => 'client_counter',
                'seq' => 1
            ]
        ]);
    }
}
