<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\Provider;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Sluggable;

class InsuranceController extends Controller
{
    
    public function index()
    {
        $insurances = Insurance::where('status', 1)->with('provider')->get();
        // dd($insurances);
        return view('insurance.index', compact('insurances'));
    }

   
    public function create()
    {
        $provider = Provider::where('status', 1)->get();
        return view('insurance.create', compact('provider'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
       ]);

        $insurance = new Insurance;

        $destinationPath = public_path('uploads/insurance/');
        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$filename);
            $insurance->image = $filename;
        }

        $insurance->name = $request->name;
        $insurance->provider_type = $request->provider_type;
        $insurance->prefix = $request->prefix;
        $insurance->net_premium = $request->net_premium;
        $insurance->commission = $request->commission;
        $insurance->gross_premium = $insurance->net_premium + $insurance->commission;
        $insurance->ipt = $insurance->gross_premium * 0.12;
        $insurance->total_premium = $insurance->gross_premium + $insurance->ipt;
        $insurance->payable_amount = $insurance->total_premium - $insurance->commission;
        // dd($insurance);
        $insurance->save();

        return redirect('insurances')->with('success', 'Insurance created successfully');
    }

   
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        $provider = Provider::where('status', 1)->get();
        $insurance = Insurance::find($id);
        return view('insurance.edit', compact('provider','insurance'));
    }

  
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name'           => 'required',
        ]);

        $insurance = Insurance::find($id);
        $insurance->name = $request->name;
        $insurance->provider_type = $request->provider_type;
        $insurance->prefix = $request->prefix;
        $insurance->net_premium = $request->net_premium;
        $insurance->commission = $request->commission;
        $insurance->gross_premium = $insurance->net_premium + $insurance->commission;
        $insurance->ipt = $insurance->gross_premium * 0.12;
        $insurance->total_premium = $insurance->gross_premium + $insurance->ipt;
        $insurance->payable_amount = $insurance->total_premium - $insurance->commission;

    

        if ($request->hasfile('image')) {
            $destinationPath = public_path('uploads/insurances/'.$insurance->image);
        
            if (File::exists($destinationPath)) {
                File::delete($destinationPath);
            }
        
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/insurances/'), $filename);
        
            $insurance->image = $filename;
        }

        $insurance->save();

        return redirect('insurances')->with('success', 'Insurance updated successfully.');
    }

    
    public function destroy(string $id)
    {
        $insurance = Insurance::find($id);
        if($insurance){
            $destination = public_path('uploads/insurances/'.$insurance->image);
            if(File::exists($destination)){
                File::delete($destination);
            }
            $insurance->delete();
            return redirect('insurances')->with('success', 'Insurance deleted successfully');
        }else{
            return redirect('insurances')->with('success', 'No data find to delete');
        }
    }
}
