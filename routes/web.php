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
	Route::view('/', 'panel.transaction-management.sales-order.index');
	
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
	Route::resource('discount', 'DiscountManagement\DiscountController');
	Route::post('discount/find', 'DiscountManagement\DiscountController@find');

	Route::resource('promo', 'DiscountManagement\PromoController');
	Route::post('promo/find', 'DiscountManagement\PromoController@find');
	/* END Master deal */

	/* Sales order */
	Route::resource('sales-order', 'TransactionManagement\SalesOrderController');
	Route::post('sales-order/find', 'TransactionManagement\SalesOrderController@find');

	Route::resource('sales-admin', 'TransactionManagement\SalesAdminController');
	Route::post('sales-admin/find', 'TransactionManagement\SalesAdminController@find');

	Route::resource('production', 'TransactionManagement\ProductionController');
	Route::post('production/find', 'TransactionManagement\ProductionController@find');
	Route::get('exportt', 'TransactionManagement\SalesOrderController@orderExport')->name('sales-order.export');
	/* END Sales order */

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

	Route::resource('taxes', 'ProductManagement\TaxesController');
	Route::post('taxes/find', 'ProductManagement\TaxesController@find');

	Route::resource('category', 'ProductManagement\CategoriesController');
	Route::post('category/find', 'ProductManagement\CategoriesController@find');

	Route::resource('attribute-sets', 'ProductManagement\AttributeSetsController');
	Route::post('attribute-sets/find', 'ProductManagement\AttributeSetsController@find');

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

	Route::resource('master-client', 'MemberManagement\MasterMemberController');
	Route::post('master-client/find', 'MemberManagement\MasterMemberController@find');

	Route::resource('level', 'MemberManagement\LevelController');
	Route::post('level/find', 'MemberManagement\LevelController@find');

	Route::resource('archievement', 'MemberManagement\ArchievementController');
	Route::post('archievement/find', 'MemberManagement\ArchievementController@find');

	Route::resource('orders', 'OrderManagement\OrdersController');
	Route::post('orders/find', 'OrderManagement\OrdersController@find');

	Route::resource('segment', 'FooterManagement\SegmentController');
	Route::post('segment/find', 'FooterManagement\SegmentController@find');

	Route::resource('segment-attributes', 'FooterManagement\SegmentAttributesController');
	Route::post('segment-attributes/find', 'FooterManagement\SegmentAttributesController@find');

	Route::resource('footer', 'FooterManagement\FooterController');
	Route::post('footer/find', 'FooterManagement\FooterController@find');	

    Route::resource('image-upload', 'ImageManagement\ImageUploadController');

	Route::resource('cart', 'OrderManagement\CartsController');
	Route::post('cart/find', 'OrderManagement\CartsController@find');

	Route::resource('point', 'ProductManagement\PointsController');
	Route::post('point/find', 'ProductManagement\PointsController@find');

	//notif-change-route
    Route::get('notif-erp', function () {
        return Auth::user()->countPOPending();
    });

	// Section CoreUI elements
	Route::view('/sample/dashboard','samples.dashboard');
	Route::view('/sample/buttons','samples.buttons');
	Route::view('/sample/social','samples.social');
	Route::view('/sample/cards','samples.cards');
	Route::view('/sample/forms','samples.forms');
	Route::view('/sample/modals','samples.modals');
	Route::view('/sample/switches','samples.switches');
	Route::view('/sample/tables','samples.tables');
	Route::view('/sample/tabs','samples.tabs');
	Route::view('/sample/icons-font-awesome', 'samples.font-awesome-icons');
	Route::view('/sample/icons-simple-line', 'samples.simple-line-icons');
	Route::view('/sample/widgets','samples.widgets');
	Route::view('/sample/charts','samples.charts');
});
// Section Pages
Route::view('/sample/error404','errors.404')->name('error404');
Route::view('/sample/error500','errors.500')->name('error500');