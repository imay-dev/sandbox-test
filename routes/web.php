<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::group([
    'middleware' => 'auth',
    'prefix' => 'credit'
], function () {
    Route::get('/', 'Services\CreditController@index')->name('credit.index');
    Route::post('/increase', 'Services\CreditController@increase')->name('credit.increase');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'payment'
], function () {
    Route::get('/confirm', 'PaymentController@confirm')->name('payment.confirm');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'transaction'
], function () {
    Route::get('/export/{type}', 'TransactionController@export')->name('transaction.export');
});
