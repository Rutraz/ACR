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
use App\User;
use App\Analysis;

use App\Http\Resources\SpecialtyResource;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\MedicAppointmentResource;
use App\Http\Resources\ClientAppointmentResource;
use App\Http\Resources\AnalysisResource;




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

    public function clientChangeStatus(Request $request)
    {
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $emplo = Client::where('user_id',$id)->first();
            if($emplo){
                $anal = Appointment::where('id',$request->id)->update(['state_id' => 5]);   
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
    
    public function createAppoint(Request $request, $id)
    {
        $user = Auth::user();
        if($user){
            $idc = $user->id;
          
            $client = Client::where('user_id',$idc)->first();

            $medic = Medic::where('user_id',$id)->first();
            if($client){

                $anal = new Appointment;
                $anal->client_id = $client->id;
                $anal->state_id = 2;
                $anal->date = $request->date;
                $anal->comments = "";
                $anal->rating = 0;
                $anal->medic_id = $medic->id;
                $anal->save();
                
                if($anal){                  
                    return response()->json([
                        'success' => true,
                        'message' =>  new MedicAppointmentResource($anal),
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

    public function createAppointEmployee(Request $request, $id)
    {
        $user = Auth::user();
        if($user){
            $idc = $user->id;
            $medic = Medic::where('user_id',$id)->first();

            $emplo = Employee::where('user_id',$idc)->first();
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

                    $anal = new Appointment;
                    $anal->client_id = $cli->id;
                    $anal->state_id = 3;
                    $anal->date = $request->date;
                    $anal->comments = "";
                    $anal->rating = 0;
                    $anal->medic_id = $medic->id;
                    $anal->save();
                    
                    if($anal){                  
                        return response()->json([
                            'success' => true,
                            'message' =>  new MedicAppointmentResource($anal),
                        ], 201);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => "Insert error",
                        ], 201);
                    }
                }else{
                    return response()->json([
                        'success' => false,
                        'messageNot' => "Cliente não encontrado",
                    ], 201); }
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

                    $singl = Appointment::find($request->id);

                    $appoint = Appointment::select('*')->where('medic_id',$singl->medic_id)->get();

                    $objectAveragePrice = $appoint->avg('rating');
                   

                    $medic = Medic::where('id',$singl->medic_id)->update(['rating' => $objectAveragePrice]);
                    
                    
                    if($message && $medic){

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

    public function EraseComment(Request $request){
        $user = Auth::user();
        if($user){
            $ids = $user->id;
            $client = Employee::where('user_id',$ids)->first();
            if($client){
                $comment = "Comentário eliminado";
                $message = Appointment::where('id',$request->id)->update(['comments' => $comment]);   
                if($message){

                    return response()->json([
                        'success' => true,
                        'message' =>  $comment,
                    ], 201);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => "Update error",
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


    public function CheckAppointClient(Request $request){
        $user = Auth::user();
        if($user){
            $ids = $user->id;
            $client = Client::where('user_id',$ids)->first();
            if($client){
               
                $appointments = ClientAppointmentResource::collection(Appointment::where('client_id', $client->id)->where('state_id', '<', 4)->latest('date')->get());
                $anal = AnalysisResource::collection(Analysis::where('client_id', $client->id)->where('state_id', '<', 4)->latest('date')->get());   

                if($appointments){

                    return response()->json([
                        'success' => true,
                        'data' =>  $appointments,
                        'anal' => $anal
                    ], 201);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' =>  "Nao tem modificações do estado",
                    ], 201);
                }
            }else{
                return redirect('/');
            }  
        }
        else{
            return redirect('/');
        }

    }
}
