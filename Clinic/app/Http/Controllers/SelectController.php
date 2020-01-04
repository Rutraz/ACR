<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Client;
use App\Employee;

class SelectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
            $emplo = Employee::where('user_id',$id)->first();
  
            if($client)
                return redirect('/client');
            else if($emplo){
                if($emplo->admin == 1)
                    return redirect('/admin');
                return redirect('/employee');
            }
            else
                return redirect('/');
            
        }
        else{
            return redirect('/');
        }
    }
    
   
}
