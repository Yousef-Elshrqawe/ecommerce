<?php

use App\Http\Controllers\Backend;
use App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [Frontend\FrontendController::class, 'index'])->name('frontend.index');
Route::get('/shop/{slug?}', [Frontend\FrontendController::class, 'shop'])->name('frontend.shop');
Route::get('/shop/tags/{slug}', [Frontend\FrontendController::class, 'shop_tag'])->name('frontend.shop_tag');
Route::get('/product/{slug?}', [Frontend\FrontendController::class, 'product'])->name('frontend.product');
Route::get('/cart', [Frontend\FrontendController::class, 'cart'])->name('frontend.cart');
Route::get('/wishlist', [Frontend\FrontendController::class, 'wishlist'])->name('frontend.wishlist');


Route::group(['middleware' => ['roles', 'role:customer|admin|supervisor']], function () {

    Route::get('/dashboard', [Frontend\CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/profile', [Frontend\CustomerController::class, 'profile'])->name('customer.profile');
    Route::patch('/profile', [Frontend\CustomerController::class, 'update_profile'])->name('customer.update_profile');
    Route::get('/profile/remove-image', [Frontend\CustomerController::class, 'remove_profile_image'])->name('customer.remove_profile_image');
    Route::get('/addresses', [Frontend\CustomerController::class, 'addresses'])->name('customer.addresses');
    Route::get('/orders', [Frontend\CustomerController::class, 'orders'])->name('customer.orders');


    Route::group(['middleware' => 'check_cart'], function () {

        Route::get('/checkout', [Frontend\PaymentController::class, 'checkout'])->name('frontend.checkout');
        Route::post('/checkout/payment', [Frontend\PaymentController::class, 'checkout_now'])->name('checkout.payment');
        Route::get('/checkout/{order_id}/cancelled', [Frontend\PaymentController::class, 'cancelled'])->name('checkout.cancel');
        Route::get('/checkout/{order_id}/completed', [Frontend\PaymentController::class, 'completed'])->name('checkout.complete');
        Route::get('/checkout/webhook/{order?}/{env?}', [Frontend\PaymentController::class, 'webhook'])->name('checkout.webhook.ipn');
    });


});


Auth::routes(['verify' => true]); // ['verify' => true] للتحقق من الاميل

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => 'guest'], function () {
        //pages Backend
        Route::get('/login', [Backend\BackendController::class, 'login'])->name('login');
        Route::get('/forgot-password', [Backend\BackendController::class, 'forgot_password'])->name('forgot_password');
    });

    Route::group(['middleware' => ['roles', 'role:admin|supervisor']], function () {
        // index
        Route::get('/', [Backend\BackendController::class, 'index'])->name('index_route');
        Route::get('/index', [Backend\BackendController::class, 'index'])->name('index');
        //Account Settings
        Route::get('/account_settings', [Backend\BackendController::class, 'account_settings'])->name('account_settings');
        Route::post('/admin/remove_image', [Backend\BackendController::class, 'remove_image'])->name('remove_image');
        Route::patch('/account_settings', [Backend\BackendController::class, 'update_account_settings'])->name('update_account_settings');
        //product_categories
        Route::post('/product_categories/remove-image', [Backend\ProductCategoriesController::class, 'remove_image'])->name('product_categories.remove_image');
        Route::resource('product_categories', Backend\ProductCategoriesController::class);
        //products
        Route::post('/products/remove-image', [Backend\ProductController::class, 'remove_image'])->name('products.remove_image');
        Route::resource('products', Backend\ProductController::class);
        //tags
        Route::resource('tags', Backend\TagController::class);
        //product_coupons
        Route::resource('product_coupons', Backend\ProductCouponController::class);
        Route::resource('product_reviews', Backend\ProductReviewController::class);
        //customers
        Route::resource('customers', Backend\CustomerController::class);
        Route::post('/customers/remove-image', [Backend\CustomerController::class, 'remove_image'])->name('customers.remove_image');
        Route::get('getCustomers', [Backend\CustomerController::class, 'getCustomers'])->name('customers.getCustomers');
        //customers Address
        Route::resource('customer_addresses', Backend\CustomerAddressController::class);
        //supervisors
        Route::resource('supervisors', Backend\SupervisorsController::class);
        Route::post('/supervisors/remove-image', [Backend\SupervisorsController::class, 'remove_image'])->name('supervisors.remove_image');
        //Orders
        Route::resource('orders', Backend\OrderController::class);
        //Sliders
        Route::resource('slider', Backend\SliderController::class);
        //Social Media
        Route::resource('social_media', Backend\Social_mediaController::class);
        //countries / states / cities
        Route::resource('countries', Backend\CountryController::class);
        Route::resource('states', Backend\StateController::class);
        Route::get('getStates', [Backend\StateController::class, 'getStates'])->name('states.getStates');
        Route::resource('cities', Backend\CityController::class);
        Route::get('getCities', [Backend\CityController::class, 'getCities'])->name('cities.getCities');
        //Shipping
        Route::resource('shipping_companies', Backend\ShippingCompanyController::class);
        //PaymentMethod
        Route::resource('payment_methods', Backend\PaymentMethodController::class);



    });


//End pages Backend
});
