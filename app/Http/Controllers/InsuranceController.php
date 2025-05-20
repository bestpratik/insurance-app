<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\Provider;
use App\Models\Insurancedocument;
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
        'type_of_insurance' => 'required',
        'name' => 'required',
        'provider_type' => 'required',
        'validity' => 'required',
        'rent_amount_from' => 'required',
        'rent_amount_to' => 'required',
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
        $insurance->type_of_insurance = $request->type_of_insurance;
        $insurance->validity = $request->validity;
        $insurance->rent_amount_from = $request->rent_amount_from;
        $insurance->rent_amount_to = $request->rent_amount_to;
        // $insurance->gross_premium = $insurance->net_premium + $insurance->commission;
        // $insurance->ipt = $insurance->gross_premium * 0.12;
        // $insurance->total_premium = $insurance->gross_premium + $insurance->ipt;
        // $insurance->payable_amount = $insurance->total_premium - $insurance->commission;
        // dd($insurance);
        $insurance->save();

        return redirect()->route('insurance.pricing',$insurance->id);
        // return redirect('insurances')->with('message', 'Insurance created successfully');
    }

    public function insurance_pricing($id){
        $insurance = Insurance::find($id);
        return view('insurance.pricing', compact('insurance'));
    }


    public function insurance_pricing_submit(Request $request, $id){
            $request->validate([
                'net_premium' => 'required',
                'commission' => 'required',
            ]);

            $insurance = Insurance::find($id);

            $insurance->net_premium = $request->net_premium;
            $insurance->commission = $request->commission;
            $insurance->gross_premium = $request->gross_premium;
            $insurance->ipt = $request->ipt;
            $insurance->total_premium = $request->total_premium;
            $insurance->payable_amount = $request->payable_amount;
            $insurance->update();
            return redirect()->route('insurance.static.document',$insurance); 
    }

    public function static_document($id){
        $insurance = Insurance::find($id);
        $insurancedoc=Insurancedocument::where('insurance_id',$insurance->id)->get();
        // dd($insurancedoc);
        return view('insurance.static_doc', compact('insurance','insurancedoc'));
    }

    public function static_document_submit(Request $request, $id){
        $request->validate([
                'title' => 'required',
                'document' => 'required|mimes:pdf,docx|max:6144',
            ]);

            $Insurancedocument = new Insurancedocument;

            $Insurancedocument->insurance_id = $id;
            $Insurancedocument->title = $request->title;

            $destinationPath = public_path('uploads/insurance_document/');
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                
                $statictitle = str_replace(' ', '_', $Insurancedocument->title);
                
                $filename = $statictitle . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $filename);
                
                $Insurancedocument->document = $filename;
            }
     
            // dd($Insurancedocument);
            $Insurancedocument->save();
            return redirect()->back()->with('message','Static Document Added Successfully!');

            // return redirect()->route('insurance.static.document',$Insurancedocument); 
    }

    public function static_document_delete($id){
        $Insurancedocument = Insurancedocument::find($id);
        if($Insurancedocument)
        {
            $destination = public_path('uploads/insurance_document/'.$Insurancedocument->document);
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            
            $Insurancedocument->delete();
            return redirect()->back();
        }
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

        return redirect('insurances')->with('message', 'Insurance updated successfully.');
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
            return redirect('insurances')->with('message', 'Insurance deleted successfully');
        }else{
            return redirect('insurances')->with('message', 'No data find to delete');
        }
    }
}
