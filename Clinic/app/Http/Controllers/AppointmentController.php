<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function client()
    {
        $user = Auth::user();
        if($user){
            return view('Client.appointment',compact('user'));
        }
        else{
            return redirect('/');
        }
    }

    
    public function employee()
    {
        $user = Auth::user();
        if($user){
            return view('Employee.appointment',compact('user'));
        }
        else{
            return redirect('/');
        }
    }
}
