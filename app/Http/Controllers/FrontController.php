<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }

    public function service(){
        return view('servicess'); 
    }

    public function policyBuyer(){
        return view('policy_buyer'); 
    }

    public function userSignin(){
        return view('signup');
    }

}
