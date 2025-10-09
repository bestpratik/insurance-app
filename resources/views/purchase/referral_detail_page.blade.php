<x-app-layout>
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12">
            @if (session('success'))
            <div class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:text-green-400">
                {{ session('success') }}
            </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 shadow-sm">
                <div class="flex flex-col gap-5 px-6 mb-4 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Referral Form Details View</h3>
                </div>

                <!-- Content Start -->
                <section id="content" class="px-6 pb-6">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                        <!-- Left Column -->
                        <div class="lg:col-span-5 space-y-6">
                            <!-- Policy Information -->
                            <div class="border rounded-lg shadow-sm">
                                <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Policy Information</div>
                                <div class="p-4 text-sm text-gray-700">
                                    <table class="w-full text-sm text-gray-700">
                                        <tr>
                                            <td class="py-1 font-medium">Insurance Name</td>
                                            <td>{{ $referral->insurance->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-1 font-medium">Policy Type</td>
                                            <td>{{ $referral->insurance_type ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-1 font-medium">Policy for</td>
                                            <td>{{ $referral->product_type ?? '' }}</td>
                                        </tr>
                                        @if($referral->insurances_required)
                                        <tr>
                                            <td class="py-1 font-medium">Insurances Required</td>
                                            <td>{{ $referral->insurances_required ?? '' }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <!-- Important Dates -->
                            <div class="border rounded-lg shadow-sm">
                                <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Important Dates</div>
                                <div class="p-4 text-sm text-gray-700">
                                    <table class="w-full text-sm text-gray-700">
                                        <tr>
                                            <td class="py-1 font-medium">Tenancy Term</td>
                                            <td>{{ $referral->tenancy_term ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-1 font-medium">AST Start Date</td>
                                            <td>{{ \Carbon\Carbon::parse($referral->ast_start_date)->format('d M Y') ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-1 font-medium">Policy Start Date</td>
                                            <td>{{ \Carbon\Carbon::parse($referral->policy_start_date)->format('d M Y') ?? '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="lg:col-span-7 space-y-6">
                            <!-- Property Details -->
                            <div class="border rounded-lg shadow-sm">
                                <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Property Details</div>
                                <div class="p-4 text-sm text-gray-700 space-y-2">
                                    <div><span class="font-medium">Address:</span> {{ $referral->door_no }}, {{ $referral->address_one ?? '' }}, {{ $referral->address_two ?? '' }}, {{ $referral->address_three ?? '' }}, {{ $referral->post_code ?? '' }}</div>
                                    <div><span class="font-medium">No of bedrooms:</span> {{ $referral->bedrooms ?? '' }}</div>
                                    <div><span class="font-medium">Rent Amount (£):</span> {{ $referral->rent_amount ?? '' }}</div>
                                    <div><span class="font-medium">LHA Rate (Rent PCM in £):</span> {{ $referral->rent_amount ?? '' }}</div>
                                </div>
                            </div>

                            <!-- Tenant Details -->
                            @if(!empty($referral->tenant_name || $referral->tenant_email || $referral->tenant_phone))
                            <div class="border rounded-lg shadow-sm">
                                <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Tenant Details</div>
                                <div class="p-4 text-sm text-gray-700 space-y-1">
                                    <div><span class="font-medium">Name:</span> {{ $referral->tenant_name ?? '' }}</div>
                                    <div><span class="font-medium">Email:</span> {{ $referral->tenant_email ?? '' }}</div>
                                    <div><span class="font-medium">Contact No:</span> {{ $referral->tenant_phone ?? '' }}</div>
                                </div>
                            </div>
                            @endif

                            <!-- Referral Details -->
                             @if(!empty($referral->referral_name || $referral->referral_email))
                            <div class="border rounded-lg shadow-sm">
                                <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Referral Details</div>
                                <div class="p-4 text-sm text-gray-700 space-y-1">
                                    <div><span class="font-medium">Name:</span> {{ $referral->referral_name ?? '' }}</div>
                                    <div><span class="font-medium">Email:</span> {{ $referral->referral_email ?? '' }}</div>
                                </div>
                            </div>
                            @endif

                            <!-- Policy Holder Details -->
                            <div class="border rounded-lg shadow-sm">
                                <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Policy Holder Details</div>
                                <div class="p-4 text-sm text-gray-700 space-y-1">
                                    <div><span class="font-medium">Insurance Type:</span> {{ $referral->insurance_type ?? '' }}</div>
                                    <div><span class="font-medium">Policy Holder Type:</span> {{ $referral->policy_holder_type ?? '' }}</div>
                                    <div><span class="font-medium">Name:</span> {{ $referral->policy_holder_title ?? '' }} {{ $referral->policy_holder_fname ?? '' }} {{ $referral->policy_holder_lname ?? '' }}</div>
                                    <div><span class="font-medium">Email:</span> {{ $referral->policy_holder_email ?? '' }}</div>
                                    <div><span class="font-medium">Address:</span> {{ $referral->policy_holder_address ?? '' }}</div>
                                    <div><span class="font-medium">Contact No:</span> {{ $referral->policy_holder_phone ?? '' }}</div>
                                    <div><span class="font-medium">Postcode:</span> {{ $referral->policy_holder_postcode ?? '' }}</div>
                                </div>
                            </div>

                            <!-- Council Details -->
                             @if(!empty($referral->council_name || $referral->council_officer_name || $referral->council_officer_email))
                            <div class="border rounded-lg shadow-sm">
                                <div class="bg-gray-800 text-white px-4 py-2 font-semibold">Council Details</div>
                                <div class="p-4 text-sm text-gray-700 space-y-1">
                                    <div><span class="font-medium">Council Name:</span> {{ $referral->council_name ?? '' }}</div>
                                    <div><span class="font-medium">Council Officer Name:</span> {{ $referral->council_officer_name ?? '' }}</div>
                                    <div><span class="font-medium">Email:</span> {{ $referral->council_officer_email ?? '' }}</div>
                                </div>
                            </div>
                            @endif
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
