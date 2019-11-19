<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     
    public function index()
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $emplo = Employee::where('user_id',$id)->first();
            if($emplo)
                return view('Employee.home',compact('user','emplo'));
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/');
        }
    }
}
