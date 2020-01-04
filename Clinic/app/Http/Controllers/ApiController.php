<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Medic;
use App\Employee;
use App\Client;
use App\Appointment;
use App\Analysis;
use App\Specialty;

use DB;
use Validator;

use Illuminate\Support\Facades\Hash;
use App\Http\Resources\MedicResource;
use App\Http\Resources\MedicAppointmentResource;
use App\Http\Resources\ClientAppointmentResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\AnalysisResource;
use App\Http\Resources\SpecialtyResource;
use App\Http\Resources\EmployeeResource;


class ApiController extends Controller
{

    // TODOS OS MEDICOS
    public function getAllMedic(){
        return MedicResource::collection(Medic::all());
    }

    public function getAllMedicOrdered(){
        $medicos = MedicResource::collection(Medic::leftJoin('users', 'medics.user_id', '=', 'users.id')
        ->orderBy('rating', 'desc')
        ->orderBy('name', 'asc')
        ->get());
        if($medicos)
            return $medicos;
        else{
            return response()->json([
                'success' => false,
                'message' => 'No medic found'
            ], 404);;
        }
    }

    
    public function getAllMedicBySpec(){
        $medicos = SpecialtyResource::collection(Specialty::orderBy("specialty","asc")->get());
        if($medicos)
            return $medicos;
        else{
            return response()->json([
                'success' => false,
                'message' => 'No medic found'
            ], 404);;
        }
    }

    // APENAS UM MEDICO COM O ID=X
    public function getMedicSingle($id){
        $medico = Medic::find($id);
        if($medico)
            return new MedicResource($medico);
        else{
            return response()->json([
                'success' => false,
                'message' => 'No medic found'
            ], 404);;
        }
        }

    //APENAS UM CLIENTE COM ID=X
    public function getClientSingle($id){
        $client = Client::find($id);
        if($client)
            return new ClientResource($client);
        else{

            return response()->json([
                'success' => false,
                'message' => 'No client found'
            ], 404);;
        }
    }

    public function getClientSingleUser($id){
        $client = Client::where('user_id',$id)->first();
        if($client)
            return new ClientResource($client);
        else{

            return response()->json([
                'success' => false,
                'message' => 'No client found'
            ], 404);;
        }
    }

    //CONSULTAS DO MEDICO COM ID=X
    public function getMedicAppoint($id){
        $medico = Medic::find($id);
        if($medico){
            return MedicAppointmentResource::collection(Appointment::where('medic_id', $medico->id)->latest('date')->paginate(10));
        }
        else{

            return response()->json([
                'success' => false,
                'message' => 'No medic appointments found'
            ], 404);
        }
    }

    //CONSULTAS DO CLIENTE COM ID=X
    public function getClientAppoint($id){
        $client = Client::find($id);
        if($client){
            return ClientAppointmentResource::collection(Appointment::where('client_id', $client->id)->latest('date')->paginate(10));
        }
        else{

            return response()->json([
                'success' => false,
                'message' => 'No client appointments found'
            ], 404);
        }
    }

    //CONSULTAS DO CLIENTE COM ID=X
    public function getClientAnalysis($id){
        $client = Client::find($id);
        if($client){
            return AnalysisResource::collection(Analysis::where('client_id', $client->id)->latest('date')->paginate(10));
        }
        else{

            return response()->json([
                'success' => false,
                'message' => 'No client appointments found'
            ], 404);
        }
    }

    //CREATE CLIENT
    public function createClient(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'cellphone' => 'required|string|regex:/^[0-9]{9}$/|unique:users',
            'CC' => 'required|string|regex:/^[0-9]{1,9}$/|unique:clients',
            'adse' => 'nullable|string|regex:/^[0-9]{1,10}$/',
            'morada' => 'required|string',
            'idade' => 'nullable|date'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'menssage' =>  $validator->errors(),
            ], 201);
        }
        else{

            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'cellphone' => $request->cellphone,
            ]);


            $client = Client::create([
                'user_id' =>  $user->id,
                'CC' =>  $request->CC,
                'adse' =>  $request->adse,
                'morada' => $request->morada,
                'idade' => $request->idade,
            ]);

            DB::commit();

            if($client)
                return new ClientResource($client);
            else{
                return response()->json([
                    'success' => false,
                'message' => 'Insert failed'
                ], 201);
            }   
        }
    }
    //Create Medic
    public function createMedic(Request $request){

        $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'cellphone' => 'required|string|regex:/^[0-9]{9}$/|unique:users',
                'adse' => 'nullable|string',
                'specialty' => 'required|string',
                'calendarid' =>  'required|string'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'menssage' =>  $validator->errors(),
            ], 201);
        }
        else{

            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'cellphone' => $request->cellphone,
            ]);

            $medic = Medic::create([
                'user_id' =>  $user->id,
                'specialty_id' => $request->specialty,
                'rating' => '0',
                'calendarid' =>  $request->calendarid,
                'adse' => $request->adse,  
            ]);

            DB::commit();

            if($medic)
                return new MedicResource($medic);
            else{
                return response()->json([
                    'success' => false,
                    'menssage' => 'Insert failed'
                ], 201);
            }         
        }
    }

    //Create Funcionario

    public function createEmployee(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'cellphone' => 'required|string|regex:/^[0-9]{9}$/|unique:users',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'menssage' =>  $validator->errors(),
        ], 201);
    }else{
        DB::beginTransaction();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cellphone' => $request->cellphone,
        ]);

        $employee = Employee::create([
            'user_id' =>  $user->id,
            'admin' => 0
        ]);

        DB::commit();

        if($employee)
                return new EmployeeResource($employee);
            else{
                return response()->json([
                    'success' => false,
                    'menssage' => 'Insert failed'
                ], 201);
            }      
    }

    }
}
