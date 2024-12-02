<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Auth::routes();

Route::controller(ContactController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/confirm', 'store');
    Route::get('/thanks', 'thanks');
});

// Admin Routes (認証されたユーザーのみ)
// Route::middleware('auth')->group(function () {
//     Route::get('admin', [AdminController::class, 'index']);
//     Route::get('/admin/contacts/{id}', [AdminController::class, 'show']);
// });

// Register Routes
Route::get('/register', [AuthController::class, 'register']); // 登録画面の表示
Route::post('/register', [AuthController::class, 'store']); // 登録処理

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm']); // ログイン画面
Route::post('/login', [AuthController::class, 'login']); // ログイン処理
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // ログアウト処理

Route::middleware('auth')->group(function () {
    // 管理者用ページ
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');  // 登録フォーム表示
Route::post('/register', [RegisterController::class, 'store']);  // 登録処理
