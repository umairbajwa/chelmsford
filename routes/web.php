<?php

use App\Coverage;
use App\Drivers\GoCardlessDriver;
use App\Drivers\MailChimpDriver;
use GoCardlessPro\Client;
use GoCardlessPro\Environment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

// URL::forceScheme('https');
// Route::get('payment', function (Request $request) {
//     try {
//         DB::beginTransaction();
//         $coverage = Coverage::first();
//         $goCardless = new GoCardlessDriver($coverage);
//         $url = $goCardless->completeRedirectFlow();
//         DB::commit();
//     } catch (QueryException $e) {
//         DB::rollBack();
//         dd($e);
//     } catch (Exception $e) {
//         DB::rollBack();
//         dd($e);
//     }
// });

Route::get('test', function () {
    // $access_token = env('GC_ACCESS_TOKEN');
    // $environment = env('GC_ENV', Environment::SANDBOX);
    // $client = new Client(array(
    //     'access_token' => $access_token,
    //     'environment'  => $environment
    // ));
    // $subscription = $client->subscriptions()->get('SB000PGZTF30YN');
    // dd($subscription);
    $mailChimp = new MailChimpDriver();
    $mailChimp->getMember('testuse1r@getnada.com');
    //     try {
    //         DB::beginTransaction();
    //         $coverage = Coverage::first();
    //         $goCardless = new GoCardlessDriver($coverage);
    //         // $url = $goCardless->createRedirectFlow();
    //         $goCardless->createPayment();
    //         DB::commit();
    //         // return redirect()->away($url);
    //     } catch (QueryException $e) {
    //         DB::rollBack();
    //         dd($e);
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         dd($e);
    //     }
    //     // $data = [];
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['account']['id'] = 851432007016085741000205631269;
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['account']['type'] = 1;
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['partnerId'] = 'Bus21';
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['amount']['currencyCode'] = 'USD';
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['amount']['value'] = 4000;
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['timestamp'] = time();
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['transactionSource']['sourceId'] = 12344332;
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['transactionSource']['institutionId'] = 'example12344332';
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['transactionSource']['sourceDetails']['institutionName'] = 'Walgreens';
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['transactionSource']['sourceDetails']['Address'] = '1234 Sample Ave N, Unit #10, Seattle, WA, US, 98101';
    //     // $data['ValidateAccountForAmazonBalanceLoadRequest']['transactionSource']['sourceDetails']['Phone'] = '+12061232333';
    //     // dd(json_decode(json_encode($data)));
});
Route::any('go-cardless-hook', 'CoverageController@webhook');
//dd('coverage.' . url('/'),url('/'));
Route::domain(env('COVERAGE_URL'))->group(function () {

    Route::get('/', 'CoverageController@index')->name('coverageIndex');
    Route::post('post-code-check', 'CoverageController@postCodeCheck')->name('postCodeCheck');
    Route::post('plan-select', 'CoverageController@selectPlan')->name('selectPlan');
    Route::post('check-email', 'CoverageController@checkEmail')->name('checkEmail');
    Route::post('information', 'CoverageController@information')->name('information');
    Route::get('proceed-payment/{id}', 'CoverageController@payment')->name('proceedPayment');
    Route::get('complete-payment', 'CoverageController@completePayment')->name('completePayment');
    Route::get('payment-error', 'CoverageController@paymentError')->name('paymentError');
    Route::get('thank-you', 'CoverageController@thankYou')->name('thankYou');
});
Route::get('/', 'QuotesController@getQuote');
Route::post('save-form-session', 'QuotesController@saveFormSession');

Auth::routes();
Route::get('roles', 'RoleController@index')->name('roles');
Route::get('roles/create', 'RoleController@create')->name('roles.create');
Route::post('roles/create', 'RoleController@store')->name('roles.store');
Route::get('roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
Route::post('roles/update', 'RoleController@update')->name('roles.update');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/coverages', 'CoverageController@listing')->name('listing');
Route::get('/coverages/archive/{id}', 'CoverageController@archive');
Route::get('/coverages/new', 'CoverageController@new')->name('coverages.new');
Route::post('/coverages/create', 'CoverageController@create')->name('coverages.create');
Route::post('/coverages/update', 'CoverageController@update')->name('coverageUpdate');
Route::get('/coverages/{id}', 'CoverageController@details');
Route::get('/estimates', 'QuotesController@index');
Route::resource('/questions', 'QuestionsController');
Route::resource('/products', 'ProductsController');
Route::resource('/postcodes', 'PostCodesController');
Route::get('/settings', 'SettingsController@index');
Route::post('/settings/changepassword', 'SettingsController@changePassword');
Route::post('/settings/updateInformation', 'SettingsController@update');
Route::get('/users', 'UserController@index');
Route::get('/users/create', 'UserController@create');
Route::post('/users/store', 'UserController@store');
Route::post('/users/update', 'UserController@update');
Route::get('/users/{id}', 'UserController@edit');
Route::get('/users/change-status/{id}', 'UserController@changeStatus');
Route::get('/getnewoptions/{x}', 'QuestionsController@newOption');
Route::get('/estimate', 'QuotesController@getQuote');
Route::get('/estimate/{stage}', 'QuotesController@getQuote');
Route::get('/estimate/output/{id}', 'QuotesController@display');
Route::post('/submitInformation', 'QuotesController@submitQuote');
Route::get('/estimate/output/admin/{id}', 'QuotesController@displayAdmin');
Route::post('/estimate/output/updateStatus', 'QuotesController@UpdateStatus');
Route::post('/product/global/price', 'ProductsController@globalPrice');
Route::post('/product/global/pdf', 'ProductsController@globalPDF');
Route::get('/product/global/pdf/delete', 'ProductsController@globalPDFDelete');
Route::post('/product/kw/update', 'ProductsController@wkUpdate');

Route::post('/submitbooking', 'QuotesController@SubmitBook');
Route::get('/thank-you', function () {
    return view('finish');
});
