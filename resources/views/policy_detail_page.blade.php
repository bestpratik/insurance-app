<x-front>
    <div class="max-w-5xl mx-auto p-8 bg-white rounded-xl shadow space-y-6 border my-6">

        <!-- PAGE TITLE -->
        <h2 class="text-3xl font-bold flex items-center gap-2">
            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            View Purchase Details
        </h2>

        <!-- Policy Information -->
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold flex items-center gap-2 mb-4 border-b pb-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M3 7h18M3 12h18M3 17h18" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Policy Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Insurance Name</p>
                    <p class="font-medium">
                        @if($purchase->insurance)
                            {{ $purchase->insurance->name }}
                        @endif
                    </p>  
                </div>
                <div>
                    <p class="text-sm text-gray-500">Policy Number</p>
                    <p class="font-medium">
                        {{ $purchase->policy_no ?? 'N/A' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Purchased By</p>
                    <p class="font-medium">
                        {{ auth()->user()->name ?? '' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Important Dates -->
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold flex items-center gap-2 mb-4 border-b pb-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M8 7V3m8 4V3m-9 8h10m-12 8h14a2 2 0 0 0 2-2V7H3v10a2 2 0 0 0 2 2z" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Important Dates
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Policy Start Date</p>
                    <p class="font-medium">
                        {{ \Carbon\Carbon::parse($purchase->policy_start_date)->format('d M Y') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Policy End Date</p>
                    <p class="font-medium">
                        {{ \Carbon\Carbon::parse($purchase->policy_end_date)->format('d M Y') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">AST Start Date</p>
                    <p class="font-medium">
                        {{ \Carbon\Carbon::parse($purchase->ast_start_date)->format('d M Y') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Purchase Date</p>
                    <p class="font-medium">
                        {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Landlord/Property/Tenant Details -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <h4 class="font-semibold flex items-center gap-2 mb-2 border-b pb-1">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Landlord/Agency Details
                </h4>
                <p class="font-medium">
                    @if($purchase->policy_holder_type == 'Company')
                                                {{ $purchase->company_name ?? '' }}
                                            @elseif($purchase->policy_holder_type == 'Individual')
                                                {{ $purchase->policy_holder_title ?? '' }} {{ $purchase->policy_holder_fname ?? '' }} {{ $purchase->policy_holder_lname ?? '' }}
                                            @else
                                                {{ $purchase->company_name ?? '' }} <br>
                                                {{ $purchase->policy_holder_title ?? '' }} {{ $purchase->policy_holder_fname ?? '' }} {{ $purchase->policy_holder_lname ?? '' }}
                                            @endif
                </p>
                <p class="text-sm text-gray-600">
                    {{ $purchase->policy_holder_address ?? '' }}
                </p>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <h4 class="font-semibold flex items-center gap-2 mb-2 border-b pb-1">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M3 12l2-2 4 4 8-8 2 2-10 10-6-6z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Property Details
                </h4>
                <p class="font-medium">
                    {{ $purchase->door_no }}, {{ $purchase->address_one ?? '' }}, {{ $purchase->address_two ?? '' }}, {{ $purchase->address_three ?? '' }}, {{ $purchase->post_code ?? '' }}
                </p>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <h4 class="font-semibold flex items-center gap-2 mb-2 border-b pb-1">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Tenant Details
                </h4>
                <p class="font-medium">
                    {{ $purchase->tenant_name ?? '' }}
                </p>
                <p class="font-medium">
                    {{ $purchase->tenant_email ?? '' }}
                </p>
                <p class="font-medium">
                    {{ $purchase->tenant_phone ?? '' }}
                </p>
            </div>
        </div>

        <!-- Billing Details -->
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold flex items-center gap-2 mb-4 border-b pb-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 8c-1.11 0-2 .89-2 2 0 1.5 2 2 2 2s2-.5 2-2c0-1.11-.89-2-2-2zm0 0V6m0 8v2m4-10H8a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4v-6a4 4 0 0 0-4-4z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Billing Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Billing Name</p>
                    <p class="font-medium">
                        {{ $purchase->invoice->billing_name ?? '' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Billing Email</p>
                    <p class="font-medium">
                        {{ $purchase->invoice->billing_email ?? '' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Billing Phone</p>
                    <p class="font-medium">
                        {{ $purchase->invoice->billing_phone ?? '' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Billing Address</p>
                    <p class="font-medium">
                        {{ $purchase->invoice->billing_address_one ?? '' }},
                                                {{ $purchase->invoice->billing_address_two ?? '' }},
                                                {{ $purchase->invoice->billing_postcode ?? '' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Static Policy Documents -->
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <h4 class="font-semibold flex items-center gap-2 mb-3 border-b pb-1">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Static Policy Documents
            </h4>
            <ul class="space-y-2">
                @if($purchase->insurance && $purchase->insurance->staticdocuments->count())
                @foreach($purchase->insurance->staticdocuments as $doc)
                    <div>
                        <a href="{{ asset('uploads/insurance_document/' . $doc->document) }}" target="_blank" class="text-blue-600 hover:underline">
                            <x-heroicon-o-document-text class="h-6 w-6 text-red-600 inline" /> {{ $doc->title }}
                        </a>
                    </div>
                @endforeach
                @else
                <div class="text-gray-500 italic">No static documents available.</div>
                @endif
                                    
                <!-- <li><a href="#" class="flex items-center text-red-600 hover:underline"><span
                            class="text-red-500 mr-2">📄</span>IPID</a></li>
                <li><a href="#" class="flex items-center text-red-600 hover:underline"><span
                            class="text-red-500 mr-2">📄</span>Policy Wordings</a></li> -->
            </ul>
        </div>

        <!-- Dynamic Policy Documents -->
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <h4 class="font-semibold flex items-center gap-2 mb-3 border-b pb-1">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Dynamic Policy Documents
            </h4>
            <div class="space-x-4">

                @foreach($purchase->insurance->dynamicdocument as $document) 
                    <a href="{{ route('insurance.document.download', ['purchase_id' => $purchase->id, 'document_id' => $document->id]) }}" target="_blank" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-2 rounded space-x-1">
                        <x-heroicon-o-document-text class="h-6 w-6 text-white inline" />

                        <span>{{ $document->title ?? ''}}</span>
                    </a>
                @endforeach

                <!-- <a href="#" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">📄
                    Policy Schedule</a>
                <a href="#" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">📄
                    Test</a> -->
            </div>
        </div>

        <!-- Invoice -->
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <h4 class="font-semibold flex items-center gap-2 mb-3 border-b pb-1">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Invoice
            </h4>
            <a href="{{route('insurance.invoice.genarate',$purchase->id)}}" target="_blank"
                                        class="inline-flex items-center gap-2 text-blue-600 hover:underline hover:text-blue-800 transition">
                <x-heroicon-o-document-text class="h-6 w-6 text-red-600" />
                    Click here to download Invoice
            </a>

            <!-- <a href="#" class="inline-flex items-center text-red-600 hover:underline"><span
                    class="text-red-500 mr-2">📄</span>Click here to download Invoice</a> -->
        </div>

    </div>
</x-front>