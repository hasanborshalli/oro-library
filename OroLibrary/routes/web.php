<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [MainController::class,'homePage']);
Route::get('/home', [MainController::class,'homePage'])->name('home');

Route::get('/login', [MainController::class,'loginPage']);
Route::post('/admin/login', [MainController::class,'login']);

Route::get('/logout', [MainController::class,'logout']);

Route::get('/cart', [MainController::class,'cartPage']);

Route::get('/thankyou', [MainController::class,'thankyouPage']);

Route::post('/order', [OrderController::class,'order']);

Route::post('/addCart', [OrderController::class,'addCart']);

Route::post('/book/like/{book}', [BookController::class,'like']);
Route::post('/book/out/{book}', [BookController::class,'outOfStock'])->middleware('auth');


Route::get('/home/search', [BookController::class,'searchPage']);
Route::get('/home/category', [BookController::class,'categoryPage']);

Route::get('/admin/books/search', [BookController::class,'searchAdminPage'])->middleware('auth');
Route::get('/order/edit/{order}/search', [BookController::class,'searchOrderPage'])->middleware('auth');
Route::get('/admin/stock/search', [BookController::class,'searchStockPage'])->middleware('auth');
Route::get('/admin/confirmed', [MainController::class,'confirmedPage'])->middleware('auth');

Route::get('/Oro/admin/Library', [MainController::class,'adminPage'])->middleware('auth');
Route::get('/Oro/login/Library', [MainController::class,'loginPage']);

Route::get('/admin/books', [MainController::class,'booksPage'])->middleware('auth');

Route::get('/admin/addBook', [MainController::class,'addBookPage'])->middleware('auth');
Route::post('/admin/addBook', [BookController::class,'addBook'])->middleware('auth');

Route::get('/admin/delete/{book}', [BookController::class,'deleteBook'])->middleware('auth');

Route::get('/admin/editBook/{book}', [MainController::class,'editBookPage'])->middleware('auth');
Route::post('/admin/editBook/{book}', [BookController::class,'editBook'])->middleware('auth');

Route::get('/admin/orders', [MainController::class,'ordersPage'])->middleware('auth');
Route::get('/order/{order}', [MainController::class,'orderDetailsPage'])->middleware('auth');
Route::get('/admin/stock', [MainController::class,'stockPage'])->middleware('auth');

Route::get('/order/confirm/{order}', [OrderController::class,'confirmOrder'])->middleware('auth');
Route::get('/order/decline/{order}', [OrderController::class,'declineOrder'])->middleware('auth');
Route::get('/order/edit/{order}', [MainController::class,'editOrderPage'])->middleware('auth');
Route::post('/order/edit/{order}', [OrderController::class,'editOrder'])->middleware('auth');