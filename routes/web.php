<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/announcement/new',[HomeController::class,'newAnnouncement'])->name('newAnnouncement');
Route::post('/announcement/create',[HomeController::class,'createAnnouncement'])->name('createAnnouncement');
Route::get('/category/detail/{id}',[HomeController::class,'detailCategory'])->name('detailCategory');

