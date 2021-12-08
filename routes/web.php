<?php

use Illuminate\Support\Facades\Route;
// Added to query database
use Illuminate\Support\Facades\DB;
// Model for roles
use App\Models\Roles;
// Model for users
use App\Models\User;
// Model for appointments
use App\Models\Appointments;
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
    Route::post('/doctor-appointment', function() {
        //$patient_name = ['name' => " "];
        //var_dump($patient_name);
        return view('doctor-appointment');
    })->name('doctor-appointment');
    Route::post('/doctor-appointment', function (Request $request) {
        $patient_id = $request->input('patient_id');
        $appointment_date = $request->input('appointment_date');
        var_dump($appointment_date);
        $patient_name = DB::select('
            select name from users
            where id = '.$patient_id.'
        ');
        $patient_name = (array)array_values($patient_name)[0];
        $doctors = DB::select('
            select * from users
            where role = 4
        ');
        return view('doctor-appointment', ['patient_name' => $patient_name])
        ->with('patient_id', $patient_id)
        ->with('doctors', $doctors);
    })->name('doctor-appointment');
    Route::view('approval', 'approval')->name('approval');
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
