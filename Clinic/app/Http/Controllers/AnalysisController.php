<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Client;
use App\User;
use App\Employee;
use App\Analysis;
use Validator;
use App\Http\Resources\AnalysisEmployeeResource;
use App\Http\Resources\AnalysisResource;


class AnalysisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function returnAnalysis(){
        $user = Auth::user();
        if($user){
            return response()->json([
                'success' => true,
                'message' =>  AnalysisResource::collection(Analysis::Select('*')->latest('date')->get())
            ], 201);
        }
        else{
            return redirect('/');
        }
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

    public function clientChangeStatus(Request $request)
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $emplo = Client::where('user_id',$id)->first();
            if($emplo){
                $anal = Analysis::where('id',$request->id)->update(['state_id' => 5]);   
                if($anal){
                    return response()->json([
                        'success' => true,       
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

    public function createAnalysis(Request $request)
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
          
            $client = Client::where('user_id',$id)->first();
            if($client){

                $anal = new Analysis;
                $anal->client_id = $client->id;
                $anal->state_id = 2;
                $anal->date = $request->date;
                $anal->save();

                if($anal){                  
                    return response()->json([
                        'success' => true,
                        'message' =>  new AnalysisResource($anal),
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

    public function createEmployeeAnalysis(Request $request)
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $emplo = Employee::where('user_id',$id)->first();
            if($emplo){
  
                $validator = Validator::make($request->all(), [
                    'email' => 'required|string|email|max:255',
                    'cc' => 'required|string|regex:/^[0-9]{1,9}$/',
                ]);
            
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' =>  $validator->errors(),
                    ], 201);
                }
                $userCli = User::where('email',$request->email)->first();
                $cli = Client::where('cc',$request->cc)->where('user_id',$userCli->id)->first();
                if($cli ){
                    
                    $anal = new Analysis;
                    $anal->client_id = $cli->id;
                    $anal->state_id = 3;
                    $anal->date = $request->date;
                    $anal->save();

                    if($anal){                  
                        return response()->json([
                            'success' => true,
                            'message' =>  new AnalysisResource($anal),
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
                return response()->json([
                    'success' => false,
                    'messageNot' => "Cliente não encontrado",
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
