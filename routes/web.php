<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountInfoController;

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

Route::get('/',  [AccountInfoController::class, 'index']);

Route::resource('accounts', '\App\Http\Controllers\AccountInfoController');

Route::delete('remove-from-cart', [AccountInfoController::class, 'remove']);

Route::post('/search', [AccountInfoController::class, 'search']);