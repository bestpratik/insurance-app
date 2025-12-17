<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use Livewire\WithPagination;

class DatewisePurchaseList extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $startDate;
    public $endDate;
    public $errorMessage;

    protected $rules = [
        'startDate' => 'required|date',
        'endDate' => 'required|date|after_or_equal:startDate',
    ];

    protected $messages = [
        'startDate.required' => 'The start date is required.',
        'endDate.required' => 'The end date is required.',
        'endDate.after_or_equal' => 'The end date must be after or equal to start date.',
    ];

    public function filterResult()
    {
        try {
            $this->validate();
            $this->errorMessage = null;
            $this->resetPage();

        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->errorMessage = $e->validator->errors()->first();
            $this->resetPage();
        }
    }
 
    public function render()
    {
        $query = Purchase::with(['insurance.provider', 'invoice'])
            ->where('status', 1)
            ->where('payment_status', 'Paid')
            ->whereNull('purchase_status')
            ->orderBy('id', 'desc');

        

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('purchase_date', [$this->startDate, $this->endDate]);
        } else {
            return view('livewire.datewise-purchase-list', [
                'purchases' => Purchase::where('id', '<', 0)->paginate($this->perPage)
            ]);
        }

        return view('livewire.datewise-purchase-list', [
            'purchases' => $query->paginate($this->perPage)
        ]);
    }
}