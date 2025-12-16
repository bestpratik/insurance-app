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
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Log;
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
    public $noOfBedrooms;

    public $rentArrears;


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

    public $referralName;
    public $referralEmail;

    //  public $paymentMethod;
    public $councilName;
    public $councilOfficerName;
    public $councilOfficerEmail;

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

        $this->availableInsurances = Insurance::where('purchase_mode', 'Offline')
                                                ->where('show_on_referral_form', 'Yes')
                                                ->get();

    }

    public function updatedProductType($value)
    {
        if ($value === 'I’m an Agent') {
            $this->policyHoldertype = 'Both';
        }
    }



    // public function updatedInsuranceType($value)
    // {
    //     if ($value !== 'renewal') {
    //         $this->rentArrears = null;
    //     }
    // }

    public function setInsuranceType($value)
    {
        $this->insuranceType = $value;

        if ($value !== 'renewal') {
            $this->rentArrears = null; // hide or clear rent arrears
        }
    }



    public function updatedInsurancesRequired()
    {
        if (!in_array('Malicious Damage/Contents', $this->insurancesRequired ?? [])) {
            $this->yearOfPurchase = null;
            $this->yearOfBuild = null;
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
            $rules = [
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
                'doorNo' => 'nullable',
                'addressOne' => 'required|string',
                'postCode' => 'required|string',
                'noOfBedrooms' => 'required',
            ];

            // ✅ Fix the condition
            if ($this->insuranceType === 'renewal') {
                $rules['rentArrears'] = 'required|in:Yes,No';
            }

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

            if ($this->policyHoldertype === 'Both') {
                $rules['companyName'] = 'required|string';
                $rules['policyholderCompanyEmail'] = 'required|email';
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
                'referralName' => 'required',
                'referralEmail' => 'required',
            ];
        } elseif ($step === 6) {
            return [
                // 'paymentMethod' => 'required',
                'councilName' => 'required',
                'councilOfficerName' => 'required',
                'councilOfficerEmail' => 'required',
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

        if ($this->currentStep < 7) {
            $this->currentStep++;

            // if ($this->currentStep === 7) {
            //     $this->prepareSummaryData();
            // }
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    // public function prepareSummaryData()
    // {
    //     $policyEndDate = $this->policyStartDate
    //         ? date('Y-m-d', strtotime($this->policyStartDate . ' + ' . ($this->insuranceDetails->validity - 1) . ' days'))
    //         : '';

    //     // $billingAddress = trim("{$this->billingAddressOne}, {$this->billingAddressTwo}, {$this->billingPostcode}");

    //     $this->summaryData = [
    //         'Insurance:' => $this->availableInsurances->firstWhere('id', $this->selectedinsuranceId)?->name ?? 'N/A',
    //         'Policy Required For:' => $this->productType,
    //         'Insurance Type:' => $this->insuranceType,
    //         'Rent Amount:' => '£- ' . $this->rentAmount,
    //         // 'Property Address:' => trim("{$this->doorNo}, {$this->addressOne}, {$this->addressTwo}, {$this->addressThree}, {$this->postCode}"),
    //         'Property Address:' => trim(implode(', ', array_filter([
    //             $this->doorNo,
    //             $this->addressOne,
    //             $this->addressTwo,
    //             $this->addressThree,
    //             $this->postCode
    //         ]))),

    //         'Policy Holder Type:' => $this->policyHoldertype,
    //         'Company Name:' => $this->policyHoldertype === 'Company' ? $this->companyName : 'N/A',
    //         'Company Email:' => $this->policyHoldertype === 'Company' ? $this->policyholderCompanyEmail : 'N/A',
    //         'Policy Holder Name:' => $this->policyHoldertype === 'Individual' ? "{$this->policyholderTitle} {$this->policyholderFirstName} {$this->policyholderLastName}" : 'N/A',
    //         'Policy Holder Email:' => $this->policyholderEmail,
    //         'Policy Holder Phone:' => $this->policyholderPhone,
    //         'Policy Term:' => $this->policyTerm . ' Year',
    //         'Policy Start Date:' => Carbon::parse($this->policyStartDate)->format('d F Y'),
    //         'Ast Start Date:' => Carbon::parse($this->astStartDate)->format('d F Y'),

    //         'Policy End Date' => Carbon::parse($policyEndDate)->format('d F Y'),
    //         // 'Billing Name' => $this->billingName,
    //         // 'Billing Email' => $this->billingEmail,
    //         // 'Billing Phone' => $this->billingPhone,
    //         // 'Billing Postcode' => $this->billingPostcode,
    //         // 'Billing Address' => $billingAddress,
    //         // 'Pon No' => $this->ponNo,
    //         // 'Policy End Date' => $this->policyEndDate,
    //         // 'Premium Amount' => $this->premiumAmount,
    //         'Tenant Name:' => $this->tenantName ?? 'N/A',
    //         'Tenant Phone:' => $this->tenantPhone ?? 'N/A',
    //         'Tenant Email:' => $this->tenantEmail ?? 'N/A',
    //         // 'Payment Method' => str_replace('_', ' ', $this->paymentMethod),
    //     ];
    // }

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
            'rentArrears',
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
            'referralName',
            'referralEmail',
            // 'paymentMethod',
            'councilName',
            'councilOfficerName',
            'councilOfficerEmail',
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
        $purchase->no_of_bedroom = $this->noOfBedrooms;
        $purchase->rent_arrears = $this->rentArrears;
        $purchase->policy_holder_address = trim(
            $this->policyholderAddress1 . ' ' .
                $this->policyholderAddress2 . ' ' .
                $this->policyholderPostcode
        );
        $purchase->copy_email = $this->copyEmail;
        $purchase->council_name = $this->councilName;
        $purchase->council_officer_name = $this->councilOfficerName;
        $purchase->council_officer_email = $this->councilOfficerEmail;
        // $purchase->is_invoice = $this->isInvoice ? 1 : 0;
        // $purchase->copy_billing_email = $this->copyBillingEmail;
        // $purchase->payment_method = $this->paymentMethod;

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
        // $purchase->policy_no = $this->insuranceDetails->prefix . '-' . rand(1000000000, 9999999999);
        $purchase->policy_start_date = $this->policyStartDate;
        $purchase->policy_end_date = date('Y-m-d', strtotime($this->policyStartDate . ' + ' . ($this->insuranceDetails->validity - 1) . ' days'));
        $purchase->ast_start_date = $this->astStartDate;
        // $purchase->purchase_date = now();
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

        $purchase->referral_name = $this->referralName;
        $purchase->referral_email = $this->referralEmail;

        $purchase->save();


        $this->send_email_one($purchase->id);

        // if ($invoice->is_invoice == 1) {

        //     $this->send_email_two($purchase->id);
        // }

        $this->resetForm();
        // return redirect()->route('policy-referral.success');
        // return redirect()->route('policy-referral.success', ['purchase_id' => $purchase->id]);
        return redirect()->route('policy-referral.success');
    }




    // public function send_email_one($purchaseId)
    // {
    //     $purchase = Policyreferralform::with('invoice')->findOrFail($purchaseId);

    //     if (!$purchase) {
    //         return false;
    //     }

    //     $insurance = Insurance::with('staticdocuments', 'dynamicdocument', 'insurancemailtemplate')
    //         ->findOrFail($purchase->insurance_id);

    //     // ======================
    //     // Collect all documents
    //     // ======================
    //     $allDocs = [];



    //     // ======================
    //     // Build Recipients
    //     // ======================
    //     $sendToemails = [];

    //     if ($purchase->policy_holder_type === 'Company') {
    //         $sendToemails[] = $purchase->policy_holder_company_email;
    //     } elseif ($purchase->policy_holder_type === 'Individual') {
    //         $sendToemails[] = $purchase->policy_holder_email;
    //     } elseif ($purchase->policy_holder_type === 'Both') {
    //         $sendToemails[] = $purchase->policy_holder_email;
    //         $sendToemails[] = $purchase->policy_holder_company_email;
    //     }

    //     // Filter invalid emails
    //     $sendToemails = array_values(array_filter($sendToemails, fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL)));

    //     if (empty($sendToemails)) {
    //         return "No valid recipient emails found.";
    //     }

    //     // CC Emails
    //     $copyEmails = array_filter(array_map('trim', explode(',', $purchase->copy_email ?? '')));
    //     $validCopyEmails = array_values(array_filter($copyEmails, fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL)));
    //     $ccEmails = array_merge(['anuradham.dbt@gmail.com'], $validCopyEmails);

    //     // ======================
    //     // Send Email
    //     // ======================
    //     $email_subject = $insurance->insurancemailtemplate->title ?? 'Policy Referral';
    //     $data = [
    //         'body'      => $insurance->insurancemailtemplate->description ?? '',
    //         'bodyValue' => $bodyValue,
    //     ];

    //     try {
    //         Mail::send('email.policy_referral_email', $data, function ($messages) use ($sendToemails, $allDocs, $email_subject, $ccEmails) {
    //             $messages->to($sendToemails);
    //             $messages->subject($email_subject);
    //             $messages->cc($ccEmails);

    //             foreach ($allDocs as $attachment) {
    //                 $messages->attach($attachment);
    //             }
    //         });

    //         return true;
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    //  public function send_email_one($referralId)
    // {
    //     // dd($insurance_purchase_data);
    //     $referral = Policyreferralform::findorfail($referralId);
    //     // dd($purchase);
    //     if (!$referral) {
    //         return response()->json(['status' => 'error', 'message' => 'Purchase record not found']);
    //     }

    //     if ($referral) {

    //         $sendToemails = [

    //             'anuradha.mondal2013@gmail.com'
    //         ];

    //         $sendToemails = array_filter($sendToemails, function ($email) {
    //             return filter_var($email, FILTER_VALIDATE_EMAIL);
    //         });

    //         $rawAddress = implode('_', array_filter([
    //             $referral->door_no,
    //             $referral->address_one,
    //             $referral->address_two ?: null,
    //             $referral->address_three ?: null,
    //         ]));

    //         $fileName = 'referral_' . $rawAddress . '.pdf';
    //         $directory = public_path('uploads/insuranceReferral'); 
    //         $filePath = $directory . '/' . $fileName;

    //         try { 
    //             if (!File::exists($directory)) {
    //                 File::makeDirectory($directory, 0755, true);
    //             }

    //             $pdf = Pdf::loadView('purchase.referral_pdf', compact('referral'))->setPaper('a4');
    //             file_put_contents($filePath, $pdf->output());
    //         } catch (Exception $e) {
    //             Log::error('PDF generation failed: ' . $e->getMessage());
    //             return response()->json(['status' => 'error', 'message' => 'PDF generation failed']);
    //         }
    //         $email_subject = 'New Policy Referral - Verification and Processing Required - Moneywise Investments Plc';
    //         $data = [
    //             'referral' => $referral,
    //         ];

    //         try {

    //             $copyEmails = explode(',', $referral->copy_email ?? '');
    //             $validCopyEmails = array_filter(array_map('trim', $copyEmails), function ($email) {
    //                 return filter_var($email, FILTER_VALIDATE_EMAIL);
    //             });

    //             $ccEmails = array_merge(['anuradham.dbt@gmail.com'], $validCopyEmails);

    //             foreach ($sendToemails as $email) {
    //                 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //                     throw new Exception("Invalid To Email: $email");
    //                 }
    //             }

    //             Mail::send('email.policy_referral_email', ['referral' => $referral], function ($messages) use ($sendToemails, $email_subject, $ccEmails, $filePath) {
    //                 $messages->to($sendToemails)
    //                     ->subject($email_subject)
    //                     ->cc($ccEmails)
    //                     // ->bcc(['bestpratik@gmail.com'])
    //                     ->attach($filePath);
    //             });


    //             return response()->json(['status' => 'success', 'message' => 'Email sent successfully']);
    //         } catch (Exception $e) {
    //             Log::error('Email sending failed: ' . $e->getMessage());
    //             return response()->json(['status' => 'error', 'message' => 'Email sending failed']);
    //         }
    //     }
    // }


    //     public function send_email_one($referralId)
    // {
    //     $referral = Policyreferralform::find($referralId);

    //     if (!$referral) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Referral record not found'
    //         ]);
    //     }

    //     // Define recipients
    //     $sendToemails = ['anuradha.mondal2013@gmail.com'];
    //     $sendToemails = array_filter($sendToemails, fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));

    //     // Generate file path for PDF
    //     $rawAddress = implode('_', array_filter([
    //         $referral->door_no,
    //         $referral->address_one,
    //         $referral->address_two ?: null,
    //         $referral->address_three ?: null,
    //     ]));
    //     $fileName = 'referral_' . $rawAddress . '.pdf';
    //     $directory = public_path('uploads/insuranceReferral');
    //     $filePath = $directory . '/' . $fileName;

    //     try {
    //         if (!File::exists($directory)) {
    //             File::makeDirectory($directory, 0755, true);
    //         }

    //         $pdf = Pdf::loadView('purchase.referral_pdf', compact('referral'))->setPaper('a4');
    //         file_put_contents($filePath, $pdf->output());
    //     } catch (\Exception $e) {
    //         Log::error('PDF generation failed: ' . $e->getMessage());
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'PDF generation failed'
    //         ]);
    //     }

    //     $email_subject = 'New Policy Referral - Verification and Processing Required - Moneywise Investments Plc';

    //     // Prepare CC emails
    //     $copyEmails = explode(',', $referral->copy_email ?? '');
    //     $validCopyEmails = array_filter(array_map('trim', $copyEmails), fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));
    //     $ccEmails = array_merge(['anuradham.dbt@gmail.com'], $validCopyEmails);

    //     try {
    //         // Validate To emails
    //         foreach ($sendToemails as $email) {
    //             if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //                 throw new \Exception("Invalid To Email: $email");
    //             }
    //         }

    //         // Send email
    //         Mail::send('email.policy_referral_email', ['referral' => $referral], function ($message) use ($sendToemails, $email_subject, $ccEmails, $filePath) {
    //             $message->to($sendToemails)
    //                     ->subject($email_subject)
    //                     ->cc($ccEmails)
    //                     ->attach($filePath);
    //         });

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Email sent successfully'
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Email sending failed: ' . $e->getMessage());
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Email sending failed'
    //         ]);
    //     }
    // }


    public function send_email_one($referralId)
    {
        $referral = Policyreferralform::find($referralId);

        if (!$referral) {
            return response()->json([
                'status' => 'error',
                'message' => 'Referral record not found'
            ]);
        }

        // Define recipients
        $sendToemails = ['aadatia@moneywiseplc.co.uk'];
        $sendToemails = array_filter($sendToemails, fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));

        // Generate file path for PDF
        $rawAddress = implode('_', array_filter([
            $referral->door_no,
            $referral->address_one,
            $referral->address_two ?: null,
            $referral->address_three ?: null,
        ]));
        $fileName = 'referral_' . $rawAddress . '.pdf';
        $directory = public_path('uploads/insuranceReferral');
        $filePath = $directory . '/' . $fileName;

        try {
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $pdf = Pdf::loadView('purchase.referral_pdf', compact('referral'))->setPaper('a4');
            file_put_contents($filePath, $pdf->output());
        } catch (\Exception $e) {
            Log::error('PDF generation failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'PDF generation failed'
            ]);
        }

        $email_subject = 'New Policy Referral - Verification and Processing Required - Moneywise Investments Plc';

        // Prepare CC emails
        $copyEmails = explode(',', $referral->copy_email ?? '');
        $validCopyEmails = array_filter(array_map('trim', $copyEmails), fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));
        $ccEmails = $validCopyEmails;
        // $ccEmails = array_merge(['anuradham.dbt@gmail.com'], $validCopyEmails);

    
        try {
            // Validate To emails
            foreach ($sendToemails as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception("Invalid To Email: $email");
                }
            }

            // Send email
            Mail::send('email.policy_referral_email', [
                'referral' => $referral,
            ], function ($message) use ($sendToemails, $email_subject, $ccEmails, $filePath) {
                $message->to($sendToemails)
                    ->subject($email_subject)
                    ->cc($ccEmails)
                    // ->bcc(['bestpratik@gmail.com'])
                    ->attach($filePath);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Email sent successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Email sending failed'
            ]);
        }
    }




    public function render()
    {
        return view('livewire.policy-referral-form-component');

        // return view('livewire.policy-referral-form-component', [
        //     'availableInsurances' => Insurance::with('services')->get(),
        // ]);
    }
}
