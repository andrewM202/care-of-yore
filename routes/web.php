<?php

// Added to query database
use App\Models\Medications;
// Model for roles
use App\Models\Roles;
// Model for users
use App\Models\Roster;
// Model for Medications
use App\Models\User;
// Model for appointments
use Illuminate\Http\Request;
// Model for roster
use Illuminate\Support\Facades\Auth;
// Get input from requests
use Illuminate\Support\Facades\DB;
//Auth
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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/approval', function () {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
        $users = DB::select('
            select * from users
            where approval = 0
        ');
        if (count($users) > 0) {
            return view('approval', ['users' => $users]);
        } else {
            return view('approval', ['users' => [] ]);
        }
    })->name('approval');

    Route::post('/approve-user', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
        $id = $request->input('id');
        $user = User::find($id);
        $user->approval = 1;
        $user->save();
        return redirect('/approval');
    })->name('approve-user');

    Route::post('/decline-user', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
        $id = $request->input('id');
        $user = User::where('id', $id)->delete();
        return redirect('/approval');
    })->name('decline-user');
    Route::get('/roles', function () {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1])) {
            return redirect('/');
        } 
        //
        $roles = DB::select('
            select * from roles;
        ');
        return view('roles', ['roles' => $roles]);
    })->name('roles');
    Route::post('/add-role', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1])) {
            return redirect('/');
        } 
        //
        $role = new Roles;
        $role->role_name = $request->input('newRole');
        $role->access_level = $request->input('accessLevel');
        $role->save();
        return redirect('/roles');
    })->name('add-role');
    Route::post('/delete-role', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1])) {
            return redirect('/');
        } 
        //
        $role_name = $request->input('roleName');
        $user = Roles::where('role_name', $role_name)->firstorfail()->delete();
        return redirect('/roles');
    })->name('delete-role');
    Route::get('dashboard', function () {
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
    Route::get('/patient-dashboard', function () {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 3])) {
            return redirect('/');
        } 
        //
        $patient_id = Auth::user()->id;
        $patient_name = DB::select("
            select concat(u.first_name,' ',u.last_name) as name
            from users u 
            where u.id = '{$patient_id}'
        ");
        $doctor = DB::select("
            select appointment_date, 
            concat(u.first_name,' ',u.last_name) as doctor_name
            from users u 
            join appointments a on a.patient_id = u.id
            where a.patient_id = '{$patient_id}'
            order by appointment_date desc
            limit 1
        ");
        $medicine = DB::select("
            select morning_med, afternoon_med, evening_med
            from medications
            where patient_id = '{$patient_id}'
            order by appointment_id desc
            limit 1
        ");
        $feed = DB::select("
            select breakfast, lunch, dinner
            from feed
            where patient_id = '{$patient_id}'
        ");
        $caregiver_name = DB::select("
            select concat(u.first_name,' ',u.last_name) as name
            from users u 
            where u.role = 5
            limit 1
        ");
        return view('patient-dashboard')
        ->with('patient_id', $patient_id)
        ->with('patient_name', $patient_name)
        ->with('doctor', $doctor)
        ->with(['medicine' => $medicine])
        ->with('caregiver_name', $caregiver_name)
        ->with(['feed' => $feed]);
    })->name('patient-dashboard');

    Route::get('doctor-dashboard', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 4])) {
            return redirect('/');
        } 
        //
        $doctor_id = Auth::user()->id;
        $currentDate = date('Y-m-d 00:00:00');
        $oldAppointments = DB::select("
            select distinct concat(u.first_name,' ',u.last_name) as patient_name,
            a.doctor_id, a.patient_id, a.appointment_date, m.morning_med, 
            m.afternoon_med, m.evening_med,
            a.appointment_id, m.comment
            from appointments a
            left outer join medications m
            on a.patient_id = m.patient_id and m.appointment_id = a.appointment_id
            inner join users u
            on a.patient_id = u.id
            where a.doctor_id = '{$doctor_id}'
            and a.appointment_date <= '{$currentDate}'
        ");
        
        $tillDate = $request->input('till-date');
        $tillDate = strtotime($tillDate);
        $tillDate = date('Y-m-d 00:00:00', $tillDate);
        if ($tillDate === null or $tillDate === '1970-01-01 00:00:00') {
            $tillDate = date('Y-m-d 00:00:00');
            $tillDate = date('Y-m-d 00:00:00', strtotime($tillDate . ' + 30 days'));
        }
        $appointmentsTill = DB::select("
            select concat(u.first_name,' ',u.last_name) as patient_name, appointment_date
            from appointments a
            join users u
            on a.patient_id = u.id
            where doctor_id = '{$doctor_id}'
            and appointment_date <= '{$tillDate}'
            and appointment_date >= '{$currentDate}'
        ");
        return view('doctor-dashboard', ['oldAppointments' => $oldAppointments])
            ->with('appointmentsTill', $appointmentsTill);
    })->name('doctor-dashboard');
    Route::post('update-meds', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 4])) {
            return redirect('/');
        } 
        //
        $morning_med = $request->input('morning_med');
        $afternoon_med = $request->input('afternoon_med');
        $evening_med = $request->input('evening_med');
        $patient_id = $request->input('patient_id');
        $comment = $request->input('comment');
        $appointment_id = $request->input('appointment_id');
        $med = DB::select("
            select * from medications
            where patient_id = '{$patient_id}'
            and appointment_id = '{$appointment_id}'
        ");
        if (!empty($med)) {
            DB::update("
                update medications m 
                set morning_med = '{$morning_med}', afternoon_med = '{$afternoon_med}', evening_med = '{$evening_med}',
                comment = '{$comment}'
                where patient_id = '{$patient_id}'
                and appointment_id = '{$appointment_id}'
            ");
        } else {
            DB::insert("
                insert into medications (patient_id, morning_med, afternoon_med, evening_med, comment, appointment_id)
                values ('{$patient_id}', '{$morning_med}', '{$afternoon_med}', '{$evening_med}', '{$comment}', '{$appointment_id}')
            ");
        }
        return redirect('/doctor-dashboard');
    })->name('update-meds');
    Route::post('/update-food', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 3, 4])) {
            return redirect('/');
        } 
        //
        $breakfast = $request->input('breakfast');
        $lunch = $request->input('lunch');
        $dinner = $request->input('dinner');
        $patient_id = $request->input('patient_id');
        $today = date('Y-m-d 00:00:00');
        $food = DB::select("
            select * from feed
            where patient_id = '{$patient_id}'
        ");
        if (!empty($food)) {
            DB::update("
                update feed
                set breakfast = '{$breakfast}',
                lunch = '{$lunch}',
                dinner = '{$dinner}'
                where patient_id = '{$patient_id}'
            ");
        } else {
            DB::insert("
                insert into feed (patient_id, date, breakfast, lunch, dinner)
                values({$patient_id}, '{$today}', '{$breakfast}', '{$lunch}', '{$dinner}')
            ");
        }
        return redirect('/caregiver-dashboard');
    })->name('update-food');
    Route::get('/caregiver-dashboard', function () {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 5])) {
            return redirect('/');
        } 
        //
        $date_today = date('Y-m-d');
        // return $date_today;
        $patients = DB::select("
            select distinct concat(u.first_name,' ',u.last_name) as patient_name,
            m.morning_med, m.afternoon_med, m.evening_med, a.appointment_date, u.id as patient_id,
            f.breakfast, f.lunch, f.dinner
            from users u
            left outer join medications m on u.id = m.patient_id
            left outer join appointments a on a.patient_id = u.id
            left outer join feed f on f.patient_id = u.id
            where a.appointment_date = '{$date_today}'
            and u.role = 3
        ");

        return view('caregiver-dashboard', ['patients' => $patients]);
    })->name('caregiver-dashboard');
    Route::post('/family-member-patient-details', function(Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 6])) {
            return redirect('/');
        } 
        //
        $date = $request->input('date');
        $family_code = $request->input('family_code');
        $patient_id = $request->input('patient_id');
        $exists = DB::select("
            select id from users
            where id = '{$patient_id}'
            and family_code = '{$family_code}'
        ");
        if(empty($exists)) {
            return view('family-member-dashboard')
            ->with('error', 'Error : Incorrect Combination');
        }
        if(!isset($date)) {
            $doctor = DB::select("
                select a.appointment_date,
                concat(u.first_name,' ',u.last_name) as doctor_name 
                from users u 
                inner join appointments a on a.doctor_id = u.id
                where a.patient_id = '{$patient_id}'
                order by a.appointment_date desc
                limit 1
            ");
            $caregiver = DB::select("
                select concat(u.first_name,' ',u.last_name) as caregiver_name
                from users u
                where role = 5
                limit 1
            ");
            $medicine = DB::select("
                select morning_med, afternoon_med, evening_med from medications
                where patient_id = '{$patient_id}'
            ");
            $feed = DB::select("
                select breakfast, lunch, dinner
                from feed
                where patient_id = '{$patient_id}'
            ");
        } else {
            $doctor = DB::select("
                select a.appointment_date,
                concat(u.first_name,' ',u.last_name) as doctor_name 
                from users u 
                inner join appointments a on a.patient_id = u.id
                where a.patient_id = '{$patient_id}'
                and a.appointment_date = '{$date}'
                order by a.appointment_date desc
                limit 1
            ");
            $caregiver = DB::select("
                select concat(u.first_name,' ',u.last_name) as caregiver_name
                from users u
                where role = 5
                limit 1
            ");
            $medicine = DB::select("
                select morning_med, afternoon_med, evening_med 
                from medications m
                inner join appointments a on m.patient_id = a.patient_id
                where patient_id = '{$patient_id}'
                and a.appointment_date = '{$date}'
            ");
            $feed = DB::select("
                select breakfast, lunch, dinner
                from feed
                where patient_id = '{$patient_id}'
                and date = '{$date}'
            ");
        }
        return view('family-member-dashboard')
        ->with(['doctor' => $doctor])
        ->with(['caregiver' => $caregiver])
        ->with(['medicine' => $medicine])
        ->with(['feed' => $feed]);
    })->name('family-member-patient-details');
    Route::get('/family-member-dashboard', function() {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 6])) {
            return redirect('/');
        } 
        //
        return view('family-member-dashboard');
    })->name('family-member-dashboard');
    Route::view('', 'welcome')->name('welcome');
    Route::get('/doctor-appointment', function () {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
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
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
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
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
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
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
        $appointment_date = $request->input('appointment_date');
        $appointment_date = strtotime($appointment_date);
        $appointment_date = date('Y-m-d 00:00:00', $appointment_date);
        $patient_id = $request->input('patient_id');
        $doctor_id = $request->input('doctors');

        DB::insert("
            insert into appointments
            (appointment_date, patient_id, doctor_id)
            values ('{$appointment_date}', '{$patient_id}', '{$doctor_id}')
        ");

        return redirect('/doctor-appointment');
    })->name('create-doctor-appointment');
    Route::post('/patient-search', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 4, 5])) {
            return redirect('/');
        } 
        //
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
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 4, 5])) {
            return redirect('/');
        } 
        //
        $patients = DB::select("
            select concat(u.first_name,' ',u.last_name) as name,
            u.id, date_of_birth, emergency_contact, u.emergency_contact_relation,
            admission_date
            from users u
            join roles r on u.role = r.role_id
            where role = 3
        ");

        return view('patients', ['patients' => $patients]);
    })->name('patients');
    Route::get('additional', function() {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
        return view('additional');
    })->name('additional');
    Route::post('/get-patient-name', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
        $id = $request->input('patientID');
        $patient = DB::select('
            select * from users
            where id = ' . $id . ' AND role = 3;
        ');
        return view('additional', ['patient' => $patient]);
    })->name('get-patient-name');
    Route::post('/update-patient-info', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
        $id = $request->input('patientID');
        $patient = User::findOrFail($id);
        $patient->group = $request->input('patientGroup');
        $patient->admission_date = $request->input('admissionDate');
        $patient->save();
        return view('additional');
    })->name('update-patient-info');
    Route::get('/payment-search', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1])) {
            return redirect('/');
        } 
        //
        $patient_id = $request->input('patient_id');
        $payments = DB::select("
            select concat(u.first_name,' ',u.last_name) as patient_name,
            total_due - total_paid as amount_left, p.payment_id,
            p.* from payments p
            inner join users u on p.patient_id = u.id
            where p.patient_id = '{$patient_id}'
        ");
        return view('payment', ['payments' => $payments]);
    })->name('payment-search');
    Route::post('modify-payment', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1])) {
            return redirect('/');
        } 
        //
        $payment_id = $request->input('patient_id');
        $total_due = $request->input('total_due');
        $total_paid = $request->input('total_paid');
        DB::update("
            update payments
            set total_due = '{$total_due}',
            total_paid = '{$total_paid}'
            where payment_id = '{$payment_id}'
        ");
        return redirect("payment");
    })->name('modify-payment');
    Route::post('/add-payment', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1])) {
            return redirect('/');
        } 
        //
        $patient_id = $request->input('patient_id');
        $total_due = $request->input('total_due');
        DB::insert("
            insert into payments (patient_id, total_due, total_paid)
            values('{$patient_id}', '{$total_due}', 0)
        ");
        return redirect("payment");
    })->name('add-payment');
    Route::get('/payment', function () {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1])) {
            return redirect('/');
        } 
        //
        $payments = DB::select("
            select concat(u.first_name,' ',u.last_name) as patient_name,
            total_due - total_paid as amount_left, p.payment_id,
            p.* from payments p
            inner join users u on p.patient_id = u.id
        ");
        return view('payment', ['payments' => $payments]);
    })->name('payment');
    Route::POST('/employee-new-salary', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
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
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
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
                    and u.role in(1, 2, 4, 5)
                ");
            } else {
                $employees = DB::select("
                    select concat(u.first_name,' ',u.last_name) as name,
                    u.id, r.role_name as role, u.salary
                    from users u
                    join roles r on u.role = r.role_id
                    where u.id = '{$employee_id}'
                    and concat(u.first_name,' ',u.last_name) like '%{$employee_name}%'
                    and r.role_name like '%{$employee_roll}%
                    and u.role in(1, 2, 4, 5)
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
                    and u.role in(1, 2, 4, 5)
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
                    and u.role in(1, 2, 4, 5)
                ");
            }
        }
        return view('employee-list', ['employees' => $employees]);
    })->name('employee-search');
    Route::get('/employee-list', function () {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
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
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
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
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 3, 4, 5, 6])) {
            return redirect('/');
        } 
        //
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
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2])) {
            return redirect('/');
        } 
        //
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
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1, 2, 3, 4, 5, 6])) {
            return redirect('/');
        } 
        //
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
    Route::get('/admin-report', function () {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1])) {
            return redirect('/');
        } 
        //
        $date = date('Y-m-d 00:00:00');
        $patients = DB::select("
            select distinct concat(u.first_name,' ',u.last_name) as patient_name,
            u.id as patient_id,
            appointments.appointment_date,
            doctor.doctor_name,
            caregiver.caregiver_name,
            medications.morning_med, 
            medications.afternoon_med,
            medications.evening_med,
            feed.breakfast,
            feed.lunch,
            feed.dinner
            from
            (
                select concat(u2.first_name,' ',u2.last_name) as caregiver_name
                from users u2
                where u2.role = 5
                limit 1
            ) as caregiver,
            users u
            left join lateral (
                select a.appointment_date, a.patient_id, a.doctor_id
                from appointments a
                where a.patient_id = u.id
                order by appointment_date desc
                limit 1
            ) as appointments on appointments.patient_id = u.id
            left join lateral ( 
                select m.morning_med, m.afternoon_med, m.evening_med,
                m.patient_id
                from medications m
                where m.patient_id = u.id
                limit 1
            ) as medications on medications.patient_id = u.id
            left join lateral (
                select f.breakfast, f.lunch, f.dinner, f.patient_id
                from feed f
                where f.patient_id = u.id
                limit 1 
            ) as feed on feed.patient_id = u.id
            left join lateral (
                select concat(u2.first_name,' ',u2.last_name) as doctor_name,
                u2.id as doctor_id
                from users u2
                where concat(u2.first_name,' ',u2.last_name) is not null
                and u2.id = appointments.doctor_id
                limit 1
            ) as doctor on doctor.doctor_id = appointments.doctor_id
            where u.role = 3
        ");
        
        return view('admin-report')
        ->with(['patients' => $patients]);
    })->name('admin-report');
    Route::get('/admin-report-by-id', function (Request $request) {
        // Route Authentication //
        if (!in_array(Auth::user()->role, [1])) {
            return redirect('/');
        } 
        //
        $patient_id = $request->input('patient_id');
        $patients = DB::select("
            select distinct concat(u.first_name,' ',u.last_name) as patient_name,
            u.id as patient_id,
            appointments.appointment_date,
            doctor.doctor_name,
            caregiver.caregiver_name,
            medications.morning_med, 
            medications.afternoon_med,
            medications.evening_med,
            feed.breakfast,
            feed.lunch,
            feed.dinner
            from
            (
                select concat(u2.first_name,' ',u2.last_name) as caregiver_name
                from users u2
                where u2.role = 5
                limit 1
            ) as caregiver,
            users u
            left outer join lateral (
                select a.appointment_date, a.patient_id, a.doctor_id
                from appointments a
                where a.patient_id = u.id
                order by appointment_date desc
                limit 1
            ) as appointments on appointments.patient_id = u.id
            left outer join lateral ( 
                select m.morning_med, m.afternoon_med, m.evening_med,
                m.patient_id
                from medications m
                where m.patient_id = u.id
                limit 1
            ) as medications on medications.patient_id = u.id
            left outer join lateral (
                select f.breakfast, f.lunch, f.dinner, f.patient_id
                from feed f
                where f.patient_id = u.id
                limit 1 
            ) as feed on feed.patient_id = u.id
            left outer join lateral (
                select concat(u2.first_name,' ',u2.last_name) as doctor_name,
                u2.id as doctor_id
                from users u2
                where concat(u2.first_name,' ',u2.last_name) is not null
                and u2.id = appointments.doctor_id
                limit 1
            ) as doctor on doctor.doctor_id = appointments.doctor_id
            where u.role = 3
            and u.id = '{$patient_id}'
        ");
        
        return view('admin-report')
        ->with(['patients' => $patients]);
    })->name('admin-report-by-id');
});

require __DIR__ . '/auth.php';
