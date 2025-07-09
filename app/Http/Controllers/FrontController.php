<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Fact;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class FrontController extends Controller
{
    public function home()
    {
        $banner = Banner::all();
        $aboutFirst = About::first();
        $service = Service::all();
        $fact = Fact::all();
        $client = Client::all();
        return view('home', compact('banner', 'service','aboutFirst', 'client', 'fact'));
    }
    public function about()
    {
        $aboutAll = About::all();
        $aboutSecond = $aboutAll->skip(1)->first();
        $index = About::all();
        return view('about', compact('aboutSecond', 'index'));
    }

    public function contact()
    {
        $contact =Contact::first();
        return view('contact', compact('contact'));
    }

    public function services()
    {
        $services = Service::all();
        return view('servicess', compact('services')); 
    }

    public function service_details($page_slug)
    {
        $service = Service::where('page_slug', $page_slug)->firstOrFail();
        return view('service_details', compact('service')); 
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

        return redirect()->route('user.login')->with('error', 'Invalid credentials');
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

    public function forgot_password(){ 
        return view('front_forgot_pass');
    }

    function validate_forgotpass(Request $request){

        $request->validate([
            'email'        =>   'required|email|exists:users'
        ]);
        $token = Str::random(64);
    
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        Mail::send('submitforgotpassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetPassword($token) { 
   
        return view('forgetpasswordlink', ['token' => $token]);
    }

    public function submitResetPassword(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
                            ->where([
                            'email' => $request->email, 
                            'token' => $request->token
                            ])
                            ->first();

                            //dd($updatePassword);

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
    
        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete(); 

        return redirect('user-login')->with('success', 'Your password has been changed!'); 
    }

    public function active_insurance(){
        // $active_insure = Purchase::where('policy_end_date' > now())->get();
        return view('active_insurance');
    }
}
