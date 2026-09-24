<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Purchase;
use App\Models\Provider;
use App\Models\Insurance;
use App\Models\UserType;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 

class DashboardCardComponent extends Component
{


      private function purchaseQuery()
    {
        $user = Auth::user();
        $userType = UserType::find($user->type);
        $query = Purchase::query();

        if ($userType && $userType->slug === 'council-officer') {

            $query->where('user_id', $user->id);
        }

        return $query;
    }
    
    public function render()
    {
        return view('livewire.dashboard-card-component');
    }

     #[Computed]
    public function policySold(){
        return $this->purchaseQuery()
            ->with('insurance', 'provider', 'invoice', 'user')
            ->whereNull('purchase_status')
            ->where('status', 1)
            ->count();
    }

    #[Computed]
    public function paidPurchaseAmount(){
        return $this->purchaseQuery()
            ->with('insurance', 'provider', 'invoice', 'user')
            ->where('status', 1)
            ->sum('payable_amount');
    }

    #[Computed]
    public function unPaidPurchase(){
        return $this->purchaseQuery()
            ->with('insurance', 'provider', 'invoice', 'user')
            ->whereNull('purchase_status')
            ->where('payment_method', 'pay_later')
            ->where('status', 1)
            ->count();
    }

     #[Computed]
    public function totalClient(){
        return $this->purchaseQuery()
            ->with('insurance', 'provider', 'invoice', 'user')
            ->distinct('policy_holder_email')
            ->where('status', 1)
            ->count();
    }
    
}
