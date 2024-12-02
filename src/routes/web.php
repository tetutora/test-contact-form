<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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

Route::controller(ContactController::class)->group(function ()
{
    Route::get('/', 'index');
    Route::post('/confirm', 'store');
    Route::get('/thanks', 'thanks');
});

Route::controller(AdminController::class)->group(function ()
{
    Route::get('admin','search');
    Route::get('/admin/contacts/{id}','show');
});