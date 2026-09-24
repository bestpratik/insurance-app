<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use Livewire\WithPagination;
use App\Exports\DateWisePurchaseExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\UserType;

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


    // public function export()
    // {
    //     $this->validate();

    //     return Excel::download(
    //         new DateWisePurchaseExport($this->startDate, $this->endDate),
    //         'purchase-records-' . now()->format('Y-m-d') . '.xlsx'
    //     );
    // }

    public function export()
    {
        $this->validate();

        $user = Auth::user();

        $userType = UserType::find($user->type);

        return Excel::download(
            new DateWisePurchaseExport(
                $this->startDate,
                $this->endDate,
                $user->id,
                $userType?->slug
            ),
            'purchase-records-' . now()->format('Y-m-d') . '.xlsx'
        );
    }


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
        /*$query = Purchase::with(['insurance.provider', 'invoice'])
            ->where('status', 1)
            ->where('payment_status', 'Paid')
            ->whereNull('purchase_status')
            ->orderBy('id', 'desc');*/

        // $query = Purchase::with(['insurance.provider', 'invoice'])
        //         ->where('status', 1)
        //         ->whereNull('purchase_status')
        //         ->orderBy('id', 'desc');

        $query = $this->purchaseQuery()->with(['insurance.provider', 'invoice'])
            ->where('status', 1)
            ->whereNull('purchase_status')
            ->where(function ($q) {

                $q->whereHas('insurance', function ($iq) {
                    $iq->where('purchase_mode', 'Offline');
                })

                    ->orWhere(function ($sub) {
                        $sub->whereHas('insurance', function ($iq) {
                            $iq->where('purchase_mode', 'Online');
                        })
                            ->whereNot('payment_status', 'Pending');
                    });
            })
            ->orderBy('policy_start_date', 'desc');



        if ($this->startDate && $this->endDate) {
            $query->whereBetween('policy_start_date', [$this->startDate, $this->endDate]);
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
