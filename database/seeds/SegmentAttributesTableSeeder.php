<?php

use Illuminate\Database\Seeder;

class SegmentAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('segment_attributes')->insert([
			[
	        	'name' => 'Tentang Kami',
	        	'slug' => 'tentang-kami',
	        	'type' => 'URL',
	        	'url' => 'https://Tentang_Kami.com',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
            [
	        	'name' => 'Karir',
	        	'slug' => 'karir',
	        	'type' => 'URL',
	        	'url' => 'https://Karir.com',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
	        	'name' => 'Blog',
	        	'slug' => 'blog',
	        	'type' => 'URL',
	        	'url' => 'https://Blog.com',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
	        	'name' => 'Belanja',
	        	'slug' => 'belanja',
	        	'type' => 'URL',
	        	'url' => 'https://Belanja.com',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
	        	'name' => 'Pembayaran',
	        	'slug' => 'pembayaran',
	        	'type' => 'URL',
	        	'url' => 'https://Pembayaran.com',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
	        	'name' => 'Jualan',
	        	'slug' => 'jualan',
	        	'type' => 'URL',
	        	'url' => 'https://Jualan.com',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
	        	'name' => 'Cara Jualan',
	        	'slug' => 'cara-jualan',
	        	'type' => 'URL',
	        	'url' => 'https://Cara_Jualan.com',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
	        	'name' => 'Seller Center',
	        	'slug' => 'seller-center',
	        	'type' => 'URL',
	        	'url' => 'https://Seller_Center.com',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
	        	'name' => 'Syarat dan Ketentuan',
	        	'slug' => 'syarat-dan-ketentuan',
	        	'type' => 'URL',
	        	'url' => 'https://Syarat_dan_Ketentuan.com',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
	        	'name' => 'Kebijakan dan Privasi',
	        	'slug' => 'kebijakan-dan-privasi',
	        	'type' => 'URL',
	        	'url' => 'https://Kebijakan_dan_Privasi.com',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
	        	'name' => '07619087900',
	        	'slug' => '07619087900',
	        	'type' => 'Icon',
	        	'url' => null,
	        	'urlicon' => null,
	        	'icon' => 'fa fa-tty',
	        	'textArea' => null,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
	        	'name' => 'Company name',
	        	'slug' => 'company-name',
	        	'type' => 'TextArea',
	        	'url' => 'https://Jualan.com',
	        	'textArea' => 'Here you can use rows and columns here to organize your footer content. Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
        	]
		]);
    }
}
