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
use App\State;
use App\Http\Resources\SpecialtyResource;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\StateResource;

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
                      
                       $appointments = AppointmentResource::collection(Appointment::with('client')->with('medic')->with('state')
                       ->latest('date')
                       
                       ->get());
                      // return $appointments;
                       return view('Employee.appointment',compact('user','medicos','appointments'));
                }
                else{
                    return redirect('/');
                }
        }
        else{
            return redirect('/');
        }
    }

    public function singleAppointment($id)
    {
        $user = Auth::user();
        if($user){
            $ids = $user->id;
            $client = Employee::where('user_id',$ids)->first();
                if($client){
                                             
                    $appointments = new AppointmentResource(Appointment::where('id',$id)->with('client')->with('medic')->with('state')
                    ->first());
                    
                    if($appointments){

                        return response()->json([
                            'success' => true,
                            'message' =>  $appointments,
                        ], 201);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => "Nao existe",
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

    public function employeeChangeStatus(Request $request)
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $emplo = Employee::where('user_id',$id)->first();
            if($emplo){
                $anal = Appointment::where('id',$request->id)->update(['state_id' => $request->state_id]);   
                if($anal){
                    $ids = $request->state_id;
                    $an = State::find($ids);
                   
                    return response()->json([
                        'success' => true,
                        'message' =>  new StateResource($an),
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

/*
    {
            id: 3,
            date: "2019-11-30 16:15:06",
            state: "Em espera",
            comments: "Nao gosto dele",
            rating: 3,
            client: {
            name: "Deusivaldo Jesus",
            email: "client2@gmail.com"
            },
            medic: {
            id: 1,
            name: "Bonifacio Pedra",
            specialty: "pernas",
            rating: 5
}
},

*/