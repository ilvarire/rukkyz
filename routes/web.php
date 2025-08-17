<?php

use App\Http\Controllers\CallbackController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Customer\Cancel;
use App\Livewire\Customer\Cart;
use App\Livewire\Customer\Checkout;
use App\Livewire\Customer\FoodDetails as CustomerFoodDetails;
use App\Livewire\Customer\Foods;
use App\Livewire\Customer\Guide;
use App\Livewire\Customer\Home;
use App\Livewire\Customer\Orders;
use App\Livewire\Customer\Policy;
use App\Livewire\Customer\Profile as CustomerProfile;
use App\Livewire\Customer\Success;
use App\Livewire\Customer\Wishlist;
use Illuminate\Support\Facades\Route;


Route::redirect('dashboard', '/');

Route::get('/', Home::class)->name('home');
Route::get('/foods', Foods::class)->name('foods');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/wishlist', Wishlist::class)->name('wishlist');
Route::get('/food/{slug}', CustomerFoodDetails::class)->name('food.details');
Route::get('/policy', Policy::class)->name('policy');
Route::get('/guide', Guide::class)->name('guide');



Route::middleware(['auth', 'verified', 'rolemanager:customer'])->group(function () {
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/orders', Orders::class)->name('orders');
    Route::get('/success', Success::class)->name('success');
    Route::get('/cancel', Cancel::class)->name('cancel');
    // Route::get('/preorder', PreorderIndex::class)->name('preorder');

    Route::post('/webhook', [CallbackController::class, 'callback'])->name('checkout.webhook');


    // Route::get('/orders/{order}', OrderDetails::class)->name('order.details');
    // Route::get('/payments', PaymentIndex::class)->name('payments');

    // Route::redirect('settings', 'settings/profile');
    Route::get('profile', CustomerProfile::class)->name('profile');
    // Route::get('settings/password', Password::class)->name('settings.password');
    // Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
