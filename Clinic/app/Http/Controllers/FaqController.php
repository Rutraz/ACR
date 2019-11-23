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
        return FaqResource::collection(Faq::paginate(5));
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
                'message' => "Invalid parameters"
            ], 201);
        }
        else{

            $faqs = new Faq;
            $faqs->question = $request->question;
            $faqs->response = $request->response;
            $faqs->save();

            if($faqs)
                return new FaqResource($faqs);
            else{
                return response()->json([
                    'success' => false,
                'message' => 'Insert failed'
                ], 201);
            }           
        }
    }
    
}
