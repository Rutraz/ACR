<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Client;
use App\Employee;
use App\Analysis;
use Validator;
use App\Http\Resources\AnalysisEmployeeResource;


class AnalysisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function clientAnalysis()
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();;
            if($client){
                $analysis = Analysis::Select('*')->latest('date')->get();
                return view('Client.analysis',compact('user','client','analysis'));
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/');
        }
    }

    public function employeeAnalysis()
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $emplo = Employee::where('user_id',$id)->first();
            if($emplo){
                $analysis = AnalysisEmployeeResource::collection(Analysis::Select('*')->latest('date')->get());
              
                return view('Employee.analysis',compact('user','emplo','analysis'));
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
