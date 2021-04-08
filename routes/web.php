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

// Route::get('/', function () {
//     return view('admin/common/login');
//     //return view('dashboard');
// });

Route::get('/', 'AdminController@login');

Route::get('Register', function () {
    return view('admin/common/register');
    //return view('dashboard');
});
Route::post('post-login', 'AdminController@postlogin');


Route::middleware(['ShopAdmin'])->group(function() {
Route::get('View-User', 'AdminController@UserList');
Route::get('Login-Status', 'AdminController@Login_Status');
Route::get('Add-User', 'AdminController@UserAdd');
Route::get('View-Stock', 'AdminController@StockList');
Route::get('Add-Stock', 'AdminController@StockAdd');
Route::get('Return-Stock', 'AdminController@Returnstock');
Route::post('search-product-barcode', 'AdminController@Productbarcode');
Route::post('return-product-submit', 'AdminController@Productreturnsubmit');

Route::post('product-order','AdminController@addproductorder');
Route::get('cust-order-return', 'AdminController@Cust_Order_Return');
Route::post('cust-resturn-order-id','AdminController@Cust_Resturn_Order_id');
Route::post('cust-resturn-product','AdminController@Cust_Resturn_Product');
Route::post('br-return-cust-order','AdminController@Br_Return_Cust_Order');






//new code rahul
Route::get('cust-order', 'AdminController@customerorder');
Route::post('add-cust-order', 'AdminController@add_cust_order');
Route::post('product-detail', 'AdminController@product_detail');
Route::post('submit-cust-order', 'AdminController@submitcustorder');
 Route::get('pdf-view', 'AdminController@pdf_view');
 Route::get('generate-barcode/{barcode}', 'BarCode@quantity');
 Route::post('print-barcode', 'BarCode@barcode');
//Route::get('invoice', 'AdminController@pdf_view');
Route::get('Add-employee', 'AdminController@add_shopEmployee');
Route::get('view-Emplist', 'AdminController@show_shopEmployee');
Route::post('submit-employee', 'AdminController@submit_shopEmp');
//
Route::get('print-barcode', 'AdminController@print_Barcode');
Route::post('change-status','AdminController@change_emp_status');
// new new code 
Route::get('list-invoice', 'AdminController@show_shop_invoice');
Route::get('cust-orderDetail/{order_id}', 'AdminController@cust_order_list');

Route::get('download-invoice/{order_id}','AdminController@downloadInvoice');
Route::get('logout', 'AdminController@logout');
Route::get('home-bash', 'AdminController@home_dashboard');
// ============================
Route::get('profile', 'AdminController@user_profile');
Route::post('update-profile','AdminController@update_profile');
Route::get('change-password', 'AdminController@change_password');
Route::post('submit-Password','AdminController@submit_Password');
Route::get('barcode-order', 'AdminController@BarCode_Order');
Route::post('br-product-detail','AdminController@br_product_detail');
// ===============================
Route::get('avaliable-quantity', 'ReportsController@avaliable_quantity');
Route::get('product-exp-report', 'ReportsController@product_exp_report');
Route::post('check-expiry2', 'ReportsController@check_expiry2');
Route::post('form-to-expiry', 'ReportsController@Form_To_Expiry');

Route::get('daily-update', 'ReportsController@daily_update');
Route::get('daily-sell-update/{date}/{amount}', 'ReportsController@daily_sell_update');
Route::get('top-sell-product', 'ReportsController@top_sell_product');
Route::post('top-selling', 'ReportsController@top_selling');
Route::get('not-sell-product', 'ReportsController@Not_Sell_Product');
Route::post('Not-selling', 'ReportsController@Not_Selling_Product');
Route::get('return_stock_report', 'ReportsController@return_stock_report');
Route::post('search-return-qty', 'ReportsController@search_return_qty');


Route::post('check-expiry', 'AdminController@check_expiry');
// ===================================================================
Route::get('export', 'AdminController@export')->name('export');
Route::get('/export_excel/{date_record}', 'ReportsController@excel_sheet')->name('export_excel');
Route::get('/top_s_export_excel/{date_record}', 'ReportsController@export_top_selling')->name('top_s_export_excel');
Route::get('/Expiry_s_export_excel/{date_record}', 'ReportsController@Expiry_excel')->name('top_s_export_excel');
Route::get('/Avaliable_s_export_excel', 'ReportsController@avaliable_Qty')->name('Avaliable_s_export_excel');






});

// Route::get('export1/{$data}', 'AdminController@export');
// =================================================











//new code 

Route::post('shop-home','AdminController@ShopHome');
// ========================================================
// =========================================================
// Route::get('home-bash', function () {
//     $data['flag'] = 1;
//     return view('dashboard');
//     //return view('admin/webviews/home_dashboard',$data);    
// });



Route::group(['prefix' => 'email'], function(){
    Route::get('inbox', function () { return view('pages.email.inbox'); });
    Route::get('read', function () { return view('pages.email.read'); });
    Route::get('compose', function () { return view('pages.email.compose'); });
});

Route::group(['prefix' => 'apps'], function(){
    Route::get('chat', function () { return view('pages.apps.chat'); });
    Route::get('calendar', function () { return view('pages.apps.calendar'); });
});

Route::group(['prefix' => 'ui-components'], function(){
    Route::get('alerts', function () { return view('pages.ui-components.alerts'); });
    Route::get('badges', function () { return view('pages.ui-components.badges'); });
    Route::get('breadcrumbs', function () { return view('pages.ui-components.breadcrumbs'); });
    Route::get('buttons', function () { return view('pages.ui-components.buttons'); });
    Route::get('button-group', function () { return view('pages.ui-components.button-group'); });
    Route::get('cards', function () { return view('pages.ui-components.cards'); });
    Route::get('carousel', function () { return view('pages.ui-components.carousel'); });
    Route::get('collapse', function () { return view('pages.ui-components.collapse'); });
    Route::get('dropdowns', function () { return view('pages.ui-components.dropdowns'); });
    Route::get('list-group', function () { return view('pages.ui-components.list-group'); });
    Route::get('media-object', function () { return view('pages.ui-components.media-object'); });
    Route::get('modal', function () { return view('pages.ui-components.modal'); });
    Route::get('navs', function () { return view('pages.ui-components.navs'); });
    Route::get('navbar', function () { return view('pages.ui-components.navbar'); });
    Route::get('pagination', function () { return view('pages.ui-components.pagination'); });
    Route::get('popovers', function () { return view('pages.ui-components.popovers'); });
    Route::get('progress', function () { return view('pages.ui-components.progress'); });
    Route::get('scrollbar', function () { return view('pages.ui-components.scrollbar'); });
    Route::get('scrollspy', function () { return view('pages.ui-components.scrollspy'); });
    Route::get('spinners', function () { return view('pages.ui-components.spinners'); });
    Route::get('tabs', function () { return view('pages.ui-components.tabs'); });
    Route::get('tooltips', function () { return view('pages.ui-components.tooltips'); });
});

Route::group(['prefix' => 'advanced-ui'], function(){
    Route::get('cropper', function () { return view('pages.advanced-ui.cropper'); });
    Route::get('owl-carousel', function () { return view('pages.advanced-ui.owl-carousel'); });
    Route::get('sweet-alert', function () { return view('pages.advanced-ui.sweet-alert'); });
});

Route::group(['prefix' => 'forms'], function(){
    Route::get('basic-elements', function () { return view('pages.forms.basic-elements'); });
    Route::get('advanced-elements', function () { return view('pages.forms.advanced-elements'); });
    Route::get('editors', function () { return view('pages.forms.editors'); });
    Route::get('wizard', function () { return view('pages.forms.wizard'); });
});

Route::group(['prefix' => 'charts'], function(){
    Route::get('apex', function () { return view('pages.charts.apex'); });
    Route::get('chartjs', function () { return view('pages.charts.chartjs'); });
    Route::get('flot', function () { return view('pages.charts.flot'); });
    Route::get('morrisjs', function () { return view('pages.charts.morrisjs'); });
    Route::get('peity', function () { return view('pages.charts.peity'); });
    Route::get('sparkline', function () { return view('pages.charts.sparkline'); });
});

Route::group(['prefix' => 'tables'], function(){
    Route::get('basic-tables', function () { return view('pages.tables.basic-tables'); });
    Route::get('data-table', function () { return view('pages.tables.data-table'); });
});

Route::group(['prefix' => 'icons'], function(){
    Route::get('feather-icons', function () { return view('pages.icons.feather-icons'); });
    Route::get('flag-icons', function () { return view('pages.icons.flag-icons'); });
    Route::get('mdi-icons', function () { return view('pages.icons.mdi-icons'); });
});

Route::group(['prefix' => 'general'], function(){
    Route::get('blank-page', function () { return view('pages.general.blank-page'); });
    Route::get('faq', function () { return view('pages.general.faq'); });
    Route::get('invoice', function () { return view('pages.general.invoice'); });
    Route::get('profile', function () { return view('pages.general.profile'); });
    Route::get('pricing', function () { return view('pages.general.pricing'); });
    Route::get('timeline', function () { return view('pages.general.timeline'); });
});

Route::group(['prefix' => 'auth'], function(){
    Route::get('login', function () { return view('pages.auth.login'); });
    Route::get('register', function () { return view('pages.auth.register'); });
});

Route::group(['prefix' => 'error'], function(){
    Route::get('404', function () { return view('pages.error.404'); });
    Route::get('500', function () { return view('pages.error.500'); });
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('pages.error.404');
})->where('page','.*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
