<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\UserAuth;


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

    public function userLogin(){
        return view('login');
    }

    public function user_register_submit(Request $request){
        $request->validate([
        'name'                  => 'required',
        'email'                 => 'required|email|unique:users',
        'password'              => 'required|confirmed|min:6',
        'type'                  => 'required',
    ]);

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->type = $request->type;
    $user->save();

        return redirect('user-login')->with('success', 'Registration is Completed, now you can login');
       
    }

    public function loginSubmit(Request $request){
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

        $result = User::where('email', $request->email)->first();

        if($result){
            if(Hash::check($request->password, $result->password)){
                $request->session()->put('user_login', true);
                $request->session()->put('logged_in_user', $result);

                return redirect('front-dashboard')->with('success', 'Login Successfull!');
               
            }else{
                return redirect('user-login')->with('error', 'Password is not correct');
            }
        }else{
            return redirect('user-login')->with('error', 'Login details are not valid');
        }
    }

    public function frontDashboard(){
        return view('front_dashboard');
    }

}
