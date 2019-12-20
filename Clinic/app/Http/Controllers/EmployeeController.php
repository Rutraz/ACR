<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EmployeeResource;
use Validator;

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

    
    public function support()
    {
        $user = Auth::user();
        if($user){
            $allemplos = EmployeeResource::collection(Employee::all());        
            return view('Client.support',compact('user','allemplos'));
        }
        else{
            return redirect('/');
        }
    }

    
}
