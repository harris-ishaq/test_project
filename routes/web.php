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
    return view('welcome');
});

Auth::routes([
    'register' => false, // Register Routes...
    'reset' => false, // Reset Password Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function(){
    Route::group(['prefix' => 'users'], function () {
		Route::get('/', [App\Http\Controllers\MData\UserController::class, 'index']);
        Route::get('/create', [App\Http\Controllers\MData\UserController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\MData\UserController::class, 'store']);
        Route::get('{user}/edit', [App\Http\Controllers\MData\UserController::class, 'edit']);
        Route::put('{user}', [App\Http\Controllers\MData\UserController::class, 'update']);
        Route::get('{user}/destroy', [App\Http\Controllers\MData\UserController::class, 'destroy']);
	});

    Route::group(['prefix' => 'students'], function () {
		Route::get('/', [App\Http\Controllers\MData\StudentController::class, 'index']);
        Route::get('/create', [App\Http\Controllers\MData\StudentController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\MData\StudentController::class, 'store']);
        Route::get('{data}/edit', [App\Http\Controllers\MData\StudentController::class, 'edit']);
        Route::put('{data}', [App\Http\Controllers\MData\StudentController::class, 'update']);
        Route::get('{data}/destroy', [App\Http\Controllers\MData\StudentController::class, 'destroy']);
        Route::get('/search', [App\Http\Controllers\MData\StudentController::class, 'search']);
        Route::get('/get-student', [App\Http\Controllers\MData\StudentController::class, 'get']);
        Route::get('/{data}/add-as-users', [App\Http\Controllers\MData\UserController::class, 'addStudentAsUser']);
	});

    Route::group(['prefix' => 'books'], function () {
		Route::get('/', [App\Http\Controllers\MData\BookController::class, 'index']);
        Route::get('/create', [App\Http\Controllers\MData\BookController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\MData\BookController::class, 'store']);
        Route::get('{book}/edit', [App\Http\Controllers\MData\BookController::class, 'edit']);
        Route::put('{book}', [App\Http\Controllers\MData\BookController::class, 'update']);
        Route::get('{book}/destroy', [App\Http\Controllers\MData\BookController::class, 'destroy']);
        Route::get('/search', [App\Http\Controllers\MData\BookController::class, 'search']);
	});

    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', [App\Http\Controllers\Transaksi\TransactionController::class, 'index']);
        Route::get('/create', [App\Http\Controllers\Transaksi\TransactionController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\Transaksi\TransactionController::class, 'store']);
        Route::get('/{transaction}/return', [App\Http\Controllers\Transaksi\TransactionController::class, 'returnBook']);
        Route::put('/return/{transaction}', [App\Http\Controllers\Transaksi\TransactionController::class, 'saveReturned']);
        Route::get('/{transaction}/destroy', [App\Http\Controllers\Transaksi\TransactionController::class, 'destroy']);
        Route::get('/{transaction}/edit', [App\Http\Controllers\Transaksi\TransactionController::class, 'edit']);
        Route::put('/{transaction}', [App\Http\Controllers\Transaksi\TransactionController::class, 'update']);
        Route::get('/{transaction}/cancel', [App\Http\Controllers\Transaksi\TransactionController::class, 'cancel']);
        Route::get('/denda', [App\Http\Controllers\Transaksi\TransactionController::class, 'indexDenda']);
        Route::get('/denda/{transaction}', [App\Http\Controllers\Transaksi\TransactionController::class, 'bayar']);
    });

    Route::group(['prefix' => 'user-transactions'], function () {
        Route::get('/list', [App\Http\Controllers\User\UserTransactionController::class, 'index']);
        Route::get('/create', [App\Http\Controllers\User\UserTransactionController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\User\UserTransactionController::class, 'store']);
    });

    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', [App\Http\Controllers\ReportController::class, 'index']);
        Route::post('/download', [App\Http\Controllers\ReportController::class, 'download']);
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
