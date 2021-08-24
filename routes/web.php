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

Route::get('/', function () {
    return redirect(route('login'));
});



Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::resource('product', 'App\Http\Controllers\ProductController');

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::get('upgrade', function () {
        return view('pages.upgrade');
    })->name('upgrade');
    Route::get('map', function () {
        return view('pages.maps');
    })->name('map');
    Route::get('icons', function () {
        return view('pages.icons');
    })->name('icons');
    Route::get('table-list', function () {
        return view('pages.tables');
    })->name('table');
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    //Functions for CSV Excel

    Route::get('importExportView', [App\Http\Controllers\UserController::class, 'importExportView']);
    Route::get('export', [App\Http\Controllers\UserController::class, 'export'])->name('export');
    Route::post('import', [App\Http\Controllers\UserController::class, 'import'])->name('import');
    // Account Route
    Route::resource('account', 'App\Http\Controllers\AccountController');
    Route::resource('finance', App\Http\Controllers\FinancialYearController::class);
    Route::post('credit-account/{id}', 'App\Http\Controllers\AccountController@credit')->name('credit');
    Route::get('sys-credit-all-accounts', 'App\Http\Controllers\AccountController@creditAll')->name('creditAll');
    Route::get('suspend-account/{id}', 'App\Http\Controllers\AccountController@suspend')->name('suspend');
    Route::get('un-suspend-account/{id}', 'App\Http\Controllers\AccountController@unsuspend')->name('unsuspend');
    Route::post('debit-account', 'App\Http\Controllers\AccountController@debit')->name('debit');
    Route::get('account-deleted-/{id}', 'App\Http\Controllers\AccountController@destroy')->name('del');
    Route::post('account-withdrawal-', 'App\Http\Controllers\AccountController@withdraw')->name('withdraw');
    Route::post('application-loan', 'App\Http\Controllers\AccountController@loan')->name('loan');
    Route::get('accounts-withdrawals-', 'App\Http\Controllers\AccountController@with_Draw')->name('with_');
    Route::get('application-on-loans', 'App\Http\Controllers\AccountController@loans')->name('loans');
    Route::post('accounts-withdrawals-Status', 'App\Http\Controllers\AccountController@withdrawStatus')->name('withdrawStatus');
    Route::post('application-on-loans-status', 'App\Http\Controllers\AccountController@loanStatus')->name('loanStatus');
    // Expense and Income , Balance Sheet
    Route::post('add-new-income', 'App\Http\Controllers\AdminController@saveIncome')->name('income');
    Route::post('add-new-expense', 'App\Http\Controllers\AdminController@saveExpense')->name('expense');
    Route::post('update-new-income/{id}', 'App\Http\Controllers\AdminController@updateIncome')->name('IncomeUpdate');
    Route::post('update-new-expense/{id}', 'App\Http\Controllers\AdminController@updateExpense')->name('ExpenseUpdate');
    Route::post('add-new-dividend', 'App\Http\Controllers\AdminController@saveDividend')->name('dividend');
    Route::get('financial-statements', 'App\Http\Controllers\AdminController@index')->name('FS');
    Route::get('financial-statements-dividend', 'App\Http\Controllers\AdminController@div')->name('DC');

    // loan
    Route::post('update-loan/{id}', 'App\Http\Controllers\AdminController@updateLoan')->name('loanUpdate');
    Route::post('add-new-loan-shedule', 'App\Http\Controllers\AdminController@saveLoan')->name('loan');
    Route::get('fetch-all-loans', 'App\Http\Controllers\AdminController@loan')->name('LM');
    Route::get('find_loan/{id}', 'App\Http\Controllers\AdminController@loanShow')->name('LS');
    Route::get('get_loaners/{id}', 'App\Http\Controllers\AdminController@showloan')->name('SL');
    Route::get('my_loans', 'App\Http\Controllers\AdminController@myLoan')->name('ML');
    Route::get('my_contributions-so-far!', 'App\Http\Controllers\AdminController@mycontribution')->name('MC');
    // Deduction Schedule
    Route::get('download-scheuled/{month}/{year}', 'App\Http\Controllers\AdminController@downloadDeduction')->name('DD');
    Route::post('view-monthly-dection', 'App\Http\Controllers\AdminController@generateDeduction')->name('GD');
    Route::get('fetch-all-deductions', 'App\Http\Controllers\AdminController@deductionShedule')->name('DS');

    // contibution manager
    Route::get('all-contibutions-from-members', 'App\Http\Controllers\AdminController@contributionManager')->name('CM');
    Route::get(
        'get-acc-contributions/{id}',
        'App\Http\Controllers\AccountController@mycontributions'
    )->name('MCT');
    // filter Items
    Route::post('filter-items', 'App\Http\Controllers\ProductController@filterItems')->name('filtItems');
    Route::get('our-market-place', 'App\Http\Controllers\ProductController@marketplace')->name('MP');
    // Shopping Cart
    Route::post('addToCart', 'App\Http\Controllers\ProductController@addToCart')->name('addToCart');
    Route::get('getCart', 'App\Http\Controllers\ProductController@getCart')->name('getCart');
    Route::get('addItemByOne/{id}', 'App\Http\Controllers\ProductController@addItemByOne')->name('addItemByOne');
    Route::get('reduceByOne/{id}', 'App\Http\Controllers\ProductController@reduceItemByOne')->name('reduceByOne');
    Route::get('removeItem/{id}', 'App\Http\Controllers\ProductController@removeItem')->name('removeItem');
    Route::get('emptyCart', 'App\Http\Controllers\ProductController@emptyCart')->name('emptyCart');
    Route::get('checkout', 'App\Http\Controllers\ProductController@checkout')->name('checkout');

    Route::get('checkouts', 'App\Http\Controllers\ProductController@checkouts')->name('checkouts');

    Route::post('pay_for-item', 'App\Http\Controllers\ProductController@redirectToGateway')->name('payH');
    Route::get('payment-success', 'App\Http\Controllers\ProductController@successPage')->name('payment-success');
    Route::get('/payment/callback', 'App\Http\Controllers\ProductController@handleGatewayCallback');
    Route::get('verify-property-pay', 'App\Http\Controllers\ProductController@verifyPayment')->name('verify-property-pay');
    //user profile
    Route::get('find_grantor/{code}','App\Http\Controllers\UserController@grantor')->name('grantor');
    Route::post('changeMemberStatus/{id}', 'App\Http\Controllers\AdminController@changeMemberStatus')->name('changeMemberStatus');
});