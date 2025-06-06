<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Insurance Summary
        </h2>
    </x-slot>
    <!-- @if($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif -->

    <div class="card bg-white rounded-lg border">
        <div class="d-md-flex align-content-stretch">
            <div class="card-body flex-fill mx-md-4">
                @include('insurance.menu')




                @if($message = Session::get('onboarderror'))
                    <div class="alert alert-success alert-dismissible">
                        {{ $message }}
                    </div>
                @endif
                <form id="_dm-customWizardForm" class="p-6 bg-white rounded shadow" action="" method="post">
                    @csrf

                    <div class="mb-6">
                        <h5 class="text-lg font-semibold text-gray-800 mb-2">General Details</h5>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            @if($insurance->type_of_insurance ?? '')
                                <label class="block">
                                    <span class="text-gray-700 font-medium">Type Of Insurance:</span>
                                    <div class="mt-1 text-gray-900">
                                        {{$insurance->type_of_insurance}}
                                    </div>
                                </label>
                            @endif

                            @if($insurance->name ?? '')
                                <label class="block">
                                    <span class="text-gray-700 font-medium">Name Of Insurance:</span>
                                    <div class="mt-1 text-gray-900">
                                        {{$insurance->name}}
                                    </div>
                                </label>
                            @endif

                            @if($insurance->provider_type ?? '')
                                <label class="block">
                                    <span class="text-gray-700 font-medium">Provider:</span>
                                    <div class="mt-1 text-gray-900">
                                        {{$insurance->provider->name}}
                                    </div>
                                </label>
                            @endif

                            @if($insurance->prefix ?? '')
                            <label class="block">
                                <span class="text-gray-700 font-medium">Prefix:</span>
                                <div class="mt-1 text-gray-900">
                                    {{$insurance->prefix}}
                                </div>
                            </label>
                        @endif

                        @if($insurance->validity ?? '')
                            <label class="block">
                                <span class="text-gray-700 font-medium">Validity (In Days):</span>
                                <div class="mt-1 text-gray-900">
                                    {{$insurance->validity}}
                                </div>
                            </label>
                        @endif
                    
                        @if($insurance->details_of_cover ?? '')
                            <label class="block">
                                <span class="text-gray-700 font-medium">Details of cover:</span>
                                <div class="mt-1 text-gray-900">
                                    {{$insurance->details_of_cover}}
                                </div>
                            </label>
                        @endif
                        </div>
                    </div>

                    


                    <div class="mb-6">
                        <h5 class="text-lg font-semibold text-gray-800 mb-2">Rent Amount (£)</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            @if($insurance->purchase->rent_amount ?? '')
                                <label class="block">
                                    <span class="text-gray-700 font-medium">To:</span>
                                    <div class="mt-1 text-gray-900">
                                        {{$insurance->purchase->rent_amount ?? ''}}
                                    </div>
                                </label>
                            @endif

                            
                        </div>
                    </div>

                    <div class="mb-6">
                        <h5 class="text-lg font-semibold text-gray-800 mb-2">Pricing</h5>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            @if($insurance->net_premium ?? '')
                                <label class="block">
                                    <span class="text-gray-700 font-medium">Net Premium:</span>
                                    <div class="mt-1 text-gray-900">
                                        {{$insurance->net_premium}}
                                    </div>
                                </label>
                            @endif

                            @if($insurance->commission ?? '')
                                <label class="block">
                                    <span class="text-gray-700 font-medium">Commission:</span>
                                    <div class="mt-1 text-gray-900">
                                        {{$insurance->commission}}
                                    </div>
                                </label>
                            @endif

                            @if($insurance->gross_premium ?? '')
                                <label class="block">
                                    <span class="text-gray-700 font-medium">Gross Premium:</span>
                                    <div class="mt-1 text-gray-900">
                                        {{$insurance->gross_premium}}
                                    </div>
                                </label>
                            @endif

                            @if($insurance->ipt ?? '')
                            <label class="block">
                                <span class="text-gray-700 font-medium">IPT:</span>
                                <div class="mt-1 text-gray-900">
                                    {{$insurance->ipt}}
                                </div>
                            </label>
                            @endif

                            @if($insurance->total_premium ?? '')
                                <label class="block">
                                    <span class="text-gray-700 font-medium">Total Premium:</span>
                                    <div class="mt-1 text-gray-900">
                                        {{$insurance->total_premium}}
                                    </div>
                                </label>
                            @endif
                        
                            @if($insurance->payable_amount ?? '')
                                <label class="block">
                                    <span class="text-gray-700 font-medium">Billable Amount:</span>
                                    <div class="mt-1 text-gray-900">
                                        {{$insurance->payable_amount}}
                                    </div>
                                </label>
                            @endif

                            @if($insurance->ipt_on_billable_amount ?? '')
                                <label class="block">
                                    <span class="text-gray-700 font-medium">IPT on Billable Amount:</span>
                                    <div class="mt-1 text-gray-900">
                                        {{$insurance->ipt_on_billable_amount}}
                                    </div>
                                </label>
                            @endif
                        </div>
                    </div>

                    <div class="mb-6">
                        <h5 class="text-lg font-semibold text-gray-800 mb-2">Static Documents</h5>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="mt-1 text-gray-900">
                                        @foreach ($insurance->staticdocuments as $row) 
                                            @php
                                                $documentUrl = url('/') . '/uploads/insurance_document/' . $row->document;
                                                $extension = pathinfo($row->document, PATHINFO_EXTENSION);
                                                
                                            @endphp

                                            @if($row->document)
                                                <div class="flex items-center gap-3">
                                                    <div>
                                                        <span class="text-theme-sm mb-0.5 block font-medium text-gray-700">
                                                            <a class="flex items-center border rounded px-4 py-1.5" target="_blank" href="{{ $documentUrl }}">
                                                                @if(in_array(strtolower($extension), ['doc', 'docx']))
                                                                    <x-heroicon-o-document-text class="h-6 w-6 text-blue-800 mr-2" />
                                                                @elseif(strtolower($extension) === 'pdf')
                                                                    <x-heroicon-o-document class="h-6 w-6 text-red-600 mr-2" />
                                                                @else
                                                                    <x-heroicon-o-document class="h-6 w-6 text-gray-600 mr-2" />
                                                                @endif
                                                                <span>Download</span>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                            </div>
                        </div>
                    </div>


                 

                    <div class="pt-4 flex justify-center gap-3">
                        <a href="{{route('insurance.email.template', $insurance->uuid)}}"
                            class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200">
                            Previous
                        </a>
                        <a href="{{route('insurance.success')}}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Submit
                        </a>
                    </div>
                </form>


            </div>
        </div>
    </div>


</x-app-layout>

<!-- Summernote) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<!-- Summernote) -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.summernote').summernote({
            height: 50,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const a = document.getElementById("_dm-customWizardSteps"),
            d = new Zangdar("#_dm-customWizardForm", {
                onStepChange() {
                    a.querySelectorAll(".active").forEach((a) =>
                        a.classList.remove("active")
                    );
                    const b = d.getCurrentStep().label;
                    a.querySelector(`[data-step="${b}"]`).classList.add("active");
                },
            }),
            b = document.getElementById("_dm-progWizardSteps"),
            e = new Zangdar("#_dm-progWizardForm", {
                onStepChange() {
                    b.querySelectorAll(".active").forEach((a) =>
                        a.classList.remove("active")
                    );
                    const a = e.getCurrentStep().label;
                    b.querySelector(`[data-step="${a}"]`).classList.add("active");
                },
            }),
            c = document.getElementById("_dm-validWizardSteps"),
            f = new Zangdar("#_dm-validWizardForm", {
                onStepChange() {
                    c.querySelectorAll(".active").forEach((a) =>
                        a.classList.remove("active")
                    );
                    const a = f.getCurrentStep().label;
                    c.querySelector(`[data-step="${a}"]`).classList.add("active");
                },

            });
    });
</script>