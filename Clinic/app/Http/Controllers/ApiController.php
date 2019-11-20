<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use App\Medic;
use App\Client;
use App\Appointment;
use App\Analysis;
use App\Http\Resources\FaqResource;
use App\Http\Resources\MedicResource;
use App\Http\Resources\MedicAppointmentResource;
use App\Http\Resources\ClientAppointmentResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\AnalysisResource;

class ApiController extends Controller
{
    //TODOS OS FAQ 5 POR PAGINA
    public function getAllFaq(){
        return FaqResource::collection(Faq::paginate(5));
    }

    // TODOS OS MEDICOS
    public function getAllMedic(){
        return MedicResource::collection(Medic::paginate(10));
    }

    // APENAS UM MEDICO COM O ID=X
    public function getMedicSingle($id){
        $medico = Medic::find($id);
        if($medico)
            return new MedicResource($medico);
        else
            return response()->json([
                'success' => false,
                'message' => 'No medic found'
            ], 404);;
    }

    //APENAS UM CLIENTE COM ID=X
    public function getClientSingle($id){
        $client = Client::find($id);
        if($client)
            return new ClientResource($client);
        else
            return response()->json([
                'success' => false,
                'message' => 'No client found'
            ], 404);;
    }

    //CONSULTAS DO MEDICO COM ID=X
    public function getMedicAppoint($id){
        $medico = Medic::find($id);
        if($medico){
            return MedicAppointmentResource::collection(Appointment::where('medic_id', $medico->id)->latest('date')->paginate(10));
        }
        else
            return response()->json([
                'success' => false,
                'message' => 'No medic appointments found'
            ], 404);
    }

    //CONSULTAS DO CLIENTE COM ID=X
    public function getClientAppoint($id){
        $client = Client::find($id);
        if($client){
            return ClientAppointmentResource::collection(Appointment::where('client_id', $client->id)->latest('date')->paginate(10));
        }
        else
            return response()->json([
                'success' => false,
                'message' => 'No client appointments found'
            ], 404);
    }

    //CONSULTAS DO CLIENTE COM ID=X
    public function getClientAnalysis($id){
        $client = Client::find($id);
        if($client){
            return AnalysisResource::collection(Analysis::where('client_id', $client->id)->latest('date')->paginate(10));
        }
        else
            return response()->json([
                'success' => false,
                'message' => 'No client appointments found'
            ], 404);
    }
    
}
