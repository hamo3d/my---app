<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WebC;
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

Route::get('/', function () {
    return view('welcome');
});


Route::view('/page','cms.parent');
Route::view('/pages','cms.starter');

Route::resource('categorey',WebC::class);
// Route::get('index',[WebC::class,'index']);
