<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use Carbon\Carbon;
use Livewire\WithPagination;

class ActiveInsurance extends Component
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


    public $showCancelModal = false;
    public $cancelReason;
    public $cancelPurchaseId = null;
    public $cancelledPurchases = [];


    public function render()
    {
        $query = Purchase::with(['insurance.provider', 'invoice'])
            ->whereNull('purchase_status')
            ->whereHas('insurance', function ($query) {
                $query
                    ->where('purchase_mode', 'Online');
            })
            ->where('policy_end_date', '>', now())
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

        return view('livewire.active-insurance', [
            'result' => $purchases,
        ]);
    }

    public function openCancelModal($purchaseId)
    {
        $this->cancelPurchaseId = $purchaseId;
        $this->cancelReason = '';
        $this->showCancelModal = true;
    }

    public function closeCancelModal()
    {
        $this->showCancelModal = false;
        $this->cancelPurchaseId = null;
        $this->cancelReason = '';
    }

    public function submitCancellation()
    {
        $this->validate([
            'cancelReason' => 'required|string|min:5',
        ]);

        $purchase = Purchase::find($this->cancelPurchaseId);

        if ($purchase) {
            $purchase->purchase_status = 'Cancelled';
            $purchase->purchase_cancel_reason = $this->cancelReason;
            $purchase->save();
            $this->cancelledPurchases[] = $this->cancelPurchaseId;
        }

        // session()->flash('message', 'Purchase cancelled successfully.');
        // $this->closeCancelModal();

        $this->dispatch('swal:message', ['message' => 'Purchase cancelled successfully.']);
        $this->closeCancelModal();
    }
}
