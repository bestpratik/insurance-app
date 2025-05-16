<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Provider;
use App\Models\Insurance;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Sluggable;

class PurchaseController extends Controller
{
    
    public function index()
    {
        $purchases = Purchase::where('status', 1)->with('insurance','provider')->get();
        return view('purchase.index', compact('purchases'));
    }

    
    public function create()
    {
        $provider = Provider::where('status', 1)->get();
        $insurance = Insurance::where('status', 1)->get();
        return view('purchase.create', compact('provider','insurance'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'insurance_id' => 'required',
            'provider_type' => 'required',
        ]);

     
        $purchase = new Purchase;

        $purchase->insurance_id = $request->insurance_id;

        $insurance = Insurance::find($purchase->insurance_id);
        $prefix = $insurance->prefix;
        $policy_no= $prefix.'-'.rand(1000000,9999999);

        $purchase->provider_type = $request->provider_type;
        $purchase->policy_no = $policy_no;
        $purchase->policy_holder_type = $request->policy_holder_type;
        $purchase->policy_holder_title = $request->policy_holder_title;
        $purchase->policy_holder_fname = $request->policy_holder_fname;
        $purchase->policy_holder_lname = $request->policy_holder_lname;
        $purchase->policy_holder_name = $request->policy_holder_name;
        $purchase->company_name = $request->company_name;
        $purchase->policy_holder_address = $request->policy_holder_address;
        $purchase->policy_holder_email = $request->policy_holder_email;
        $purchase->policy_holder_phone = $request->policy_holder_phone;
        $purchase->policy_start_date = $request->policy_start_date;
        $purchase->policy_end_date = $request->policy_end_date;
        $purchase->transaction_type = $request->transaction_type;
        $purchase->payable_amount = $request->payable_amount;
        $purchase->property_address = $request->property_address;
        // dd($purchase);
        $purchase->save();
        return redirect('purchases')->with('success', 'Purchase created successfully');
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        // $provider = Provider::where('status', 1)->get();
        // $insurance = Insurance::where('status', 1)->get();
        // $purchase = Purchase::find($id);
        // return view('purchase.edit', compact('provider','insurance','purchase'));
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        $purchase = Purchase::find($id);
        if($purchase){
            $purchase->delete();
            return redirect('purchases')->with('success', 'Purchase deleted Successfully');
        }else{
            return redirect('purchases')->with('success', 'No data find to delete'); 
        }
    }
}
