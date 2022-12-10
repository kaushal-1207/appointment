<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Availibility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    //
    public function userReg(Request $request)
    {
        $rules = array(
            'demail' => 'unique:users,email',
            'dmobile' => 'unique:users,mobile',
        );
        $val = Validator::make($request->all(), $rules);
        if ($val->fails()) {
            $msg = "Email or Mobile has Already been Taken";
            $request->session()->flash('message', $msg);
        } else {
            $doctor_details = new User();
            $role = $request->utype;
            if ($role == 'Patient') {
                $doctor_details->address = $request->address;
            } else {
                $doctor_details->address = null;
            }
            $doctor_details->name = $request->dname;
            $doctor_details->email = $request->demail;
            $doctor_details->mobile = $request->dmobile;
            $doctor_details->user_id = uniqid();
            $doctor_details->role = $request->utype;
            $password = $request->pass;
            $confirm_pass = $request->repeatpass;
            if ($password == $confirm_pass) {
                $doctor_details->password = Hash::make($request->pass);
                $saveData = $doctor_details->save();
                if ($saveData) {
                    $msg = "Data Added Successfully";
                    $request->session()->flash('message', $msg);
                } else {
                    $msg = "Something went wrong to Save Data";
                    $request->session()->flash('message', $msg);
                }
            } else {
                $msg = "Password & Confirm Password Not Match";
                $request->session()->flash('message', $msg);
            }
        }
        return redirect('register');
    }

    public function userLogin(Request $request)
    {
        $role = $request->input('utype');
        $email = $request->input('email');
        $name = User::where('email', $email)->pluck('name')->all();
        $userid = User::where('email', $email)->pluck('user_id')->all();
        $user_data = array(
            'role' => $request->get('utype'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        );

        if (Auth::attempt($user_data)) {
            $request->session()->put('user', ['user_name' => implode($name), 'role' => $role, 'email' => $email, 'user_id' => implode($userid)]);
            if($role == 'Patient')
            {
                $checkApointments = DB::table('appointments')->where('p_id', '=', $userid)->first();
                if($checkApointments)
                {
                    session()->put('patient_appointment','Available');
                }
                else
                {
                    session()->put('patient_appointment','Not Available');
                }
            }
            return redirect('dashboard');
        } else {
            $msg = "Invalid Information";
            $request->session()->flash('message', $msg);
            return redirect('login');
        }
    }

    public function createAppointment()
    {
        if(session('user'))
        {
            $data = User::where('role', 'Doctor')->get();
            return view('create_appointment', ['doctordetails' => $data]);
        }
        else{
            return view('login');
        }
        
    }

    public function createAppointmentForm(Request $request)
    {
        if(session('user'))
        {
            $p_name = session()->get('user')['user_name'];
            $p_id = session()->get('user')['user_id'];
            $checkApointments = DB::table('appointments')->where([
                ['p_id', '=', $p_id],
                ['d_id', '=', $request->doctor_id],
                ['date', '=', $request->a_date],
                ['time', '=', $request->time_slot]])->first();
            if ($checkApointments) {
                $msg = "Appointment with this Doctor is Already Exists";
                $request->session()->flash('message', $msg);
                return redirect('create_appointment');
            }
            $checkAvailibility = DB::table('availibilities')->where([
                ['d_id', '=', $request->doctor_id],
                ['date', '=', $request->a_date],
                ['time', '=', $request->time_slot],
            ])->first();
            if ($checkAvailibility) {
                $formData = new Appointments();
                $d_name = User::where('user_id', $request->doctor_id)->pluck('name')->first();
                $p_mobile = User::where('user_id', $p_id)->pluck('mobile')->first();
                $p_addr = User::where('user_id', $p_id)->pluck('address')->first();
                $formData->p_id = $request->p_id;
                $formData->p_name = $p_name;
                $formData->p_mobile = $p_mobile;
                $formData->p_addr = $p_addr;
                $formData->d_id = $request->doctor_id;
                $formData->d_name = $d_name;
                $formData->date = $request->a_date;
                $formData->time = $request->time_slot;
                $saveData = $formData->save();
                if ($saveData) {
                    $msg = "Appointment Created... !";
                    $request->session()->flash('message', $msg);
                    $request->session()->put('patient_appointment','Available');
                } else {
                    $msg = "Something went wrong";
                    $request->session()->flash('message', $msg);
                }
                
            } else {
                $msg = "Doctor is not Available at this Time Slot... !";
                $request->session()->flash('message', $msg);
                return redirect('create_appointment');
            }
            return redirect('show_patient_appointment');
        }
        else{
            return redirect()->back('login');
        }
    }

    public function addAvailibility(Request $request)
    {
            $formData = new Availibility();
            $formData->d_id = $request->d_id;
            $formData->date = $request->date;
            $formData->time = $request->time;
            $saveData = $formData->save();
            if ($saveData) {
                $msg = "Data Added... !";
                $request->session()->flash('message', $msg);
            } else {
                $msg = "Something went wrong";
                $request->session()->flash('message', $msg);
            }

        return redirect('availibility');
    }

    public function showDoctorAppointment()
    {
        $doctor_id = session()->get('user')['user_id'];
        $details = Appointments::where('d_id', $doctor_id)->get();
        return view('show_doctor_appointment',['appointmentdetails'=>$details]);
    }

    public function showPatientAppointment()
    {
        $patient_id = session()->get('user')['user_id'];
        $details = Appointments::where('p_id', $patient_id)->get();
        return view('show_patient_appointment',['appointmentdetails'=>$details]);
    }

    public function showAvailibility()
    {
        $doctor_id = session()->get('user')['user_id'];
        $a_details = Availibility::where('d_id', $doctor_id)->get();
        return view('availibility',['availibilitydetails'=>$a_details]);
    }
}
