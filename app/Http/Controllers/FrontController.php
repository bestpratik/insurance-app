<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Fact;
use App\Models\Service;
use Illuminate\Http\Request;

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

}
