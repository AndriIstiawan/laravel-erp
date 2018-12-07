<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
/* CoreUI templates */

Route::middleware('auth')->group(function() {
	Route::get('/', function(){
		if (Auth::user()->email == env('ROOT_USERNAME')) {
			return App::call('App\Http\Controllers\DashboardController@index');
		}else if (Auth::user()->role[0]['name'] == 'Sales') {
			return App::call('App\Http\Controllers\TransactionManagement\OrderCreateController@index');
		}else if (Auth::user()->role[0]['name'] == 'Production'){
			return App::call('App\Http\Controllers\TransactionManagement\ProductionController@index');
		}else{
			return App::call('App\Http\Controllers\TransactionManagement\ProductionController@index');
		}
 	});

	/*Route::get('/', 'TransactionManagement\OrderCreateController@index');
	Route::get('dashboard', 'DashboardController@index');	*/
	Route::get('profile/reset-password', 'ProfileController@resetPass');
	Route::post('profile/change-password', 'ProfileController@changePassword');

	Route::resource('master-setting', 'SettingManagement\MasterSettingController');

	/* Master User */
	Route::resource('permission', 'UserManagement\PermissionController');
	Route::post('permission/find', 'UserManagement\PermissionController@find');

	Route::resource('role', 'UserManagement\RoleController');
	Route::post('role/find', 'UserManagement\RoleController@find');

	Route::resource('master-user', 'UserManagement\MasterUserController');
	Route::post('master-user/find', 'UserManagement\MasterUserController@find');
	/* END Master User */

	/* Master deal */
	Route::resource('promo', 'DiscountManagement\DiscountController');
	Route::post('promo/find', 'DiscountManagement\DiscountController@find');

	Route::resource('tipe-promosi', 'DiscountManagement\TipePromoController');
	Route::post('tipe-promosi/find', 'DiscountManagement\TipePromoController@find');
	/* END Master deal */

	/* Master sales */
	Route::resource('sales-staff', 'SalesManagement\SalesController');
	Route::post('sales-staff/find', 'SalesManagement\SalesController@find');

	/* END Master sales */

	/* Master production */
	Route::resource('productions-staff', 'ProductionsManagement\ProductionsController');
	Route::post('productions-staff/find', 'ProductionsManagement\ProductionsController@find');
	
	Route::resource('points-performance', 'ProductionsManagement\PointsPerformanceController');
	Route::post('points-performance/find', 'ProductionsManagement\PointsPerformanceController@find');

	Route::resource('master-reject', 'ProductionsManagement\MasterRejectController');
	Route::post('master-reject/find', 'ProductionsManagement\MasterRejectController@find');
	/* END Master production */

	/* Master qc */
	Route::resource('qc-staff', 'QCManagement\QCController');
	Route::post('qc-staff/find', 'QCManagement\QCController@find');
	
	Route::resource('product-review', 'QCManagement\ProductPriviewController');
	Route::post('product-review/find', 'QCManagement\ProductPriviewController@find');
	/* END Master production */

    /* transaction */
    Route::resource('buat-so', 'TransactionManagement\OrderCreateController');

	Route::resource('sales-order', 'TransactionManagement\SalesOrderController');
	Route::post('sales-order/find', 'TransactionManagement\SalesOrderController@find');

	Route::resource('sales-admin', 'TransactionManagement\SalesAdminController');
	Route::post('sales-admin/find', 'TransactionManagement\SalesAdminController@find');

	Route::resource('production', 'TransactionManagement\ProductionController');
	Route::post('production/find', 'TransactionManagement\ProductionController@find');
	Route::get('production/proses/{id}', 'TransactionManagement\ProductionController@proses')->name('production.proses');
	Route::get('production/selesai/{id}', 'TransactionManagement\ProductionController@selesai')->name('production.selesai');

	Route::resource('qc','TransactionManagement\QcController');
	Route::get('qc/pass/{id}', 'TransactionManagement\QcController@pass')->name('qc.pass');
	Route::get('qc/reject/{id}', 'TransactionManagement\QcController@reject')->name('qc.reject');

	Route::resource('produksi','TransactionManagement\MobileProductionController');
	Route::get('produksi/proses/{id}', 'TransactionManagement\MobileProductionController@proses')->name('produksi.proses');
	Route::get('produksi/selesai/{id}', 'TransactionManagement\MobileProductionController@selesai')->name('produksi.selesai');
	Route::get('produksi/detail/{id}', 'TransactionManagement\MobileProductionController@detail')->name('produksi.detail');

	Route::resource('buat-qc','TransactionManagement\MobileQcController');
	Route::get('buat-qc/pass/{id}', 'TransactionManagement\MobileQcController@pass')->name('buat-qc.pass');
	Route::get('buat-qc/reject/{id}', 'TransactionManagement\MobileQcController@reject')->name('buat-qc.reject');
	Route::get('buat-qc/detail/{id}', 'TransactionManagement\MobileQcController@detail')->name('buat-qc.detail');

	/*Route::resource('mobile-packaging','TransactionManagement\MobilePackagingController');
	Route::get('mobile-packaging/proses/{id}', 'TransactionManagement\MobilePackagingController@proses')->name('mobile-packaging.proses');
	Route::get('mobile-packaging/selesai/{id}', 'TransactionManagement\MobilePackagingController@selesai')->name('mobile-packaging.selesai');
	Route::get('mobile-packaging/detail/{id}', 'TransactionManagement\MobilePackagingController@detail')->name('mobile-packaging.detail');

	Route::resource('mobile-qc-packaging','TransactionManagement\MobileQcPackagingController');
	Route::get('mobile-qc-packaging/pass/{id}', 'TransactionManagement\MobileQcPackagingController@pass')->name('mobile-qc-packaging.pass');
	Route::get('mobile-qc-packaging/reject/{id}', 'TransactionManagement\MobileQcPackagingController@reject')->name('mobile-qc-packaging.reject');
	Route::get('mobile-qc-packaging/detail/{id}', 'TransactionManagement\MobileQcPackagingController@detail')->name('mobile-qc-packaging.detail');
	Route::resource('monitor-packaging-qc','TransactionManagement\MonitoringQcPackagingController');
	Route::resource('monitor-packaging','TransactionManagement\MonitoringPackagingController');*/
	/* END Transaction  */

	/* Master home */
	Route::resource('slider', 'MasterhomeManagement\SliderController');
	Route::post('slider/find', 'MasterhomeManagement\SliderController@find');

	Route::resource('brands', 'MasterhomeManagement\BrandController');
	Route::post('brands/find', 'MasterhomeManagement\BrandController@find');
	/* END Master home */

	/* Custom PO */
	Route::resource('custompo', 'OrderManagement\CustomPoController');
	Route::post('custompo/find', 'OrderManagement\CustomPoController@find');
	/* END Custom PO */

	/* List Email Blast */
	Route::resource('mail', 'MailManagement\mailController');
	Route::post('mail/find', 'MailManagement\mailController@find');
	/* END List Email Blast */

	/* Product Management */
	Route::resource('attributes', 'ProductManagement\AttributesController');
    Route::post('attributes/find', 'ProductManagement\AttributesController@find');
    // export
    Route::get('export', 'ProductManagement\ProductController@productExport')->name('product.export');
    // import
    Route::post('import', 'ProductManagement\ProductController@productImport')->name('product.import');
    // end export import

	Route::resource('product', 'ProductManagement\ProductController');
    Route::post('product/find', 'ProductManagement\ProductController@find');
    
    Route::post('product/import', 'ProductManagement\ImportProductController@importData');
    Route::post('product/import-data', 'ProductManagement\ProductController@ImportData');

	Route::resource('type', 'ProductManagement\TypeController');
	Route::post('type/find', 'ProductManagement\TypeController@find');

	Route::resource('category', 'ProductManagement\CategoriesController');
	Route::post('category/find', 'ProductManagement\CategoriesController@find');

	Route::resource('commercial-status', 'ProductManagement\CommercialStatusesController');
	Route::post('commercial-status/find', 'ProductManagement\CommercialStatusesController@find');

	Route::resource('variant', 'ProductManagement\VariantController');
	Route::post('variant/find', 'ProductManagement\VariantController@find');
	/* END Product Management */

	Route::resource('orderstatuses', 'OrderManagement\OrderStatusController');
	Route::post('orderstatuses/find', 'OrderManagement\OrderStatusController@find');

	Route::resource('courier', 'DeliveriesManagement\CarriersController');
	Route::post('courier/find', 'DeliveriesManagement\CarriersController@find');

	Route::resource('deliveries', 'DeliveriesManagement\DeliveriesController');
	Route::post('deliveries/find', 'DeliveriesManagement\DeliveriesController@find');

	Route::resource('payment-method', 'PaymentManagement\PaymentMethodController');
	Route::post('payment-method/find', 'PaymentManagement\PaymentMethodController@find');

	Route::resource('payment', 'PaymentManagement\PaymentController');
	Route::post('payment/find', 'PaymentManagement\PaymentController@find');

	Route::resource('paymentpo', 'PaymentManagement\PaymentPOController');
	Route::post('paymentpo/find', 'PaymentManagement\PaymentPOController@find');

    /* Master CLient */
	Route::resource('master-client', 'MemberManagement\MasterMemberController');
    Route::post('master-client/find', 'MemberManagement\MasterMemberController@find');
    
    Route::post('master-client/import', 'MemberManagement\ImportClientController@importData');
    Route::post('master-client/import-data', 'MemberManagement\MasterMemberController@ImportData');
    Route::post('master-client/get-city-list/{province}','MemberManagement\MasterMemberController@getCityList');

    Route::resource('location', 'MemberManagement\LocationController');
    Route::post('location/find', 'MemberManagement\LocationController@find');
    /* END Master CLient */

	Route::resource('level', 'MemberManagement\LevelController');
	Route::post('level/find', 'MemberManagement\LevelController@find');

	Route::resource('archievement', 'MemberManagement\ArchievementController');
	Route::post('archievement/find', 'MemberManagement\ArchievementController@find');

	Route::resource('orders', 'OrderManagement\OrdersController');
	Route::post('orders/find', 'OrderManagement\OrdersController@find');
/*
	Route::resource('segment', 'FooterManagement\SegmentController');
	Route::post('segment/find', 'FooterManagement\SegmentController@find');*/

	Route::resource('segment-attributes', 'FooterManagement\SegmentAttributesController');
	Route::post('segment-attributes/find', 'FooterManagement\SegmentAttributesController@find');

	//warehouse
	Route::resource('warehouse-rack', 'WarehouseManagement\WarehouseRackController');
	Route::post('warehouse-rack/find', 'WarehouseManagement\WarehouseRackController@find');

	Route::resource('warehouse-branch', 'WarehouseManagement\WarehouseBranchController');
	Route::post('warehouse-branch/find', 'WarehouseManagement\WarehouseBranchController@find');
	//end

    Route::resource('image-upload', 'ImageManagement\ImageUploadController');

	Route::resource('cart', 'OrderManagement\CartsController');
	Route::post('cart/find', 'OrderManagement\CartsController@find');

	Route::resource('point', 'ProductManagement\PointsController');
	Route::post('point/find', 'ProductManagement\PointsController@find');

	//notif-change-route
    Route::get('notif-erp', function () {
        return Auth::user()->countPOPending();
    });

    Route::get('notif-produksi', function () {
        return Auth::user()->countProduksi();
    });

    Route::get('notif-qcpord', function () {
        return Auth::user()->countSelesaiProduksi();
    });

    Route::get('notif-packaging', function () {
        return Auth::user()->countSelesaiQc();
    });

    Route::get('notif-qcpack', function () {
        return Auth::user()->countSelesaiPackaging();
    });

	//download file from storage
    Route::get('download-storage/{status}/{filename}', function () {
        $status = (Route::current()->status == 'true'?true:false);
        $filename = Route::current()->filename;
        if(file_exists(storage_path('exports/'.$filename))){
            return response()->download(storage_path('exports/'.$filename))->deleteFileAfterSend($status);
        }else{
            return redirect('/');
        }
    });

    //download file from storage
    Route::get('download-storage/{filename}', function () {
        $filename = Route::current()->filename;
        if(file_exists(storage_path('exports/'.$filename))){
            return response()->download(storage_path('exports/'.$filename))->deleteFileAfterSend(true);
        }else{
            return redirect('/');
        }
    });
});
// Section Pages
Route::view('/sample/error404','errors.404')->name('error404');
Route::view('/sample/error500','errors.500')->name('error500');

//RouteGroupMasterPackaging
Route::group(['namespace' => 'MasterPackagings'], function(){
	Route::resource('packaging', 'PackagingController');
	Route::post('packaging/find', 'PackagingController@find');
});
