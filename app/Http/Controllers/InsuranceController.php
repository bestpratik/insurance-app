<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\Invoice;
use App\Models\Insurancedocument;
use App\Models\Insurancedynamicdocument;
use App\Models\Insuranceemailtemplate;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Mail;
use App\Mail\PolicyHolderEmail;



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
        $insurance->prefix = str_replace('-', '', $request->prefix);
        $insurance->type_of_insurance = $request->type_of_insurance;
        $insurance->validity = $request->validity;
        $insurance->rent_amount_from = $request->rent_amount_from;
        $insurance->rent_amount_to = $request->rent_amount_to;
        $insurance->details_of_cover = $request->details_of_cover;
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
            // return redirect()->back()->with('message','Static Document Added Successfully!');

            return redirect()->route('insurance.static.document',$id); 
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

    public function dynamic_document($id){  
        $insurance = Insurance::find($id);
       
        $purchase = Purchase::where('insurance_id', $insurance->id)->get();
        // dd($purchase);
        $insurancedynamicdoc=Insurancedynamicdocument::where('insurance_id',$insurance->id)->get(); 
        // dd($insurancedynamicdoc);
        return view('insurance.dynamic_doc', compact('insurance','insurancedynamicdoc'));
    }

    public function dynamic_document_submit(Request $request, $id){
        $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);

            $insurancedynamicdoc = new Insurancedynamicdocument;

            $insurancedynamicdoc->insurance_id = $id;
            $insurancedynamicdoc->title = $request->title;
            $insurancedynamicdoc->header = $request->header;
            $insurancedynamicdoc->description = $request->description;
            $insurancedynamicdoc->title = $request->title;

            // dd($Insurancedocument);
            $insurancedynamicdoc->save();
            // return redirect()->back()->with('message','Static Document Added Successfully!');

            return redirect()->route('insurance.dynamic.document',$id); 
    }

    public function insurance_email_template($id){
        $insurance=Insurance::find($id);
        $insuranceEmailTemplate=Insuranceemailtemplate::where('insurance_id',$insurance->id)->first(); 
        // dd($insuranceEmailTemplate);
        return view('insurance.insurance_email_template', compact('insurance','insuranceEmailTemplate'));
    }

    public function insurance_email_template_update(Request $request, $id){
        $request->validate([
                'title' => 'required',
                'description' => 'required',
        ]);
        $insurance=Insurance::find($id);

        $insuranceEmailTemplate=Insuranceemailtemplate::where('insurance_id',$id)->first();
    
        if ($insuranceEmailTemplate != null) {
           
           $mailTemplate = Insuranceemailtemplate::where('insurance_id',$id)->first();
           $mailTemplate->title = $request->title;
           $mailTemplate->description = $request->description;
           $mailTemplate->update();
           return redirect()->route('insurance.summary',$insurance->id);
    
        } else {
           
            $mailTemplate = new Insuranceemailtemplate;
            $mailTemplate->title = $request->title;
            $mailTemplate->description = $request->description;
            $mailTemplate->insurance_id = $id;
    
            $mailTemplate->save();
            return redirect()->route('insurance.summary',$insurance->id);
        }

        // return redirect()->route('insurance.email.template',$insuranceEmailTemplate); 
    }

    public function insurance_summary($id){
        $insurance = Insurance::with('provider','purchase')->find($id);
        // dd($insurance);
        return view('insurance.insurance_summary', compact('insurance'));
    }

    // public function invoiceSubmit(Request $request, $id){
    //     $insurance = Insurance::with('provider', 'purchase')->findOrFail($id);
    //     if ($request->has('is_invoice')) {
    //         $billingEmail = $insurance->purchase->billing_email ?? null;

    //         if ($billingEmail) {
    //             Mail::to($billingEmail)->send(new PolicyHolderEmail($insurance));
    //         }
    //     }

    //     return redirect()->route('insurance.success')->with('message', 'Insurance summary submitted successfully!');
    // }

//    public function invoiceSubmit(Request $request, $id)
// {
//     $insurance = Insurance::with('provider', 'purchase')->findOrFail($id);

//     if ($request->has('is_invoice')) {
//         // Ensure the purchase relationship exists
//         $purchase = $insurance->purchase;
//         if (!$purchase) {
//             return redirect()->back()->with('error', 'No purchase record associated with this insurance.');
//         }

//         $invoice = Invoice::where('purchase_id', $purchase->id)->first();
//         $billingEmail = $invoice->billing_email ?? null;

//         if ($billingEmail) {
//             $template = Insuranceemailtemplate::where('insurance_id', $insurance->id)->first();
//             dd($template);

//             if ($template) {
//                 $placeholders = [
//                     '%InsuranceName%' => $insurance->name ?? 'N/A',
//                     '%policyNo%' => $purchase->policy_no ?? 'N/A',
//                     '%landlordagentName%' => $purchase->policy_holder_name ?? 'N/A',
//                     '%landlordagentAddress%' => $purchase->policy_holder_address ?? 'N/A',
//                     '%riskAddress%' => $purchase->property_address ?? 'N/A',
//                     '%policyStartdate%' => $purchase->policy_start_date ?? 'N/A',
//                     '%policyEnddate%' => $purchase->policy_end_date ?? 'N/A',
//                     '%purchaseDate%' => $purchase->purchase_date ?? 'N/A',
//                     '%insurerTitle%' => $insurance->provider->name ?? 'N/A',
//                     '%insurerDescription%' => $insurance->provider->description ?? 'N/A',
//                     '%detailsofCover%' => $insurance->details_of_cover ?? 'N/A',
//                     '%policyTerm%' => $purchase->policy_term ?? 'N/A',

//                     // Financial fields from insurance table
//                     '%netAnnualpremium%' => $insurance->net_premium ?? 'N/A',
//                     '%insurancePremiumtax%' => $insurance->ipt ?? 'N/A',
//                     '%grossPremium%' => $insurance->gross_premium ?? 'N/A',
//                     '%rentAmount%' => $purchase->rent_amount ?? 'N/A',
//                 ];

//                 $emailTitle = str_replace(array_keys($placeholders), array_values($placeholders), $template->title);
//                 $emailBody = str_replace(array_keys($placeholders), array_values($placeholders), $template->description);

//                 Mail::to('anuradham.dbt@gmail.com')->send(new PolicyHolderEmail($emailTitle, $emailBody));
//             }
//         }
//     }

//     return redirect()->route('insurance.success')->with('message', 'Insurance summary submitted successfully!');
// }


// public function invoiceSubmit(Request $request, $id)
// {
    
//     $emailBody = 'Thank you for submitting your insurance summary. We will process it shortly.';
   
//     Mail::to('anuradham.dbt@gmail.com')->send(new PolicyHolderEmail($emailBody));

//     return redirect()->route('insurance.success')->with('message', 'Insurance summary submitted successfully!');
// }


public function testmail()
{
  
    $emailBody = 'Thank you for submitting your insurance summary. We will process it shortly.';
//    dd($emailBody);
    Mail::to('sarat.dbt@gmail.com')->send(new PolicyHolderEmail($emailBody));

    return redirect()->route('insurance.success')->with('message', 'Insurance summary submitted successfully!');
}


    function success(){
        return view('insurance.success');
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
        $insurance->type_of_insurance = $request->type_of_insurance;
        $insurance->validity = $request->validity;
        $insurance->rent_amount_from = $request->rent_amount_from;
        $insurance->rent_amount_to = $request->rent_amount_to;
        $insurance->details_of_cover = $request->details_of_cover;

    

        if ($request->hasfile('image')) {
            $destinationPath = public_path('uploads/insurance/'.$insurance->image);
        
            if (File::exists($destinationPath)) {
                File::delete($destinationPath);
            }
        
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/insurance/'), $filename);
        
            $insurance->image = $filename;
        }

        $insurance->save();

        return redirect()->route('insurance.pricing',$insurance->id)->with('message', 'Insurance updated successfully.');

        // return redirect('insurances')->with('message', 'Insurance updated successfully.');
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
