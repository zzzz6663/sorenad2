<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/clear', 'HomeController@clear')->name('clear');
Route::get('/', 'HomeController@index')->name('home');
Route::any('/check_code', 'HomeController@check_code')->name('check.code');
Route::any('/mobile_login', 'HomeController@mobile_login')->name('mobile.login');
Route::any('/register', 'HomeController@register')->name('register');
Route::get('/login', 'HomeController@login')->name('login');
Route::get('/logout', 'HomeController@logout')->name('logout');
// Route::get('/clear', 'HomeController@clear')->name('clear');
Route::get('/redirect', 'HomeController@redirect')->name('redirect');

Route::post('/check_login', 'HomeController@check_login')->name('check.login');

Route::middleware(['auth'])->group(function () {

    Route::get('/download', 'HomeController@download')->name('download');
    Route::get('/change_panel', 'HomeController@change_panel')->name('change.panel');

});
Route::prefix('admin')->middleware(['auth'])->namespace('admin')->group(function () {
    Route::get('/login', 'AdminController@login')->name('admin.login');
    Route::get('/admin_dashoard', 'AdminController@admin_dashoard')->name('admin.dashoard');
    Route::any('/setting_ads_app', 'SettingController@setting_ads_app')->name('setting.ads.app');
    Route::any('/setting_ads_banner', 'SettingController@setting_ads_banner')->name('setting.ads.banner');
    Route::any('/setting_ads_fixpost', 'SettingController@setting_ads_fixpost')->name('setting.ads.fixpost');
    Route::any('/setting_ads_popup', 'SettingController@setting_ads_popup')->name('setting.ads.popup');
    Route::any('/setting_ads_video', 'SettingController@setting_ads_video')->name('setting.ads.video');
    Route::any('/setting_ads_text', 'SettingController@setting_ads_text')->name('setting.ads.text');
    Route::any('/site_setting', 'SettingController@site_setting')->name('site.setting');


    Route::any('/user_bank_info/{user}', 'UserController@user_bank_info')->name('user.bank.info');
    Route::any('/site_confirm/{site}', 'SiteController@site_confirm')->name('site.confirm');
    Route::post('/advertise_confirm/{advertise}', 'AdvertiseController@advertise_confirm')->name('advertise.confirm');

    Route::resource('user', 'UserController')->middleware(['role:admin']);;;
    Route::resource('faq', 'FaqController')->middleware(['role:admin']);;;
    Route::resource('cat', 'CatController')->middleware(['role:admin']);;;
    Route::resource('site', 'SiteController')->middleware(['role:admin']);;;
    Route::resource('ticket', 'TicketController')->middleware(['role:admin']);;;;;;
    Route::resource('transaction', 'TransactionController')->middleware(['role:admin']);;;;;;
    Route::resource('advertise', 'AdvertiseController')->middleware(['role:admin']);;;;;;
    Route::resource('withdrawal', 'WithdrawalController')->middleware(['role:admin']);;;;;;
});


Route::prefix('customer')->middleware(['auth',"role:customer"])->namespace('customer')->group(function () {
    Route::any('/money_charge', 'CustomerController@money_charge')->name('customer.money.charge');
    Route::any('/transaction_factor', 'CustomerController@transaction_factor')->name('customer.transaction.factor');
});
Route::prefix('advertiser')->middleware(['auth'])->namespace('advertiser')->group(function () {
    Route::any('/contact', 'AdvertiserController@contact')->name('advertiser.contact');
    Route::any('/profile', 'AdvertiserController@profile')->name('advertiser.profile');
    Route::any('/change_password', 'AdvertiserController@change_password')->name('advertiser.change.password');
    Route::any('/bank_info', 'AdvertiserController@bank_info')->name('advertiser.bank.info');
    Route::get('/faqs', 'AdvertiserController@faqs')->name('advertiser.faqs');
    Route::any('/sites', 'AdvertiserController@sites')->name('advertiser.sites');
    Route::any('/update_site/{site}', 'AdvertiserController@update_site')->name('advertiser.update.site');
    Route::any('/withdrawal_request', 'AdvertiserController@withdrawal_request')->name('advertiser.withdrawal.request');
    Route::any('/advertiser_new_ad_popup/{advertise?}', 'AdvertiserController@advertiser_new_ad_popup')->name('advertiser.new.ad.popup');
    Route::any('/advertiser_new_ad_app/{advertise?}', 'AdvertiserController@advertiser_new_ad_app')->name('advertiser.new.ad.app');
    Route::any('/advertiser_new_ad_banner/{advertise?}', 'AdvertiserController@advertiser_new_ad_banner')->name('advertiser.new.ad.banner');
    Route::any('/advertiser_new_ad_fixpost/{advertise?}', 'AdvertiserController@advertiser_new_ad_fixpost')->name('advertiser.new.ad.fixpost');
    Route::any('/advertiser_new_ad_text/{advertise?}', 'AdvertiserController@advertiser_new_ad_text')->name('advertiser.new.ad.text');
    Route::any('/advertiser_new_ad_video/{advertise?}', 'AdvertiserController@advertiser_new_ad_video')->name('advertiser.new.ad.video');
    Route::get('/advertiser_list', 'AdvertiserController@advertiser_list')->name('advertiser.list');
    Route::get('/logs', 'AdvertiserController@logs')->name('logs');
    // Route::get('/withdrawal_list', 'AdvertiserController@withdrawal_list')->name('advertiser.withdrawal.list');
    // Route::any('/sites', 'AdvertiserController@sites')->name('advertiser.sites');


    Route::any('/new_answer/{ticket}', 'UserTicketController@new_answer')->name('advertiser.new.answer');
    Route::post('/close_ticket/{ticket}', 'UserTicketController@close_ticket')->name('advertiser.close.ticket')->middleware(['role:admin']);
    Route::resource('userticket', 'UserTicketController');;;

});





// پرداخت ها
Route::get('/result_pay/{transaction}', 'PayController@result_pay')->name('result.pay');
Route::get('/bill_verify', 'PayController@bill_verify')->name('pay.verify');
Route::any('/send_pay', 'PayController@send_pay')->name('send.pay');

// Route::prefix('admin')->middleware(['auth'])->namespace('admin')->group(function () {
//     Route::get('/active_region/{region}', 'RegionController@active_region')->name('active.region')->withTrashed();;
//     Route::any('/visit_note/{visit}', 'VisitController@visit_note')->name('visit.note')->withTrashed();;
//     Route::any('/look_note/{look}', 'LookController@look_note')->name('look.note')->withTrashed();;
//     Route::resource('user', 'UserController')->middleware(['role:admin']);;;
//     // Route::resource('account', 'AccountController');
//     Route::resource('user', 'UserController')->middleware(['role:admin']);;;
//     Route::resource('visit', 'VisitController')->middleware(['role:admin|inspector|observer']);;;
//     Route::resource('look', 'LookController')->middleware(['role:admin|inspector|observer']);;;
// });

// Route::middleware(['auth',"role:student"])->group(function () {
//     Route::get('/profile', 'StudentController@profile')->name('profile');
//     Route::get('/myCourse', 'StudentController@myCourse')->name('myCourse');
//     Route::get('/setting', 'StudentController@setting')->name('setting');
// });
