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

use App\Models\Admin\Transaction;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('divisions', 'Admin\DivisionController', ["as" => 'admin']);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('departments', 'Admin\DepartmentController', ["as" => 'admin']);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('departmentDivisions', 'Admin\Department_DivisionController', ["as" => 'admin']);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('members', 'Admin\MemberController', ["as" => 'admin']);
});





Route::group(['prefix' => 'admin'], function () {
    Route::resource('users', 'Admin\UserController', ["as" => 'admin']);
});




Route::group(['prefix' => 'admin'], function () {
    Route::resource('transactions', 'Admin\TransactionController', ["as" => 'admin']);
});




Route::group(['prefix' => 'admin'], function () {
    Route::resource('deposits', 'Admin\DepositController', ["as" => 'admin']);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('withdrawals', 'Admin\WithdrawalController', ["as" => 'admin']);
});


Route::group(['prefix'=>'admin'], function(){
    Route::post('import_deposits', 'Admin\Importing\DepositImportsController@store')->name('admin.import.deposit');
    Route::post('import_withdrawals', 'Admin\Importing\WithdrawalImportsController@store')->name('admin.import.withdrawal');

});




Route::group(['prefix' => 'admin'], function () {
    Route::get('reports/member_statement', 'Admin\ReportsController@member_statement', ["as" => 'admin'])
        ->name('admin.reports.member_statement');
    Route::post('reports/generate_statement', 'Admin\ReportsController@generate_statement', ["as" => 'admin'])
        ->name('admin.reports.generate_statement');
});


Route::get('/get', function (){
    $transaction = Transaction::whereIn('transaction_date', ["2021-01-08", "2021-01-10"])->get();
    return $transaction;
});


//TEST ROUTES

Route::post('/testExport', 'Exporting\UserExportsController@export');
Route::get('/export', 'Exporting\UserExportsController@getForm');

Route::get('/users/imports', 'Importing\UsersImportsController@show')->name('getForm');
Route::post('/users/imports', 'Importing\UsersImportsController@store')->name('users.imports');
