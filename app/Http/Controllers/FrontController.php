<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Policyreferralform;
use App\Models\Fact;
use App\Models\Service;
use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;



class FrontController extends Controller
{
    public function home()
    {
        $banner = Banner::all();
        $aboutFirst = About::first();
        $service = Service::with('insurance')->get();
        $fact = Fact::all();
        $client = Client::all();
        return view('home', compact('banner', 'service', 'aboutFirst', 'client', 'fact'));
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
        $contact = Contact::first();
        return view('contact', compact('contact'));
    }

    public function services()
    {
        $services = Service::all();
        return view('servicess', compact('services'));
    }

    public function service_details($page_slug)
    {
        $service = Service::with('insurance.staticdocuments')
            ->where('page_slug', $page_slug)
            ->firstOrFail();

        return view('service_details', compact('service'));
    }





    // public function policyBuyer()
    // {
    //     return view('policy_buyer');
    // }

    // public function policyBuyer($slug = null)
    // {
    //     $insuranceId = null;

    //     if ($slug) {
    //         $service = Service::where('page_slug', $slug)->with('insurance')->first();
    //         // dd($service);
    //         if ($service && $service->insurance) {
    //             $insuranceId = $service->insurance->id;
    //             // dd($service->insurance);
    //         }
    //     }

    //     return view('policy_buyer', compact('insuranceId'));
    // }


    public function policyBuyer($slug = null)
    {
        $insuranceId = null;

        if ($slug) {
            $service = Service::where('page_slug', $slug)->with('insurance')->first();
            if ($service && $service->insurance) {
                $insuranceId = $service->insurance->id;
            }
        }

        return view('policy_buyer', compact('insuranceId'));
    }


    public function userSignin()
    {
        return view('signup');
    }

    public function userLogin()
    {
        return view('login');
    }

    public function user_register_submit(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|confirmed|min:6',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = 'user';
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

                session()->put('pending_purchase_id', $purchase->id);
                return redirect()->route('stripe.booking');
            }
            // session()->put('resume_summary', true);
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

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

        $user = User::where('email', $request->email)->first();
        // dd($user);


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
                    session()->put('pending_purchase_id', $purchase->id);
                    return redirect()->route('stripe.booking');
                }
            }
            if ($user->type === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Welcome admin!');
            } elseif ($user->type === 'user') {
                return redirect()->route('dashboard.frontend')->with('success', 'Login successful!');
            } else {
                // Default fallback
                return redirect('/')->with('success', 'Login successful!');
            }
        }

        // return redirect()->route('policy.buyer')->with('error', 'Invalid credentials');
        return redirect()->route('user.login')->with('error', 'Invalid credentials');
    }

    public function frontDashboard()
    {

        // if (Auth::user()->type !== 'user') {
        //     return redirect('/dashboard')->with('error', 'Unauthorized access.');
        // }

        if (Auth::user()->type !== 'user') {
            return redirect('/dashboard');
        }

        $totalActive = Purchase::where('policy_end_date', '>', now())
            ->whereHas('insurance', function ($query) {
                $query
                    ->where('purchase_mode', 'Online');
            })
            ->where('payment_status', 'Paid')
            ->when(Auth::check(), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->whereNull('purchase_status')
            ->count();

        $totalInactive = Purchase::where('policy_end_date', '<', now())
            ->whereHas('insurance', function ($query) {
                $query
                    ->where('purchase_mode', 'Online');
            })
            ->where('payment_status', 'Paid')
            ->when(Auth::check(), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->whereNull('purchase_status')
            ->count();

        $totalCancel = Purchase::where('purchase_status', 'Cancelled')
            ->whereHas('insurance', function ($query) {
                $query
                    ->where('purchase_mode', 'Online');
            })
            ->where('payment_status', 'Paid')
            ->when(Auth::check(), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->count();

        return view('front_dashboard', compact('totalActive', 'totalInactive', 'totalCancel'));
    }

    public function frontSuccessPage(Request $request)
    {
        $purchaseId = $request->get('purchase_id');
        // dd($purchaseId);
        $purchase = Purchase::with(['insurance.staticdocuments', 'insurance.dynamicdocument', 'invoice'])->find($purchaseId);
        // dd($purchase);
        return view('front_success_page', compact('purchaseId', 'purchase'));
    }

    public function referralSuccessPage(Request $request)
    {
        // $purchaseId = $request->get('purchase_id');
        // dd($purchaseId);
        // $purchase = Purchase::with(['insurance.staticdocuments','insurance.dynamicdocument','invoice'])->find($purchaseId);
        // dd($purchase);
        return view('referral_success_page');
    }

    // public function policyReferralSuccessPage(Request $request)
    // {
    //     // $purchaseId = $request->get('purchase_id');
    //     // $purchase = Policyreferralform::with(['insurance.staticdocuments', 'insurance.dynamicdocument', 'invoice'])->find($purchaseId);

    //     $purchaseId = $request->get('purchase_id');

    //     $purchase = Policyreferralform::with([
    //         'insurance.staticdocuments',
    //         'insurance.dynamicdocument',
    //         'invoice'
    //     ])->find($purchaseId);

    //     // Check if purchase exists
    //     if (!$purchase) {
    //         return redirect()->route('home')->with('error', 'Purchase not found.');
    //     }

    //     return view('policy_referral_success_page', compact('purchaseId', 'purchase'));
    // }


    public function policyReferralSuccessPage($purchaseId)
    {
        //dd($purchaseId);
        $purchase = Policyreferralform::find($purchaseId);

        return view('policy_referral_success_page', compact('purchase'));
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

    public function forgot_password()
    {
        return view('front_forgot_pass');
    }

    function validate_forgotpass(Request $request)
    {

        $request->validate([
            'email'        =>   'required|email|exists:users'
        ]);
        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('submitforgotpassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetPassword($token)
    {

        return view('forgetpasswordlink', ['token' => $token]);
    }

    public function submitResetPassword(Request $request)
    {

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

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect('user-login')->with('success', 'Your password has been changed!');
    }

    public function active_insurance()
    {
        // $active_insure = Purchase::where('policy_end_date' > now())->get();
        return view('active_insurance');
    }

    public function inactive_insurance()
    {
        return view('inactive_insurance');
    }

    public function cancel_insurance()
    {
        return view('cancel_insurance');
    }

    /**
     * Function : googleLogin
     * Description : This function will redirect to google
     * @param NA
     * @return void
     */

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Function : googleAuthentication
     * Description : This function will authenticate the user through the google account
     * @param NA
     * @return void
     */

    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('provider_id', $googleUser->id)->where('provider', 'google')->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard.frontend');
            } else {
                $user = new User;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->password = Hash::make('Password@123');
                $user->type = 'user';
                $user->provider_id = $googleUser->id;
                $user->provider = 'google';
                $user->save();

                Auth::login($user);
                return redirect()->route('dashboard.frontend');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }


    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookAuthentication()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            $user = User::where('provider_id', $facebookUser->id)
                ->where('provider', 'facebook')
                ->first();

            if ($user) {
                Auth::login($user);
            } else {
                $user = new User;
                $user->name = $facebookUser->name;
                $user->email = $facebookUser->email;
                $user->password = Hash::make('Password@123');
                $user->type = 'user';
                $user->provider_id = $facebookUser->id;
                $user->provider = 'facebook';
                $user->save();

                Auth::login($user);
            }

            return redirect()->route('dashboard.frontend');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function referralForm()
    {
        return view('referral_form');
    }

    public function policyDetailPage($id)
    {
        // $purchase = Purchase::with(['insurance.provider', 'invoice']) 
        //     ->where('payment_status', 'Paid')
        //     ->whereHas('insurance', function ($query) {
        //         $query
        //             ->where('purchase_mode', 'Online');
        //     })
        //     ->where('policy_end_date', '>', now())
        //     ->when(Auth::check(), function ($query) {
        //         $query->where('user_id', Auth::id());
        //     })->find($id);

        $purchase = Purchase::with(['insurance.provider', 'invoice'])
            ->whereHas('insurance', function ($query) {
                $query
                    ->where('purchase_mode', 'Online');
            })
            ->when(Auth::check(), function ($query) {
                $query->where('user_id', Auth::id());
            })->find($id);

        // dd($purchase);
        return view('policy_detail_page', compact('purchase'));
    }


    public function termsConditions()
    {
        $terms = Content::first();
        return view('terms_conditions', compact('terms'));
    }

    public function policy_referral_form()
    {
        return view('policy_referral_form');
    }
}
