<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\RatingController;
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
    Route::get('/user/history', [RatingController::class, 'history']);
    Route::post('/user/history', [RatingController::class, 'postRating']);
});

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/', [ShopController::class, 'index']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/register/representative', [AdminController::class, 'getEditorRegister']);
    Route::post('/admin/register/representative', [AdminController::class, 'postEditorRegister']);
    Route::get('/admin/user/index', [AdminController::class, 'list']);
});

Route::middleware(['auth', 'role:editor'])->group(function () {
    Route::get('/editor/shop/edit', [EditorController::class, 'index']);
    Route::post('/editor/shop/edit', [EditorController::class, 'edit']);
    Route::get('/editor/shop/list', [EditorController::class, 'list']);
    Route::get('/editor/shop/date', [EditorController::class, 'date']);
});

Route::get('/admin/register', [AuthController::class, 'getAdminRegister']);
Route::post('/admin/register', [AuthController::class, 'postAdminRegister']);

