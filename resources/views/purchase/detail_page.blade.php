<x-app-layout>
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12">
            @if (session('success'))
            <div class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:text-green-400">
                {{ session('success') }}
            </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4">
                <div class="flex flex-col gap-5 px-6 mb-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">View Purchase Details</h3>
                    </div>
                </div>

                <!-- Content Start -->
                <section id="content" class="px-6 pb-6">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                        <!-- Left Column -->
                        <div class="lg:col-span-5 space-y-6">
                            <div>
                                <h2 class="text-lg font-semibold">Policy Information</h2>
                                <hr class="my-2 border-gray-300">
                                <table class="w-full text-sm text-gray-700">
                                    <tr>
                                        <td class="py-1 font-medium">Insurance Name</td>
                                        <td>{{ $purchase->insurance->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 font-medium">Policy Number</td>
                                        <td>{{ $purchase->policy_no ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 font-medium">Purchased By</td>
                                        <td>{{ auth()->user()->name ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div>
                                <h2 class="text-lg font-semibold">Important Dates</h2>
                                <hr class="my-2 border-gray-300">
                                <table class="w-full text-sm text-gray-700">
                                    <tr>
                                        <td class="py-1 font-medium">Purchase Date</td>
                                        <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="lg:col-span-7 space-y-6">
                            <!-- Payment Summary -->
                            <div>
                                <h3 class="text-lg font-semibold">Payment Summary</h3>
                                <table class="w-full text-sm border border-gray-300 rounded-lg overflow-hidden">
                                    <thead class="bg-gray-800 text-white">
                                        <tr>
                                            <th class="px-3 py-2 text-left">Policy Start Date</th>
                                            <th class="px-3 py-2 text-left">Policy End Date</th>
                                            <th class="px-3 py-2 text-left">AST Start Date</th>
                                            <th class="px-3 py-2 text-left">Purchase Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white">
                                            <td class="px-3 py-2">{{ \Carbon\Carbon::parse($purchase->policy_start_date)->format('d M Y') }}</td>
                                            <td class="px-3 py-2">{{ \Carbon\Carbon::parse($purchase->policy_end_date)->format('d M Y') }}</td>
                                            <td class="px-3 py-2">{{ \Carbon\Carbon::parse($purchase->ast_start_date)->format('d M Y') }}</td>
                                            <td class="px-3 py-2">{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Landlord/Agency -->
                                <div>
                                    <div class="border rounded-lg">
                                        <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Landlord/Agency Details</div>
                                        <div class="p-4 text-sm text-gray-700">
                                            <!-- Add content if needed -->
                                            <!-- <span class="text-gray-500 italic">No details provided</span> -->
                                            @if($purchase->policy_holder_type == 'Company')
                                                {{ $purchase->company_name ?? '' }}
                                            @elseif($purchase->policy_holder_type == 'Individual')
                                                {{ $purchase->policy_holder_title ?? '' }} {{ $purchase->policy_holder_fname ?? '' }} {{ $purchase->policy_holder_lname ?? '' }}
                                            @else
                                                {{ $purchase->company_name ?? '' }} <br>
                                                {{ $purchase->policy_holder_title ?? '' }} {{ $purchase->policy_holder_fname ?? '' }} {{ $purchase->policy_holder_lname ?? '' }}
                                            @endif
                                            </br>

                                            {{ $purchase->policy_holder_address ?? '' }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Property Details -->
                                <div class="space-y-4">
                                    <div class="border rounded-lg">
                                        <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Property Details</div>
                                        <div class="p-4 text-sm text-gray-700">
                                            {{ $purchase->door_no }}, {{ $purchase->address_one ?? '' }}, {{ $purchase->address_two ?? '' }}, {{ $purchase->address_three ?? '' }}, {{ $purchase->post_code ?? '' }}
                                        </div>
                                    </div>

                                    <div class="border rounded-lg">
                                        <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Tenant Details</div>
                                        <div class="p-4 text-sm text-gray-700 space-y-1">
                                            <div>{{ $purchase->tenant_name ?? '' }}</div>
                                            <div>{{ $purchase->tenant_email ?? '' }}</div>
                                            <div>{{ $purchase->tenant_phone ?? '' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Billing Department -->
                            <div class="border rounded-lg">
                                <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Billing Details</div>
                                <table class="w-full text-sm text-gray-700">
                                    <thead class="bg-gray-100 text-left">
                                        <tr>
                                            <th class="p-2">Billing Name</th>
                                            <th class="p-2">Billing Email</th>
                                            <th class="p-2">Billing Phone</th>
                                            <th class="p-2">Billing Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="p-2">{{ $purchase->invoice->billing_name ?? '' }}</td>
                                            <td class="p-2">{{ $purchase->invoice->billing_email ?? '' }}</td>
                                            <td class="p-2">{{ $purchase->invoice->billing_phone ?? '' }}</td>
                                            <td class="p-2">
                                                {{ $purchase->invoice->billing_address_one ?? '' }},
                                                {{ $purchase->invoice->billing_address_two ?? '' }},
                                                {{ $purchase->invoice->billing_postcode ?? '' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Static Policy Documents -->
                            <div class="border rounded-lg">
                                <div class="px-4 py-2 font-semibold">Static Policy Documents</div>
                                <div class="p-4 space-y-2 text-sm">
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
                                </div>
                            </div>

                            <!-- Dynamic Policy Documents -->
                            <div class="border rounded-lg">
                                <div class="px-4 py-2 font-semibold">Dynamic Policy Documents</div>
                                <div class="p-4 space-x-2">
                                    @foreach($purchase->insurance->dynamicdocument as $document) 
                                    <a href="{{ route('insurance.document.download', ['purchase_id' => $purchase->id, 'document_id' => $document->id]) }}"
                                        target="_blank"
                                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-2 rounded space-x-1">
                                        <x-heroicon-o-document-text class="h-6 w-6 text-white inline" />

                                        <span>{{ $document->title ?? ''}}</span>
                                    </a>
                                    @endforeach
                                </div>

                            </div>

                            <!-- Invoice -->
                            <div class="">
                                <h4 class="text-md font-semibold mb-2">Invoice</h4>
                                <div class="p-4 border border-gray-200 rounded-lg  text-center inline-block">
                                    <a href="{{route('insurance.invoice.genarate',$purchase->id)}}" target="_blank"
                                        class="inline-flex items-center gap-2 text-blue-600 hover:underline hover:text-blue-800 transition">
                                        <x-heroicon-o-document-text class="h-6 w-6 text-red-600" />
                                        Click here to download Invoice
                                    </a>
                                </div>
                            </div>
                        </div>
                </section>
                <!-- Content End -->
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this data?');
    }
</script>