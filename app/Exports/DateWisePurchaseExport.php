<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DateWisePurchaseExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $startDate;
    public $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Purchase::where('status', 1)
            ->whereNull('purchase_status')
            ->whereBetween('policy_start_date', [$this->startDate, $this->endDate])
            ->get([
                'product_type',
                'policy_no',
                'policy_holder_fname',
                'policy_holder_lname',
                'policy_start_date',
                'policy_end_date',
                'insurance_type',
                'net_premium',
                'commission',
                'gross_premium',
                'ipt',
                'total_premium',
                'policy_holder_address',
                'property_address',

                'company_name',
                'policy_holder_email',
                'policy_holder_phone',
                'ast_start_date',
                'payable_amount',
                'tenant_name',
                'tenant_email',
                'tenant_phone',
                'rent_amount',
                'insurance_type',
                'policy_holder_postcode',
                'post_code',
                'purchase_date',
                'ipt_on_billable_amount',
                'admin_fee',
                'payment_method',
                'payment_status',
            ]);
    }

    public function map($row): array
    {
        // Policy Holder Name
        if ($row->policy_holder_type == 'Company') {
            $policyHolderName = $row->company_name ?? '';
        } elseif ($row->policy_holder_type == 'Individual') {
            $policyHolderName = trim(
                ($row->policy_holder_title ?? '') . ' ' .
                ($row->policy_holder_fname ?? '') . ' ' .
                ($row->policy_holder_lname ?? '')
            );
        } else {
            $policyHolderName = trim(
                ($row->company_name ?? '') . ' ' .
                ($row->policy_holder_title ?? '') . ' ' .
                ($row->policy_holder_fname ?? '') . ' ' .
                ($row->policy_holder_lname ?? '')
            );
        }

        return [

            $row->product_type ?? '',
            $row->policy_no ?? '',
            $policyHolderName,

            $row->policy_start_date
                ? date('d/m/Y', strtotime($row->policy_start_date))
                : '',

            $row->policy_end_date
                ? date('d/m/Y', strtotime($row->policy_end_date))
                : '',

            ucfirst($row->insurance_type ?? ''),

            $row->net_premium ?? '',
            $row->commission ?? '',
            $row->gross_premium ?? '',
            $row->ipt ?? '',
            $row->total_premium ?? '',

            ($row->total_premium ?? 0) - ($row->commission ?? 0),

            $row->policy_holder_address ?? '',
            $row->property_address ?? '',

            $row->company_name ?? '',
            $row->policy_holder_email ?? '',
            $row->policy_holder_phone ?? '',

            $row->ast_start_date
                ? date('d/m/Y', strtotime($row->ast_start_date))
                : '',

            $row->payable_amount ?? '',
            $row->tenant_name ?? '',
            $row->tenant_email ?? '',
            $row->tenant_phone ?? '',
            $row->rent_amount ?? '',
            ucfirst($row->insurance_type ?? ''),
            $row->policy_holder_postcode ?? '',
            $row->post_code ?? '',
            // $row->policy_term ?? '',

            $row->purchase_date
                ? date('d/m/Y', strtotime($row->purchase_date))
                : '',

            $row->ipt_on_billable_amount ?? '',
            $row->admin_fee ?? '',
            $row->payment_method ?? '',
            $row->payment_status ?? '',
        ];
    }

    public function headings(): array
    {
        return [
            'Product Type',
            'Policy No',
            'First Name',
            'Last Name',
            'Policy Start Date',
            'Policy End Date',
            'Transaction Type',
            'Net Premium',
            'Commission',
            'Gross Premium',
            'IPT',
            'Total Premium',
            'Insured Address',
            'Property Address',


            'Company Name',
            'Policy Holder Email',
            'Policy Holder Phone',
            'Ast Start Date',
            'Payable Amount',
            'Tenant Name',
            'Tenant Email',
            'Tenant Phone',
            'Rent Amount',
            'Insurance Type',
            'Policy Holder Postcode',
            'Postcode',
            // 'Policy Term',
            'Purchase Date',
            'Ipt on Billable Amount',
            'Admin Fee',
            'Payment Method',
            'Payment Status',
            
        ];
    }
}
