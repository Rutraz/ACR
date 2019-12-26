<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use Validator;
use App\Http\Resources\FaqResource;

class FaqController extends Controller
{
    function index(){

        $faqs = Faq::all();
        return view('Gest.help',compact('faqs'));
    }

    public function getAllFaq(){
        return FaqResource::collection(Faq::all());
    }
    public function eraseFaq($id){
       
        $faq = Faq::find($id);    
        $faq->delete();    
        
        if($faq){
            return response()->json([
                'success' => true,
                'message' =>   "Eliminação com sucesso",
            ], 201);
        }
        else{
            return response()->json([
                'success' => false,
                'message' =>  "Eliminação com insucesso"
            ], 201);
        }
        
    }

    //INSERIR UM NOVO FAQ
    public function insertFaq(Request $request){
      
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'response' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'menssage' =>  $validator->errors(),
            ], 201);
        }
        else{

            $faqs = new Faq;
            $faqs->question = $request->question;
            $faqs->response = $request->response;
            $faqs->save();

            if($faqs)
            return response()->json([
                'success' => true,
                'data' =>  new FaqResource($faqs),
            ], 201);
               
            else{
                return response()->json([
                    'success' => false,
                'message' => 'Insert failed'
                ], 201);
            }           
        }
    }
    
}
