<?php

use Illuminate\Support\Facades\Route;

// Added to query database
use Illuminate\Support\Facades\DB;

// Model for roles
use App\Models\User;

// Get input from requests
use Illuminate\Http\Request;

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
    Route::get('/approval', function () {
        $users = DB::select('
            select * from users
            where approval = 0
        ');
        if (count($users) > 0) {
            return view('approval', ['users' => $users]);
        } else {
            return view('approval', ['users' => []]);
        }
    })->name('approval');

    Route::post('/approve-user', function (Request $request) {
        $id = $request->input('id');
        $user = User::find($id);
        $user->approval = 1;
        $user->save();
        return redirect('/approval');
    })->name('approve-user');

    Route::post('/decline-user', function (Request $request) {
        $id = $request->input('id');
        $user = User::where('id', $id)->delete();
        return redirect('/approval');
    })->name('decline-user');

    Route::view('patients', 'patients')->name('patients');
    Route::view('additional', 'additional')->name('additional');
    Route::view('payment', 'payment')->name('payment');
    Route::view('doctor-appointment', 'doctor-appointment')->name('doctor-appointment');
    Route::view('employee-list', 'employee-list')->name('employee-list');
    Route::view('new-roster', 'new-roster')->name('new-roster');
    Route::view('view-roster', 'view-roster')->name('view-roster');
    Route::view('admin-report', 'admin-report')->name('admin-report');
});

require __DIR__.'/auth.php';
