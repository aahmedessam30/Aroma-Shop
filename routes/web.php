<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdcutController;
use App\Http\Controllers\WishlistController;

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

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('wishlist', WishlistController::class)->only(['index', 'store', 'destroy']);

    Route::delete('wishlist', [WishlistController::class, 'clear'])->name('wishlist.clear');

    Route::resource('order', OrderController::class)->only(['index', 'store']);
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::post('/shop/filter', [ShopController::class, 'filter'])->name('shop.filter');

Route::get('/prodcut/{prodcut}', [ProdcutController::class, 'show'])->name('shop.show');

Route::post('review', [ProdcutController::class, 'review_store'])->name('review.store');

Route::post('comment', [CommentController::class, 'store'])->name('comment.store');

Route::post('reply', [ProdcutController::class, 'reply_store'])->name('reply.store');

Route::resource('blog', PostController::class)->parameters(['blog' => 'post'])->except(['create']);

Route::post('blog/{category}', [PostController::class, 'filter'])->name('blog.filter');

Route::resource('cart', CartController::class)->parameters(['cart' => 'prodcut'])->except(['show', 'create', 'edit']);

Route::delete('cart', [CartController::class, 'clear'])->name('cart.clear');

Route::get('contact', [ContactController::class, 'index'])->name('contact');

Route::Post('contact/email', [ContactController::class, 'sendMail'])->name('contact.send');
