<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{
    public function dashboard()
    {
        if (Gate::allows('isUser')) {
            return redirect()->route('dashboard.frontend')->with('error', 'Access denied to admin dashboard.');
        }
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        $lastSixMonths = [];
        $lastSixsaleamount = [];
        $lastSixUnpaids = [];
        $lastSixPaids = [];

        for ($i = 0; $i < 6; $i++) {
            $currentDate = Carbon::createFromDate($currentYear, $currentMonth, 1);
            $first_date_of_month = $currentDate->subMonths($i);

            $lastSixMonths[] = $currentDate->format('F');

            $first_day = date('Y-m-01', strtotime($first_date_of_month)); // First day of the month.
            $last_day = date('Y-m-t', strtotime($first_date_of_month));

            $totalSale = Purchase::with(['insurance.provider', 'invoice'])
                ->where('status', 1)
                ->whereNull('purchase_status')
                ->whereBetween('purchase_date', [$first_day, $last_day])
                ->sum('payable_amount');
            $lastSixsaleamount[] = number_format($totalSale, 2, '.', '');

            $unpaid = Purchase::with(['insurance.provider', 'invoice'])
                ->where('status', 1)
                ->where('payment_status', 0)
                ->whereNull('purchase_status')
                ->whereBetween('purchase_date', [$first_day, $last_day])
                ->sum('payable_amount');
            $lastSixUnpaids[] = number_format($unpaid, 2, '.', '');

            $paid = Purchase::with(['insurance.provider', 'invoice'])
                ->where('status', 1)
                ->where('payment_status', 1)
                ->whereNull('purchase_status')
                ->whereBetween('purchase_date', [$first_day, $last_day])
                ->sum('payable_amount');
            $lastSixPaids[] = number_format($paid, 2, '.', '');
        }

        $data = [
            'labels' => $lastSixMonths,
            'data' => [
                'total_sale' => $lastSixsaleamount, // Total sale for each month
                'paid_amount' => $lastSixPaids,  // Paid amount for each month
                'pending_amount' => $lastSixUnpaids   // Pending amount for each month
            ]
        ];

        return view('dashboard', compact('data'));
    }

    public function online_purchase()
    {
        $onlinePurchase = Purchase::with(['insurance.provider', 'invoice'])
            ->where('status', 1)
            ->whereHas('insurance', function ($query) {
                $query
            ->where('purchase_mode', 'Online');
            })->get();
            // dd($onlinePurchase);
        return view('admin.online_purchase_list', compact('onlinePurchase'));
    }

    public function offline_purchase()
    {
        $offlinePurchase = Purchase::with(['insurance.provider', 'invoice'])
            ->where('status', 1)
            ->whereHas('insurance', function ($query) {
                $query
            ->where('purchase_mode', 'Offline');
            })->get();
        return view('admin.offline_purchase_list', compact('offlinePurchase'));
    }
}
