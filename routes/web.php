<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/wallet', [App\Http\Controllers\UserController::class, 'dashboard_user'])->name('dashboard_user');
Route::get('/dashboard_fetch', [App\Http\Controllers\UserController::class, 'dashboard_fetch'])->name('dashboard_fetch');
Route::post('/refund', [App\Http\Controllers\UserController::class, 'refund'])->name('refund');
Route::get('/list', [App\Http\Controllers\UserController::class, 'list'])->name('list');
Route::get('/get-related-records', [App\Http\Controllers\UserController::class, 'getRelatedRecords']);
Route::get('/Fatchlist', [App\Http\Controllers\UserController::class, 'Fatchlist'])->name('Fatchlist');
Route::post('/wallet_payment', [App\Http\Controllers\UserController::class, 'wallet_payment'])->name('wallet_payment');
Route::get('/payment', [App\Http\Controllers\UserController::class, 'medical_payment'])->name('medical_payment');
Route::post('/medical_payment_status/{id}', [App\Http\Controllers\UserController::class, 'medical_payment_status'])->name('medical_payment_status');
Route::get('/FatchMedical', [App\Http\Controllers\UserController::class, 'FatchMedical'])->name('FatchMedical');
Route::get('/getTransactionComment/{id}', [App\Http\Controllers\UserController::class, 'getTransactionComment'])->name('getTransactionComment');
Route::post('/requestTransaction', [App\Http\Controllers\UserController::class, 'requestTransaction'])->name('requestTransaction');
Route::post('/status_update_Transaction/{id}', [App\Http\Controllers\UserController::class, 'status_update_Transaction'])->name('status_update_Transaction');
Route::post('/sendMoney', [App\Http\Controllers\UserController::class, 'sendMoney'])->name('sendMoney');
Route::get('/send', [App\Http\Controllers\UserController::class, 'send'])->name('send');
Route::get('/sendFatch', [App\Http\Controllers\UserController::class, 'sendFatch'])->name('sendFatch');
Route::post('/requestApprovalSend/{id}', [App\Http\Controllers\UserController::class, 'requestApprovalSend'])->name('requestApprovalSend');
Route::post('/requestdisapprovalSend', [App\Http\Controllers\UserController::class, 'requestdisapprovalSend'])->name('requestdisapprovalSend');
Route::get('/getCommentSend/{id}', [App\Http\Controllers\UserController::class, 'getCommentSend'])->name('getCommentSend');
Route::get('/bank', [App\Http\Controllers\PaymentController::class, 'bank'])->name('bank');
Route::get('/verify_payment/{reference}', [App\Http\Controllers\PaymentController::class, 'verify_payment'])->name('verify_payment');
Route::post('/verify_online_payment/{reference}', [App\Http\Controllers\PaymentController::class, 'verify_online_payment'])->name('verify_online_payment');
Route::get('/request', [App\Http\Controllers\PaymentController::class, 'request'])->name('request');
Route::get('/requestFatch', [App\Http\Controllers\PaymentController::class, 'requestFatch'])->name('requestFatch');
Route::post('/requestApproval/{id}', [App\Http\Controllers\PaymentController::class, 'requestApproval'])->name('requestApproval');
Route::post('/requestdisapproval', [App\Http\Controllers\PaymentController::class, 'requestdisapproval'])->name('requestdisapproval');
Route::get('/getComment/{id}', [App\Http\Controllers\PaymentController::class, 'getComment'])->name('getComment');
Route::post('/requestdeposit', [App\Http\Controllers\PaymentController::class, 'requestdeposit'])->name('requestdeposit');
Route::get('/getDepositComment/{id}', [App\Http\Controllers\PaymentController::class, 'getDepositComment'])->name('getDepositComment');
Route::post('/top_up_store', [App\Http\Controllers\PaymentController::class, 'top_up_store'])->name('top_up_store');
Route::post('/top_up_transwction', [App\Http\Controllers\PaymentController::class, 'top_up_transwction'])->name('top_up_transwction');
Route::get('/topfetch', [App\Http\Controllers\PaymentController::class, 'topfetch'])->name('topfetch');
Route::get('/awaiting', [App\Http\Controllers\PaymentController::class, 'awaiting'])->name('awaiting');
Route::post('/status_update/{id}', [App\Http\Controllers\PaymentController::class, 'status_update'])->name('status_update');
Route::get('/sendMoneyReport', [App\Http\Controllers\ReportController::class, 'sendMoneyReport'])->name('sendMoneyReport');
Route::get('/sendMoneyReportFetch', [App\Http\Controllers\ReportController::class, 'sendMoneyReportFetch'])->name('sendMoneyReportFetch');
Route::get('/TransactionReport', [App\Http\Controllers\ReportController::class, 'TransactionReport'])->name('TransactionReport');
Route::get('/TransactionReportFetch', [App\Http\Controllers\ReportController::class, 'TransactionReportFetch'])->name('TransactionReportFetch');
