<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::get('/', [App\Http\Controllers\LinkController::class,  'index']);
Route::post('/shorten', [App\Http\Controllers\LinkController::class,  'shorten']);
Route::get('/redirect/{code}', [App\Http\Controllers\LinkController::class,  'redirect']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
