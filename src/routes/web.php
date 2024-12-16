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

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/', [ShopController::class, 'index']);
Route::get('/detail/{shop_id}', [ShopController::class, 'getDetail']);

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/mypage', [ShopController::class, 'getMypage']);
    Route::delete('/mypage/delete/{reservation_id}', [ShopController::class, 'delete']);
    Route::get('/user/done', [ShopController::class, 'done']);
    Route::get('/history', [RatingController::class, 'getHistory']);
    Route::post('/history', [RatingController::class, 'postRating']);
    Route::get('/payment/{reservation_id}', [PaymentController::class, 'getPayment'])->name('payment');
    Route::post('/payment/charge{total}', [PaymentController::class, 'postCharge']);

});

Route::get('/admin/register', [AuthController::class, 'getAdminRegister']);
Route::post('/admin/register', [AuthController::class, 'postAdminRegister']);

Route::prefix('admin')->middleware(['auth', 'role:admin', 'verified'])->group(function () {
    Route::get('/register/representative', [AdminController::class, 'getEditorRegister']);
    Route::post('/register/representative', [AdminController::class, 'postEditorRegister']);
    Route::get('/user/index', [AdminController::class, 'getAdminList']);
    Route::get('/email', [AdminController::class, 'getSendView']);
    Route::post('/email', [AdminController::class, 'sendNotification']);
});

Route::prefix('editor')->middleware(['auth', 'role:editor', 'verified'])->group(function () {
    Route::get('/shop/edit', [EditorController::class, 'getEditorForm']);
    Route::post('/shop/edit', [EditorController::class, 'postEditorForm']);
    Route::get('/shop/menu', [EditorController::class, 'getMenu']);
    Route::post('/shop/menu', [EditorController::class, 'postMenu']);
    Route::patch('/shop/menu/update{menu_id}', [EditorController::class, 'updateMenu']);
    Route::delete('/shop/menu/delete{menu_id}', [EditorController::class, 'deleteMenu']);
    Route::get('/shop/list', [EditorController::class, 'getReservationList']);
    Route::get('/shop/date', [EditorController::class, 'getReservationDate']);
    Route::get('/change', [AuthController::class, 'getChangePassword']);
    Route::patch('/change', [AuthController::class, 'postChangePassword']);
});

Route::get('/reservation/confirm/{reservation_id}', [ShopController::class, 'reservationConfirm'])->middleware('signed')->name('reservation.confirm');


