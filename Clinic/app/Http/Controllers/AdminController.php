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
}
