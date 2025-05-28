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



class InsuranceController extends Controller
{
<<<<<<< HEAD
=======

       public function policy_holder_email(){
        $purchase = Purchase::findorfail(23);
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
                    return view('purchase.pdfs.insurance_dynamic_document', ['data' => $data]);

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

>>>>>>> development
    
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
            // dd($insurance);
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
            // $insurancedynamicdoc->header = $request->header;
            $insurancedynamicdoc->description = $request->description;
            // $insurancedynamicdoc->footer = $request->footer;

            // dd($Insurancedocument);
            $insurancedynamicdoc->save();
            // return redirect()->back()->with('message','Static Document Added Successfully!');

            return redirect()->route('insurance.dynamic.document',$id); 
    }

    public function dynamic_document_delete($id){
        $insurancedynamicdoc = Insurancedynamicdocument::find($id);
        if($insurancedynamicdoc)
        {
            $insurancedynamicdoc->delete();
            return redirect()->back();
        }
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
