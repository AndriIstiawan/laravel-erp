<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        DB::table('permissions')->insert([
			[
	        	'name' => 'Transaction',
	        	'slug' => null,
	        	'type' => 'module-menu',
				'icon' => 'fa fa-newspaper-o',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
            ],
            [
	        	'name' => 'Buat SO',
	        	'slug' => 'buat-so',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Sales Order',
	        	'slug' => 'sales-order',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Production',
	        	'slug' => 'production',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'User Management',
	        	'slug' => null,
	        	'type' => 'module-menu',
				'icon' => 'icon-people',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			// [
	        // 	'name' => 'Permission',
	        // 	'slug' => 'permission',
	        // 	'type' => 'module-menu',
			// 	'icon' => 'icon-cursor',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],
			[
	        	'name' => 'Role',
	        	'slug' => 'role',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Master User',
	        	'slug' => 'master-user',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Product Management',
	        	'slug' => null,
	        	'type' => 'module-menu',
				'icon' => 'fa fa-bars',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Product',
	        	'slug' => 'product',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Type',
	        	'slug' => 'type',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Master Client',
	        	'slug' => null,
	        	'type' => 'module-menu',
				'icon' => 'fa fa-users',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Client',
	        	'slug' => 'master-client',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
            ],
            [
	        	'name' => 'Master-Deal',
	        	'slug' => null,
	        	'type' => 'module-menu',
				'icon' => 'fa fa-credit-card-alt',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Discount',
	        	'slug' => 'discount',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Courier',
	        	'slug' => 'courier',
	        	'type' => 'module-menu',
				'icon' => 'fa fa-truck',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
      [
        'name' => 'Master Packaging',
        'slug' => null,
        'type' => 'module-menu',
        'icon' => 'fa fa-dropbox',
        'parent' => null,
        'description' => 'Module Menu',
        'guard_name' => 'web',
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ],
      [
        'name' => 'Packaging',
        'slug' => 'packaging',
        'type' => 'module-menu',
        'icon' => 'icon-cursor',
        'parent' => null,
        'description' => 'Module Menu',
        'guard_name' => 'web',
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ],
            // [
	        // 	'name' => 'Location',
	        // 	'slug' => 'location',
	        // 	'type' => 'module-menu',
			// 	'icon' => 'icon-cursor',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],
			// [
	        // 	'name' => 'Level',
	        // 	'slug' => 'level',
	        // 	'type' => 'module-menu',
			// 	'icon' => 'icon-cursor',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],
			// [
	        // 	'name' => 'Category',
	        // 	'slug' => 'category',
	        // 	'type' => 'module-menu',
			// 	'icon' => 'icon-cursor',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],

			// [
	        // 	'name' => 'Promo',
	        // 	'slug' => 'promo',
	        // 	'type' => 'module-menu',
			// 	'icon' => 'icon-cursor',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],
			// [
	        // 	'name' => 'Master-Home',
	        // 	'slug' => null,
	        // 	'type' => 'module-menu',
			// 	'icon' => 'fa fa-home',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],
			// [
	        // 	'name' => 'Promo Slider',
	        // 	'slug' => 'slider',
	        // 	'type' => 'module-menu',
			// 	'icon' => 'icon-cursor',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],
			// [
	        // 	'name' => 'Brands/Partners',
	        // 	'slug' => 'brands',
	        // 	'type' => 'module-menu',
			// 	'icon' => 'icon-cursor',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],
			// [
	        // 	'name' => 'Attributes',
	        // 	'slug' => 'attributes',
	        // 	'type' => 'module-menu',
			// 	'icon' => 'fa fa-tag',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],
			// [
	        // 	'name' => 'Attribute Sets',
	        // 	'slug' => 'attribute-sets',
	        // 	'type' => 'module-menu',
			// 	'icon' => 'fa fa-tags',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],
			/**/
			// [
	        // 	'name' => 'Taxes',
	        // 	'slug' => 'taxes',
	        // 	'type' => 'module-menu',
			// 	'icon' => 'fa fa-balance-scale',
			// 	'parent' => null,
			// 	'description' => 'Module Menu',
			// 	'guard_name' => 'web',
			// 	'created_at' => date("Y-m-d H:i:s"),
			// 	'updated_at' => date("Y-m-d H:i:s")
			// ],
			/*[
	        	'name' => 'Orders Management',
	        	'slug' => null,
	        	'type' => 'module-menu',
				'icon' => 'fa fa fa-bars',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Transaction',
	        	'slug' => 'orders',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Order Status',
	        	'slug' => 'orderstatuses',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Deliveries',
	        	'slug' => null,
	        	'type' => 'module-menu',
				'icon' => 'fa fa-bars',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'View Deliveries',
	        	'slug' => 'deliveries',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Payment Method',
	        	'slug' => 'payment-method',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			]*/
			/*[
	        	'name' => 'Master Setting',
	        	'slug' => 'master-setting',
	        	'type' => 'access',
				'icon' => 'fa fa-cog',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Custom PO',
	        	'slug' => 'custompo',
	        	'type' => 'module-menu',
				'icon' => 'fa fa-cart-plus',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Mail Blast',
	        	'slug' => 'mail',
	        	'type' => 'module-menu',
				'icon' => 'fa fa-send-o',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Payment',
	        	'slug' => null,
	        	'type' => 'module-menu',
				'icon' => 'fa fa-bars',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'View Payment',
	        	'slug' => 'payment',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Payment PO',
	        	'slug' => 'paymentpo',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Image Upload',
	        	'slug' => 'image-upload',
	        	'type' => 'module-menu',
				'icon' => 'fa fa-image',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Footer Management',
	        	'slug' => null,
	        	'type' => 'module-menu',
				'icon' => 'fa fa-bars',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Footer',
	        	'slug' => 'footer',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Segment',
	        	'slug' => 'segment',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Segment Attributes',
	        	'slug' => 'segment-attributes',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			],
			[
	        	'name' => 'Cart',
	        	'slug' => 'cart',
	        	'type' => 'module-menu',
				'icon' => 'icon-cursor',
				'parent' => null,
				'description' => 'Module Menu',
				'guard_name' => 'web',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			]*/
		]);

$parent = DB::table('permissions')->where('name','User Management')->first();
DB::table('permissions')->whereIn('slug', ['role', 'master-user'])
->update(['parent' => (string)$parent['_id']]);

$parent = DB::table('permissions')->where('name','Transaction')->first();
DB::table('permissions')->whereIn('slug', ['sales-order','production','buat-so'])
->update(['parent' => (string)$parent['_id']]);

$parent = DB::table('permissions')->where('name','Master-Deal')->first();
DB::table('permissions')->whereIn('slug', ['discount','promo'])
->update(['parent' => (string)$parent['_id']]);

$parent = DB::table('permissions')->where('name','Master-Home')->first();
DB::table('permissions')->whereIn('slug', ['slider','brands'])
->update(['parent' => (string)$parent['_id']]);

$parent = DB::table('permissions')->where('name','Product Management')->first();
DB::table('permissions')->whereIn('slug', ['product','type'])
->update(['parent' => (string)$parent['_id']]);

$parent = DB::table('permissions')->where('name','Payment')->first();
DB::table('permissions')->whereIn('slug', ['payment','payment-method','paymentpo'])
->update(['parent' => (string)$parent['_id']]);

// $parent = DB::table('permissions')->where('name','Deliveries')->first();
// DB::table('permissions')->whereIn('slug', ['deliveries','courier'])
// ->update(['parent' => (string)$parent['_id']]);

$parent = DB::table('permissions')->where('name','Master Client')->first();
DB::table('permissions')->whereIn('slug', ['master-client', 'location'/*,'level'*//*,'archievement'*/])
->update(['parent' => (string)$parent['_id']]);

$parent = DB::table('permissions')->where('name','Footer Management')->first();
DB::table('permissions')->whereIn('slug', ['footer','segment','segment-attributes'])
->update(['parent' => (string)$parent['_id']]);

$parent = DB::table('permissions')->where('name','Master Packaging')->first();
DB::table('permissions')->whereIn('slug', ['packaging'])
->update(['parent' => (string)$parent['_id']]);
}
}
