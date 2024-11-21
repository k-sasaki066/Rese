<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisteredUserController;
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
});

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/', [ShopController::class, 'index']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);

Route::get('/store', [EditorController::class, 'index']);
Route::post('/store/edit', [EditorController::class, 'edit']);
Route::get('/list', [EditorController::class, 'list']);
Route::get('/list/date', [EditorController::class, 'date']);
Route::get('/editor/register', [AdminController::class, 'register']);
Route::get('/editor/list', [AdminController::class, 'list']);

Route::get('/admin/register', [AdminController::class, 'getRegister']);

