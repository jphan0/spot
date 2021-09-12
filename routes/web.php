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
Route::get('/about', [App\Http\Controllers\SpotController::class, 'about'])->name('about');
Route::get('/song', [App\Http\Controllers\SpotController::class, 'song_home'])->name('songs');
Route::post('/song', [App\Http\Controllers\SpotController::class, 'song_search']);
Route::get('/song/{search_key}', [App\Http\Controllers\SpotController::class, 'download_song']);
Route::get('/playlist', [App\Http\Controllers\SpotController::class, 'playlist_home'])->name('playlists');
Route::post('/playlist', [App\Http\Controllers\SpotController::class, 'playlist_search']);
Route::get('/playlist/{link}', [App\Http\Controllers\SpotController::class, 'playlist_download']);

Route::get('/status/{video}', [App\Http\Controllers\SpotController::class, 'status'], 'status')->name('status');
Route::get('/download/{video}', [App\Http\Controllers\SpotController::class, 'download'], 'download')->name('download');