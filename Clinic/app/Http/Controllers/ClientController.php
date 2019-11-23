<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Client;
use App\Analysis;
use App\Appointment;
use Validator;
use App\Http\Resources\ClientAppointmentResource;
use App\Http\Resources\ClientResource;


class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        if($user){
            return view('Client.home',compact('user'));
        }
        else{
            return redirect('/');
        }
    }
    
    public function getAllClients()
    {
        $user = Auth::user();
        if($user){
            $allusers = Client::all();
            return view('Employee.client',compact('user','allusers'));
        }
        else{
            return redirect('/');
        }
    }

    public function profile()
    {
        $user = Auth::user();
        if($user){           
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
                if($client){
                    //$appointments = Appointment::where('client_id', $client->id)->latest('date')->get(); APENAS TRAZ A TAbela consultas
                    $analysis = Analysis::where('client_id', $client->id)->latest('date')->get();
                    $appointments = ClientAppointmentResource::collection(Appointment::where('client_id', $client->id)->latest('date')->get());
                    return view('Client.profile',compact('user','client','appointments','analysis'));
                }
                else{
                    return redirect('/');
                }
        }
        else{
            return redirect('/');
        }
    }

}
