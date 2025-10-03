<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Policyreferralform;
use App\Models\Insurance;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;
use App\Mail\InsuranceBillingEmail;
use Illuminate\Support\Facades\File;
use PDF;

class ReferralListComponent extends Component
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

    public $showResendInvoiceModal = false;
    public $resendInvoice;
    public $resendInvoicePurchaseId = null;


    public $showPaymentCheckModal = false;
    public $checkPayment;
    public $checkPaymentPurchaseId = null;
    public $paymentMethod;
    public $paymentStatus;

    

    public function render()
    {
        // $query = Purchase::with(['insurance.provider','invoice'])
        //         ->where('status', 1)
        //         ->whereNull('purchase_status')
        //         ->orderBy('id', 'desc');


        $query = Policyreferralform::with(['insurance.provider', 'invoice'])
                ->where('status', 1)
                ->whereNull('purchase_status')
                ->where(function ($query) {
                    $query->where(function ($q) {
                        $q->whereHas('insurance', function ($subQuery) {
                            $subQuery->where('purchase_mode', 'Online');
                        })
                        ->where('payment_status', 'Paid');
                    })->orWhere(function ($q) {
                        $q->whereHas('insurance', function ($subQuery) {
                            $subQuery->where('purchase_mode', 'Offline');
                        });
                    });
                })
                ->orderBy('id', 'desc');

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
        return view('livewire.referral-list-component', [
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

    $purchase = Policyreferralform::find($this->cancelPurchaseId);

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
            'resendDocument' => 'required',
        ]);

        $purchase = Policyreferralform::find($this->resendDocPurchaseId);
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
        
        $purchase = Policyreferralform::with('invoice')->findOrFail($purchaseId);

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
            $purchase->net_premium,
            $purchase->ipt,
            $purchase->gross_premium,
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


        //    $additionalEmails = [];

        //     if ($purchase->policy_holder_type === 'Company') {
        //         $additionalEmails[] = $purchase->policy_holder_company_email;
        //     } elseif ($purchase->policy_holder_type === 'Individual') {
        //         $additionalEmails[] = $purchase->policy_holder_email;
        //     } elseif ($purchase->policy_holder_type === 'Both') {
        //         $additionalEmails[] = $purchase->policy_holder_email;
        //         $additionalEmails[] = $purchase->policy_holder_company_email;
        //     }

            // $finalRecipients = array_unique(array_merge((array) $sendMailArray, $additionalEmails));
             $finalRecipients = $sendMailArray;

        try {
            Mail::send('email.insurance_billing', $data, function ($messages) use ($finalRecipients, $allDocs, $email_subject) {
                $messages->to($finalRecipients);
                $messages->subject($email_subject);
                $messages->bcc(['bestpratik@gmail.com']);
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

      public function openResendInvoiceModal($purchaseId) 
    {
        $this->resendInvoicePurchaseId = $purchaseId;
        $this->resendInvoice = '';
        $this->showResendInvoiceModal = true;
    }

    public function closeResendInvoiceModal()
    {
        $this->showResendInvoiceModal = false;
        $this->resendInvoicePurchaseId = null;
        $this->resendInvoice = '';
    }

    // public function submitResendInvoice()
    // {
    //     $this->validate([
    //         'resendInvoice' => 'required|email',
    //     ]);

    //     $purchase = Purchase::find($this->resendInvoicePurchaseId);
    //     // dd($purchase);
    //     if (!$purchase) {
    //         $this->addError('resendInvoice', 'Purchase not found.');
    //         return;
    //     }

    //     $emailList = collect(preg_split('/[\s,]+/', $this->resendInvoice))
    //         ->filter()
    //         ->map(fn($email) => trim($email))
    //         ->unique()
    //         ->toArray();

    //     if (empty($emailList)) {
    //         $this->addError('resendInvoice', 'Please enter at least one valid email address.');
    //         return;
    //     }

    //     $this->send_email_two($purchase->id, $emailList);

    //     // session()->flash('message', 'Documents resent successfully.');
    //     // $this->closeResendModal();
    //     $this->dispatch('swal:success', ['message' => 'Documents resent successfully.']);
    //     $this->closeResendModal();
    // }

    // public function send_email_two($purchaseId, $resendEmails = [])
    // {
    //     $purchase = Purchase::with(['insurance', 'insurance.staticdocuments', 'insurance.dynamicdocument', 'invoice'])->find($purchaseId);

    //     if (!$purchase) {
    //         return 'Purchase not found.';
    //     }

    //     $pdf = PDF::loadView('insurance.policy_invoice', compact('purchase'))->setPaper('a4');
    //     $pdfContent = $pdf->output();

    //     $fileName = 'policy_invoice_' . $purchaseId . '.pdf';
    //     $directory = public_path('uploads/invoice');
    //     $filePath = $directory . '/' . $fileName;

    //     if (!File::exists($directory)) {
    //         File::makeDirectory($directory, 0755, true);
    //     }

    //     file_put_contents($filePath, $pdfContent);

    //     // Email details
    //     $sendToEmails = [$purchase->invoice->billing_email];
    //     $emailSubject = 'Moneywise Investments PLC - Invoice for Policy - ' . $purchase->policy_no;

    //     $data = [
    //         'body' => 'Dear client,<br>
    //                 Please find the attached invoice for policy no. ' . $purchase->policy_no . '.'
    //     ];

    //     try {
    //         Mail::send('email.invoice_mail', $data, function ($message) use ($sendToEmails, $filePath, $emailSubject, $purchase, $resendEmails) {
    //             $message->to($sendToEmails);
    //             $message->subject($emailSubject);

    //             $ccEmails = array_merge(['anuradham.dbt@gmail.com'], explode(',', $purchase->invoice->copy_email));
    //             $message->cc($ccEmails);

    //             // $existingCopyEmails = explode(',', $purchase->invoice->copy_email ?? '');
    //             // $ccEmails = array_filter(array_merge(['anuradham.dbt@gmail.com'], $existingCopyEmails, $resendEmails));
    //             // $ccEmails = array_map('trim', $ccEmails);
    //             // $ccEmails = array_unique($ccEmails);

    //             // $message->cc($ccEmails);
    //             // $message->bcc(['bestpratik@gmail.com']);
    //             $message->attach($filePath);
    //         });

    //         return response()->download($filePath);
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }


    public function submitResendInvoice()
{
    $this->validate([
        'resendInvoice' => 'required',
    ]);

    $purchase = Policyreferralform::find($this->resendInvoicePurchaseId);

    if (!$purchase) {
        $this->addError('resendInvoice', 'Purchase not found.');
        return;
    }

    $emailList = collect(preg_split('/[\s,]+/', $this->resendInvoice))
        ->filter(fn($email) => filter_var(trim($email), FILTER_VALIDATE_EMAIL))
        ->map(fn($email) => trim($email))
        ->unique()
        ->values()
        ->toArray();

    if (empty($emailList)) {
        $this->addError('resendInvoice', 'Please enter at least one valid email address.');
        return;
    }

    $this->send_email_two($purchase->id, $emailList);

    $this->dispatch('swal:messages', ['message' => 'Invoice has been resent successfully!']);
    $this->closeResendInvoiceModal();
}

public function send_email_two($purchaseId, $resendEmails = [])
{
    // dd($resendEmails);
    $purchase = Policyreferralform::with(['insurance', 'insurance.staticdocuments', 'insurance.dynamicdocument', 'invoice'])
        ->find($purchaseId);

    if (!$purchase) {
        return;
    }

    $pdf = PDF::loadView('insurance.policy_invoice', compact('purchase'))->setPaper('a4');
    $pdfContent = $pdf->output();

    $fileName = 'policy_invoice_' . $purchaseId . '.pdf';
    $directory = public_path('uploads/invoice');
    $filePath = $directory . '/' . $fileName;

    if (!File::exists($directory)) {
        File::makeDirectory($directory, 0755, true);
    }

    file_put_contents($filePath, $pdfContent);

    // $sendToEmails = [$purchase->invoice->billing_email];
    $sendToEmails = $resendEmails;

    // $sendToEmails = array_merge(
    //     [$purchase->invoice->billing_email],
    //     $resendEmails
    // );
    $emailSubject = 'Moneywise Investments PLC - Invoice for Policy - ' . $purchase->policy_no;

    $data = [
        'body' => 'Dear client,<br>Please find the attached invoice for policy no. ' . $purchase->policy_no . '.'
    ];

    try {
        Mail::send('email.invoice_mail', $data, function ($message) use ($sendToEmails, $filePath, $emailSubject, $purchase, $resendEmails) {
            $message->to($sendToEmails);
            $message->subject($emailSubject);

            // $existingCopyEmails = array_filter(explode(',', $purchase->invoice->copy_email ?? ''));
            // $ccEmails = array_unique(array_merge(['anuradham.dbt@gmail.com'], $existingCopyEmails, $resendEmails));

            $ccEmails = 'aadatia@moneywiseplc.co.uk';

            $message->cc($ccEmails);
            $message->bcc(['bestpratik@gmail.com']);
            $message->attach($filePath);
        });
    } catch (Exception $e) {
        report($e);
    }
}


public function openPaymentCheckModal($purchaseId)  
{
    $this->checkPaymentPurchaseId = $purchaseId;

    $purchase = Policyreferralform::find($purchaseId);
    if ($purchase) {
        $this->paymentStatus = $purchase->payment_status; 
        $this->paymentMethod = $purchase->payment_method;
    }

    $this->checkPayment = '';
    $this->showPaymentCheckModal = true;
}

public function closePaymentCheckModal()
{
    $this->showPaymentCheckModal = false;
    $this->checkPaymentPurchaseId = null;
    $this->checkPayment = '';
}

public function submitPaymentCheckModal()
{
    // dd($this->checkPaymentPurchaseId);
    // $this->validate([
    //     'paymentMethod' => 'required',
    //     'paymentStatus' => 'required',
    // ]);

    $purchase = Policyreferralform::find($this->checkPaymentPurchaseId);
    // dd($purchase);

    if ($purchase) {
        $purchase->payment_method = $this->paymentMethod;
        $purchase->payment_status = $this->paymentStatus; 
        // dd($purchase);
        $purchase->save();

        $this->dispatch('swal:successs', [
            'message' => 'Payment information updated successfully!'
        ]);

    }

    $this->closePaymentCheckModal();
}


}
