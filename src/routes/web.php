<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\PaymentController;
use App\Http\Livewire\Search;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/mypage', [ShopController::class, 'getMypage']);
    Route::delete('/mypage/delete/{reservation_id}', [ShopController::class, 'delete']);
    Route::get('/user/done', [ShopController::class, 'done']);
    Route::get('/history', [RatingController::class, 'history']);
    Route::post('/history', [RatingController::class, 'postRating']);
    Route::get('/payment/{reservation_id}', [PaymentController::class, 'getPayment'])->name('payment');
    Route::post('/payment/charge', [PaymentController::class, 'charge']);

});

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/', [ShopController::class, 'index']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);

Route::middleware(['auth', 'role:admin', 'verified'])->group(function () {
    Route::get('/admin/register/representative', [AdminController::class, 'getEditorRegister']);
    Route::post('/admin/register/representative', [AdminController::class, 'postEditorRegister']);
    Route::get('/admin/user/index', [AdminController::class, 'list']);
    Route::get('/admin/email', [AdminController::class, 'getSendView']);
    Route::post('/admin/email', [AdminController::class, 'sendNotification']);
});

Route::middleware(['auth', 'role:editor', 'verified'])->group(function () {
    Route::get('/editor/shop/edit', [EditorController::class, 'index']);
    Route::post('/editor/shop/edit', [EditorController::class, 'edit']);
    Route::get('/editor/shop/menu', [EditorController::class, 'getMenu']);
    Route::post('/editor/shop/menu', [EditorController::class, 'postMenu']);
    Route::patch('/editor/shop/menu/update{menu_id}', [EditorController::class, 'updateMenu']);
    Route::delete('/editor/shop/menu/delete{menu_id}', [EditorController::class, 'deleteMenu']);
    Route::get('/editor/shop/list', [EditorController::class, 'list']);
    Route::get('/editor/shop/date', [EditorController::class, 'date']);
    Route::get('/editor/change', [AuthController::class, 'getChangePassword']);
    Route::patch('/editor/change', [AuthController::class, 'postChangePassword']);
});

Route::get('/admin/register', [AuthController::class, 'getAdminRegister']);
Route::post('/admin/register', [AuthController::class, 'postAdminRegister']);

Route::get('/reservation/confirm/{reservation_id}', [ShopController::class, 'confirm'])->middleware('signed')->name('reservation.confirm');
Route::get('/reservation/scan{reservation_id}', [ShopController::class, 'scan']);

