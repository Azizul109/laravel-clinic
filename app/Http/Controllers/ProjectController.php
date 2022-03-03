<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Appointment;
use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    //
    // public function getData(Request $request){

    //     $data = "";
    //     return view('index', ['data'=>$data]);
    // }

    public function getAllDepartments(Request $request) {
        $departments = Department::all();
        return view('index', ['departments'=>$departments]);
    }

    public function showAppointments(Request $request){
        $department_id = $request->input('department_id');
        $appointments = Appointment::where('department_id', $department_id)->get();
        return view('appointments', ['appointments'=>$appointments]);
    }

    public function bookAppointment(Request $request){
        $appointment_id = $request->input('appointment_id');
        $department_name = $request->input('department_name');
        $appointment_date = $request->input('appointment_date');

        $exists = Booking::where('appointment_id', $appointment_id)->exists();

        if($exists){
            Session::flash('message', 'Appointment was already booked');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }else{  
            $booking = new Booking;
            $booking->appointment_id = $appointment_id;
            $booking->department_name = $department_name;
            $booking->appointment_date = $appointment_date;
            $booking->username = Auth::user()->name;
            $booking->user_id = Auth::user()->id;

            $booking->save();

            Appointment::where('id', $appointment_id)->update(['taken'=>1]);

            Session::flash('message', 'Appointment booked successfull');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
    }

    public function myBookings(request $request){
        $bookings = Booking::where('user_id', Auth::user()->id)->get();
        return view('myBookings', ['bookings' => $bookings]);
    }
}
