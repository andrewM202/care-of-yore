<?php

// Added to query database
use App\Models\Roles;
// Model for roles
use App\Models\Roster;
// Model for users
use App\Models\User;
// Model for Medications
use App\Models\Medications;
// Model for appointments
use Illuminate\Http\Request;
// Model for roster
use Illuminate\Support\Facades\DB;
// Get input from requests
use Illuminate\Support\Facades\Route;
//Auth
use Illuminate\Support\Facades\Auth;

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

    Route::get('dashboard', function() {
        $user = Auth::user();
        if ($user->role == 3) {
            return redirect('patient-dashboard');
        } elseif ($user->role == 4) {
            return redirect('doctor-dashboard');
        } elseif ($user->role == 5) {
            return redirect('caregiver-dashboard');
        } elseif ($user->role == 6) {
            return redirect('family-member-dashboard');
        } else {
            return redirect('get-roster');
        }
    })->name('dashboard');
    Route::view('patient-dashboard', 'patient-dashboard')->name('patient-dashboard');
    Route::get('doctor-dashboard', function() {
        $doctor_id = Auth::user()->id;
        $appointments = DB::select("
            select concat(u.first_name,' ',u.last_name) as patient_name,
            doctor_id, a.patient_id, appointment_date, morning_med, afternoon_med, evening_med 
            from appointments a
            left join medications m
            on a.patient_id = m.patient_id
            join users u
            on a.patient_id = u.id
            where a.doctor_id = '{$doctor_id}'
        ");
        return view('doctor-dashboard', ['appointments' => $appointments]);
    })->name('doctor-dashboard');
    Route::post('update-meds', function(Request $request) {
        $morning_med = $request->input('morning_med');
        $afternoon_med = $request->input('afternoon_med');
        $evening_med = $request->input('evening_med');
        $patient_id = $request->input('patient_id');
        $med = Medications::where('patient_id', $patient_id);
        if ($med->exists()) {
            DB::update("
                update medications
                set morning_med = '{$morning_med}', afternoon_med = '{$afternoon_med}', evening_med = '{$evening_med}'
                where patient_id = '{$patient_id}'
            ");
        } else {
            DB::insert("
                insert into medications (patient_id, morning_med, afternoon_med, evening_med)
                values ('{$patient_id}', '{$morning_med}', '{$afternoon_med}', '{$evening_med}')
            ");
        }
        // $patient->morning_med = $morning_med;
        // $patient->afternoon_med = $afternoon_med;
        // $patient->evening_med = $evening_med;
        // $patient->save();
        return redirect('/doctor-dashboard');
    })->name('update-meds');
    Route::view('caregiver-dashboard', 'caregiver-dashboard')->name('caregiver-dashboard');
    Route::view('family-member-dashboard', 'family-member-dashboard')->name('family-member-dashboard');
    
    Route::view('', 'welcome')->name('welcome');
    Route::get('/roles', function () {
        $roles = DB::select('
            select * from roles;
        ');
        return view('roles', ['roles' => $roles]);
    })->name('roles');
    Route::get('/doctor-appointment', function () {
        $appointments = DB::select("
            select concat(u.first_name,' ',u.last_name) as doctor_name,
            a.patient_id, a.appointment_date
            from appointments a
            join users u
            on a.doctor_id = u.id
            limit 50
        ");
        return view('doctor-appointment', ['appointments' => $appointments]);
    })->name('doctor-appointment');
    Route::post('/delete-appointment', function (Request $request) {
        $patient_id = $request->input('patient_id');
        $doctor_name = $request->input('doctor_name');
        $appointment_date = $request->input('appointment_date');
        $appointment_date = strtotime($appointment_date);
        $appointment_date = date('Y-m-d 00:00:00', $appointment_date);

        DB::delete("
            delete a.*
            from appointments a
            join users u on a.doctor_id = u.id
            where patient_id = '{$patient_id}'
            and appointment_date = '{$appointment_date}'
            and concat(u.first_name,' ',u.last_name) = '{$doctor_name}'
        ");

        return redirect('doctor-appointment');
    })->name('delete-appointment');
    Route::post('/fill-appointment-form', function (Request $request) {
        $patient_id = $request->input('patient_id');
        $appointment_date = $request->input('appointment_date');
        $doctor = $request->input('doctors');
        $patient_name = DB::select("
            select concat(first_name,' ',last_name) as name
            from users
            where id = '{$patient_id}'
        ");
        $patient_name = (array)array_values($patient_name)[0];
        $doctors = DB::select("
            select concat(first_name,' ',last_name) as name,
            id from users
            where role = 4
        ");
        $appointments = DB::select("
            select concat(u.first_name,' ',u.last_name) as doctor_name,
            a.patient_id, a.appointment_date
            from appointments a
            join users u
            on a.doctor_id = u.id
            where a.patient_id = '{$patient_id}'
            limit 50
        ");
        return view('doctor-appointment', ['patient_name' => $patient_name])
            ->with('patient_id', $patient_id)
            ->with('doctors', $doctors)
            ->with(['appointments' => $appointments]);
    })->name('fill-appointment-form');
    Route::post('/create-doctor-appointment', function (Request $request) {
        $appointment_date = $request->input('appointment_date');
        $appointment_date = strtotime($appointment_date);
        $appointment_date = date('Y-m-d 00:00:00', $appointment_date);
        $patient_id = $request->input('patient_id');
        $doctor_id = DB::select('
            select id from users
            where role = 4
        ');
        $doctor_id = (array)array_values($doctor_id)[0];

        DB::insert("
            insert into appointments
            (appointment_date, patient_id, doctor_id)
            values ('{$appointment_date}', '{$patient_id}', '{$doctor_id['id']}')
        ");

        return redirect('/doctor-appointment');
    })->name('create-doctor-appointment');
    Route::view('patients', 'patients')->name('patients');
    Route::post('/patient-search', function (Request $request) {
        $patient_id = $request->input('patient_id');
        $patient_name = $request->input('patient_name');
        $patient_date_of_birth = $request->input('patient_date_of_birth');
        $patient_date_of_birth = strtotime($patient_date_of_birth);
        $patient_date_of_birth = date('Y-m-d 00:00:00', $patient_date_of_birth);
        $emergency_contact = $request->input('emergency_contact');
        $emergency_contact_relation = $request->input('emergency_contact_relation');
        $admission_date = $request->input('admission_date');
        $admission_date = strtotime($admission_date);
        $admission_date = date('Y-m-d 00:00:00', $admission_date);

        $patients = DB::select("
            select concat(u.first_name,' ',u.last_name) as name,
            u.id, date_of_birth, emergency_contact, emergency_contact_relation,
            admission_date
            from users u
            join roles r on u.role = r.role_id
            where role = 3
            and (id = '{$patient_id}' or '{$patient_id}' = '')
            and (concat(u.first_name,' ',u.last_name) like '%{$patient_name}%' or '{$patient_name}' = '')
            and (date_of_birth = '{$patient_date_of_birth}' or '{$patient_date_of_birth}' = '1970-01-01 00:00:00')
            and (emergency_contact like '%{$emergency_contact}%' or '{$emergency_contact}' = '')
            and (emergency_contact_relation like '%{$emergency_contact_relation}%' or '{$emergency_contact_relation}' = '')
            and (admission_date = '{$admission_date}' or '{$admission_date}' = '1970-01-01 00:00:00')
        ");

        return view('patients', ['patients' => $patients]);
    })->name('patient-search');
    Route::get('/patients', function () {
        $patients = DB::select("
            select concat(u.first_name,' ',u.last_name) as name,
            u.id, date_of_birth, emergency_contact, emergency_contact_relation,
            admission_date
            from users u
            join roles r on u.role = r.role_id
            where role = 3
        ");

        return view('patients', ['patients' => $patients]);
    })->name('patients');
    Route::view('additional', 'additional')->name('additional');
    Route::post('/get-patient-name', function (Request $request) {
        $id = $request->input('patientID');
        $patient = DB::select('
            select * from users
            where id = ' . $id . ' AND role = 3;
        ');
        return view('additional', ['patient' => $patient]);
    })->name('get-patient-name');
    Route::post('/update-patient-info', function (Request $request) {
        $id = $request->input('patientID');
        $patient = User::findOrFail($id);
        $patient->group = $request->input('patientGroup');
        $patient->admission_date = $request->input('admissionDate');
        $patient->save();
        return view('additional');
    })->name('update-patient-info');
    Route::view('payment', 'payment')->name('payment');
    Route::POST('/employee-new-salary', function (Request $request) {
        $employee_id = $request->input('employee_id');
        $new_salary = $request->input('new_salary');

        DB::update("
            update users
            set salary = '{$new_salary}'
            where id = '{$employee_id}'
            and role in(1, 2, 4, 5)
        ");

        return redirect('/employee-list');
    })->name('employee-new-salary');
    Route::post('/employee-search', function (Request $request) {
        $employee_id = $request->input('employee_id');
        $employee_name = $request->input('employee_name');
        $employee_roll = $request->input('employee_roll');
        $employee_salary = $request->input('employee_salary');

        if ($employee_salary === null) {
            if ($employee_id === null) {
                $employees = DB::select("
                    select concat(u.first_name,' ',u.last_name) as name,
                    u.id, r.role_name as role, u.salary
                    from users u
                    join roles r on u.role = r.role_id
                    where concat(u.first_name,' ',u.last_name) like '%{$employee_name}%'
                    and r.role_name like '%{$employee_roll}%'
                ");
            } else {
                $employees = DB::select("
                    select concat(u.first_name,' ',u.last_name) as name,
                    u.id, r.role_name as role, u.salary
                    from users u
                    join roles r on u.role = r.role_id
                    where u.id = '{$employee_id}'
                    and concat(u.first_name,' ',u.last_name) like '%{$employee_name}%'
                    and r.role_name like '%{$employee_roll}%'
                ");
            }
        } else {
            if ($employee_id === null) {
                $employees = DB::select("
                    select concat(u.first_name,' ',u.last_name) as name,
                    u.id, r.role_name as role, u.salary
                    from users u
                    join roles r on u.role = r.role_id
                    where concat(u.first_name,' ',u.last_name) like '%{$employee_name}%'
                    and r.role_name like '%{$employee_roll}%'
                    and u.salary = '{$employee_salary}'
                ");
            } else {
                $employees = DB::select("
                    select concat(u.first_name,' ',u.last_name) as name,
                    u.id, r.role_name as role, u.salary
                    from users u
                    join roles r on u.role = r.role_id
                    where u.id = '{$employee_id}'
                    and concat(u.first_name,' ',u.last_name) like '%{$employee_name}%'
                    and r.role_name like '%{$employee_roll}%'
                    and u.salary = '{$employee_salary}'
                ");
            }
        }
        return view('employee-list', ['employees' => $employees]);
    })->name('employee-search');
    Route::get('/employee-list', function () {
        $employees = DB::select("
            select concat(u.first_name,' ',u.last_name) as name,
            u.id, r.role_name as role, u.salary
            from users u
            join roles r on u.role = r.role_id
            where role in(1, 2, 4, 5)
        ");
        return view('employee-list', ['employees' => $employees]);
    })->name('employee-list');
    Route::post('/set-roster', function (Request $request) {
        $date = $request->input('roster_date');
        $date = strtotime($date);
        $date = date('Y-m-d 00:00:00', $date);
        // $date = date('m/d/Y', $date);
        $date = ['date' => $date];
        $supervisor = $request->input('supervisor'); // null
        // Update roster
        $roster = DB::select("
            select * from rosters
            where roster_date = '{$date['date']}'
        ");
        // If the array has length 0 there is nothing there,
        // insert new into rosters table
        $values = array_values($request->input());
        $keys = array_keys($request->input());
        for ($i = 2; $i < count($request->input()); $i++) {
            // See if the value already exists in the database
            $exists = DB::select("
                select * from rosters
                where roster_date = '{$date['date']}'
                and role = '{$keys[$i]}'
            ");
            $roster = new Roster;
            $roster->roster_date = $date['date'];
            switch ($i) {
                case $i === 2:
                    $roster->role = $keys[$i];
                    $roster->personnel_name = $values[$i];
                    break;
                case $i === 3:
                    $roster->role = $keys[$i];
                    $roster->personnel_name = $values[$i];
                    break;
                case $i === 4:
                    $roster->role = $keys[$i];
                    $roster->personnel_name = $values[$i];
                    break;
                case $i === 5:
                    $roster->role = $keys[$i];
                    $roster->personnel_name = $values[$i];
                    break;
                case $i === 6:
                    $roster->role = $keys[$i];
                    $roster->personnel_name = $values[$i];
                    break;
                case $i === 7:
                    $roster->role = $keys[$i];
                    $roster->personnel_name = $values[$i];
                    break;
            }
            // If nothing exists in database then add it,
            // Else save it
            if (count($exists) == 0) {
                $roster->save();
            } else {
                DB::update("
                    update rosters
                    set personnel_name = '{$values[$i]}'
                    where role = '{$keys[$i]}'
                    and roster_date = '{$date['date']}'
                ");
            }
        }
        // Roster to return
        $roster = DB::select("
            select * from rosters
            where roster_date = '{$date['date']}'
        ");
        // return(var_dump($roster));
        // Get list of supervisors
        $supervisors = DB::select("
            select concat(first_name,' ',last_name) as name,
            id from users u
            join roles r on u.role = r.role_id
            where r.role_name = 'Supervisor'
        ");
        // Get list of caretakers
        $caregivers = DB::select("
            select concat(first_name,' ',last_name) as name,
            id from users u
            join roles r on u.role = r.role_id
            where r.role_name = 'Caregiver'
        ");
        // Get list of doctors
        $doctors = DB::select("
            select concat(first_name,' ',last_name) as name,
            id from users u
            join roles r on u.role = r.role_id
            where r.role_name = 'Doctor'
        ");
        return view('set-roster', ['roster' => $roster])
            ->with('date', $date)
            ->with('caregivers', $caregivers)
            ->with('doctors', $doctors)
            ->with('supervisors', $supervisors);
    })->name('set-roster');
    Route::get('/get-roster/', function (Request $request) {
        $date = $request->input('roster_date');
        $date = strtotime($date);
        $date = date('Y-m-d 00:00:00', $date);
        $date = ['date' => $date];
        $roster = DB::select("
            select * from rosters
            where roster_date = '{$date['date']}'
        ");
        // Get list of supervisors
        $supervisors = DB::select("
            select concat(first_name,' ',last_name) as name,
            id from users u
            join roles r on u.role = r.role_id
            where r.role_name = 'Supervisor'
        ");
        // Get list of caretakers
        $caregivers = DB::select("
            select concat(first_name,' ',last_name) as name,
            id from users u
            join roles r on u.role = r.role_id
            where r.role_name = 'Caregiver'
        ");
        // Get list of doctors
        $doctors = DB::select("
            select concat(first_name,' ',last_name) as name,
            id from users u
            join roles r on u.role = r.role_id
            where r.role_name = 'Doctor'
        ");
        $return = (int)$request->input('is-view-roster');
        if ($return === 1) {
            return view('view-roster', ['roster' => $roster])
                ->with('date', $date)
                ->with('caregivers', $caregivers)
                ->with('doctors', $doctors)
                ->with('supervisors', $supervisors);
        } else {
            return view('set-roster', ['roster' => $roster])
                ->with('date', $date)
                ->with('caregivers', $caregivers)
                ->with('doctors', $doctors)
                ->with('supervisors', $supervisors);
        }
    })->name('get-roster');
    Route::get('/view-set-roster', function () {
        // Get latest roster date
        $roster = DB::select("
            select * from rosters
            where roster_date = (
                select roster_date from rosters
                order by roster_date desc
                limit 1
            )
        ");
        // Get latest date roster is set for
        $date = DB::select("
            select roster_date from rosters
            order by roster_date desc
            limit 1
        ");
        // Get list of supervisors
        $supervisors = DB::select("
            select concat(first_name,' ',last_name) as name,
            id from users u
            join roles r on u.role = r.role_id
            where r.role_name = 'Supervisor'
        ");
        // Get list of caretakers
        $caregivers = DB::select("
            select concat(first_name,' ',last_name) as name,
            id from users u
            join roles r on u.role = r.role_id
            where r.role_name = 'Caregiver'
        ");
        // Get list of doctors
        $doctors = DB::select("
            select concat(first_name,' ',last_name) as name,
            id from users u
            join roles r on u.role = r.role_id
            where r.role_name = 'Doctor'
        ");
        try {
            $date = (array)array_values($date)[0];
        } catch (Exception $ex) {
            $date = $date;
        }
        return view('set-roster', ['roster' => $roster])
            ->with('date', $date)
            ->with('caregivers', $caregivers)
            ->with('doctors', $doctors)
            ->with('supervisors', $supervisors);
    })->name('view-set-roster');
    Route::get('/view-roster', function () {
        $roster = DB::select("
            select * from rosters
            where roster_date = (
                select roster_date from rosters
                order by roster_date desc
                limit 1
            )
        ");
        // return var_dump($roster);
        $date = DB::select("
            select roster_date from rosters
            order by roster_date desc
            limit 1
        ");
        try {
            $date = (array)array_values($date)[0];
        } catch (Exception $ex) {
            $date = $date;
        }
        return view('view-roster', ['roster' => $roster])
            ->with('date', $date);
    })->name('view-roster');
    Route::view('admin-report', 'admin-report')->name('admin-report');
});

require __DIR__ . '/auth.php';
