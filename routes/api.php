<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('divisions', 'Admin\DivisionAPIController');
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('departments', 'Admin\DepartmentAPIController');
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('department__divisions', 'Admin\Department_DivisionAPIController');
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('members', 'Admin\MemberAPIController');
});








Route::group(['prefix' => 'admin'], function () {
    Route::resource('transactions', 'Admin\TransactionAPIController');
});




Route::group(['prefix' => 'admin'], function () {
    Route::resource('deposits', 'Admin\DepositAPIController');
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('withdrawals', 'Admin\WithdrawalAPIController');
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('loans', 'Admin\LoanAPIController');
});
