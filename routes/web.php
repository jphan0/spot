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
Route::get('/song', [App\Http\Controllers\SpotController::class, 'songHome'])->name('songs');
Route::post('/song', [App\Http\Controllers\SpotController::class, 'songSearch']);
Route::get('/song/{search_key}', [App\Http\Controllers\SpotController::class, 'downloadSong']);
Route::get('/playlist', [App\Http\Controllers\SpotController::class, 'playlistHome'])->name('playlists');
Route::post('/playlist', [App\Http\Controllers\SpotController::class, 'playlistSearch']);
Route::get('/playlist/{link}', [App\Http\Controllers\SpotController::class, 'playlistDownload']);
Route::get('/playlistList/{link}', [App\Http\Controllers\SpotController::class, 'playlistList']);

// Route::get('/queue', function() {
//     dispatch(function() {
//         logger('Running our first job!');
//     });
// });

Route::get('status/{song}', [App\Http\Controllers\SpotController::class, 'status'])->name('status');
Route::get('download/{song}', [App\Http\Controllers\SpotController::class, 'download'])->name('download');

Route::get('vaticancameos', [App\Http\Controllers\SpotController::class, 'manualDelete']);