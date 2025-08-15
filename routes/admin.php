<?php

use App\Livewire\Admin\AddCouponCode;
use App\Livewire\Admin\AddFood;
use App\Livewire\Admin\AddShippingRates;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Countries;
use App\Livewire\Admin\CouponCodes;
use App\Livewire\Admin\Customers;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Food;
use App\Livewire\Admin\Orders;
use App\Livewire\Admin\Payments;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\Reviews;
use App\Livewire\Admin\ShippingRates;
use App\Livewire\Admin\Sizes;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['auth', 'rolemanager:admin'])->group(function () {
        //dashboard
        Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');

        //categories
        Route::get('/categories', Categories::class)->name('admin.categories');

        //countries
        Route::get('/countries', Countries::class)->name('admin.countries');

        //food
        Route::get('/food', Food::class)->name('admin.food');
        Route::get('/food/add', AddFood::class)->name('admin.food.add');
        Route::get('/reviews', Reviews::class)->name('admin.reviews');

        //sizes
        Route::get('/sizes', Sizes::class)->name('admin.sizes');

        //order
        Route::get('/orders', Orders::class)->name('admin.orders');

        //payments
        Route::get('/payments', Payments::class)->name('admin.payments');

        //customers
        Route::get('/customers', Customers::class)->name('admin.customers');

        //coupons & discount
        Route::get('/coupons', CouponCodes::class)->name('admin.coupons');
        Route::get('/coupon/add', AddCouponCode::class)->name('admin.coupon.add');

        //shipping rates
        Route::get('/rates', ShippingRates::class)->name('admin.rates');
        Route::get('/rates/add', AddShippingRates::class)->name('admin.rates.add');

        //Profile
        Route::get('/profile', Profile::class)->name('admin.profile');
    });
});
