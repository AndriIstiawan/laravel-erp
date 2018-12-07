<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
		$this->call(PermissionsTableSeeder::class);/*
        $this->call(MemberTableSeeder::class);
        $this->call(CarriersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(LevelTableSeeder::class);
        $this->call(SegmentAttributesTableSeeder::class);
        $this->call(SegmentsTableSeeder::class);
        $this->call(FootersTableSeeder::class);
        $this->call(PaymensMethodsTableSeeder::class);*/
        $this->call(CounterTableSeeder::class);
        $this->call(MasterSettingTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
        $this->call(SalesOrderSetting::class);
        $this->call(LocationTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PointsPerformanceTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
