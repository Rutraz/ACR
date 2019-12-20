<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Validator;

use App\Employee;
use App\Medic;
use App\Client;
use App\User;


use App\Http\Resources\EmployeeResource;
use App\Http\Resources\MedicResource;
use App\Http\Resources\ClientResource;


class AdminController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        if($user){
            return view('Admin.home',compact('user'));
        }
        else{
            return redirect('/');
        }
    }

    public function getAllClients()
    {
        $user = Auth::user();
        if($user){
            $clients = ClientResource::collection(Client::all());
            return view('Admin.clients',compact('user','clients'));
        }
        else{
            return redirect('/');
        }
    }

    public function getAllMedics()
    {
        $user = Auth::user();
        if($user){
            $medicos = MedicResource::collection(Medic::all());
            return view('Admin.medics',compact('user','medicos'));
        }
        else{
            return redirect('/');
        }
    }
    public function getAllEmployees()
    {
        $user = Auth::user();
        if($user){
            $allemplos = EmployeeResource::collection(Employee::all());        
            return view('Admin.employees',compact('user','allemplos'));
        }
        else{
            return redirect('/');
        }
    }

    public function EraseClient($id){
        $user = Auth::user();
        if($user)
        {
            $client = Client::find($id);
            $userToDelete = User::find($client->user_id);
            $client->delete();
            $userToDelete->delete();
            return redirect("/admin/clients");
        }
        else{
            return redirect('/');
        }
    }

   
    public function EraseEmployee($id){
        $user = Auth::user();
        if($user)
        {
           
            $employee = Employee::find($id);
            $userToDelete = User::find($employee->user_id);
            $employee->delete();
            $userToDelete->delete();
            return redirect("/admin/employees");
        }
        else{
            return redirect('/');
        }
    }

    public function EraseMedic($id){
        $user = Auth::user();
        if($user)
        {
            $medic = Medic::find($id);
            $userToDelete = User::find($medic->user_id);
            $medic->delete();
            $userToDelete->delete();
            return redirect("/admin/medics");
        }
        else{
            return redirect('/');
        }
    }

    public function modifyEmployees(Request $request){
        $user = Auth::user();
       
        if($user){
            $id = $user->id;
            $emplo = Employee::where('user_id',$id)->first();

            if($emplo){

                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'cellphone' => 'required|string|regex:/^[0-9]{9}$/',
                    ]);   

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'menssage' =>  $validator->errors(),
                    ], 201);
                }else{
                                       
                    $employee = Employee::find($request->id);
                   
                    $user = User::where('id', $employee->user_id)->update([
                            'name' => $request ->name,
                            'email' => $request->email,
                            'cellphone' => $request->cellphone,                   
                            ]);
                 
                    if($user){
                        
                        return response()->json([
                            'success' => true,
                            'data' => new EmployeeResource($employee)
                        ], 201); 
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'menssage' => "Insert error",
                        ], 201);
                    }
                }
            }  
            else{
                return redirect('/');
                }      

            }else
                return redirect('/');
    }

    public function modifyMedic(Request $request){
        $user = Auth::user();
       
        if($user){
            $id = $user->id;
            $emplo = Employee::where('user_id',$id)->first();

            if($emplo){

                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'cellphone' => 'required|string|regex:/^[0-9]{9}$/',
                    'adse' => 'required|string|regex:/[0-1]{1}/',
                    'specialty_id' => 'required',
                    ]);   

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' =>  $validator->errors(),
                    ], 201);
                }else{
                                     
                    $medicos = Medic::find($request->id);

                    $medicUpdated = Medic::where('id',$request->id)->update([
                        'adse' => $request->adse,
                        'specialty_id' =>$request->specialty_id
                    ]);

                    $user = User::where('id', $medicos->user_id)->update([
                            'name' => $request ->name,
                            'email' => $request->email,
                            'cellphone' => $request->cellphone,                   
                            ]);
                    
                    $getMedico = Medic::find($request->id);
                    if($user){
                        
                        return response()->json([
                            'success' => true,
                            'data' => new MedicResource($getMedico)
                        ], 201); 
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => "Insert error",
                        ], 201);
                    }
                }
            }  
            else{
                return redirect('/');
                }      

            }else
                return redirect('/');
    }


   
}