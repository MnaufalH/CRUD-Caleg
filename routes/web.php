<?php

use Illuminate\Support\Facades\Route;

Route::resource('/calegs', \App\Http\Controllers\CalegController::class);
Route::resource('/partais', \App\Http\Controllers\PartaiController::class);
// Route::get('/calegs/edit', 'CalegController@edit');
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
