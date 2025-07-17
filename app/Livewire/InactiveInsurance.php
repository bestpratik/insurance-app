<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use Carbon\Carbon;
use Livewire\WithPagination; 
use Illuminate\Support\Facades\Auth;

class InactiveInsurance extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $policyNo;
    public $insuranceName;
    public $propertyAddress;
    public $rentAmount;
    public $landlordAgency;
    public $landlordagencyAddress;
    public $landlordagencyEmail;
    public $policyStartdate;
    public $policyEnddate;
    public $astStartdate;
    public $purchaseDate;
    public $tenantName;
    public $tenantEmail;
    public $detailsofCover;

    public function render()
    {
         $query = Purchase::with(['insurance.provider','invoice'])
            ->whereNull('purchase_status')
            ->whereHas('insurance', function ($query) {
                $query
            ->where('purchase_mode', 'Online');
            })
            ->where('policy_end_date', '<', now())
            ->when(Auth::check(), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('id', 'desc');
        //  dd($query);
       
        if (!empty($this->policyNo)) {
            $query->where('policy_no', 'LIKE', '%' . $this->policyNo . '%');
        }

        if (!empty($this->insuranceName)) {
            $query->whereHas('insurance', function ($query) {
                 $query->where('name', 'like', '%' . $this->insuranceName . '%');
            });
        }

        if (!empty($this->propertyAddress)) {
            $query->where('property_address', 'LIKE', '%' . $this->propertyAddress . '%');
        }

        if (!empty($this->rentAmount)) {
            $query->where('rent_amount', $this->rentAmount);
        }

        if (!empty($this->landlordAgency)) {
            $query->where('policy_holder_title', $this->landlordAgency)
                        ->orWhere('policy_holder_fname', 'LIKE', '%' . $this->landlordAgency . '%')
                        ->orWhere('policy_holder_lname', 'LIKE', '%' . $this->landlordAgency . '%')
                        ->orWhere('company_name', 'LIKE', '%' . $this->landlordAgency . '%');
        }

        if (!empty($this->landlordagencyAddress)) {
            $query->where('policy_holder_address', $this->landlordagencyAddress);
        }

        if (!empty($this->landlordagencyEmail)) {
            $query->where('policy_holder_email', $this->landlordagencyEmail);
        }

        if (!empty($this->policyStartdate)) {
            $query->where('policy_start_date', $this->policyStartdate);
        }

        if (!empty($this->policyEnddate)) {
            $query->where('policy_end_date', $this->policyEnddate);
        }

        if (!empty($this->astStartdate)) {
            $query->where('ast_start_date', $this->astStartdate);
        }

        if (!empty($this->purchaseDate)) {
            $query->where('purchase_date', $this->purchaseDate);
        }

        if (!empty($this->tenantName)) {
            $query->where('tenant_name', $this->tenantName);
        }

        if (!empty($this->tenantEmail)) {
            $query->where('tenant_email', $this->tenantEmail);
        }

        $purchases = $query->paginate($this->perPage);

        return view('livewire.inactive-insurance', [
            'result' => $purchases,
        ]); 
    }
}
