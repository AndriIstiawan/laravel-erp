<?php

use Illuminate\Database\Seeder;

class SegmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('segments')->insert([
        	[
	            'name' => 'Toko',
                'slug' => 'toko',
	            'attr' => [],
	            'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
            [
                'name' => 'Beli',
                'slug' => 'beli',
                'attr' => [],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Jual',
                'slug' => 'jual',
                'attr' => [],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Bantuan',
                'slug' => 'bantuan',
                'attr' => [],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Profil',
                'slug' => 'profil',
                'attr' => [],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Contacs',
                'slug' => 'contacs',
                'attr' => [],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]	
        ]);

        $parent = DB::table('segment_attributes')->whereIn('slug',['tentang-kami','karir','blog'])->get();
        DB::table('segments')->whereIn('slug', ['toko'])
			->update(['attr' => $parent->toArray()]);

        $parent = DB::table('segment_attributes')->whereIn('slug',['belanja','cara-belanja','pembayaran'])->get();
        DB::table('segments')->whereIn('slug', ['beli'])
            ->update(['attr' => $parent->toArray()]);

        $parent = DB::table('segment_attributes')->whereIn('slug',['jualan','cara-jualan','seller-center'])->get();
        DB::table('segments')->whereIn('slug', ['jual'])
            ->update(['attr' => $parent->toArray()]);

        $parent = DB::table('segment_attributes')->whereIn('slug',['syarat-dan-ketentuan','kebijakan-dan-privasi'])->get();
        DB::table('segments')->whereIn('slug', ['bantuan'])
            ->update(['attr' => $parent->toArray()]);

        $parent = DB::table('segment_attributes')->whereIn('slug',['company-name'])->get();
        DB::table('segments')->whereIn('slug', ['profil'])
            ->update(['attr' => $parent->toArray()]);

        $parent = DB::table('segment_attributes')->whereIn('slug',['07619087900'])->get();
        DB::table('segments')->whereIn('slug', ['contacs'])
            ->update(['attr' => $parent->toArray()]);
    }
}
