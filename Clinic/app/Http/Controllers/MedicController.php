<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Medic;
use App\Client;
use App\Specialty;
use App\Appointment;


use App\User;


use Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\MedicResource;
use App\Http\Resources\MedicAppointmentResource;

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

    public function MedicCalendar($id){
        $user = Auth::user();
        if($user){
            $idC = $user->id;
            
            $medico = Medic::where('user_id',$id)->first();
            $appointments = MedicAppointmentResource::collection(Appointment::where('medic_id', $medico->id)->latest('date')->get());
            
            return response()->json([
                'success' => true,
                'appointments' => $appointments
            ], 201);     
            
        }else{
                return redirect('/');
            }
    }
    
    

    public function clientMedic($id){
        $user = Auth::user();
        if($user){
            $idC = $user->id;
            $client = Client::where('user_id',$idC)->first();
            if($client){                
                $getMedic =  new MedicResource(Medic::with('specialty')
                ->where('user_id',$id)
                ->first());
                $medico = Medic::where('user_id',$id)->first();
                $appointments = MedicAppointmentResource::collection(Appointment::where('medic_id', $medico->id)->latest('date')->get());
               
                if($getMedic)
                  return view('Client.medic', compact('user', 'getMedic','appointments'));
                else
                    return redirect('/client/appointment');
            }
            else{
                return redirect('/');
            }
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

    public function EmployeeMedic($id){
        $user = Auth::user();
        if($user){
            $medico = Medic::with('specialty')
            ->where('medics.id',$id)
            ->first();

            if($medico){
                $getMedic = new MedicResource($medico);
            }
            else{
                $getMedic = new MedicResource(Medic::with('specialty')
                    ->where('user_id',$id)
                    ->first());
            }
           
            $appointments = MedicAppointmentResource::collection(Appointment::where('medic_id', $getMedic->id)->latest('date')->get());

            
            if($getMedic)
                return view('Employee.singleMedic',compact('user','getMedic','appointments'));
            else
                return redirect('/employee/medic');
        }
        else{
            return redirect('/');
        }
    }

    public function EmployeeMedicAppoint($id){
        $user = Auth::user();
        if($user){
            $getMedic = new MedicResource(Medic::with('specialty')
            ->where('user_id',$id)
            ->first());
           
            if($getMedic)
                return view('Employee.appointmentMedic',compact('user','getMedic'));
            else
                return redirect('/employee');
        }
        else{
            return redirect('/');
        }
    }
     
     
    public function medicSearch(Request $request){
        
        $user = Auth::user();
        if($user){
            $id = $user->id;
                    $esp = $request->esp;
                    $medic = $request->medic;
                    $order = "";
                    $type = "";
                    if($request->order ==1){
                        $order = "rating";
                        $type = "desc";
                    }
                    elseif($request->order ==2)
                    {
                        $order = "rating";
                        $type = "asc";
                    }
                    elseif($request->order ==3){
                        $order = "name";
                        $type = "asc";
                    }
                    else{
                        $order = "name";
                        $type = "desc";
                    }
                    
                    if(!empty($medic)){
                        $medicos = MedicResource::collection(Medic::leftJoin('users', 'medics.user_id', '=', 'users.id')
                       ->where('users.name',$medic)
                       ->get());
                       return $medicos;
                    }

                    if(!empty($esp)){
                        if($order ==="rating"){
                            $medicos = MedicResource::collection(Medic::leftjoin('specialties', 'medics.specialty_id', '=', 'specialties.id')
                            ->leftjoin('users', 'medics.user_id', '=', 'users.id')
                            ->where('specialties.specialty',$esp)
                            ->orderBy($order, $type)
                            ->orderBy('name', 'asc')
                            ->get());
                        }
                        else{
                            $medicos = MedicResource::collection(Medic::leftjoin('specialties', 'medics.specialty_id', '=', 'specialties.id')
                            ->leftjoin('users', 'medics.user_id', '=', 'users.id')
                            ->where('specialties.specialty',$esp)
                            ->orderBy($order, $type)
                            ->get());
                        }

                        return $medicos;
                    }
                    else{
                        if($order ==="rating"){
                            $medicos = MedicResource::collection(Medic::leftJoin('users', 'medics.user_id', '=', 'users.id')
                            ->orderBy($order, $type)
                            ->orderBy('name', 'asc')
                            ->get());
                        }
                        else{
                            $medicos = MedicResource::collection(Medic::leftJoin('users', 'medics.user_id', '=', 'users.id')
                            ->orderBy($order, $type)
                            ->get());
                        }
                        return $medicos;
                    }
        }
        else{
            return redirect('/');
        }
    }
 

}
