<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MedicResource;
use App\Medic;
use DB;
use App\Employee;
use App\Client;
use App\Appointment;
use Validator;

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
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
                if($client){
                       $medicos = MedicResource::collection(Medic::leftJoin('users', 'medics.user_id', '=', 'users.id')
                       ->orderBy('rating', 'desc')
                       ->orderBy('name', 'asc')
                       ->get());
                       //return $medicos;
                       return view('Client.appointment',compact('user','medicos'));
                }
                else{
                    return redirect('/');
                }
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
