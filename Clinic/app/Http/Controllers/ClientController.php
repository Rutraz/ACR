<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Client;
use App\Analysis;
use App\Appointment;
use App\Employee;

use Validator;
use DB;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ClientAppointmentResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\AnalysisResource;


class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        if($user){
            return view('Client.home',compact('user'));
        }
        else{
            return redirect('/');
        }
    }
    
    public function getAllClients()
    {
        $user = Auth::user();
        if($user){
            return view('Employee.client',compact('user'));
        }
        else{
            return redirect('/');
        }
       
    }

    public function getAllCliApi(){
        $user = Auth::user();
        if($user){
            $clients = ClientResource::collection(Client::leftJoin('users', 'users.id','=','clients.user_id')->orderBy('name', 'asc')
            ->get());
            if($clients){
                return $clients;
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'No clients found'
                ], 404);;
            }
        }
        else{
            return redirect('/');
        }
    }

    public function profile()
    {
        $user = Auth::user();
        if($user){           
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
                if($client){
                    $analysis = AnalysisResource::collection(Analysis::where('client_id', $client->id)->latest('date')->get());
                    $appointments = ClientAppointmentResource::collection(Appointment::where('client_id', $client->id)->latest('date')->get());
                    return view('Client.profile',compact('user','client','appointments','analysis'));
                }
                else{
                    return redirect('/');
                }
        }
        else{
            return redirect('/');
        }
    }

    public function editProfile(){
        $user = Auth::user();
        if($user){           
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
                if($client){
                        return view('Client.editprofile',compact('user','client'));
                }
                else{
                    return redirect('/');
                }
        }
        else{
            return redirect('/');
        }
    }

    public function eraseProfile( Request $request ){
        $user = Auth::user();
        if($user){           
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
                if($client){
                    $pass = DB::table('users')->select('password')->where('id',$id)->first();

                    $resul = Hash::check($request->passwordErase, $pass->password); // verifica se old é igual a new 
                    $conf = Str::is($request->passwordErase, $request->passwordComfirm); // verifica se pass == passconfirm
                    
                    if( !$conf || !$resul ){
                        $messages = [
                            'passwordComfirm' => 'Passwords têm de ser iguais',
                            'passwordErase' => 'Password pode estar incorreta'
                        ];
                        return redirect('/client/profile/edit')->withErrors($messages);
                    }
                    else{
                        $validator = Validator::make($request->all(), [
                            'passwordErase' => 'required|string|min:8',
                            'passwordComfirm' => 'required|string|min:8',
                            ]);
                        if ($validator->fails()) {
                            return redirect('/client/profile/edit')->withErrors($validator)->withInput();
                        }
                        else{
                            $client->delete();
                            $user->delete();
                            return redirect('/');
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

    public function submitEditProfile( Request $request )
    {
        $user = Auth::user();
        if($user){           
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
                if($client){
                    
                    $validator = Validator::make($request->all(), [
                        'name' => 'required|string|max:255',
                        'cellphone' => 'required|string|regex:/^[0-9]{9}$/',
                        'CC' => 'required|string|regex:/^[0-9]{1,9}$/',
                        'adse' => 'nullable|string|regex:/^[0-9]{1,10}$/',
                        'morada' => 'required|string',
                        'idade' => 'nullable|date'
                    ]);
                
                    if ($validator->fails()) {
                        return redirect('/client/profile/edit')->withErrors($validator)->withInput();
                    }
                    else{
                            DB::beginTransaction();
                           
                            $user = User::where('id', $id)->update([
                            'name' => $request->name,
                            'cellphone' => $request->cellphone
                            ]);

                            $client = Client::where('user_id', $id)->update([
                                'CC' =>  $request->CC,
                                'adse' =>  $request->adse,
                                'morada' => $request->morada,
                                'idade' => $request->idade,
                            ]);

                            DB::commit();

                            if($client)
                                return redirect('/client/profile'); 
                            else
                                return redirect('/client/profile');
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

    public function submitEditEmail( Request $request){
        $user = Auth::user();
        if($user){           
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
                if($client){
                    $pass = DB::table('users')->select('password')->where('id',$id)->first();
                    $resul = Hash::check($request->password, $pass->password);

                    if(Str::is($request->email, $user->email) || !$resul) {
                        $messages = [
                            'email' => 'O email tem de ser diferente',
                            'password' => 'Password pode estar incorreta'
                        ];
                        return redirect('/client/profile/edit')->withErrors($messages);
                    }
                    else{
                        $validator = Validator::make($request->all(), [
                            'email' => 'required|string|email|max:255|unique:users',
                            ]);
                            
                            if ($validator->fails()) {
                                return redirect('/client/profile/edit')->withErrors($validator)->withInput();
                            }
                            else{
                                $user = User::where('id', $id)->update([
                                    'email' => $request->email,
                                    ]);

                                if($user)
                                    return redirect('/client/profile'); 
                                else
                                    return redirect('/client/profile');
                            }
                        }
                    }
                    else
                        return redirect('/');
            }
            else
                return redirect('/');
        }


    public function submitEditPassword(Request $request){
        $user = Auth::user();
        if($user){           
            $id = $user->id;
            $client = Client::where('user_id',$id)->first();
                if($client){
                    $pass = DB::table('users')->select('password')->where('id',$id)->first();

                    $resul = Hash::check($request->old_password, $pass->password); // verifica se old é igual a new 
                    $conf = Str::is($request->new_password, $request->comfirm); // verifica se new == confirm
                    $dif = Hash::check($request->new_password, $pass->password); // verifica se new == confirm
               
                    if( !$conf || !$resul || $dif) {
                        $messages = [
                            'old_password' => 'A password tem de ser igual a recente',
                            'new_password' => 'A password tem de ser diferente da antiga',
                            'comfirm' => 'As password tem de ser iguais'
                        ];
                        return redirect('/client/profile/edit')->withErrors($messages);
                    }
                    else{
                        $validator = Validator::make($request->all(), [
                            'old_password' => 'required|string|min:8',
                            'new_password' => 'required|string|min:8',
                            ]);
                            
                            if ($validator->fails()) {
                                return redirect('/client/profile/edit')->withErrors($validator)->withInput();
                            }
                            else{
                                $user = User::where('id', $id)->update([
                                    'password' => Hash::make($request->new_password),
                                    ]);

                                if($user)
                                    return redirect('/client/profile'); 
                                else
                                    return redirect('/client/profile');
                            }
                        }
                    }
                    else
                        return redirect('/');
            }
            else
                return redirect('/');
    }
 
    public function clientSearch(Request $request){
        
        $user = Auth::user();
        if($user){
            $id = $user->id;
            $emplo = Employee::where('user_id',$id)->first();
                if($emplo){
                    
                    $cli = $request->cli;
                    $cc = $request->cc;
                    $cell = $request->cell;
                    $order = "";
                    $type = "";
                    if($request->order ==1){
                        $order = "name";
                        $type = "asc";
                    }
                    elseif($request->order ==2)
                    {
                        $order = "name";
                        $type = "desc";
                    }
                    elseif($request->order ==3){
                        $order = "CC";
                        $type = "asc";
                    }
                    elseif($request->order == 4){
                        $order = "CC";
                        $type = "desc";
                    }
                    elseif($request->order == 5){
                        $order = "idade";
                        $type = "asc";
                    }
                    else{
                        $order = "idade";
                        $type = "desc";
                    }
                    if(!empty($cli)){
                        if($order ==="idade"){
                            if($type == "desc"){
                                $client = ClientResource::collection(Client::leftJoin('users', 'users.id','=','clients.user_id')
                                ->where("users.name",$cli)
                                ->oldest('idade')
                                ->orderBy($order, $type)
                                ->get());
                            }
                            else{
                                $client = ClientResource::collection(Client::leftJoin('users', 'users.id','=','clients.user_id')
                                ->where("users.name",$cli)
                                ->latest('idade')
                                ->orderBy($order, $type)
                                ->get());
                            }
                        }
                        else{
                            $client = ClientResource::collection(Client::leftJoin('users', 'users.id','=','clients.user_id')
                            ->where("users.name",$cli)
                            ->orderBy($order, $type)
                            ->get());
                        }                       
                        if($client)
                            return $client;
                        else{
                            return response()->json([
                                'success' => false,
                                'message' => 'Cliente não encontrado'
                            ], 404);;
                        }
                    }
                    if(!empty($cc)){
                        $client = ClientResource::collection(Client::leftJoin('users', 'users.id','=','clients.user_id')
                        ->where("clients.CC",$cc)
                        ->orderBy($order, $type)
                        ->get());
                        if($client)
                            return $client;
                        else{
                            return response()->json([
                                'success' => false,
                                'message' => 'Cliente não encontrado'
                            ], 404);;
                        }
                    }
                    if(!empty($cell)){
                        $client = ClientResource::collection(Client::leftJoin('users', 'users.id','=','clients.user_id')
                        ->where("users.cellphone",$cell)
                        ->orderBy($order, $type)
                        ->get());
                        if($client)
                            return $client;
                        else{
                            return response()->json([
                                'success' => false,
                                'message' => 'Cliente não encontrado'
                            ], 404);;
                        }
                    }
                    else{
                        if($order ==="idade"){
                            if($type == "desc"){
                                $client = ClientResource::collection(Client::leftJoin('users', 'users.id','=','clients.user_id')
                                ->oldest('idade')
                                ->get());
                            }
                            else{
                                $client = ClientResource::collection(Client::leftJoin('users', 'users.id','=','clients.user_id')
                                ->latest('idade')
                                ->get());
                            }
                        }
                        else{
                            $client = ClientResource::collection(Client::leftJoin('users', 'users.id','=','clients.user_id')
                            ->orderBy($order, $type)
                            ->get());
                        }
                        return $client;
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
