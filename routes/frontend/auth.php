<?php

use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\SocialLoginController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\ConfirmAccountController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\UpdatePasswordController;
use App\Http\Controllers\Frontend\Auth\PasswordExpiredController;
use App\Http\Controllers\Frontend\Auth\UserType\SellerController;
use App\Http\Controllers\Frontend\Auth\UserType\BuyerController;
use App\Http\Controllers\Frontend\Auth\UserType\TransactionController;
use App\Http\Controllers\Frontend\Auth\UserType\BidMasterController;
// Whenever using a new method from Controller, we havto use that contoller's class here.


/*
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.auth'.
 */
Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
    // These routes require the user to be logged in
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        //For when admin is logged in as user from backend
        Route::get('logout-as', [LoginController::class, 'logoutAs'])->name('logout-as');

        // These routes can not be hit if the password is expired
        Route::group(['middleware' => 'password_expires'], function () {
            // Change Password Routes
            Route::patch('password/update', [UpdatePasswordController::class, 'update'])->name('password.update');
        });

        // Password expired routes
        Route::get('password/expired', [PasswordExpiredController::class, 'expired'])->name('password.expired');
        Route::patch('password/expired', [PasswordExpiredController::class, 'update'])->name('password.expired.update');

        /**
         * ------------------------------------Buyer-Seller Routes--------------------------------------
         */
        // Seller Routes
        
        Route::get('seller',[SellerController::class, 'index'])->name('user-type.seller');
        Route::get('seller/add-products',[SellerController::class, 'create'])->name('user-type.seller.add-products');
        Route::post('seller/submit-product',[SellerController::class, 'store'])->name('seller.submit-product');
        Route::get('seller/edit-product/{id}',[SellerController::class,'edit'])->name ('seller.edit-product');
        Route::post('seller/update-product/{id}',[SellerController::class,'update'])->name ('seller.update-product');
        Route::get('seller/delete-product/{id}',[SellerController::class,'destroy'])->name ('seller.delete-product');

        Route::get('seller/auction-list',[SellerController::class, 'indexSetAuction'])->name('user-type.seller.set-auction');
        Route::get('seller/add-auction',[SellerController::class, 'createSetAuction'])->name('seller.add-auction');
        Route::post('seller/submit-auction',[SellerController::class,'storeSetAuction'])->name('seller.submit-auction');
        Route::get('seller/edit-auction/{id}',[SellerController::class,'editSetAuction'])->name ('seller.edit-auction');
        Route::post('seller/update-auction/{id}',[SellerController::class,'updateSetAuction'])->name ('seller.update-auction');
        Route::get('seller/delete-auction/{id}',[SellerController::class,'destroySetAuction'])->name ('seller.delete-auction');

        // Buyer Routes
        Route::get('buyer', [BuyerController::class, 'index'])->name('user-type.buyer');
        Route::get('buyer/add-credit', [BuyerController::class, 'add_credit_index'])->name('buyer.add-credit');
        Route::post('buyer/add-credit/buy',[TransactionController::class,'storeTransaction'])->name('buye.add-credit.buy');
        
        Route::post('buyer/start-bid',[BidMasterController::class,'store'])->name('buyer.start-bid');
        Route::post('buyer/last-bidder-name',[BidMasterController::class,'getLastBidder'])->name('buyer.last-bidder-name');
        /** Whenever using a new method from Controller, we havto use that contoller's up here.
         * ---------------------------------------------------------------------------------------------
         */
        
    });
    // These routes require no user to be logged in
    Route::group(['middleware' => 'guest'], function () {
        
        // Authentication Routes
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');

        // Socialite Routes
        Route::get('login/{provider}', [SocialLoginController::class, 'login'])->name('social.login');
        Route::get('login/{provider}/callback', [SocialLoginController::class, 'login']);

        // Registration Routes
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('register.post');

        // Confirm Account Routes
        Route::get('account/confirm/{token}', [ConfirmAccountController::class, 'confirm'])->name('account.confirm');
        Route::get('account/confirm/resend/{uuid}', [ConfirmAccountController::class, 'sendConfirmationEmail'])->name('account.confirm.resend');

        // Password Reset Routes
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.email');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email.post');

        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
    });
});