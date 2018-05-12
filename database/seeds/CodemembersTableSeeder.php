<?php

use Illuminate\Database\Seeder;

class CodemembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('codemembers')->insert([
            [
                '_id' => 'code_member',
                'seq' => 1
            ]
        ]);
    }
}
