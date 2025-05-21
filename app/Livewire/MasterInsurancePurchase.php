<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Insurance;
use App\Models\Purchase;
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

    // Step 4: Policy Details
    public $policyStartDate;
    public $policyEndDate;
    public $premiumAmount;

    // Step 5: Tenant Details
    public $tenantName;
    public $tenantPhone;
    public $tenantEmail;

    // Step 6: Payment Method
    public $paymentMethod;

    // Step 7: Summary data
    public $summaryData = [];

    public function mount()
    {
        $this->availableInsurances = Insurance::all();
      
        if ($this->availableInsurances) {
            $this->insuranceDetails = $this->availableInsurances;
            // dd($this->insuranceDetails);
        }
    }

    public function updatedSelectedinsuranceId($value)
    {
        $this->insuranceDetails = Insurance::find($value);
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
                'policyHoldertype' => ['required', Rule::in(['Company', 'Individual'])],
                'policyholderEmail' => 'required|email',
                'policyholderPhone' => 'required|string',
            ];

            if ($this->policyHoldertype === 'Company') {
                $rules['companyName'] = 'required|string';
            } else {
                $rules['policyholderTitle'] = 'required|string';
                $rules['policyholderFirstName'] = 'required|string';
                $rules['policyholderLastName'] = 'required|string';
            }

            return $rules;
        } elseif ($step == 4) {
            return [
                    'policyStartDate' => 'required|date',
                    'policyEndDate' => 'required|date|after_or_equal:policyStartDate',
                    'premiumAmount' => 'required|numeric|min:0',
            ];
        } elseif ($step == 5) {
            return [
                'tenantName' => 'required|string',
                'tenantPhone' => 'required|string',
                'tenantEmail' => 'required|email',
            ];
        } elseif ($step == 6) {
            return [
                'paymentMethod' => ['required', Rule::in(['credit_card', 'paypal', 'bank_transfer'])],
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
        $this->summaryData = [
            'Insurance Selected' => $this->availableInsurances->firstWhere('id', $this->selectedinsuranceId)?->name ?? 'N/A',
            'Product Type' => $this->productType,
            'Insurance Type' => $this->insuranceType,
            'Rent Amount' => $this->rentAmount,
            'Property Address' => trim("{$this->doorNo}, {$this->addressOne}, {$this->addressTwo}, {$this->addressThree}, {$this->postCode}"),
            'Policy Holder Type' => $this->policyHoldertype,
            'Company Name' => $this->policyHoldertype === 'Company' ? $this->companyName : 'N/A',
            'Policy Holder Name' => $this->policyHoldertype === 'Individual' ? "{$this->policyholderTitle} {$this->policyholderFirstName} {$this->policyholderLastName}" : 'N/A',
            'Policy Holder Email' => $this->policyholderEmail,
            'Policy Holder Phone' => $this->policyholderPhone,
            'Policy Start Date' => $this->policyStartDate,
            'Policy End Date' => $this->policyEndDate,
            'Premium Amount' => $this->premiumAmount,
            'Tenant Name' => $this->tenantName,
            'Tenant Phone' => $this->tenantPhone,
            'Tenant Email' => $this->tenantEmail,
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
            $this->rulesForStep(6)
        );

        $this->validate($allRules);

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
        $purchase->company_name = $this->policyHoldertype === 'Company' ? $this->companyName : null;
        $purchase->policy_holder_title = $this->policyHoldertype === 'Individual' ? $this->policyholderTitle : null;
        $purchase->policy_holder_fname = $this->policyHoldertype === 'Individual' ? $this->policyholderFirstName : null;
        $purchase->policy_holder_lname = $this->policyHoldertype === 'Individual' ? $this->policyholderLastName : null;
        $purchase->policy_holder_email = $this->policyholderEmail;
        $purchase->policy_holder_phone = $this->policyholderPhone;

        $purchase->policy_start_date = $this->policyStartDate;
        $purchase->policy_end_date = $this->policyEndDate;
        $purchase->payable_amount = $this->premiumAmount;

        $purchase->tenant_name = $this->tenantName;
        $purchase->tenant_phone = $this->tenantPhone;
        $purchase->tenant_email = $this->tenantEmail;

        $purchase->payment_method = $this->paymentMethod;

        $purchase->save();

        session()->flash('message', 'Insurance purchase completed successfully!');

        return redirect('purchases');
    }

    public function render()
    {
        return view('livewire.master-insurance-purchase');
    }
}
