<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Session;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        // dd($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
        {
            // dd($provider);
            try {
                
                $userSocial = Socialite::driver($provider)->stateless()->user();

                dd($userSocial);
                $user = User::where('email', $userSocial->getEmail())->first();
                // dd($user);
                if ($user) {
                    // If user exists, log them in
                    Auth::login($user);
                } else {
                    $user = User::create([
                        'name' => $userSocial->getName(),
                        'email' => $userSocial->getEmail(),
                        'provider_id' => $userSocial->getId(),
                        'provider' => $provider,
                    ]);
                    
                    // Log the new user in
                    Auth::login($user);
                }

              

                // Redirect to the user's dashboard after successful login
                
                return redirect()->route('dashboard.frontend');

            } catch (\Exception $e) {
                
                return redirect()->route('dashboard.frontend')->withErrors('Something went wrong. Please try again.');
            }
        }
}
