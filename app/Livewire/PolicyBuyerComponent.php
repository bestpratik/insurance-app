<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Insurance;
use App\Models\Purchase;
use App\Models\Invoice;
use App\Models\Service;
use Carbon\Carbon;
use App\Mail\InsuranceBillingEmail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Str;

use Illuminate\Validation\Rule;

class PolicyBuyerComponent extends Component
{

    public $currentStep = 1;
    public $insuranceId;
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
    public $copyEmail;

    // Step 4: Policy Details
    public $policyStartDate;
    public $purchaseDate;
    public $astStartDate;
    public $policyTerm;

    public $riskAddress;
    // public $premiumAmount;

    // Step 5: Tenant Details
    public $tenantName;
    public $tenantPhone;
    public $tenantEmail;

    // Step 6: Payment Method
    // public $paymentMethod;

    // Step 6: Biling Department
    public $billingName;
    public $billingEmail;
    public $copyBillingEmail;
    public $billingPhone;
    public $billingAddressOne;
    public $billingAddressTwo;
    public $billingPostcode;
    public $ponNo;

    public $isInvoice;
    public $curDate;

    // Step 7: Summary data
    public $summaryData = [];
    public $selectedInsuranceId;
    public $disableInsuranceSelect = false;
    public $selectedInsuranceName;


    public function mount($insuranceId = null)
    {
        // if (!Auth::check()) {
        //     session()->flash('error', 'Please log in to continue.');
        //     redirect()->route('user.login');
        // }

        $this->policyTerm = 1;
        $this->isInvoice = true;

        $this->availableInsurances = Insurance::where('purchase_mode', 'Online')
            ->with('services')
            ->get();

        if ($this->availableInsurances) {
            $this->insuranceDetails = $this->availableInsurances;
            // dd($this->insuranceDetails);
        }

        // if ($insuranceId) {
        //     $this->selectedInsuranceId = $insuranceId;
        //     $this->disableInsuranceSelect = true;
        // }

        if ($insuranceId) {
            $this->selectedInsuranceId = $insuranceId;
            $insurance = $this->availableInsurances->firstWhere('id', $insuranceId);
            if ($insurance) {
                $offers = $insurance->services->pluck('offer')->join(', ');
                $this->selectedInsuranceName = $insurance->name . ($offers ? " ($offers)" : "");
            }
            $this->disableInsuranceSelect = true;
        }
    }


    public function updatedProductType($value)
    {
        if ($value === 'Agent') {
            $this->policyHoldertype = 'Both';
        }
    }

    public function updatedSelectedinsuranceId($value)
    {
        $this->fetchInsuranceDetails();
    }

    public function fetchInsuranceDetails()
    {
        $this->insuranceDetails = Insurance::with('staticdocuments', 'dynamicdocument', 'insurancemailtemplate')->findOrFail($this->selectedinsuranceId);
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
            } elseif ($this->policyHoldertype === 'Both') {
                $rules['companyName'] = 'required|string';
                $rules['policyholderCompanyEmail'] = 'required|string';
                $rules['policyholderTitle'] = 'required|string';
                $rules['policyholderFirstName'] = 'required|string';
                $rules['policyholderLastName'] = 'required|string';
                $rules['policyholderEmail'] = 'required|string';
                $rules['policyholderPostcode'] = 'required|string';
                $rules['policyholderPhone'] = 'required|string';
            }

            return $rules;
        } elseif ($step == 4) {
            return [
                'policyStartDate' => 'required|date|after_or_equal:today',
                // 'purchaseDate' => 'required|date',
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
        }
        //  elseif ($step == 6) {
        //     return [
        //         'paymentMethod' => ['required', Rule::in(['pay_later', 'bank_transfer'])],
        //     ];
        // }
        elseif ($step == 6) {
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

        if ($this->currentStep < 7) {
            $this->currentStep++;

            if ($this->currentStep === 7) {
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
            // 'Property Address:' => trim("{$this->doorNo}, {$this->addressOne}, {$this->addressTwo}, {$this->addressThree}, {$this->postCode}"),
            'Property Address:' => implode(', ', array_filter([
                $this->doorNo,
                $this->addressOne,
                $this->addressTwo,
                $this->addressThree,
                $this->postCode,
            ])),

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
            // 'Pon No' => $this->ponNo,
            // 'Policy End Date' => $this->policyEndDate,
            // 'Premium Amount' => $this->premiumAmount,
            'Tenant Name:' => $this->tenantName ?? 'N/A',
            'Tenant Phone:' => $this->tenantPhone ?? 'N/A',
            'Tenant Email:' => $this->tenantEmail ?? 'N/A',
            // 'Payment Method' => str_replace('_', ' ', $this->paymentMethod),
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
            // $this->rulesForStep(7)
        );

        $this->validate($allRules);

        // $insurance = Insurance::find($this->selectedinsuranceId);
        // $validityDays = $insurance->validity;

        // $policyStart = Carbon::parse($this->policyStartDate);
        // $policyEnd = $policyStart->copy()->addDays($validityDays);
        // $this->policyEndDate = $policyEnd->toDateString();

        $userId = Auth::id();;
        // dd($userId);

        // if (!Auth::check()) {
        //     session()->flash('error', 'You must be logged in to submit Policy Buyer Form.');
        //     return redirect()->route('user.login');
        // }



        $purchase = new Purchase();
        $purchase->user_id = $userId;
        $purchase->insurance_id = $this->selectedInsuranceId;
        $purchase->product_type = $this->productType;
        $purchase->insurance_type = $this->insuranceType;
        $purchase->rent_amount = $this->rentAmount;
        $purchase->door_no = $this->doorNo;
        $purchase->address_one = $this->addressOne;
        $purchase->address_two = $this->addressTwo;
        $purchase->address_three = $this->addressThree;
        $purchase->post_code = $this->postCode;
        $purchase->policy_holder_type = $this->policyHoldertype;
        $purchase->property_address = $this->doorNo . ',' . $this->addressOne . ',' . $this->addressTwo . ',' . $this->addressThree . ',' . $this->postCode;
        $purchase->policy_holder_address = $this->policyholderAddress1 . ' ' . $this->policyholderAddress2 . ' ' . $this->policyholderPostcode;

        // $purchase->company_name = $this->policyHoldertype === 'Company' ? $this->companyName : null;
        // $purchase->policy_holder_company_email = $this->policyHoldertype === 'Company' ? $this->policyholderCompanyEmail : null;
        // $purchase->policy_holder_title = $this->policyHoldertype === 'Individual' ? $this->policyholderTitle : null;
        // $purchase->policy_holder_fname = $this->policyHoldertype === 'Individual' ? $this->policyholderFirstName : null;
        // $purchase->policy_holder_lname = $this->policyHoldertype === 'Individual' ? $this->policyholderLastName : null;
        // $purchase->policy_holder_email = $this->policyholderEmail;

        // ✅ Save Company details if Company or Both
        if (in_array($this->policyHoldertype, ['Company', 'Both'])) {
            $purchase->company_name = $this->companyName;
            $purchase->policy_holder_company_email = $this->policyholderCompanyEmail;
        }

        // ✅ Save Individual details if Individual or Both
        if (in_array($this->policyHoldertype, ['Individual', 'Both'])) {
            $purchase->policy_holder_title = $this->policyholderTitle;
            $purchase->policy_holder_fname = $this->policyholderFirstName;
            $purchase->policy_holder_lname = $this->policyholderLastName;
            $purchase->policy_holder_email = $this->policyholderEmail;
        }

        $purchase->policy_holder_phone = $this->policyholderPhone;
        $purchase->policy_holder_alternative_phone = $this->policyholderAlternativePhone;
        $purchase->policy_holder_postcode = $this->policyholderPostcode;
        $this->copyEmail = preg_replace('/[\s,]+/', ' ', $this->copyEmail);
        $purchase->copy_email = collect(explode(' ', str_replace(',', ' ', $this->copyEmail)))
            ->filter()
            ->map(fn($email) => trim($email))
            ->unique()
            ->implode(',');

        $purchase->policy_holder_address_one = $this->policyholderAddress1;
        $purchase->policy_holder_address_two = $this->policyholderAddress2;
        $purchase->policy_no = $this->insuranceDetails->prefix . '-' . rand(1000000000, 9999999999);

        $purchase->policy_start_date = $this->policyStartDate;
        $purchase->policy_end_date = date('Y-m-d', strtotime($this->policyStartDate . ' + ' . ($this->insuranceDetails->validity - 1) . ' days'));
        $purchase->ast_start_date = $this->astStartDate;
        $purchase->purchase_date = now();
        $purchase->policy_term = $this->policyTerm;


        $purchase->net_premium = $this->insuranceDetails->net_premium;
        $purchase->commission = $this->insuranceDetails->commission;
        $purchase->gross_premium = $this->insuranceDetails->gross_premium;
        $purchase->ipt = $this->insuranceDetails->ipt;
        $purchase->total_premium = $this->insuranceDetails->total_premium;
        $purchase->payable_amount = $this->insuranceDetails->payable_amount;
        $purchase->ipt_on_billable_amount = $this->insuranceDetails->ipt_on_billable_amount;
        $purchase->admin_fee = $this->insuranceDetails->admin_fee;



        // $purchase->purchase_date = now();
        // $purchase->payable_amount = $this->premiumAmount;

        $purchase->tenant_name = $this->tenantName;
        $purchase->tenant_phone = $this->tenantPhone;
        $purchase->tenant_email = $this->tenantEmail;

        // $purchase->payment_method = $this->paymentMethod;

        if (!$userId) {
            $guestToken = (string) Str::uuid();
            $purchase->token  = $guestToken;
            session()->put('guest_purchase_token', $guestToken);
        }

        // dd($purchase);
        $purchase->save();

        $invoice = new Invoice();
        $invoice->purchase_id = $purchase->id;
        $invoice->billing_name = $this->billingName;
        $invoice->billing_email = $this->billingEmail;
        $this->copyBillingEmail = preg_replace('/[\s,]+/', ' ', $this->copyBillingEmail);
        $invoice->copy_email = collect(explode(' ', str_replace(',', ' ', $this->copyBillingEmail)))
            ->filter()
            ->map(fn($email) => trim($email))
            ->unique()
            ->implode(',');
        $invoice->billing_phone = $this->billingPhone;
        $invoice->billing_address_one = $this->billingAddressOne;
        $invoice->billing_address_two = $this->billingAddressTwo;
        $invoice->billing_postcode = $this->billingPostcode;
        $invoice->billing_full_addresss = trim("{$this->billingAddressOne}, {$this->billingAddressTwo}, {$this->billingPostcode}");
        $invoice->pon = $this->ponNo;

        $curDate = date('Y-m-d');
        $payment_due_date = date('Y-m-d', strtotime($curDate . ' + 7 days'));
        $invoice->payment_due_date = $payment_due_date;

        $invoice->invoice_no = $purchase->id;
        $invoice->invoice_date  = $curDate;


        $invoice->is_invoice = 1;

        $invoice->save();



        //Policy holder email send
        // $this->send_email_one($purchase->id);

        // if($invoice->is_invoice == 1){

        //     $this->send_email_two($purchase->id);
        // }

        // if (!Auth::check()) {
        //     session()->flash('error', 'You must be logged in to submit Policy Buyer Form.');
        //     return redirect()->route('user.login');
        // }

        // if (!$userId) {
        //     session()->flash('error', 'You must be logged in to complete your purchase.');
        //     return redirect()->route('user.login');
        // }

        // if (!$userId) {
        //     session()->put('guest_redirect_intended', url()->current());
        //     return redirect()->route('user.register'); 
        // }

        if (!$userId) {
            $guestToken = (string) Str::uuid();
            $purchase->token  = $guestToken;
            $purchase->save();

            session()->put('guest_purchase_token', $guestToken);
            session()->put('resume_summary', true);

            return redirect()->route('user.register');
        }

        // ✅ Store purchase ID in session
        session()->put('pending_purchase_id', $purchase->id);

        // ✅ Redirect to Stripe
        return redirect()->route('stripe.booking');

        // return redirect()->route('front.purchase.success');


        // session()->flash('message', 'Insurance purchase successfully created!');
        // return redirect()->route('purchase.success');
    }


    //Policy holder email
    public function send_email_one($purchaseId)
    {
        $purchase = Purchase::with('invoice')->findorfail($purchaseId);
        if ($purchase) {
            $insurance = Insurance::with('staticdocuments', 'dynamicdocument', 'insurancemailtemplate')->findOrFail($purchase->insurance_id);
            //Load all documents
            // - 1. Load static documents
            $allDocs = [];
            if ($insurance && $insurance->staticdocuments) {
                foreach ($insurance->staticdocuments as $docs) {
                    // $filePath = public_path('uploads/insurance_document/' . $docs->document);
                    // if (file_exists($filePath)) {
                    //     $allDocs[] = $filePath;
                    // }

                    $filePath = public_path('uploads/insurance_document/');
                    if (file_exists($filePath)) {
                        $newStaticName = 'policy-wording-' . $purchase->policy_no . '.pdf';
                        $newStaticPath = public_path($filePath . $newStaticName);
                        $allDocs[] = $newStaticPath;
                    }
                }
            }

            //PDFs dynamic value for dynamic documents
            $pdfDynamicval = array();
            $pdfDynamicval[] = $insurance->name;
            $pdfDynamicval[] = $purchase->policy_no;
            $pdfDynamicval[] = $purchase->policy_holder_address;
            $pdfDynamicval[] = date('jS F Y', strtotime($purchase->policy_start_date));
            $pdfDynamicval[] = date('jS F Y', strtotime($purchase->policy_end_date));
            $pdfDynamicval[] = date('jS F Y', strtotime($purchase->purchase_date));
            $pdfDynamicval[] = $purchase->policy_term;
            $pdfDynamicval[] = $purchase->net_premium;
            $pdfDynamicval[] = $purchase->ipt;
            $pdfDynamicval[] = $purchase->gross_premium;
            $pdfDynamicval[] = $purchase->rent_amount;
            $riskAddress = $purchase->door_no . ' ' . $purchase->address_one . ' ' . $purchase->address_two . ' ' . $purchase->address_three . ' ' . $purchase->post_code;

            $insurartitle = "";
            if ($purchase->policy_holder_type == 'Company') {
                $insurartitle = $purchase->company_name;
            } elseif ($purchase->policy_holder_type == 'Individual') {
                $insurartitle = $purchase->policy_holder_title . ' ' . $purchase->policy_holder_fname . ' ' . $purchase->policy_holder_lname;
            } else {
                $insurartitle = $purchase->company_name . '/' . $purchase->policy_holder_title . ' ' . $purchase->policy_holder_fname . ' ' . $purchase->policy_holder_lname;
            }

            $pdfDynamicval[] = $riskAddress;
            $pdfDynamicval[] = $insurartitle;
            $pdfDynamicval[] = $insurance->details_of_cover;

            // - 2. Load dynamic documents
            if ($insurance && $insurance->dynamicdocument) {
                foreach ($insurance->dynamicdocument as $dydocs) {
                    // $file_name = $dydocs->title . rand(11, 999999) . '.pdf';

                    $file_name = 'policy-wording-' . $purchase->policy_no . '.pdf';

                    $data = array(
                        'templateTitle' => $dydocs->title,
                        'templateBody' => $dydocs->description,
                        'templateHeder' => $dydocs->header,
                        'templateFooter' => $dydocs->footer,
                        'templatebodyValue' => $pdfDynamicval
                    );

                    $pdf = PDF::loadView('purchase.pdfs.insurance_dynamic_document_email', ['data' => $data]);
                    $pdfPath = public_path('uploads/dynamicdoc/' . $file_name);
                    $pdf->save($pdfPath);
                    if (file_exists($pdfPath)) {
                        $allDocs[] = $pdfPath;
                    }
                }
            }

            //Load dynamic email template
            /*Dynamic Value*/
            $bodyValue = array();
            /*Dynamic Value*/
            $bodyValue[] = $insurance->name;
            $bodyValue[] = $purchase->policy_no;
            $bodyValue[] = $purchase->policy_holder_address;
            $bodyValue[] = date('jS F Y', strtotime($purchase->policy_start_date));
            $bodyValue[] = date('jS F Y', strtotime($purchase->policy_end_date));
            $bodyValue[] = date('jS F Y', strtotime($purchase->purchase_date));
            $bodyValue[] = $purchase->policy_term;
            $bodyValue[] = $purchase->net_premium;
            $bodyValue[] = $purchase->ipt;
            $bodyValue[] = $purchase->gross_premium;
            $bodyValue[] = $purchase->rent_amount;
            $bodyValue[] = $riskAddress;
            $bodyValue[] = $insurartitle;
            $bodyValue[] = $insurance->details_of_cover;


            $sendToemails = [];

            if ($purchase->policy_holder_type === 'Company') {
                $sendToemails[] = $purchase->policy_holder_company_email;
            } elseif ($purchase->policy_holder_type === 'Individual') {
                $sendToemails[] = $purchase->policy_holder_email;
            } elseif ($purchase->policy_holder_type === 'Both') {
                $sendToemails[] = $purchase->policy_holder_email;
                $sendToemails[] = $purchase->policy_holder_company_email;
            }


            $sendToemails = array_filter($sendToemails, function ($email) {
                return filter_var($email, FILTER_VALIDATE_EMAIL);
            });

            // dd($purchase->policy_holder_email, $purchase->policy_holder_company_email);


            //Now send email
            // $sendToemails = array(
            //     $purchase->policy_holder_email,
            // );
            $email_subject = $insurance->insurancemailtemplate->title ?? '';
            $data = array(
                'body' => $insurance->insurancemailtemplate->description ?? '',
                'bodyValue' => $bodyValue
            );


            try {

                $copyEmails = explode(',', $purchase->copy_email);
                $validCopyEmails = array_filter(array_map('trim', $copyEmails), function ($email) {
                    return filter_var($email, FILTER_VALIDATE_EMAIL);
                });

                $ccEmails = array_merge(['aadatia@moneywiseplc.co.uk'], $validCopyEmails);

                foreach ($sendToemails as $email) {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        throw new \Exception("Invalid To Email: $email");
                        //  abort(404); 
                    }
                }

                Mail::send('email.insurance_billing', $data, function ($messages) use ($sendToemails, $allDocs, $email_subject, $ccEmails) {
                    $messages->to($sendToemails);
                    $messages->subject($email_subject);
                    $messages->cc($ccEmails);
                    $messages->bcc(['bestpratik@gmail.com']);

                    foreach ($allDocs as $attachment) {
                        $messages->attach($attachment);
                    }
                });


                // Mail::send('email.insurance_billing', $data, function ($messages) use ($sendToemils, $allDocs, $email_subject, $purchase) {
                //     //$messages->to($user['to']); 
                //     $messages->to($sendToemils);
                //     $messages->subject($email_subject);
                //     // $messages->cc(['aadatia@moneywiseplc.co.uk']);
                //     // $messages->cc(['aadatia@moneywiseplc.co.uk'],explode(',', $purchase->copy_email));
                //     $ccEmails = array_merge(['anuradham.dbt@gmail.com'], explode(',', $purchase->copy_email));
                //     $messages->cc($ccEmails);
                //     // $messages->bcc(['bestpratik@gmail.com']);
                //     foreach ($allDocs as $attachment) {
                //         $messages->attach($attachment);
                //     }
                // });

                return true;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function send_email_two($purchaseId)
    {
        $purchase = Purchase::with(['insurance', 'insurance.staticdocuments', 'insurance.dynamicdocument', 'invoice'])->find($purchaseId);

        if (!$purchase) {
            return 'Purchase not found.';
        }

        $pdf = PDF::loadView('insurance.policy_invoice', compact('purchase'))->setPaper('a4');
        $pdfContent = $pdf->output();

        // Define filename and path
        $fileName = 'policy_invoice_' . $purchaseId . '.pdf';
        $directory = public_path('uploads/invoice');
        $filePath = $directory . '/' . $fileName;
        // dd($filePath);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        file_put_contents($filePath, $pdfContent);

        // Send email
        $sendToBillingEmails = [$purchase->invoice->billing_email];
        // dd($sendToBillingEmails);
        $emailSubject = 'Moneywise Investments PLC - Invoice for Policy - ' . $purchase->policy_no;
        $data = [
            'body' => 'Dear client,<br>
                 Please find the attached invoice for policy no. ' . $purchase->policy_no . '.'
        ];
        // dd($data);?\

        try {

            $copyEmails = explode(',', $purchase->copy_email);
            $validCopyEmails = array_filter(array_map('trim', $copyEmails), function ($email) {
                return filter_var($email, FILTER_VALIDATE_EMAIL);
            });

            $ccEmails = array_merge(['aadatia@moneywiseplc.co.uk'], $validCopyEmails);

            foreach ($sendToBillingEmails as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception("Invalid To Email: $email");
                    //  abort(404); 
                }
            }

            Mail::send('email.invoice_mail', $data, function ($message) use ($sendToBillingEmails, $filePath, $emailSubject, $ccEmails) {
                $message->to($sendToBillingEmails);
                $message->subject($emailSubject);
                // $message->cc(['aadatia@moneywiseplc.co.uk']);
                // $ccEmails = array_merge(['anuradha.mondal2013@gmail.com'], explode(',', $purchase->invoice->copy_email));
                $message->cc($ccEmails);
                $message->bcc(['bestpratik@gmail.com']);
                $message->attach($filePath);
            });

            return response()->download($filePath);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function render()
    {
        // return view('livewire.policy-buyer-component');

        return view('livewire.policy-buyer-component', [
            'availableInsurances' => Insurance::with('services')->get(),
        ]);
    }
}
