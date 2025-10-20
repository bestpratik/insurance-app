<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Insurance;

class PurchaseEdit extends Component
{
    public $purchaseId;
    public $productType;
    public $purchaseData;
    public $insuranceList;
    public $insuranceType;
    public $rentAmount;
    public $selectedinsuranceId;

    public $policyHoldertype = 'Individual'; 
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
    
    // property
    public $doorNo;
    public $addressOne;
    public $addressTwo;
    public $addressThree;
    public $postCode;

    // Step 8: Summary data
    public $summaryData = [];



    public function mount($policyNo = null) 
    {
      
        $this->purchaseData= Purchase::with('invoice')->where('policy_no', $policyNo)->firstOrFail();
        $this->purchaseId = $this->purchaseData->id;
        $this->insuranceList=Insurance::all();

        if($this->purchaseId){
            $this->productType = $this->purchaseData->product_type;
            $this->insuranceType = $this->purchaseData->insurance_type;
            $this->selectedinsuranceId = $this->purchaseData->insurance_id;
            $this->rentAmount = $this->purchaseData->rent_amount;
            $this->doorNo = $this->purchaseData->door_no;
            $this->addressOne = $this->purchaseData->address_one;
            $this->addressTwo = $this->purchaseData->address_two;
            $this->addressThree = $this->purchaseData->address_three;
            $this->postCode = $this->purchaseData->post_code; 


            // policy holder
            $this->policyHoldertype = $this->purchaseData->policy_holder_type;
            $this->companyName = $this->purchaseData->company_name;
            $this->policyholderCompanyEmail = $this->purchaseData->policy_holder_company_email;

            $this->policyholderTitle = $this->purchaseData->policy_holder_title;
            $this->policyholderFirstName = $this->purchaseData->policy_holder_fname;
            $this->policyholderLastName = $this->purchaseData->policy_holder_lname;
            $this->policyholderEmail = $this->purchaseData->policy_holder_email;
            $this->policyholderPhone = $this->purchaseData->policy_holder_company_phone;
            $this->policyholderAlternativePhone = $this->purchaseData->policy_holder_alternative_phone;
            $this->policyholderAddress1 = $this->purchaseData->policy_holder_address_one;
            $this->policyholderAddress2 = $this->purchaseData->policy_holder_address_two;
            $this->policyholderPostcode = $this->purchaseData->policy_holder_postcode;

            $this->policyStartDate = $this->purchaseData->policy_start_date;
            $this->astStartDate = $this->purchaseData->ast_start_date;
            $this->policyTerm = $this->purchaseData->policy_term;

            // tenant
            $this->tenantName = $this->purchaseData->tenant_name;
            $this->tenantPhone = $this->purchaseData->tenant_phone;
            $this->tenantEmail = $this->purchaseData->tenant_email;

             $this->paymentMethod = $this->purchaseData->payment_method;


            //  billing
            $this->billingName = $this->purchaseData->invoice->billing_name ?? '';
            $this->billingEmail = $this->purchaseData->invoice->billing_email ?? '';
            $this->billingPhone = $this->purchaseData->invoice->billing_phone ?? '';
            $this->billingAddressOne = $this->purchaseData->invoice->billing_address_one ?? '';
            $this->billingAddressTwo = $this->purchaseData->invoice->billing_address_two ?? '';
            $this->billingPostcode = $this->purchaseData->invoice->billing_postcode ?? '';
            $this->ponNo = $this->purchaseData->invoice->pon ?? '';


        }

        //dd($purchaseId);


    }

    public function update()
    {
        $purchase = Purchase::find($this->purchaseId);
            $this->validate([
            'productType' => 'required',
            'selectedinsuranceId' => 'required',
            'insuranceType' => 'required',
            'billingName' => 'required',
            'billingEmail' => 'required|email',
            'billingPhone' => 'required',
            // 'tenantName' => 'required',
            // 'tenantPhone' => 'required',
            // 'tenantEmail' => 'required|email',
            'policyStartDate' => 'required',
            'astStartDate' => 'required',
            'policyTerm' => 'required',
            'policyholderPostcode' => 'required',
            'rentAmount' => 'required',
            'doorNo' => 'nullable',
            'addressOne' => 'required',

        ]);


        try {
           

            // dd([
            //     'product_type' => $this->productType,
            //     'insurance_type' => $this->insuranceType,
            //     'selectedinsuranceId' => $this->selectedinsuranceId,
            //     'rent_amount' => $this->rentAmount,
            //     'door_no' => $this->doorNo,
            //     'address_one' => $this->addressOne,
            //     'address_two' => $this->addressTwo,
            //     'address_three' => $this->addressThree,
            //     'post_code' => $this->postCode,

            //     // Policy holder
            //     'policy_holder_type' => $this->policyHoldertype,
            //     'company_name' => $this->companyName,
            //     'policy_holder_company_email' => $this->policyholderCompanyEmail,
            //     'policy_holder_title' => $this->policyholderTitle,
            //     'policy_holder_fname' => $this->policyholderFirstName,
            //     'policy_holder_lname' => $this->policyholderLastName,
            //     'policy_holder_email' => $this->policyholderEmail,
            //     'policy_holder_company_phone' => $this->policyholderPhone,
            //     'policy_holder_alternative_phone' => $this->policyholderAlternativePhone,
            //     'policy_holder_address_one' => $this->policyholderAddress1,
            //     'policy_holder_address_two' => $this->policyholderAddress2,
            //     'policy_holder_postcode' => $this->policyholderPostcode,
            //     'policy_start_date' => $this->policyStartDate,
            //     'ast_start_date' => $this->astStartDate,
            //     'policy_term' => $this->policyTerm,

            //     // Tenant
            //     'tenant_name' => $this->tenantName,
            //     'tenant_phone' => $this->tenantPhone,
            //     'tenant_email' => $this->tenantEmail,

            //     // Payment method
            //     'payment_method' => $this->paymentMethod,
            // ]);

           $purchase->update([
                'product_type' => $this->productType,
                'insurance_type' => $this->insuranceType,
                'insurance_id' => $this->selectedinsuranceId,
                'rent_amount' => $this->rentAmount,
                'door_no' => $this->doorNo,
                'address_one' => $this->addressOne,
                'address_two' => $this->addressTwo,
                'address_three' => $this->addressThree,
                'post_code' => $this->postCode,

                // Policy holder
                'policy_holder_type' => $this->policyHoldertype,
                'company_name' => $this->companyName,
                'policy_holder_company_email' => $this->policyholderCompanyEmail,
                'policy_holder_title' => $this->policyholderTitle,
                'policy_holder_fname' => $this->policyholderFirstName,
                'policy_holder_lname' => $this->policyholderLastName,
                'policy_holder_email' => $this->policyholderEmail,
                'policy_holder_company_phone' => $this->policyholderPhone,
                'policy_holder_alternative_phone' => $this->policyholderAlternativePhone,
                'policy_holder_address_one' => $this->policyholderAddress1,
                'policy_holder_address_two' => $this->policyholderAddress2,
                'policy_holder_postcode' => $this->policyholderPostcode,
                'policy_start_date' => $this->policyStartDate,
                'ast_start_date' => $this->astStartDate,
                'policy_term' => $this->policyTerm,

                // Tenant
                'tenant_name' => $this->tenantName,
                'tenant_phone' => $this->tenantPhone,
                'tenant_email' => $this->tenantEmail,

                // Payment method
                'payment_method' => $this->paymentMethod,
            ]);

              // Emit browser event for success
            $this->dispatch('swal');

            //dd($purchase->invoice);

           if ($purchase->invoice) {
            $purchase->invoice->update([
                'billing_name'         => $this->billingName,
                'billing_email'        => $this->billingEmail,
                'billing_phone'        => $this->billingPhone,
                'billing_address_one'  => $this->billingAddressOne,
                'billing_address_two'  => $this->billingAddressTwo,
                'billing_postcode'     => $this->billingPostcode,
                'pon'                  => $this->ponNo,
            ]);
        }



        } catch (\Exception $e) {
            
            session()->flash('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function render()
    {

        return view('livewire.purchase-edit');
    }
}
