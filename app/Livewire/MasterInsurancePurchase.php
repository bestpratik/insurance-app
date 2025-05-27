<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Insurance;
use App\Models\Purchase;
use App\Models\Invoice;
use Carbon\Carbon;
use App\Mail\InsuranceBillingEmail;
use Illuminate\Support\Facades\Mail;
use PDF;


use Illuminate\Validation\Rule;

class MasterInsurancePurchase extends Component 
{
    public $currentStep = 1;

    public $selectedinsuranceId;
    public $insuranceDetails;
    public $availableInsurances;
    public $productType;

    // Step 2: Property info
    public $insuranceType;
    public $rentAmount;
    public $doorNo;
    public $addressOne;
    public $addressTwo;
    public $addressThree;
    public $postCode;

    // Step 3: Policy Holder Info
    public $policyHoldertype = 'Individual'; // default 
    public $companyName;
    public $policyholderTitle;
    public $policyholderFirstName;
    public $policyholderLastName;
    public $policyholderEmail;
    public $policyholderPhone;
    public $policyholderCompanyEmail;
    public $policyholderAlternativePhone;
    public $policyholderAddress1;
    public $policyholderAddress2;
    public $policyholderPostcode;

    // Step 4: Policy Details
    public $policyStartDate;
    public $astStartDate;
    public $policyTerm;

    public $riskAddress;
    // public $premiumAmount;

    // Step 5: Tenant Details
    public $tenantName;
    public $tenantPhone;
    public $tenantEmail;

    // Step 6: Payment Method
    public $paymentMethod;

    // Step 7: Biling Department
    public $billingName;
    public $billingEmail;
    public $billingPhone;
    public $billingAddressOne;
    public $billingAddressTwo;
    public $billingPostcode;
    public $ponNo;

    public $isInvoice;
    public $curDate;

    // Step 8: Summary data
    public $summaryData = [];

    public function mount()
    {
        $this->availableInsurances = Insurance::all();
      
        if ($this->availableInsurances) {
            $this->insuranceDetails = $this->availableInsurances;
            // dd($this->insuranceDetails);
        }
    }

    // public function updatedSelectedinsuranceId($value) 
    // {
    //     $this->insuranceDetails = Insurance::find($value);
    // }

    public function updatedSelectedinsuranceId($value){
        $this->fetchInsuranceDetails();
    }

    public function fetchInsuranceDetails(){
        $this->insuranceDetails = Insurance::with('staticdocuments','dynamicdocument','insurancemailtemplate')->findOrFail($this->selectedinsuranceId);
        // dd($this->insuranceDetails);
    }

    public function updated($propertyName)
    {
        $rules = $this->rulesForStep($this->currentStep);

        if (array_key_exists($propertyName, $rules)) {
            $this->validateOnly($propertyName, $rules);
        }
    }

    public function rulesForStep($step)
    {
        if ($step == 1) {
            return [
                'productType' => 'required',
                'selectedinsuranceId' => 'required|exists:insurances,id',
            ];
        } elseif ($step == 2) {
             return [
                'insuranceType' => 'required',
                'rentAmount' => [
                    'required',
                    'numeric',
                    function ($attribute, $value, $fail) {
                        if (!$this->insuranceDetails) {
                            return;
                        }
                        $minRentAmount = $this->insuranceDetails->rent_amount_from;
                       
                        $maxRentAmount = $this->insuranceDetails->rent_amount_to;
                        if ($value < $minRentAmount || $value > $maxRentAmount) {
                            $fail("The $attribute must be between £$minRentAmount and £$maxRentAmount.");
                        }
                    },
                ],
                'doorNo' => 'required|string',
                'addressOne' => 'required|string',
                'postCode' => 'required|string',
            ];
        } elseif ($step == 3) {
            $rules = [
                'policyHoldertype' => ['required', Rule::in(['Company', 'Individual', 'Both'])],
            ];

            if ($this->policyHoldertype === 'Company') {
                $rules['companyName'] = 'required|string';
                $rules['policyholderCompanyEmail'] = 'required|string';
                $rules['policyholderPostcode'] = 'required|string';
                $rules['policyholderPhone'] = 'required|string';
            } elseif ($this->policyHoldertype === 'Individual') {
                $rules['policyholderTitle'] = 'required|string';
                $rules['policyholderFirstName'] = 'required|string';
                $rules['policyholderLastName'] = 'required|string';
                $rules['policyholderEmail'] = 'required|string';
                $rules['policyholderPhone'] = 'required|string';
            }

            return $rules;
        } elseif ($step == 4) { 
            return [
                    'policyStartDate' => 'required|date',
                    'astStartDate' => 'required|date',
                    'policyTerm' => 'required',
                    // 'premiumAmount' => 'required|numeric|min:0',
            ];
        } elseif ($step == 5) {
            return [
                'tenantName' => 'nullable',
                'tenantPhone' => 'nullable',
                'tenantEmail' => 'nullable',
            ];
        } elseif ($step == 6) {
            return [
                'paymentMethod' => ['required', Rule::in(['pay_later', 'bank_transfer'])],
            ];
        } elseif ($step == 7) {
            return [
                'billingName' => 'required|string',
                'billingEmail' => 'required|email',
                'billingPhone' => 'required',
                'billingAddressOne' => 'required|string',
                'billingPostcode' => 'required'
            ];
        }

        return [];
    }

    public function nextStep()
    {
        $this->validate($this->rulesForStep($this->currentStep));

        if ($this->currentStep < 8) {
            $this->currentStep++;

            if ($this->currentStep === 8) {
                $this->prepareSummaryData();
            }
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function prepareSummaryData()
    {
         $policyEndDate = $this->policyStartDate
        ? date('Y-m-d', strtotime($this->policyStartDate . ' + ' . ($this->insuranceDetails->validity - 1) . ' days'))
        : '';

        $billingAddress = trim("{$this->billingAddressOne}, {$this->billingAddressTwo}, {$this->billingPostcode}");

        $this->summaryData = [
            'Insurance Selected:' => $this->availableInsurances->firstWhere('id', $this->selectedinsuranceId)?->name ?? 'N/A',
            'Product Type:' => $this->productType,
            'Insurance Type:' => $this->insuranceType,
            'Rent Amount:' => '£- ' . $this->rentAmount,
            'Property Address:' => trim("{$this->doorNo}, {$this->addressOne}, {$this->addressTwo}, {$this->addressThree}, {$this->postCode}"),
            'Policy Holder Type:' => $this->policyHoldertype,
            'Company Name:' => $this->policyHoldertype === 'Company' ? $this->companyName : 'N/A',
            'Company Email:' => $this->policyHoldertype === 'Company' ? $this->policyholderCompanyEmail : 'N/A',
            'Policy Holder Name:' => $this->policyHoldertype === 'Individual' ? "{$this->policyholderTitle} {$this->policyholderFirstName} {$this->policyholderLastName}" : 'N/A',
            'Policy Holder Email:' => $this->policyholderEmail,
            'Policy Holder Phone:' => $this->policyholderPhone,
            'Policy Term:' => $this->policyTerm . ' Year',
            'Policy Start Date:' => Carbon::parse($this->policyStartDate)->format('d F Y'),
            'Ast Start Date:' => Carbon::parse($this->astStartDate)->format('d F Y'),

            'Policy End Date' => Carbon::parse($policyEndDate)->format('d F Y'),
            'Billing Name' => $this->billingName,
            'Billing Email' => $this->billingEmail,
            'Billing Phone' => $this->billingPhone,
            'Billing Postcode' => $this->billingPostcode,
            'Billing Address' => $billingAddress,
            'Pon No' => $this->ponNo,
            // 'Policy End Date' => $this->policyEndDate,
            // 'Premium Amount' => $this->premiumAmount,
            'Tenant Name:' => $this->tenantName ?? 'N/A',
            'Tenant Phone:' => $this->tenantPhone ?? 'N/A',
            'Tenant Email:' => $this->tenantEmail ?? 'N/A',
            'Payment Method' => str_replace('_', ' ', $this->paymentMethod),
        ];
    }

    public function submitForm()
    {
        $allRules = array_merge(
            $this->rulesForStep(1),
            $this->rulesForStep(2),
            $this->rulesForStep(3),
            $this->rulesForStep(4),
            $this->rulesForStep(5),
            $this->rulesForStep(6),
            $this->rulesForStep(7)
        );

        $this->validate($allRules);

        // $insurance = Insurance::find($this->selectedinsuranceId);
        // $validityDays = $insurance->validity;

        // $policyStart = Carbon::parse($this->policyStartDate);
        // $policyEnd = $policyStart->copy()->addDays($validityDays);
        // $this->policyEndDate = $policyEnd->toDateString();

        $purchase = new Purchase();
        $purchase->insurance_id = $this->selectedinsuranceId;
        $purchase->product_type = $this->productType;
        $purchase->insurance_type = $this->insuranceType;
        $purchase->rent_amount = $this->rentAmount;
        $purchase->door_no = $this->doorNo;
        $purchase->address_one = $this->addressOne;
        $purchase->address_two = $this->addressTwo;
        $purchase->address_three = $this->addressThree;
        $purchase->post_code = $this->postCode;

        $purchase->policy_holder_type = $this->policyHoldertype;
        $purchase->policy_holder_address = $this->doorNo . ',' . $this->addressOne . ',' . $this->addressTwo . ',' . $this->addressThree . ',' . $this->postCode ;
        $purchase->company_name = $this->policyHoldertype === 'Company' ? $this->companyName : null;
        $purchase->policy_holder_company_email = $this->policyHoldertype === 'Company' ? $this->policyholderCompanyEmail : null;
        $purchase->policy_holder_title = $this->policyHoldertype === 'Individual' ? $this->policyholderTitle : null;
        $purchase->policy_holder_fname = $this->policyHoldertype === 'Individual' ? $this->policyholderFirstName : null;
        $purchase->policy_holder_lname = $this->policyHoldertype === 'Individual' ? $this->policyholderLastName : null;
        $purchase->policy_holder_email = $this->policyholderEmail;
        $purchase->policy_holder_phone = $this->policyholderPhone;
        $purchase->policy_holder_alternative_phone = $this->policyholderAlternativePhone;
        $purchase->policy_holder_postcode = $this->policyholderPostcode;
        $purchase->policy_holder_address_one = $this->policyholderAddress1;
        $purchase->policy_holder_address_two = $this->policyholderAddress2;
        $purchase->policy_no = $this->insuranceDetails->prefix.'-'.rand(1000000000,9999999999);

        $purchase->policy_start_date = $this->policyStartDate;
        $purchase->policy_end_date = date('Y-m-d', strtotime($this->policyStartDate. ' + '.($this->insuranceDetails->validity - 1).' days'));
        $purchase->ast_start_date = $this->astStartDate;
        $purchase->policy_term = $this->policyTerm;
        $purchase->purchase_date = now();
        // $purchase->payable_amount = $this->premiumAmount;

        $purchase->tenant_name = $this->tenantName;
        $purchase->tenant_phone = $this->tenantPhone;
        $purchase->tenant_email = $this->tenantEmail;

        $purchase->payment_method = $this->paymentMethod;

        $purchase->save();

        $invoice = new Invoice();
        $invoice->purchase_id = $purchase->id;
        $invoice->billing_name = $this->billingName;
        $invoice->billing_email = $this->billingEmail;
        $invoice->billing_phone = $this->billingPhone;
        $invoice->billing_address_one = $this->billingAddressOne;
        $invoice->billing_address_two = $this->billingAddressTwo;
        $invoice->billing_postcode = $this->billingPostcode;
        $invoice->billing_full_addresss = trim("{$this->billingAddressOne}, {$this->billingAddressTwo}, {$this->billingPostcode}");
        $invoice->pon = $this->ponNo;

        $curDate = date('Y-m-d');
        $payment_due_date = date('Y-m-d', strtotime($curDate. ' + 7 days'));
        $invoice->payment_due_date = $payment_due_date;

        $invoice->invoice_no = $purchase->id;
        $invoice->invoice_date  = $curDate;
            

        $invoice->is_invoice = $this->isInvoice ? 1 : 0;
      
        $invoice->save();

        if ($invoice->is_invoice == 1)
        {
                $staticDocs = [];
                if ($this->insuranceDetails && $this->insuranceDetails->insurancedocument) {
                    foreach ($this->insuranceDetails->insurancedocument as $docs) {
                       $filePath = public_path('uploads/' . $docs->document);
                        if (file_exists($filePath)) {
                            $staticDocs[] = $filePath;
                        }     
                    }
                }

                //Date format changes
                $dd_policy_start_date = Carbon::parse($purchase->policy_start_date);
                $dd_policy_end_date = Carbon::parse($purchase->policy_end_date);
                $dd_purchase_date = Carbon::parse($purchase->purchase_date);
                //Dynamic Detaills
                $dynamic_body_value = array();
                $dynamic_body_value[] = $purchase->insurance_name;
                $dynamic_body_value[] = $purchase->policy_no;

                if($purchase->policy_holder_type == 'Company'){
                    $dynamic_body_value[] = $purchase->company_name;
                }else{
                    $dynamic_body_value[] = $purchase->policy_holder_name;
                }
                $dynamic_body_value[] = $purchase->policy_holder_address_one.' '.$purchase->policy_holder_address_two.' '.$purchase->policy_holder_post_code;
                $dynamic_body_value[] = $purchase->door_no.' '.$purchase->address_one.' '.$purchase->address_two.' '.$purchase->address_three.' '.$purchase->post_code;
                $dynamic_body_value[] = $dd_policy_start_date->format('d F Y');
                $dynamic_body_value[] = $dd_policy_end_date->format('d F Y');
                $dynamic_body_value[] = $dd_purchase_date->format('d F Y');
                $dynamic_body_value[] = $this->insuranceDetails->insurer_title;
                $dynamic_body_value[] = $this->insuranceDetails->insurer_description;
                $dynamic_body_value[] = $this->insuranceDetails->details_of_cover;
                $dynamic_body_value[] = $purchase->policyTerm;

                $dynamic_body_value[] = $purchase->annual_premium;
                $dynamic_body_value[] = $purchase->ipt;
                $dynamic_body_value[] = $purchase->payable_amount;
                $dynamic_body_value[] = $purchase->rent_amount;

                //Dynamic Documents
                if($this->insuranceDetails && $this->insuranceDetails->dynamicdocument) 
                {
                    foreach($this->insuranceDetails->dynamicdocument as $dydocs) 
                    {
                        $file_name = $dydocs->title .rand(11,999999). '.pdf';
                        $data = array(
                            'templateTitle' => $dydocs->title,
                            'templateBody' => $dydocs->description,
                            'templateHeder' => $dydocs->header,
                            'templateFooter' => $dydocs->footer,
                            'templatebodyValue' => $dynamic_body_value
                        );
                        $pdf = PDF::loadView('purchase.pdfs.insurance_dynamic_document', ['data' => $data]);
                        $pdfPath = public_path('uploads/dynamicdoc' . $file_name); 
                        $pdf->save($pdfPath);
                        if (file_exists($pdfPath)) 
                        {
                            $staticDocs[] = $pdfPath;
                        } 
                    }
                }

                //Emails
                //Get purchaser email & landlord email
                $sendToemils = array(
                    // $purchase->user->email,
                    $purchase->invoice->billing_email
                );
                $email_subject = 'YOUR POLICY SCHEDULE - Help2Rent';
                $user['to'] = 'anuradham.dbt@gmail.com';
                $data = array(
                    'body' => $this->insuranceDetails->insurancemailtemplate->description ?? '', 
                    'bodyValue' => $dynamic_body_value
                    );
                // dd($data);
                Mail::send('email.insurance_billing',$data, function($messages) use ($sendToemils, $staticDocs, $email_subject){
                    //$messages->to($user['to']);
                    $messages->to($sendToemils);
                    $messages->subject($email_subject);
                    $messages->cc(['anuradha.mondal2013@gmail.com']);
                    $messages->bcc(['anuradha.mondal2013@gmail.com']);
                    foreach ($staticDocs as $attachment) {
                        $messages->attach($attachment);
                    }
                });
            } 

        // if ($invoice->is_invoice == 1) {

        //     $template = "
        //         Insurance Name: %InsuranceName%
        //         Policy Number: %policyNo%
        //         Policy Holder Address: %policyHolderAddress1%
        //         Risk Address: %riskAddress%
        //         Policy Start Date: %policyStartdate%
        //         Policy End Date: %policyEnddate%
        //         Purchase Date: %purchaseDate%
        //         Policy Term: %policyTerm%
        //         Rent Amount: %rentAmount%
        //         Billing Name: %billingName%
        //         Billing Email: %billingEmail%
        //         Billing Phone: %billingPhone%
        //         Billing Address: %billingAddress%
        //         PON No: %ponNo%
        //     ";

        //     $placeholders = [
        //         '%InsuranceName%' => $this->insuranceDetails->name ?? '',
        //         '%policyNo%' => $purchase->policy_no,
        //         '%policyHolderAddress1%' => trim("{$purchase->policy_holder_address_one} {$purchase->policy_holder_address_two} {$purchase->policy_holder_postcode}"),
        //         '%riskAddress%' => trim("{$purchase->door_no} {$purchase->address_one} {$purchase->address_two} {$purchase->address_three} {$purchase->post_code}"),
        //         '%policyStartdate%' => Carbon::parse($purchase->policy_start_date)->format('d F Y'),
        //         '%policyEnddate%' => Carbon::parse($purchase->policy_end_date)->format('d F Y'),
        //         '%purchaseDate%' => Carbon::parse($purchase->purchase_date)->format('d F Y'),
        //         '%policyTerm%' => $purchase->policy_term,
        //         '%rentAmount%' => $purchase->rent_amount,
        //         '%netAnnualpremium%' => ,
        //         '%insurancePremiumtax%' => ,
        //         '%grossPremium%' => ,
        //         '%rentAmount%' => ,
        //     ];

        //     $finalContent = str_replace(array_keys($placeholders), array_values($placeholders), $template);
        //     // dd($finalContent);
            
        //     // Mail::raw($finalContent, function ($message) use ($invoice) {
        //     //     $message->to($invoice->billing_email)
        //     //             ->subject('Your Insurance Purchase Invoice');
        //     // });

        //     Mail::to($invoice->billing_email)->send(new InsuranceBillingEmail($invoice, $finalContent));

        // }

        return redirect()->route('purchase.success', ['id' => $purchase->id]);


        // session()->flash('message', 'Insurance purchase successfully created!');
        // return redirect()->route('purchase.success');
    }


    public function send_email_one($purchaseId){
        $purchase = Purchase::with('invoice')->findorfail($purchaseId);
        if($purchase){
            $insurance = Insurance::with('staticdocuments','dynamicdocument','insurancemailtemplate')->findOrFail($purchase->insurance_id);
            //Load all documents
             // - 1. Load static documents
            $allDocs = [];
            if ($insurance && $insurance->staticdocuments) {
                foreach ($insurance->staticdocuments as $docs) {
                    $filePath = public_path('uploads/insurance_document/' . $docs->document);
                    if (file_exists($filePath)) {
                        $allDocs[] = $filePath;
                    }     
                }
            }

            //PDFs dynamic value for dynamic documents
            $pdfDynamicval = array();
            $pdfDynamicval[] = $insurance->name;
            $pdfDynamicval[] = $purchase->policy_no;
            $pdfDynamicval[] = $purchase->policy_holder_address;
            $pdfDynamicval[] = $purchase->policy_start_date;
            $pdfDynamicval[] = $purchase->policy_end_date;
            $pdfDynamicval[] = $purchase->purchase_date;
            $pdfDynamicval[] = $purchase->policy_term;
            $pdfDynamicval[] = $insurance->net_premium;
            $pdfDynamicval[] = $insurance->ipt;
            $pdfDynamicval[] = $insurance->gross_premium;
            $pdfDynamicval[] = $insurance->rent_amount;

            // - 2. Load dynamic documents
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

                    $pdf = PDF::loadView('purchase.pdfs.insurance_dynamic_document', ['data' => $data]);
                    $pdfPath = public_path('uploads/dynamicdoc' . $file_name); 
                    $pdf->save($pdfPath);
                    if (file_exists($pdfPath)) {
                        $allDocs[] = $pdfPath;
                    }     
                }
            }

            //Load dynamic email template
            /*Dynamic Value*/
            $bodyValue = array();
            $bodyValue[] = $insurance->name;
            $bodyValue[] = $purchase->policy_no;
            $bodyValue[] = $purchase->policy_holder_address;
            $bodyValue[] = $purchase->door_no.''.$purchase->address_one.' '.$purchase->address_two.''.$purchase->address_three.''.$purchase->post_code;
            $bodyValue[] = $purchase->policy_start_date;
            $bodyValue[] = $purchase->policy_end_date;
            $bodyValue[] = $purchase->purchase_date;
            $bodyValue[] = $purchase->policy_term;
            $bodyValue[] = $insurance->net_premium;
            $bodyValue[] = $insurance->ipt;
            $bodyValue[] = $insurance->gross_premium;
            $bodyValue[] = $insurance->rent_amount;


            //Now send email
            $sendToemils = array(
                // $purchase->user->email,
                //$purchase->invoice->billing_email
                'sujoyinkolkata1@gmail.com'
            );
            $email_subject = 'YOUR POLICY SCHEDULE - MoneyWise PLC';
            $data = array(
                'body' => $insurance->insurancemailtemplate->description ?? '', 
                'bodyValue' => $bodyValue
                );
            Mail::send('email.insurance_billing',$data, function($messages) use ($sendToemils, $allDocs, $email_subject){
                    //$messages->to($user['to']);
                    $messages->to($sendToemils);
                    $messages->subject($email_subject);
                    //$messages->cc(['anuradha.mondal2013@gmail.com']);
                    $messages->bcc(['anuradha.mondal2013@gmail.com']);
                    foreach ($allDocs as $attachment) {
                        $messages->attach($attachment);
                    }
            });


        }
        
    }



    public function render()
    {
        return view('livewire.master-insurance-purchase');
    }
}
