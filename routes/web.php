<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', function () {
    return view('login');
});


// Login Route
Route::view("login",'/login');
Route::post('user_login',[MainController::class,'userLogin']);

// Logout
Route::get('/logout', function () {
    if(session('user')){
        session()->pull('user');
    }
    return redirect('login');
});

// Registeration Route
Route::view("register",'/register');
Route::post('user_register',[MainController::class,'userReg']);

// Dashboard
Route::view('dashboard','dashboard');

// Create Appointment
Route::get('create_appointment',[MainController::class,'createAppointment']);
Route::post('create_appointment_form',[MainController::class,'createAppointmentForm']);

// Doctor Availibility
// Route::view('availibility','availibility');
Route::post('submit_form',[MainController::class,'addAvailibility']);
Route::get('availibility',[MainController::class,'showAvailibility']);

// Doctor Appointment Details
Route::get("show_doctor_appointment",[MainController::class,'showDoctorAppointment']);

// Patient Appointment Details
Route::get("show_patient_appointment",[MainController::class,'showPatientAppointment']);