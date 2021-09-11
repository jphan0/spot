<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\SpotController::class, 'index'])->name('home');
Route::post('/', [App\Http\Controllers\SpotController::class, 'search']);
Route::get('/playlist', [App\Http\Controllers\SpotController::class, 'playlist_home'])->name('playlist_home');
Route::post('/playlist', [App\Http\Controllers\SpotController::class, 'playlist_search']);

Route::get('/download', [App\Http\Controllers\SpotController::class, 'download_search'])->name('download_search');
Route::post('/prepare', [App\Http\Controllers\SpotController::class, 'prepare'], 'prepare')->name('prepare');
Route::get('/status/{video}', [App\Http\Controllers\SpotController::class, 'status'], 'status')->name('status');
Route::get('/download/{video}', [App\Http\Controllers\SpotController::class, 'download'], 'download')->name('download');