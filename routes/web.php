<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $itemCount = \App\Models\Item::count();
    $customerCount = \App\Models\Customer::count();
    $recentOrders = \App\Models\Order::with('customer')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    return view('dashboard', compact('itemCount', 'customerCount', 'recentOrders'));
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('items', ItemController::class);
    Route::resource('customers', CustomerController::class);
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{item}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{cartLine}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartLine}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
});

require __DIR__.'/auth.php';
