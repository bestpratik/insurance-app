<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Insurance;
use App\Models\Policyreferralform;
use App\Models\Invoice;
use Carbon\Carbon;
use App\Mail\InsuranceBillingEmail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Str;

use Illuminate\Validation\Rule;

class PolicyReferralFormComponent extends Component
{
    public $successMessage = '';
    public $currentStep = 1;

    public $selectedinsuranceId;
    public $insuranceDetails;
    public $availableInsurances;
    public $productType;
    public $insurancesRequired = [];


    // Step 2: Property info
    public $yearOfPurchase;
    public $yearOfBuild;
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
    // public $billingName;
    // public $billingEmail;
    public $copyBillingEmail;
    // public $billingPhone;
    // public $billingAddressOne;
    // public $billingAddressTwo;
    // public $billingPostcode;
    // public $ponNo;

    public $isInvoice;
    public $curDate;

    // Step 7: Summary data
    public $summaryData = [];

    public function mount()
    {

        $this->policyTerm = 1;
        $this->isInvoice = true;

        $this->availableInsurances = Insurance::where('purchase_mode', 'Offline')->get();
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
                // 'insurancesRequired' => 'required|in:Home Emergency,Malicious Damage/Contents',
                'insurancesRequired' => 'array',
                'insurancesRequired.*' => Rule::in(['Home Emergency', 'Malicious Damage/Contents']),

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
                // 'yearOfPurchase' => 'required_if:insurancesRequired,Malicious Damage/Contents|digits:4',
                // 'yearOfBuild' => 'required_if:insurancesRequired,Malicious Damage/Contents|digits:4',
                'doorNo' => 'required|string',
                'addressOne' => 'required|string',
                'postCode' => 'required|string',
            ];
 
            if (
                is_array($this->insurancesRequired) &&
                in_array('Malicious Damage/Contents', $this->insurancesRequired)
            ) {
                $rules['yearOfPurchase'] = 'required|digits:4';
                $rules['yearOfBuild']    = 'required|digits:4';
            }

            return $rules;
        } elseif ($step == 3) {
            $rules = [
                'policyHoldertype' => ['required', Rule::in(['Company', 'Individual', 'Both'])],
            ];

            if ($this->policyHoldertype === 'Company') {
                $rules['companyName'] = 'required|string';
                $rules['policyholderCompanyEmail'] = 'required|email';
                $rules['policyholderPostcode'] = 'required|string';
                $rules['policyholderPhone'] = 'required|string';
            } elseif ($this->policyHoldertype === 'Individual') {
                $rules['policyholderTitle'] = 'required|string';
                $rules['policyholderFirstName'] = 'required|string';
                $rules['policyholderLastName'] = 'required|string';
                $rules['policyholderEmail'] = 'required|email';
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


        // elseif ($step == 6) {
        //     return [
        //         'billingName' => 'required|string',
        //         'billingEmail' => 'required|email',
        //         'billingPhone' => 'required',
        //         'billingAddressOne' => 'required|string',
        //         'billingPostcode' => 'required'
        //     ];
        // }

        return [];
    }

    public function nextStep()
    {
        $this->validate($this->rulesForStep($this->currentStep));

        if ($this->currentStep < 6) {
            $this->currentStep++;

            if ($this->currentStep === 6) {
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

        // $billingAddress = trim("{$this->billingAddressOne}, {$this->billingAddressTwo}, {$this->billingPostcode}");

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
            // 'Billing Name' => $this->billingName,
            // 'Billing Email' => $this->billingEmail,
            // 'Billing Phone' => $this->billingPhone,
            // 'Billing Postcode' => $this->billingPostcode,
            // 'Billing Address' => $billingAddress,
            // 'Pon No' => $this->ponNo,
            // 'Policy End Date' => $this->policyEndDate,
            // 'Premium Amount' => $this->premiumAmount,
            'Tenant Name:' => $this->tenantName ?? 'N/A',
            'Tenant Phone:' => $this->tenantPhone ?? 'N/A',
            'Tenant Email:' => $this->tenantEmail ?? 'N/A',
            // 'Payment Method' => str_replace('_', ' ', $this->paymentMethod),
        ];
    }

    private function resetForm()
    {
        $this->reset([
            'selectedinsuranceId',
            'insuranceDetails',
            'productType',
            'insurancesRequired',
            'yearOfPurchase',
            'yearOfBuild',
            'insuranceType',
            'rentAmount',
            'doorNo',
            'addressOne',
            'addressTwo',
            'addressThree',
            'postCode',
            'policyHoldertype',
            'companyName',
            'policyholderTitle',
            'policyholderFirstName',
            'policyholderLastName',
            'policyholderEmail',
            'policyholderPhone',
            'policyholderCompanyEmail',
            'policyholderAlternativePhone',
            'policyholderAddress1',
            'policyholderAddress2',
            'policyholderPostcode',
            'copyEmail',
            'policyStartDate',
            'astStartDate',
            'policyTerm',
            'tenantName',
            'tenantPhone',
            'tenantEmail',
            // 'billingName',
            // 'billingEmail',
            'copyBillingEmail',
            // 'billingPhone',
            // 'billingAddressOne',
            // 'billingAddressTwo',
            // 'billingPostcode',
            // 'ponNo',
        ]);

        $this->currentStep = 1; // go back to first step
    }


    public function submitForm()
    {
        $allRules = array_merge(
            $this->rulesForStep(1),
            $this->rulesForStep(2),
            $this->rulesForStep(3),
            $this->rulesForStep(4),
            $this->rulesForStep(5),
            // $this->rulesForStep(6)
        );

        $this->validate($allRules);

        $userId = Auth::id();

        $purchase = new Policyreferralform();
        $purchase->user_id = $userId;
        $purchase->insurance_id = $this->selectedinsuranceId;
        // $purchase->insurances_required = $this->insurancesRequired;
        $purchase->insurances_required = implode(',', $this->insurancesRequired);
        $purchase->year_of_purchase = $this->yearOfPurchase;
        $purchase->year_of_build = $this->yearOfBuild;
        $purchase->product_type = $this->productType;
        $purchase->insurance_type = $this->insuranceType;
        $purchase->rent_amount = $this->rentAmount;
        $purchase->door_no = $this->doorNo;
        $purchase->address_one = $this->addressOne;
        $purchase->address_two = $this->addressTwo;
        $purchase->address_three = $this->addressThree;
        $purchase->post_code = $this->postCode;
        $purchase->policy_holder_type = $this->policyHoldertype;

        // Company/Individual info
        if (in_array($this->policyHoldertype, ['Company', 'Both'])) {
            $purchase->company_name = $this->companyName;
            $purchase->policy_holder_company_email = $this->policyholderCompanyEmail;
        }
        if (in_array($this->policyHoldertype, ['Individual', 'Both'])) {
            $purchase->policy_holder_title = $this->policyholderTitle;
            $purchase->policy_holder_fname = $this->policyholderFirstName;
            $purchase->policy_holder_lname = $this->policyholderLastName;
            $purchase->policy_holder_email = $this->policyholderEmail;
        }

        $purchase->policy_holder_phone = $this->policyholderPhone;
        $purchase->policy_holder_alternative_phone = $this->policyholderAlternativePhone;
        $purchase->policy_holder_postcode = $this->policyholderPostcode;
        $purchase->policy_no = $this->insuranceDetails->prefix . '-' . rand(1000000000, 9999999999);
        $purchase->policy_start_date = $this->policyStartDate;
        $purchase->policy_end_date = date('Y-m-d', strtotime($this->policyStartDate . ' + ' . ($this->insuranceDetails->validity - 1) . ' days'));
        $purchase->ast_start_date = $this->astStartDate;
        $purchase->purchase_date = now();
        $purchase->policy_term = $this->policyTerm;

        // Premium
        $purchase->net_premium = $this->insuranceDetails->net_premium;
        $purchase->commission = $this->insuranceDetails->commission;
        $purchase->gross_premium = $this->insuranceDetails->gross_premium;
        $purchase->ipt = $this->insuranceDetails->ipt;
        $purchase->total_premium = $this->insuranceDetails->total_premium;
        $purchase->payable_amount = $this->insuranceDetails->payable_amount;
        $purchase->admin_fee = $this->insuranceDetails->admin_fee;

        $purchase->tenant_name = $this->tenantName;
        $purchase->tenant_phone = $this->tenantPhone;
        $purchase->tenant_email = $this->tenantEmail;

        $purchase->save();

        // $invoice = new Invoice();
        // $invoice->policyreferralform_id = $purchase->id;
        // $invoice->billing_name = $this->billingName;
        // $invoice->billing_email = $this->billingEmail;
        // $this->copyBillingEmail = preg_replace('/[\s,]+/', ' ', $this->copyBillingEmail);
        // $invoice->copy_email = collect(explode(' ', str_replace(',', ' ', $this->copyBillingEmail)))
        //     ->filter()
        //     ->map(fn($email) => trim($email))
        //     ->unique()
        //     ->implode(',');
        // $invoice->billing_phone = $this->billingPhone;
        // $invoice->billing_address_one = $this->billingAddressOne;
        // $invoice->billing_address_two = $this->billingAddressTwo;
        // $invoice->billing_postcode = $this->billingPostcode;
        // $invoice->billing_full_addresss = trim("{$this->billingAddressOne}, {$this->billingAddressTwo}, {$this->billingPostcode}");
        // $invoice->pon = $this->ponNo;

        // $curDate = date('Y-m-d');
        // $payment_due_date = date('Y-m-d', strtotime($curDate . ' + 7 days'));
        // $invoice->payment_due_date = $payment_due_date;

        // $invoice->invoice_no = $purchase->id;
        // $invoice->invoice_date  = $curDate;


        // $invoice->is_invoice = 1;

        // $invoice->save();

        // $this->successMessage = "Form submitted successfully!"; 

        $this->send_email_one($purchase->id);

        // if ($invoice->is_invoice == 1) {

        //     $this->send_email_two($purchase->id);
        // }

        $this->resetForm();
        // return redirect()->route('policy-referral.success');
        	// return redirect()->route('policy-referral.success', ['purchase_id' => $purchase->id]);
            return redirect()->route('policy-referral.success');
            
    }

   
    public function send_email_one($purchaseId)
    {
        $purchase = Policyreferralform::with('invoice')->findOrFail($purchaseId);

        if (!$purchase) {
            return false;
        }

        $insurance = Insurance::with('staticdocuments', 'dynamicdocument', 'insurancemailtemplate')
            ->findOrFail($purchase->insurance_id);

        // ======================
        // Collect all documents
        // ======================
        $allDocs = [];

        // 1. Static documents
        if ($insurance->staticdocuments) {
            foreach ($insurance->staticdocuments as $docs) {
                $filePath = public_path('uploads/insurance_document/' . $docs->document);
                if (file_exists($filePath)) {
                    $allDocs[] = $filePath;
                }
            }
        }

        // 2. Dynamic PDFs
        $pdfDynamicval = [
            $insurance->name,
            $purchase->policy_no,
            $purchase->policy_holder_address,
            date('jS F Y', strtotime($purchase->policy_start_date)),
            date('jS F Y', strtotime($purchase->policy_end_date)),
            date('jS F Y', strtotime($purchase->purchase_date)),
            $purchase->policy_term,
            $purchase->net_premium,
            $purchase->ipt,
            $purchase->gross_premium,
            $purchase->rent_amount,
        ];

        $riskAddress = trim(
            $purchase->door_no . ' ' .
                $purchase->address_one . ' ' .
                $purchase->address_two . ' ' .
                $purchase->address_three . ' ' .
                $purchase->post_code
        );

        $insurartitle = match ($purchase->policy_holder_type) {
            'Company'   => $purchase->company_name,
            'Individual' => $purchase->policy_holder_title . ' ' . $purchase->policy_holder_fname . ' ' . $purchase->policy_holder_lname,
            default     => $purchase->company_name . '/' . $purchase->policy_holder_title . ' ' . $purchase->policy_holder_fname . ' ' . $purchase->policy_holder_lname,
        };

        $pdfDynamicval[] = $riskAddress;
        $pdfDynamicval[] = $insurartitle;
        $pdfDynamicval[] = $insurance->details_of_cover;

        if ($insurance->dynamicdocument) {
            foreach ($insurance->dynamicdocument as $dydocs) {
                $file_name = $dydocs->title . rand(11, 999999) . '.pdf';

                $data = [
                    'templateTitle'   => $dydocs->title,
                    'templateBody'    => $dydocs->description,
                    'templateHeder'   => $dydocs->header,
                    'templateFooter'  => $dydocs->footer,
                    'templatebodyValue' => $pdfDynamicval,
                ];

                $pdf = PDF::loadView('purchase.pdfs.policy_referral_dynamic_document_email', ['data' => $data]);
                $pdfPath = public_path('uploads/dynamicdoc/' . $file_name);
                $pdf->save($pdfPath);

                if (file_exists($pdfPath)) {
                    $allDocs[] = $pdfPath;
                }
            }
        }

        // ======================
        // Prepare Email Template
        // ======================
        $bodyValue = [
            $insurance->name,
            $purchase->policy_no,
            $purchase->policy_holder_address,
            date('jS F Y', strtotime($purchase->policy_start_date)),
            date('jS F Y', strtotime($purchase->policy_end_date)),
            date('jS F Y', strtotime($purchase->purchase_date)),
            $purchase->policy_term,
            $purchase->net_premium,
            $purchase->ipt,
            $purchase->gross_premium,
            $purchase->rent_amount,
            $purchase->payable_amount,
            $riskAddress,
            $insurartitle,
            $insurance->details_of_cover,
        ];

        // ======================
        // Build Recipients
        // ======================
        $sendToemails = [];

        if ($purchase->policy_holder_type === 'Company') {
            $sendToemails[] = $purchase->policy_holder_company_email;
        } elseif ($purchase->policy_holder_type === 'Individual') {
            $sendToemails[] = $purchase->policy_holder_email;
        } elseif ($purchase->policy_holder_type === 'Both') {
            $sendToemails[] = $purchase->policy_holder_email;
            $sendToemails[] = $purchase->policy_holder_company_email;
        }

        // Filter invalid emails
        $sendToemails = array_values(array_filter($sendToemails, fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL)));

        if (empty($sendToemails)) {
            return "No valid recipient emails found.";
        }

        // CC Emails
        $copyEmails = array_filter(array_map('trim', explode(',', $purchase->copy_email ?? '')));
        $validCopyEmails = array_values(array_filter($copyEmails, fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL)));
        $ccEmails = array_merge(['anuradham.dbt@gmail.com'], $validCopyEmails);

        // ======================
        // Send Email
        // ======================
        $email_subject = $insurance->insurancemailtemplate->title ?? 'Policy Referral';
        $data = [
            'body'      => $insurance->insurancemailtemplate->description ?? '',
            'bodyValue' => $bodyValue,
        ];

        try {
            Mail::send('email.policy_referral_email', $data, function ($messages) use ($sendToemails, $allDocs, $email_subject, $ccEmails) {
                $messages->to($sendToemails);
                $messages->subject($email_subject);
                $messages->cc($ccEmails);

                foreach ($allDocs as $attachment) {
                    $messages->attach($attachment);
                }
            });

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    // public function send_email_two($purchaseId)
    // {
    //     $purchase = Policyreferralform::with(['insurance', 'insurance.staticdocuments', 'insurance.dynamicdocument', 'invoice'])
    //         ->find($purchaseId);

    //     if (!$purchase) {
    //         return 'Purchase not found.';
    //     }

    //     // ========================
    //     // Generate Invoice PDF
    //     // ========================
    //     $pdf = PDF::loadView('insurance.policy_referral_invoice', compact('purchase'))->setPaper('a4');
    //     $pdfContent = $pdf->output();

    //     $fileName = 'referral_invoice_' . $purchaseId . '.pdf';
    //     $directory = public_path('uploads/invoice');
    //     $filePath = $directory . '/' . $fileName;

    //     if (!File::exists($directory)) {
    //         File::makeDirectory($directory, 0755, true);
    //     }

    //     file_put_contents($filePath, $pdfContent);

    //     // ========================
    //     // Build Recipients
    //     // ========================
    //     $sendToBillingEmails = [];
    //     if (!empty($purchase->invoice->billing_email) && filter_var($purchase->invoice->billing_email, FILTER_VALIDATE_EMAIL)) {
    //         $sendToBillingEmails[] = $purchase->invoice->billing_email;
    //     }

    //     if (empty($sendToBillingEmails)) {
    //         return "No valid billing email found for this purchase.";
    //     }

    //     // CC Emails
    //     $copyEmails = array_filter(array_map('trim', explode(',', $purchase->copy_email ?? '')));
    //     $validCopyEmails = array_filter($copyEmails, fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));

    //     $ccEmails = array_merge(['anuradham.dbt@gmail.com'], $validCopyEmails);

    //     // ========================
    //     // Prepare Email Content
    //     // ========================
    //     $emailSubject = 'Moneywise Investments PLC - Invoice for Policy - ' . $purchase->policy_no;
    //     $data = [
    //         'body' => 'Dear client,<br>
    //               Please find attached the invoice for policy no. <strong>' . $purchase->policy_no . '</strong>.',
    //     ];

    //     // ========================
    //     // Send Email
    //     // ========================
    //     try {
    //         Mail::send('email.invoice_mail', $data, function ($message) use ($sendToBillingEmails, $filePath, $emailSubject, $ccEmails) {
    //             $message->to($sendToBillingEmails);
    //             $message->subject($emailSubject);
    //             $message->cc($ccEmails);
    //             $message->attach($filePath);
    //         });

    //         return response()->download($filePath);
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }


    public function render()
    {
        // return view('livewire.policy-referral-form-component');

        return view('livewire.policy-referral-form-component', [
            'availableInsurances' => Insurance::with('services')->get(),
        ]);
    }
}
