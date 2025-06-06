<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Provider;
use App\Models\Insurance;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Carbon\Carbon;

class DashboardComponent extends Component 
{
    use WithPagination;
    public $perPage = 10;

     public function render()
    {
        $query = Purchase::with(['insurance.provider','invoice'])
                ->where('status', 1)
                ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
                ->whereNull('purchase_status')
                ->orderBy('id', 'desc');



        $purchases = $query->paginate($this->perPage);
        return view('livewire.dashboard-component', [
            'result' => $purchases,
        ]);
    }
    public $showPaymentCheckModal = false;
    public $checkPayment;
    public $checkPaymentPurchaseId = null;
    public function openPaymentCheckModal($purchaseId) 
    {
        $this->checkPaymentPurchaseId = $purchaseId;
        $this->checkPayment = '';
        $this->showPaymentCheckModal = true;
    }

    public function closePaymentCheckModal()
    {
        $this->showPaymentCheckModal = false;
        $this->checkPaymentPurchaseId = null;
        $this->checkPayment = '';
    }

    #[Computed]
    public function policySold(){
        return Purchase::with('insurance', 'provider', 'invoice', 'user')
            ->whereNull('purchase_status')
            ->where('status', 1)
            ->count();
    }

    #[Computed]
    public function paidPurchaseAmount(){
        return Purchase::with('insurance', 'provider', 'invoice', 'user')
            ->where('status', 1)
            ->sum('payable_amount');
    }

    #[Computed]
    public function unPaidPurchase(){
        return Purchase::with('insurance', 'provider', 'invoice', 'user')
            ->where('payment_method', 'pay_later')
            ->where('status', 1)
            ->count();
    }

     #[Computed]
    public function totalClient(){
        return Purchase::with('insurance', 'provider', 'invoice', 'user')
            ->distinct('policy_holder_email')
            ->where('status', 1)
            ->count();
    }

   
}
