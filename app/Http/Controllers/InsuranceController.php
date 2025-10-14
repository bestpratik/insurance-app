<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Insurance;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\Insurancedocument;
use App\Models\Insurancedynamicdocument;
use App\Models\Insuranceemailtemplate;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Mail;
use App\Mail\PolicyHolderEmail;
use PDF;
use Illuminate\Support\Str;



class InsuranceController extends Controller
{


       public function policy_holder_email(){
        $purchase = Purchase::findorfail(28);
        //$purchase = Purchase::findorfail($purchaseId);
        if($purchase){
            $insurance = Insurance::with('staticdocuments','dynamicdocument','insurancemailtemplate')->findOrFail($purchase->insurance_id);
            //Load all documents

            //Load static documents
            $allDocs = [];
            // if ($insurance && $insurance->staticdocuments) {
            //     foreach ($insurance->staticdocuments as $docs) {
            //         $filePath = public_path('uploads/insurance_document/' . $docs->document);
            //         if (file_exists($filePath)) {
            //             $allDocs[] = $filePath;
            //         }     
            //     }
            // }

            //PDFs dynamic value for dynamic documents
            $pdfDynamicval = array();
            $pdfDynamicval[] = $insurance->name;
            $pdfDynamicval[] = $purchase->policy_no;
            $pdfDynamicval[] = $purchase->policy_holder_address;
            $pdfDynamicval[] = date('jS F Y', strtotime($purchase->policy_start_date));
            $pdfDynamicval[] = date('jS F Y', strtotime($purchase->policy_end_date));
            $pdfDynamicval[] = date('jS F Y', strtotime($purchase->purchase_date));
            $pdfDynamicval[] = $purchase->policy_term;
            $pdfDynamicval[] = $insurance->net_premium;
            $pdfDynamicval[] = $insurance->ipt;
            $pdfDynamicval[] = $insurance->gross_premium;
            $pdfDynamicval[] = $insurance->rent_amount;
            $pdfDynamicval[] = $insurance->payable_amount;

            $riskAddress = $purchase->door_no.' '.$purchase->address_one.' '.$purchase->address_two.' '.$purchase->address_three.' '.$purchase->post_code;

            $insurartitle = "";
            if($purchase->policy_holder_type == 'Company'){
                $insurartitle = $purchase->company_name;
            }elseif($purchase->policy_holder_type == 'Individual'){
                $insurartitle = $purchase->policy_holder_title.' '.$purchase->policy_holder_fname.' '.$purchase->policy_holder_lname;
            }else{
                $insurartitle = $purchase->company_name.'/'.$purchase->policy_holder_title.' '.$purchase->policy_holder_fname.' '.$purchase->policy_holder_lname;
            }

            $pdfDynamicval[] = $riskAddress;
            $pdfDynamicval[] = $insurartitle;
            $pdfDynamicval[] = $insurance->details_of_cover;



            //Load dynamic documents
            if ($insurance && $insurance->dynamicdocument) {
                foreach ($insurance->dynamicdocument as $dydocs) {
                    $file_name = $dydocs->title .rand(11,999999). '.pdf';

                    $data = array(
                        'templateTitle' => $dydocs->title,
                        'templateBody' => $dydocs->description,
                        'templateHeder' => $dydocs->header,
                        'templateFooter' => $dydocs->footer,
                        'templatebodyValue' => $pdfDynamicval
                    );
                    return view('purchase.pdfs.insurance_dynamic_document_email', ['data' => $data]);

                    // $pdf = PDF::loadView('purchase.pdfs.insurance_dynamic_document', ['data' => $data]);
                    // $pdfPath = public_path('uploads/dynamicdoc' . $file_name); 
                    // $pdf->save($pdfPath);
                    // if (file_exists($pdfPath)) {
                    //     $allDocs[] = $pdfPath;
                    // }     
                }
            }
            

            //Load dynamic email template
            // /Dynamic Value
            $bodyValue = array();
            $bodyValue[] = $insurance->name;
            $bodyValue[] = $purchase->policy_no;
            $bodyValue[] = $purchase->policy_holder_address;
            $bodyValue[] = date('jS F Y', strtotime($purchase->policy_start_date));
            $bodyValue[] = date('jS F Y', strtotime($purchase->policy_end_date));
            $bodyValue[] = date('jS F Y', strtotime($purchase->purchase_date));
            $bodyValue[] = $purchase->policy_term;
            $bodyValue[] = $insurance->net_premium;
            $bodyValue[] = $insurance->ipt;
            $bodyValue[] = $insurance->gross_premium;
            $bodyValue[] = $insurance->rent_amount;
            $bodyValue[] = $insurance->payable_amount;
            $bodyValue[] = $riskAddress;
            $bodyValue[] = $insurartitle;

            //Now send email
            $sendToemils = array(
                'sujoyinkolkata1@gmail.com'
            );
            $email_subject = 'YOUR POLICY SCHEDULE - MoneyWise PLC';
            $data = array(
                'body' => $insurance->insurancemailtemplate->description ?? '', 
                'bodyValue' => $bodyValue
                );
            // Mail::send('email.insurance_billing',$data, function($messages) use ($sendToemils, $allDocs, $email_subject){
            //         //$messages->to($user['to']);
            //         $messages->to($sendToemils);
            //         $messages->subject($email_subject);
            //         //$messages->cc(['anuradha.mondal2013@gmail.com']);
            //         $messages->bcc(['bestpratik@gmail.com']);
            //         foreach ($allDocs as $attachment) {
            //             $messages->attach($attachment);
            //         }
            // });


        }


        

        //return view('email.insurance_billing', compact('bodyValue','body'));

        //dd($purchase);
    }


    
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
        'purchase_mode' => 'required',
        'show_on_referral_form' => 'required',
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
        $insurance->show_on_referral_form = $request->show_on_referral_form;
        $insurance->type_of_insurance = $request->type_of_insurance;
        $insurance->validity = $request->validity;
        $insurance->rent_amount_from = $request->rent_amount_from;
        $insurance->rent_amount_to = $request->rent_amount_to;
        $insurance->details_of_cover = $request->details_of_cover;
        $insurance->purchase_mode = $request->purchase_mode;
        $insurance->uuid = Str::uuid();
        // dd($insurance);
        $insurance->save();

        return redirect()->route('insurance.pricing',$insurance->uuid);
        // return redirect('insurances')->with('message', 'Insurance created successfully');
    }

    public function insurance_pricing($uuid){
        $insurance = Insurance::where('uuid', $uuid)->firstOrFail();
        // dd($insurance);
        return view('insurance.pricing', compact('insurance'));
    }


    public function insurance_pricing_submit(Request $request, $uuid){
            $request->validate([
                'net_premium' => 'required',
                'commission' => 'required',
            ]);

            $insurance = Insurance::where('uuid', $uuid)->firstOrFail();

            $insurance->net_premium = $request->net_premium;
            $insurance->commission = $request->commission;
            $insurance->gross_premium = $request->gross_premium;
            $insurance->ipt = $request->ipt;
            $insurance->total_premium = $request->total_premium;
            $insurance->payable_amount = $request->payable_amount;
            $insurance->ipt_on_billable_amount = $request->ipt_on_billable_amount;
            $insurance->admin_fee = $request->admin_fee;
            // dd($insurance);
            $insurance->update();
            return redirect()->route('insurance.static.document',$insurance->uuid); 
    }

    public function static_document($uuid){
        // dd($uuid);
        $insurance = Insurance::where('uuid', $uuid)->firstOrFail();
        // dd($insurance);
        $insurancedoc=Insurancedocument::where('insurance_id',$insurance->id)->get();
        // dd($insurancedoc);
        return view('insurance.static_doc', compact('insurance','insurancedoc'));
    }

    public function static_document_submit(Request $request, $uuid){
        $request->validate([
                'title' => 'required',
                'document' => 'required|mimes:pdf,docx|max:6144',
            ]);
            
            
            $Insurancedocument = new Insurancedocument;
            $insurance = Insurance::where('uuid', $uuid)->firstOrFail();
            $Insurancedocument->insurance_id = $insurance->id;
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

            return redirect()->route('insurance.static.document',$insurance->uuid); 
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

    public function dynamic_document($uuid){  
        $insurance = Insurance::where('uuid', $uuid)->firstOrFail();
       
        $purchase = Purchase::where('insurance_id', $insurance->id)->get();
        // dd($purchase);
        $insurancedynamicdoc=Insurancedynamicdocument::where('insurance_id',$insurance->id)->get(); 
        // dd($insurancedynamicdoc);
        return view('insurance.dynamic_doc', compact('insurance','insurancedynamicdoc'));
    }

    public function dynamic_document_submit(Request $request, $uuid){
        $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);

            $insurancedynamicdoc = new Insurancedynamicdocument;

            $insurance = Insurance::where('uuid', $uuid)->firstOrFail();
            $insurancedynamicdoc->insurance_id = $insurance->id;
            $insurancedynamicdoc->title = $request->title;
            // $insurancedynamicdoc->header = $request->header;
            $insurancedynamicdoc->description = $request->description;
            // $insurancedynamicdoc->footer = $request->footer;

            // dd($Insurancedocument);
            $insurancedynamicdoc->save();
            // return redirect()->back()->with('message','Static Document Added Successfully!');

            return redirect()->route('insurance.dynamic.document',$insurance->uuid); 
    }

    // public function dynamic_document_update(Request $request, $id, $insurancedynamicdocId){
    //     $request->validate([
    //             'title' => 'string',
    //             'description' => 'string',
    //         ]);

    //     $insurancedynamicdoc = Insurancedynamicdocument::find($insurancedynamicdocId, 'id');
     
    //     $insurancedynamicdoc->title = $request->title;
    //     $insurancedynamicdoc->description = $request->description;

    //     $insurancedynamicdoc->update();

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Document updated successfully.',
    //     ]);
    // }


    public function dynamic_document_update(Request $request, $uuid, $insurancedynamicdocId)
{
    $request->validate([
        'title' => 'string',
        'description' => 'string',
    ]);

    $insurancedynamicdoc = Insurancedynamicdocument::find($insurancedynamicdocId);
    

    if (!$insurancedynamicdoc) {
        return response()->json([
            'status' => 'error',
            'message' => 'Document not found.',
        ], 404);
    }

    $insurancedynamicdoc->title = $request->title;
    $insurancedynamicdoc->description = $request->description;
    // dd($$insurancedynamicdoc);
    $insurancedynamicdoc->update();

    return response()->json([
        'status' => 'success',
        'message' => 'Document updated successfully.',
    ]);
}

    public function dynamic_document_delete($id){
        $insurancedynamicdoc = Insurancedynamicdocument::find($id);
        if($insurancedynamicdoc)
        {
            $insurancedynamicdoc->delete();
            return redirect()->back();
        }
    }

    public function insurance_email_template($uuid){
        $insurance=Insurance::where('uuid', $uuid)->firstOrFail();
        // dd($insurance);
        $insuranceEmailTemplate=Insuranceemailtemplate::where('insurance_id',$insurance->id)->first(); 
        // dd($insuranceEmailTemplate);
        return view('insurance.insurance_email_template', compact('insurance','insuranceEmailTemplate'));
    }

    public function insurance_email_template_update(Request $request, $uuid){
        $request->validate([
                'title' => 'required',
                'description' => 'required',
        ]);
       
    
        $insurance = Insurance::where('uuid', $uuid)->firstOrFail();
        // dd($insurance);
        $insuranceEmailTemplate = Insuranceemailtemplate::where('insurance_id', $insurance->id)->first();
    //    dd($insuranceEmailTemplate);
        // // $insuranceEmailTemplate=Insuranceemailtemplate::where('insurance_id',$insurance->id)->first();
    
        if ($insuranceEmailTemplate != null) {
           
           $mailTemplate = Insuranceemailtemplate::where('insurance_id',$insurance->id)->first();
           $mailTemplate->title = $request->title;
           $mailTemplate->description = $request->description;
        //    dd($mailTemplate);
           $mailTemplate->update();
           return redirect()->route('insurance.summary',$insurance->uuid);
    
        } else {
           
            $mailTemplate = new Insuranceemailtemplate;
            $mailTemplate->title = $request->title;
            $mailTemplate->description = $request->description;
            $mailTemplate->insurance_id = $insurance->id;
            // dd($mailTemplate);
            $mailTemplate->save();
            return redirect()->route('insurance.summary',$insurance->uuid); 
        }


        // return redirect()->route('insurance.email.template',$insuranceEmailTemplate); 
    }

    public function insurance_summary($uuid){
        $insurance = Insurance::where('uuid', $uuid)->with('provider','purchase','staticdocuments','dynamicdocument','insurancemailtemplate')->firstOrFail();
        // dd($insurance);
        return view('insurance.insurance_summary', compact('insurance')); 
    }

    // public function testmail()
    // {
    //     dd('Test');
    //     $emailBody = 'Thank you for submitting your insurance summary. We will process it shortly.';
    
    //     Mail::to('anuradham.dbt@gmail.com')->send(new PolicyHolderEmail($emailBody));

    //     return redirect()->route('insurance.success')->with('message', 'Insurance summary submitted successfully!');
    // }

    public function success(){
        return view('insurance.success');
    }


    
   

    public function show(string $id)
    {
        //
    }

    
    public function edit(string $uuid)
    {
        $provider = Provider::where('status', 1)->get();
        $insurance = Insurance::where('uuid', $uuid)->firstOrFail(); 
        // dd($insurance);

        return view('insurance.edit', compact('provider','insurance')); 
    }

  
    public function update(Request $request, string $uuid)
    {
         $request->validate([
            'name'           => 'required',
        ]);

        $insurance = Insurance::where('uuid', $uuid)->firstOrFail();
        $insurance->name = $request->name;
        $insurance->provider_type = $request->provider_type;
        $insurance->purchase_mode = $request->purchase_mode;
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
        // dd($insurance);
        $insurance->save();

        return redirect()->route('insurance.pricing',$insurance->uuid)->with('message', 'Insurance updated successfully.');

        // return redirect('insurances')->with('message', 'Insurance updated successfully.');
    }

    
    public function destroy(string $uuid)
    {
        $insurance = Insurance::where('uuid', $uuid)->with('staticdocuments','dynamicdocument','insurancemailtemplate')->firstOrFail();
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
