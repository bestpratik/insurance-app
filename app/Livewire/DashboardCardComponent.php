<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Purchase;
use App\Models\Provider;
use App\Models\Insurance;
use Livewire\Attributes\Computed;
use Carbon\Carbon; 

class DashboardCardComponent extends Component
{
    public function render()
    {
        return view('livewire.dashboard-card-component');
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
