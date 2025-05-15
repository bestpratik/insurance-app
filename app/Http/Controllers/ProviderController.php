<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Sluggable;

class ProviderController extends Controller
{
    
    public function index()
    {
        $providers = Provider::where('status', 1)->get();
        return view('provider.index', compact('providers'));
    }

  
    public function create()
    {
        return view('provider.create');
    }

    
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required',
       ]);

       $provider = new Provider;
       $provider->name = $request->name;
       $provider->save();

        return redirect('providers')->with('success', 'Provider created successfully');
    }

   
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $provider = Provider::find($id);
        return view('provider.edit', compact('provider'));
    }

   
    public function update(Request $request, string $id)
    {
        $request->validate([
        'name' => 'required',
       ]);

       $provider = Provider::find($id);
       $provider->name = $request->name;
    //    dd($provider);
       $provider->update();

       return redirect('providers')->with('success', 'Provider updated successfully');
    }

    
    public function destroy(string $id)
    {
         $provider = Provider::find($id);
        if($provider){
            $provider->delete();
            return redirect('providers')->with('success', 'Provider deleted Successfully');
        }else{
            return redirect('providers')->with('success', 'No data find to delete'); 
        }
    }
}
