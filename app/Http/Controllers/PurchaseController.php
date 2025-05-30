<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Provider;
use App\Models\Insurance;
use App\Models\Insurancedocument;
use App\Models\Insurancedynamicdocument;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;


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

    public function purchaseList(){
        $purchases = Purchase::where('status', 1)->with('insurance','provider')->paginate(10);
        return view('purchase.list', compact('purchases'));
    }

    public function purchaselist_edit($id){
        $purchase = Purchase::find('insurance_id', $id)->first();
        return view('purchase.edit', compact('purchase'));
    }

    // public function successPage(){
    //     $purchase = Purchase::all();
    //     return view('purchase.success_page',compact('purchase'));
    // }

    public function successPage($id){
        // dd($id);
        $purchase = Purchase::find($id);
        return view('purchase.success_page', compact('purchase'));
    }


    public function detailsPage($id){
        
        $purchase = Purchase::with(['insurance.staticdocuments','insurance.dynamicdocument','invoice'])->find($id);
        // dd($purchase);
        return view('purchase.detail_page', compact('purchase'));
    }

    //  public function downloadDynamicDocument($id)
    // {
        
    //     $insurancePurchase = Purchase::with('insurance')->find($id);
    //     // dd($insurancePurchase);

    //     $dynamicDocument = Insurancedynamicdocument::where('insurance_id', $insurancePurchase->insurance_id)->first();
    //     // dd($dynamicDocument);

    //     $dynamicValues = [
    //         '%InsuranceName%' => $insurancePurchase->insurance->name,
    //         '%policyNo%' => $insurancePurchase->policy_no,
    //         '%policyHolderAddress1%' => $insurancePurchase->policy_holder_address_one . ' ' . $insurancePurchase->policy_holder_address_two . ' ' . $insurancePurchase->policy_holder_post_code,
    //         '%riskAddress%' => $insurancePurchase->door_no . ' ' . $insurancePurchase->address_one . ' ' . $insurancePurchase->address_two . ' ' . $insurancePurchase->address_three . ' ' . $insurancePurchase->post_code,
    //         '%policyStartdate%' => \Carbon\Carbon::parse($insurancePurchase->policy_start_date)->format('d F Y'),
    //         '%policyEnddate%' => \Carbon\Carbon::parse($insurancePurchase->policy_end_date)->format('d F Y'),
    //         '%purchaseDate%' => \Carbon\Carbon::parse($insurancePurchase->purchase_date)->format('d F Y'),
    //         '%insurerTitle%' => $insurancePurchase->insurance->insurer_title ?? '',
    //         '%insurerDescription%' => $insurancePurchase->insurance->insurer_description ?? '',
    //         '%policyTerm%' => $insurancePurchase->policy_term,
    //         '%netAnnualpremium%' => $insurancePurchase->annual_premium,
    //         '%insurancePremiumtax%' => $insurancePurchase->ipt,
    //         '%grossPremium%' => $insurancePurchase->selling_price,
    //         '%rentAmount%' => $insurancePurchase->rent_amount,
    //     ];

    //     $templateBody = str_replace(array_keys($dynamicValues), array_values($dynamicValues), $dynamicDocument->description);


    //     $data = [
    //         'templateTitle' => $dynamicDocument->title,
    //         'templateHeader' => $dynamicDocument->header,
    //         'templateBody' => $templateBody,
    //         'templateFooter' => $dynamicDocument->footer,
    //     ];

    //     // return view('purchase.pdfs.insurance_dynamic_document');
    
    //     $pdf = PDF::loadView('purchase.pdfs.insurance_dynamic_document', compact('data'));

    //     return $pdf->download($dynamicDocument->title . '.pdf');
    // }


    public function downloadDynamicDocument($purchase_id, $document_id)
{
    $insurancePurchase = Purchase::with('insurance')->findOrFail($purchase_id);
    $dynamicDocument = Insurancedynamicdocument::findOrFail($document_id);

    $insurartitle = "";
    if ($insurancePurchase->policy_holder_type == 'Company') {
        $insurartitle = $insurancePurchase->company_name;
    } elseif ($insurancePurchase->policy_holder_type == 'Individual') {
        $insurartitle = $insurancePurchase->policy_holder_title . ' ' . $insurancePurchase->policy_holder_fname . ' ' . $insurancePurchase->policy_holder_lname;
    } else {
        $insurartitle = $insurancePurchase->company_name . '/' . $insurancePurchase->policy_holder_title . ' ' . $insurancePurchase->policy_holder_fname . ' ' . $insurancePurchase->policy_holder_lname;
    }

    $dynamicValues = [
        '%InsuranceName%' => $insurancePurchase->insurance->name,
        '%policyNo%' => $insurancePurchase->policy_no,
        '%policyHolderAddress1%' => $insurancePurchase->policy_holder_address_one . ' ' . $insurancePurchase->policy_holder_address_two . ' ' . $insurancePurchase->policy_holder_post_code,
        '%riskAddress%' => $insurancePurchase->door_no . ' ' . $insurancePurchase->address_one . ' ' . $insurancePurchase->address_two . ' ' . $insurancePurchase->address_three . ' ' . $insurancePurchase->post_code,
        '%policyStartdate%' => \Carbon\Carbon::parse($insurancePurchase->policy_start_date)->format('d F Y'),
        '%policyEnddate%' => \Carbon\Carbon::parse($insurancePurchase->policy_end_date)->format('d F Y'),
        '%purchaseDate%' => \Carbon\Carbon::parse($insurancePurchase->purchase_date)->format('d F Y'),
        '%insurerTitle%' => $insurartitle ?? '',
        '%insurerDescription%' => $insurancePurchase->insurance->insurer_description ?? '',
        '%policyTerm%' => $insurancePurchase->policy_term,
        '%netAnnualpremium%' => $insurancePurchase->insurance->net_premium,
        '%insurancePremiumtax%' => $insurancePurchase->insurance->ipt,
        '%grossPremium%' => $insurancePurchase->insurance->gross_premium,
        '%rentAmount%' => $insurancePurchase->rent_amount,
        // new add
        '%detailsofCover%' => $insurancePurchase->insurance->details_of_cover,
        


    ];

    $templateBody = str_replace(array_keys($dynamicValues), array_values($dynamicValues), $dynamicDocument->description);

    $data = [
        'templateTitle' => $dynamicDocument->title,
        'templateHeader' => $dynamicDocument->header,
        'templateBody' => $templateBody,
        'templateFooter' => $dynamicDocument->footer,
    ];

    $pdf = PDF::loadView('purchase.pdfs.insurance_dynamic_document', compact('data'));

    return $pdf->download($dynamicDocument->title . '.pdf');
}

public function downloadInvoice($purchase_id){
    $purchase = Purchase::with(['insurance','insurance.staticdocuments','insurance.dynamicdocument','invoice'])->find($purchase_id);
    $pdf = PDF::loadView('insurance.policy_invoice', compact('purchase'))->setPaper('a4');
    // return $pdf->download('policy_invoice.pdf');

    $pdfContent = $pdf->output();

    // Define filename and path
    $fileName = 'policy_invoice_' . $purchase_id . '.pdf';
    $directory = public_path('uploads/invoice');
    $filePath = $directory . '/' . $fileName;

    if (!File::exists($directory)) {
        File::makeDirectory($directory, 0755, true);
    }

    file_put_contents($filePath, $pdfContent);

    return response()->download($filePath);
}



}
