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
                return view('Client.analysis',compact('user','client'));
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

    public function employeeChangeStatus(Request $request)
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $emplo = Employee::where('user_id',$id)->first();
            if($emplo){
                $anal = Analysis::where('id',$request->id)->update(['state_id' => $request->state_id]);   
                if($anal){
                    $ids = $request->id;
                    $analysis = Analysis::find($ids);
                   
                    return response()->json([
                        'success' => true,
                        'message' =>  new AnalysisEmployeeResource($analysis),
                    ], 201);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => "Insert error",
                    ], 201);
                }
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
