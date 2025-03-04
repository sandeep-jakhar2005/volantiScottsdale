<?php

use Illuminate\Support\Facades\Route;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\AddressController;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\AuthController;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\CartController;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\CheckoutController;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\InvoiceController;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\OrderController;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\ShipmentController;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\TransactionController;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\WishlistController;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\FboController;
use Webkul\RestApi\Http\Controllers\V1\Shop\Customer\CustomerController;

/**
 * Customer auth routes.
 */

Route::post('customer/login', [AuthController::class, 'login']);

Route::post('customer/register', [AuthController::class, 'register']);

Route::post('customer/forgot-password', [AuthController::class, 'forgotPassword']);


/* Airport endpoint*/
Route::get('customer/airport', [AddressController::class, 'airport']);
Route::get('customer/airport/{id}', [AddressController::class, 'specific_airport']);


Route::post('customer/temprary-token', [AuthController::class, 'TempUser']);
Route::post('customer/set-password', [AuthController::class, 'set_password']);
    
// , 'sanctum.custer'
Route::group(['middleware' => ['auth:sanctum']], function () {
    /**
     * Customer auth routes.
     */ 
 
    Route::get('customer/fbo', [AuthController::class, 'get_fbo']);
    Route::post('customer/add', [AuthController::class, 'add_fbo']);
    Route::put('customer/update_fbo', [AuthController::class, 'update_fbo']);


    Route::get('customer/get', [AuthController::class, 'get']);

    Route::put('customer/profile', [AuthController::class, 'update']);

    Route::post('customer/logout', [AuthController::class, 'logout']);

    /**
     * Customer address routes.
     */
    Route::get('customer/addresses', [AddressController::class, 'allResources']);

    Route::get('customer/addresses/{id}', [AddressController::class, 'getResource']);

    Route::post('customer/addresses', [AddressController::class, 'store']);

    Route::put('customer/addresses/{id}', [AddressController::class, 'update']);

    Route::delete('customer/addresses/{id}', [AddressController::class, 'destroy']);



    /**
     * Customer sale routes.
     */
    // sandeep change method 
    Route::get('customer/orders', [OrderController::class, 'allResources']);

    Route::get('customer/orders/{id}', [OrderController::class, 'getResource']);

    Route::post('customer/orders/{id}/cancel', [OrderController::class, 'cancel']);

    Route::get('customer/invoices', [InvoiceController::class, 'allResources']);

    Route::get('customer/invoices/{id}', [InvoiceController::class, 'getResource']);

    Route::get('customer/shipments', [ShipmentController::class, 'allResources']);

    Route::get('customer/shipments/{id}', [ShipmentController::class, 'getResource']);

    Route::get('customer/transactions', [TransactionController::class, 'allResources']);

    Route::get('customer/transactions/{id}', [TransactionController::class, 'getResource']);

    /**
     * Customer wishlist routes.
     */
    Route::get('customer/wishlist', [WishlistController::class, 'index']);

    Route::post('customer/wishlist/{id}', [WishlistController::class, 'addOrRemove']);

    Route::post('customer/wishlist/{id}/move-to-cart', [WishlistController::class, 'moveToCart']);

    /**
     * Customer cart routes.
     */
    
    Route::get('customer/cart', [CartController::class, 'get']);

    Route::post('customer/cart/add/{productId}', [CartController::class, 'add']);

    Route::put('customer/cart/update', [CartController::class, 'update']);

    Route::delete('customer/cart/remove/{cartItemId}', [CartController::class, 'removeItem']);

    Route::delete('customer/cart/empty', [CartController::class, 'empty']);

    Route::post('customer/cart/move-to-wishlist/{cartItemId}', [CartController::class, 'moveToWishlist']);

    Route::post('customer/cart/coupon', [CartController::class, 'applyCoupon']);

    Route::delete('customer/cart/coupon', [CartController::class, 'removeCoupon']);

    /**
     * Customer checkout routes.
     */
    Route::post('customer/checkout/save-address', [CheckoutController::class, 'saveAddress']);

    Route::post('customer/checkout/save-shipping', [CheckoutController::class, 'saveShipping']);

    Route::post('customer/checkout/save-payment', [CheckoutController::class, 'savePayment']);

    Route::post('customer/checkout/check-minimum-order', [CheckoutController::class, 'checkMinimumOrder']);

    Route::post('customer/checkout/save-order', [CheckoutController::class, 'saveOrder']);
    

    // sandeep add route
    Route::post('customer/custom-order-enquiry', [CustomerController::class, 'saveInquiry']);

    // download api route
    Route::get('download/customerinquery/{file}', [CustomerController::class, 'downloadInquiry']);

    



});
