<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;

class FaqController extends Controller
{
    function index(){

        $faqs = Faq::all();
        return view('Gest.help',compact('faqs'));
    }
}
