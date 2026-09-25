<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Council;
use App\Models\Purchase;
use Carbon\Carbon;

class CouncilController extends Controller
{
    // public function dashboard()
    // {
    //     if (Auth::user()->userType->slug !== 'council-officer') {
    //         abort(403);
    //     }

    //     $currentMonth = Carbon::now()->format('m');
    //     $currentYear = Carbon::now()->format('Y');

    //     $lastSixMonths = [];
    //     $lastSixsaleamount = [];
    //     $lastSixUnpaids = [];
    //     $lastSixPaids = [];

    //     for ($i = 0; $i < 6; $i++) {
    //         $currentDate = Carbon::createFromDate($currentYear, $currentMonth, 1);
    //         $first_date_of_month = $currentDate->subMonths($i);

    //         $lastSixMonths[] = $currentDate->format('F');

    //         $first_day = date('Y-m-01', strtotime($first_date_of_month)); // First day of the month.
    //         $last_day = date('Y-m-t', strtotime($first_date_of_month));

    //         $totalSale = Purchase::with(['insurance.provider', 'invoice'])
    //             ->where('status', 1)
    //             ->whereNull('purchase_status')
    //             ->whereBetween('purchase_date', [$first_day, $last_day])
    //             ->sum('payable_amount');
    //         $lastSixsaleamount[] = number_format($totalSale, 2, '.', '');

    //         $unpaid = Purchase::with(['insurance.provider', 'invoice'])
    //             ->where('status', 1)
    //             ->where('payment_status', 0)
    //             ->whereNull('purchase_status')
    //             ->whereBetween('purchase_date', [$first_day, $last_day])
    //             ->sum('payable_amount');
    //         $lastSixUnpaids[] = number_format($unpaid, 2, '.', '');

    //         $paid = Purchase::with(['insurance.provider', 'invoice'])
    //             ->where('status', 1)
    //             ->where('payment_status', 1)
    //             ->whereNull('purchase_status')
    //             ->whereBetween('purchase_date', [$first_day, $last_day])
    //             ->sum('payable_amount');
    //         $lastSixPaids[] = number_format($paid, 2, '.', '');
    //     }

    //     $data = [
    //         'labels' => $lastSixMonths,
    //         'data' => [
    //             'total_sale' => $lastSixsaleamount, // Total sale for each month
    //             'paid_amount' => $lastSixPaids,  // Paid amount for each month
    //             'pending_amount' => $lastSixUnpaids   // Pending amount for each month
    //         ]
    //     ];


    //     return view('council.dashboard', compact('data'));
    // }


    public function dashboard()
{
    // Check Council Officer
    if (
        !Auth::check() ||
        !Auth::user()->userType ||
        Auth::user()->userType->slug !== 'council-officer'
    ) {
        abort(403);
    }

    // Get logged-in user's type ID
    $userTypeId = Auth::user()->type;

    $currentMonth = Carbon::now()->format('m');
    $currentYear = Carbon::now()->format('Y');

    $lastSixMonths = [];
    $lastSixsaleamount = [];
    $lastSixUnpaids = [];
    $lastSixPaids = [];

    for ($i = 0; $i < 6; $i++) {

        $currentDate = Carbon::createFromDate(
            $currentYear,
            $currentMonth,
            1
        );

        $first_date_of_month = $currentDate->copy()->subMonths($i);

        $lastSixMonths[] = $first_date_of_month->format('F');

        $first_day = $first_date_of_month->format('Y-m-01');
        $last_day = $first_date_of_month->format('Y-m-t');


        // TOTAL SALE
        $totalSale = Purchase::whereHas('user', function ($query) use ($userTypeId) {

                // users.type = logged-in user's type
                $query->where('type', $userTypeId);

            })
            ->where('status', 1)
            ->whereNull('purchase_status')
            ->whereBetween('purchase_date', [$first_day, $last_day])
            ->sum('payable_amount');

        $lastSixsaleamount[] = number_format(
            $totalSale,
            2,
            '.',
            ''
        );


        // UNPAID
        $unpaid = Purchase::whereHas('user', function ($query) use ($userTypeId) {

                // users.type = logged-in user's type
                $query->where('type', $userTypeId);

            })
            ->where('status', 1)
            ->where('payment_status', 0)
            ->whereNull('purchase_status')
            ->whereBetween('purchase_date', [$first_day, $last_day])
            ->sum('payable_amount');

        $lastSixUnpaids[] = number_format(
            $unpaid,
            2,
            '.',
            ''
        );


        // PAID
        $paid = Purchase::whereHas('user', function ($query) use ($userTypeId) {

                // users.type = logged-in user's type
                $query->where('type', $userTypeId);

            })
            ->where('status', 1)
            ->where('payment_status', 1)
            ->whereNull('purchase_status')
            ->whereBetween('purchase_date', [$first_day, $last_day])
            ->sum('payable_amount');

        $lastSixPaids[] = number_format(
            $paid,
            2,
            '.',
            ''
        );
    }


    $data = [
        'labels' => $lastSixMonths,

        'data' => [
            'total_sale' => $lastSixsaleamount,
            'paid_amount' => $lastSixPaids,
            'pending_amount' => $lastSixUnpaids
        ]
    ];

    return view('dashboard', compact('data'));
}
    public function index()
    {
        $councils = Council::where('status', 1)->get();
        return view('council.index', compact('councils'));
    }

    public function create()
    {
        return view('council.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'council_name'  => 'required|unique:councils,council_name',
            'council_email' => 'required|email|unique:councils,council_email',
        ]);

        $council = new Council;
        $council->council_name = $request->council_name;
        $council->council_email = $request->council_email;
        $council->save();

        return redirect('councils')->with('success', 'Council created successfully');
    }

    public function edit($id)
    {
        $council = Council::find($id);
        return view('council.edit', compact('council'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'council_name' => 'required|unique:councils,council_name,' . $id,
            'council_email' => 'required|email|unique:councils,council_email,' . $id,
        ]);

        $council = Council::find($id);
        $council->council_name = $request->council_name;
        $council->council_email = $request->council_email;
        $council->update();

        return redirect('councils')->with('success', 'Council updated successfully');
    }

    public function destroy($id)
    {
        $council = Council::find($id);
        if ($council) {
            $council->delete();
            return redirect('councils')->with('success', 'Council deleted Successfully');
        } else {
            return redirect('councils')->with('success', 'No data find to delete');
        }
    }
}
