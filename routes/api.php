<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AjosController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Ajo\AjoController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PinController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Mono\MonoController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Payouts\BankController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\WalletTransfers\TransferController;
use App\Http\Controllers\WebhookController;
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



Route::post('/flutterwave/webhook-response', [WebhookController::class, 'flutterwaveWebhook']);

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/get-phone-number', [RegisterController::class, 'getPhoneNumber']);
    Route::post('/verify-code', [RegisterController::class, 'verifyCode']);
    // Route::post('/verify-email', [RegisterController::class, 'verifyEmail']);
    Route::post('/resend-code', [RegisterController::class, 'resendCode']);
    Route::post('/check-pin', [RegisterController::class, 'checkPin']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');
    Route::post('/create-pin', [PinController::class, 'create']);
    Route::post('/verify-device', [VerifyDeviceController::class, 'verifyDevice']);
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    Route::get('/verify-email', [VerificationController::class, 'verify'])->name('verification.verify');



    Route::post('/login', [LoginController::class, 'login'])->name('login');
});


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::get('verify-transaction', [PaymentController::class, 'verifyTransaction']);

    Route::post('charge-token', [PaymentController::class, 'chargeToken']);

    Route::group(['prefix' => 'mono'], function () {
        Route::post('mono-verify', [MonoController::class, 'monoVerify']);
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('user-details', [ProfileController::class, 'userDetails']);
        Route::post('change-pin', [ProfileController::class, 'changePin']);
        Route::post('change-password', [ProfileController::class, 'changePassword']);
    });


    Route::group(['middleware' => ['isActive']], function () {

        Route::group(['prefix' => 'ajo'], function () {
            Route::post('create-ajo', [AjoController::class, 'createAjo']);
            Route::post('join-ajo', [AjoController::class, 'joinAjo']);
            Route::get('max-ajo', [AjoController::class, 'checkMaxAjoAmount']);
        });

        Route::group(['prefix' => 'payments'], function () {
            Route::get('get-card-details', [PaymentController::class, 'getCardDetails']);
            Route::post('pay-ahead', [PaymentController::class, 'payAhead']);
        });


        Route::group(['prefix' => 'transfers'], function () {
            Route::get('verify-Wallet', [TransferController::class, 'verifyWalletUser']);
            Route::post('wallet2wallet', [TransferController::class, 'wallet2WalletTransfer']);
            Route::post('wallet2bank', [TransferController::class, 'walletToBank']);
        });

        Route::group(['prefix' => 'payout'], function () {
            Route::get('get-bank-list', [BankController::class, 'bankList']);
            Route::post('create-account', [BankController::class, 'createAccount']);
        });
    });
});



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function (Request $request) {
        return auth()->user();
    });

    Route::post('/auth/logout', [LogoutController::class, 'logout']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'admin']], function () {

    Route::get('all-users', [AdminUserController::class, 'allUsers']);
    Route::get('pending-users', [AdminUserController::class, 'pendingUsers']);
    Route::get('active-users', [AdminUserController::class, 'activeUsers']);
    Route::get('suspended-users', [AdminUserController::class, 'suspendedUsers']);


    Route::group(['prefix' => 'transactions'], function () {
        Route::get('all', [TransactionsController::class, 'allTransactions']);
        Route::get('credit', [TransactionsController::class, 'creditTransactions']);
        Route::get('debit', [TransactionsController::class, 'debitTransactions']);
        Route::get('wallet', [TransactionsController::class, 'walletTransactions']);
        Route::get('bank', [TransactionsController::class, 'bankTransactions']);
        Route::get('pending', [TransactionsController::class, 'pendingTransactions']);
        Route::get('successful', [TransactionsController::class, 'successfulTransactions']);
    });

    Route::group(['prefix' => 'ajos'], function () {
        Route::get('all',[AjosController::class, 'all']);
        Route::get('active',[AjosController::class, 'active']);
        Route::get('pending',[AjosController::class, 'pending']);
        Route::get('completed',[AjosController::class, 'completed']);
    });
});
