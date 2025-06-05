<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Insurance;
use Livewire\WithPagination;
use PDF;

class DatewisePurchaseList extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $startDate;
    public $endDate;
    public $errorMessage;
    public $purchases = [];

    public function filterResult(){
        if($this->startDate && $this->endDate){
            $query = Purchase::with(['insurance.provider','invoice'])
                                ->where('status', 1)
                                ->whereNull('purchase_status')
                                ->whereBetween('purchase_date', [$this->startDate, $this->endDate])
                                ->orderBy('id', 'desc');
            $this->purchases = $query->get();
            //dd($this->purchases);
        }else{
            $this->errorMessage = "Please choose start date & end date";
        }
    }

    public function render()
    {
        return view('livewire.datewise-purchase-list');
    }
}
