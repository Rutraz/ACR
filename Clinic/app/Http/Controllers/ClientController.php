<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Client;

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

    public function profile()
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();;
                if($client){
                    $appointments = $client->appointment;
                    return view('Client.profile',compact('user','client','appointments'));
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
