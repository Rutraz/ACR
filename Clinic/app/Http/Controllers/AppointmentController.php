<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MedicResource;
use App\Medic;
use DB;
use App\Employee;
use App\Client;
use App\Appointment;
use App\Specialty;
use App\Http\Resources\SpecialtyResource;
use Validator;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function client()
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
                if($client){
                       return view('Client.appointment',compact('user'));
                }
                else{
                    return redirect('/');
                }
        }
        else{
            return redirect('/');
        }
    }

    public function clientSearch(Request $request){
        
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
                if($client){
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
        else{
            return redirect('/');
        }
    }
    
    
    public function clientMedic($id){
        $user = Auth::user();
        if($user){
            $idC = $user->id;
            $client = Client::where('user_id',$idC)->first();
            if($client){
                $medicos = MedicResource::collection(Medic::leftjoin('specialties', 'medics.specialty_id', '=', 'specialties.id')
                ->where('user_id',$id)
                ->get());
                
                if($medicos)
                    return view('Client.medic',compact('user','medicos'));
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


    public function employee()
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $client = Employee::where('user_id',$id)->first();
                if($client){
                       $medicos = MedicResource::collection(Medic::leftJoin('users', 'medics.user_id', '=', 'users.id')
                       ->orderBy('name', 'asc')
                       ->get());
                       //return $medicos;
                       return view('Employee.appointment',compact('user','medicos'));
                }
                else{
                    return redirect('/');
                }
        }
        else{
            return redirect('/');
        }
    }

    public function modifyComment(Request $request){
        $user = Auth::user();
        if($user){
            $ids = $user->id;
            $client = Client::where('user_id',$ids)->first();
            if($client){
                
                $validator = Validator::make($request->all(), [
                        'comment' => 'required|string|max:255',]);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' =>  $validator->errors(),
                    ], 201);
                }else{
                    
                    $message = Appointment::where('id',$request->id)->update(['comments' => $request->comment]);   
                    if($message){

                        return response()->json([
                            'success' => true,
                            'message' =>  $request->comment,
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
        }
        else{
            return redirect('/');
        }
    }

    public function modifyRating(Request $request){
        $user = Auth::user();
        if($user){
            $ids = $user->id;
            $client = Client::where('user_id',$ids)->first();
            if($client){
                
                $validator = Validator::make($request->all(), [
                        'rating' => 'required|string|regex:/[1-5]{1}/',]);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' =>  $validator->errors(),
                    ], 201);
                }else{
                    
                    $message = Appointment::where('id',$request->id)->update(['rating' => $request->rating]);   
                    if($message){

                        return response()->json([
                            'success' => true,
                            'message' =>  $request->rating,
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
        }
        else{
            return redirect('/');
        }
    }



}
