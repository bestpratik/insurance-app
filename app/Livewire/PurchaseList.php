<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Insurance;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;
use App\Mail\InsuranceBillingEmail;
use PDF;

class PurchaseList extends Component
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


    public $showResendDocumentModal = false;
    public $resendDocument;
    public $resendDocPurchaseId = null;
    public $sendMail = [];

    public function render()
    {
        $query = Purchase::with(['insurance.provider','invoice'])->where('status', 1)->whereNull('purchase_status')->orderBy('id', 'desc');

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
        return view('livewire.purchase-list', [
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


public function openResendModal($purchaseId)
    {
        $this->resendDocPurchaseId = $purchaseId;
        $this->resendDocument = '';
        $this->showResendDocumentModal = true;
    }

    public function closeResendModal()
    {
        $this->showResendDocumentModal = false;
        $this->resendDocPurchaseId = null;
        $this->resendDocument = '';
    }

    public function submitResendingDoc()
    {
        $this->validate([
            'resendDocument' => 'required|email',
        ]);

        $purchase = Purchase::find($this->resendDocPurchaseId);
        if (!$purchase) {
            $this->addError('resendDocument', 'Purchase not found.');
            return;
        }

        $emailList = collect(preg_split('/[\s,]+/', $this->resendDocument))
            ->filter()
            ->map(fn($email) => trim($email))
            ->unique()
            ->toArray();

        if (empty($emailList)) {
            $this->addError('resendDocument', 'Please enter at least one valid email address.');
            return;
        }

        $this->send_email_one($purchase->id, $emailList);

      
        $this->sendMail = array_unique(array_merge($this->sendMail, [$this->resendDocPurchaseId]));

        // session()->flash('message', 'Documents resent successfully.');
        // $this->closeResendModal();
        $this->dispatch('swal:success', ['message' => 'Documents resent successfully.']);
        $this->closeResendModal();
    }

    public function send_email_one($purchaseId, $sendMailArray)
    {
        $purchase = Purchase::with('invoice')->findOrFail($purchaseId);

        $insurance = Insurance::with('staticdocuments', 'dynamicdocument', 'insurancemailtemplate')
            ->findOrFail($purchase->insurance_id);

        $allDocs = [];

        // Static documents
        if ($insurance->staticdocuments) {
            foreach ($insurance->staticdocuments as $docs) {
                $filePath = public_path('uploads/insurance_document/' . $docs->document);
                if (file_exists($filePath)) {
                    $allDocs[] = $filePath;
                }
            }
        }

        // Dynamic data for PDFs
        $pdfDynamicval = [
            $insurance->name,
            $purchase->policy_no,
            $purchase->policy_holder_address,
            date('jS F Y', strtotime($purchase->policy_start_date)),
            date('jS F Y', strtotime($purchase->policy_end_date)),
            date('jS F Y', strtotime($purchase->purchase_date)),
            $purchase->policy_term,
            $insurance->net_premium,
            $insurance->ipt,
            $insurance->gross_premium,
            $purchase->rent_amount,
        ];

        $riskAddress = trim($purchase->door_no . ' ' . $purchase->address_one . ' ' . $purchase->address_two . ' ' . $purchase->address_three . ' ' . $purchase->post_code);

        $insurartitle = $purchase->policy_holder_type === 'Company'
            ? $purchase->company_name
            : ($purchase->policy_holder_type === 'Individual'
                ? $purchase->policy_holder_title . ' ' . $purchase->policy_holder_fname . ' ' . $purchase->policy_holder_lname
                : $purchase->company_name . '/' . $purchase->policy_holder_title . ' ' . $purchase->policy_holder_fname . ' ' . $purchase->policy_holder_lname);

        $pdfDynamicval[] = $riskAddress;
        $pdfDynamicval[] = $insurartitle;
        $pdfDynamicval[] = $insurance->details_of_cover;

        // Dynamic documents
        if ($insurance->dynamicdocument) {
            foreach ($insurance->dynamicdocument as $dydocs) {
                $file_name = $dydocs->title . rand(11, 999999) . '.pdf';

                $data = [
                    'templateTitle' => $dydocs->title,
                    'templateBody' => $dydocs->description,
                    'templateHeder' => $dydocs->header,
                    'templateFooter' => $dydocs->footer,
                    'templatebodyValue' => $pdfDynamicval
                ];

                $pdf = PDF::loadView('purchase.pdfs.insurance_dynamic_document_email', ['data' => $data]);
                $pdfPath = public_path('uploads/dynamicdoc/' . $file_name);
                $pdf->save($pdfPath);
                if (file_exists($pdfPath)) {
                    $allDocs[] = $pdfPath;
                }
            }
        }

        $email_subject = $insurance->insurancemailtemplate->title ?? 'Insurance Documents';
        $data = [
            'body' => $insurance->insurancemailtemplate->description ?? '',
            'bodyValue' => $pdfDynamicval
        ];

        try {
            Mail::send('email.insurance_billing', $data, function ($messages) use ($sendMailArray, $allDocs, $email_subject) {
                $messages->to($sendMailArray);
                $messages->subject($email_subject);
                foreach ($allDocs as $attachment) {
                    $messages->attach($attachment);
                }
            });

            return true;
        } catch (\Exception $e) {
            logger()->error("Document resend failed: " . $e->getMessage());
            return false;
        }
    }

}