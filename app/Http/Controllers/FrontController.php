<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Purchase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



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

    Auth::login($user);
    session()->put('user_login', true);
    session()->put('logged_in_user', $user);
 

    $guestToken = session('guest_purchase_token');
    if ($guestToken) {
        $purchase = Purchase::where('token', $guestToken)->first();
        if ($purchase && !$purchase->user_id) {
            $purchase->user_id = $user->id;
            $purchase->token = null;
            $purchase->update();
            session()->forget('guest_purchase_token');
        }
        session()->put('resume_summary', true);
    }
        return redirect()->route('policy.buyer');
        // return redirect('user-login')->with('success', 'Registration is Completed, now you can login');
       
    }

    // public function loginSubmit(Request $request){
    //     $request->validate([
    //         'email' =>  'required',
    //         'password'  =>  'required'
    //     ]);

    //      $user = User::where('email', $request->email)->first();

    //     if ($user && Hash::check($request->password, $user->password)) {
    //         Auth::login($user); 
    //         session()->put('user_login', true);
    //         session()->put('logged_in_user', $user);

    //         return redirect()->route('dashboard.frontend')->with('success', 'Login successful!');
    //     }

    //     return redirect()->route('user.login')->with('error', 'Invalid credentials');
    // }

    public function loginSubmit(Request $request){
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

         $user = User::where('email', $request->email)->first();

        // if ($user && Hash::check($request->password, $user->password)) {
        //     Auth::login($user); 
        //     session()->put('user_login', true);
        //     session()->put('logged_in_user', $user);

        //     return redirect()->route('dashboard.frontend')->with('success', 'Login successful!');
        // }

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); 
            session()->put('user_login', true);
            session()->put('logged_in_user', $user);


            $guestToken = session('guest_purchase_token');
            if ($guestToken) {
                $purchase = Purchase::where('token', $guestToken)->first();
                if ($purchase && !$purchase->user_id) {
                    $purchase->user_id = $user->id;
                    $purchase->token = null; 
                    $purchase->update();
                    session()->forget('guest_purchase_token'); 
                }
                session()->put('resume_summary', true);
            }

            // $redirectUrl = session()->pull('guest_redirect_intended', route('dashboard.frontend'));
            // return redirect($redirectUrl)->with('success', 'Login successful!');

            // return redirect()->route('dashboard.frontend')->with('success', 'Login successful!');

            return redirect()->route('policy.buyer');
        }

        // return redirect()->route('user.login')->with('error', 'Invalid credentials');
    }

    public function frontDashboard(){

        if (Auth::user()->type !== 'user') {
            return redirect('/dashboard')->with('error', 'Unauthorized access.');
        }
        return view('front_dashboard');
    }

      public function frontSuccessPage(){
        
        return view('front_success_page');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('user.login');
    }

}
