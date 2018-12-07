<?php

use Illuminate\Database\Seeder;

class FootersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('footers')->insert([
        	[
	            'name' => 'Footer1',
                'slug' => 'footer1',
	            'segment' => [],
	            'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			]
        ]);

        $parent = DB::table('segments')->whereIn('slug',['profil','toko','beli','jual','bantuan','contacs'])->get();
        DB::table('footers')->whereIn('slug', ['footer1'])
			->update(['segment' => $parent->toArray()]);
    }
}
