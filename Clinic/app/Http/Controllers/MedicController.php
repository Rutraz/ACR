<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Medic;

use Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\MedicResource;

class MedicController extends Controller
{
    public function getAllMedic(){
        $user = Auth::user();
        if($user){
            $medics = Medic::all();
            return view('Employee.medic',compact('user','medics'));
        }
        else{
            return redirect('/');
        }

    }

    public function schedule(){
        $user = Auth::user();
        if($user){
            return view('Employee.schedule',compact('user'));
        }
        else{
            return redirect('/');
        }
    }
}
