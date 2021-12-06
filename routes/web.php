<?php

use Illuminate\Support\Facades\Route;
// Added to query database
use Illuminate\Support\Facades\DB;
// Model for roles
use App\Models\Roles;
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

Route::group(['middleware' => ['auth']], function () {

    Route::post('/add-role', function (Request $request) {
        $role = new Roles;
        $role->role_name = $request->input('newRole');
        $role->access_level = $request->input('accessLevel');
        $role->save();
        return redirect('/roles');
    })->name('add-role');
    Route::post('/delete-role', function (Request $request) {
        $role_name = $request->input('roleName');
        $user = Roles::where('role_name', $role_name)->firstorfail()->delete();
        return redirect('/roles');
    })->name('delete-role');
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('', 'welcome')->name('welcome');
    Route::get('/roles', function () {
        $roles = DB::select('
            select * from roles
        ');
        return view('roles', ['roles' => $roles]);
    })->name('roles');
    Route::view('approval', 'approval')->name('approval');
    Route::view('patients', 'patients')->name('patients');
    Route::view('additional', 'additional')->name('additional');
    Route::view('payment', 'payment')->name('payment');
    Route::view('doctor-appointment', 'doctor-appointment')->name('doctor-appointment');
    Route::view('employee-list', 'employee-list')->name('employee-list');
    Route::get('/set-roster', function () {
        
        return view('set-roster');
    })->name('set-roster');
    Route::get('/view-roster', function(){

        return view('view-roster');
    })->name('view-roster');
    Route::view('admin-report', 'admin-report')->name('admin-report');
});

require __DIR__.'/auth.php';
