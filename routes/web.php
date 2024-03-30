<?php

use App\Http\Controllers\ImageController;
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

Route::get('/', [ImageController::class,'index'])->name('images.index');
Route::get('/images/{image:slug}', [ImageController::class,'show'])->name('images.show');
Route::get('/images', [ImageController::class,'create'])->name('images.create');
Route::post('/images', [ImageController::class,'store'])->name('images.store');
Route::get('/images/{image}/edit', [ImageController::class,'edit'])->name('images.edit');
Route::put('/images/{image}', [ImageController::class,'update'])->name('images.update');
Route::view('/test-blade','test');
