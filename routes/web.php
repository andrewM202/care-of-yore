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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('roles', 'roles')->name('roles');
    Route::view('approval', 'approval')->name('approval');
    Route::view('patients', 'patients')->name('patients');
    Route::view('additional', 'additional')->name('additional');
    Route::view('payment', 'payment')->name('payment');
});

require __DIR__.'/auth.php';
