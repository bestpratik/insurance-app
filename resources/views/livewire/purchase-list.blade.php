<div class="p-4">
    <!-- Filter Section -->
    <div class="flex flex-wrap justify-between items-center mb-4 gap-4">
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Policy No</label>
            <input type="text" wire:model.live="policyNo" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Insurance</label>
            <input type="text" wire:model.live="insuranceName" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Property</label>
            <input type="text" wire:model.live="propertyAddress" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Rent Amount</label>
            <input type="number" wire:model.live="rentAmount" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Landlord/Agency</label>
            <input type="text" wire:model.live="landlordAgency" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        {{-- <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Landlord/Agency Address</label>
            <input type="text" wire:model.live="landlordagencyAddress" placeholder="Search..." class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div> --}}
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Landlord/Agency Email</label>
            <input type="text" wire:model.live="landlordagencyEmail" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Policy Start Date</label>
            <input type="date" wire:model.live="policyStartdate" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Policy End Date</label>
            <input type="date" wire:model.live="policyEnddate" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">AST Start Date</label>
            <input type="date" wire:model.live="astStartdate" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Purchase Date</label>
            <input type="date" wire:model.live="purchaseDate" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Tenant Name</label>
            <input type="text" wire:model.live="tenantName" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Tenant Email</label>
            <input type="text" wire:model.live="tenantEmail" placeholder="Search..."
                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
        </div>

    </div>



    <!-- Loader -->
    <div wire:loading class="absolute right-3 top-[42px] transform -translate-y-1/2">
        <svg class="animate-spin h-5 w-5 text-brand-500" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
            </circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
    </div>

    <hr>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="sm:w-64">
            <label for="storeFilter" class="block text-sm font-medium text-gray-700 mb-1">Per Page</label>
            <select wire:model.live="perPage">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sl No
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Policy No
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Insurance
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Insurance Price
                        </th>
                        {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Payble Amount
                        </th> --}}
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Providers
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Policy Term
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Property
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rent Amount
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Landlord/Agency
                        </th>
                        {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Landlord/Agency Address
                        </th> --}}
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Landlord/Agency Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Policy Start Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Policy End Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            AST Start Date
                        </th>
                        {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Days Inspected
                        </th> --}}
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Purchase Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Purchased By
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Invoice No
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Purchase Mode
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($result as $row)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $row->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $row->policy_no ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($row->insurance)
                                    {{ $row->insurance->name }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($row->insurance)
                                    {{ $row->insurance->total_premium }}
                                @endif
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $row->insurance->payable_amount ?? '' }}
                        </td> --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($row->insurance && $row->insurance->provider)
                                    {{ $row->insurance->provider->name }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $row->policy_term }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $row->door_no . ' ' . $row->address_one . ' ' . $row->address_two . ' ' . $row->address_three . ' ' . $row->post_code }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $row->rent_amount }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($row->policy_holder_type == 'Company')
                                    {{ $row->company_name }}
                                @elseif($row->policy_holder_type == 'Individual')
                                    {{ $row->policy_holder_title }} {{ $row->policy_holder_fname }}
                                    {{ $row->policy_holder_lname }}
                                @else
                                    {{ $row->company_name }} <br>
                                    {{ $row->policy_holder_title }} {{ $row->policy_holder_fname }}
                                    {{ $row->policy_holder_lname }}
                                @endif
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $row->policy_holder_address }}
                        </td> --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if (!empty($row->policy_holder_email))
                                    {{ $row->policy_holder_email }}
                                @else
                                    {{ $row->policy_holder_company_email }}
                                @endif

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ date('jS F Y', strtotime($row->policy_start_date)) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ date('jS F Y', strtotime($row->policy_end_date)) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ date('jS F Y', strtotime($row->ast_start_date)) }}
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @php
                            $target_date_one = strtotime($row->purchase_date);
                            $target_date_two = strtotime($row->policy_start_date);
                            $days_incepted = (($target_date_two - $target_date_one) / (60 * 60 * 24));
                            @endphp
                            @if ($days_incepted < -5)
                                <span class="text-red-500">{{ $days_incepted }} days</span>
                                @else
                                <span class="text-green-500">{{ $days_incepted }} days</span>
                                @endif
                        </td> --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ date('jS F Y', strtotime($row->purchase_date)) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                N/A
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($row->invoice)
                                    {{ $row->invoice->invoice_no }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $row->insurance->purchase_mode }}
                            </td>

                            {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <a href="{{route('purchase.edit',$row->policy_no)}}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                                </a>
                                <a href="{{route('purchase.details', $row->id)}}" class="text-indigo-600 hover:text-indigo-900" title="Details View">
                                    <x-heroicon-o-eye class="w-5 h-5" />
                                </a>

                                <button wire:click="openResendModal({{ $row->id }})"
                                    @if (in_array($row->id, $sendMail)) disabled @endif
                                    class="text-green-600 hover:text-yellow-900 focus:outline-none"
                                    title="Resend Documents">
                                    <x-heroicon-o-arrow-path class="w-5 h-5" />
                                </button>

                                <button wire:click="openResendInvoiceModal({{ $row->id }})"
                                    @if (in_array($row->id, $sendMail)) disabled @endif
                                    class="text-green-600 hover:text-yellow-900 focus:outline-none"
                                    title="Resend Invoice">
                                    <x-heroicon-o-paper-airplane class="w-5 h-5 text-blue-600" />
                                </button>

                                <button wire:click="openReminderModal({{ $row->id }})"
                                    class="text-yellow-600 hover:text-yellow-900 focus:outline-none"
                                    title="Send Reminder">
                                    <x-heroicon-o-bell class="w-5 h-5" />
                                </button>

                                <a href="{{route('insurance.invoice.genarate',$row->id)}}" target="_blank" title="Download Invoice">
                                    <x-heroicon-o-arrow-down-tray class="w-5 h-5" />
                                </a>

                                <a href="{{ route('purchase.renewal.overview', $row->id) }}"
                                    title="Policy Renewal"
                                    class="text-green-600 hover:text-green-800">
                                        <x-heroicon-o-calendar-days class="w-5 h-5" />
                                </a>

                                <button wire:click="openPaymentCheckModal({{ $row->id }})"
                                    class="text-green-600 hover:text-yellow-900 focus:outline-none" 
                                    title="Check Payment">
                                    <x-heroicon-o-check-circle class="w-5 h-5 text-green-600" />
                                </button>

                                <button wire:click="openCancelModal({{ $row->id }})"
                                    @if (in_array($row->id, $cancelledPurchases)) disabled @endif
                                    class="text-red-600 hover:text-red-900 focus:outline-none"
                                    title="Cancel Purchase">
                                    <x-heroicon-o-x-mark class="w-5 h-5" /> 
                                </button>


                            </div>
                        </td> --}}

                        @php
                            $policyEndDate = \Carbon\Carbon::parse($row->policy_end_date);
                            $today = \Carbon\Carbon::today();

                            $daysUntilExpiry = $today->diffInDays($policyEndDate, false);
                        @endphp

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="relative flex justify-center action-menu-wrapper">

                                    <details class="action-menu relative">

                                        <summary
                                            class="list-none cursor-pointer flex items-center justify-center
                       w-9 h-9 rounded-lg border border-gray-200
                       bg-white text-gray-600
                       hover:bg-gray-50 hover:text-gray-900
                       transition focus:outline-none">

                                            <x-heroicon-o-ellipsis-vertical class="w-5 h-5" />
                                        </summary>

                                        <!-- Action Menu -->
                                        <div
                                            class="action-dropdown absolute right-0 top-11 z-[9999]
                        w-56 rounded-xl border border-gray-200
                        bg-white shadow-xl p-2">

                                            <!-- Edit -->
                                            <a href="{{ route('purchase.edit', $row->policy_no) }}"
                                                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg
                          text-sm text-gray-700 hover:bg-gray-50 transition">
                                                <x-heroicon-o-pencil-square class="w-5 h-5 text-indigo-600" />
                                                <span>Edit</span>
                                            </a>

                                            <!-- Details -->
                                            <a href="{{ route('purchase.details', $row->id) }}"
                                                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg
                          text-sm text-gray-700 hover:bg-gray-50 transition">
                                                <x-heroicon-o-eye class="w-5 h-5 text-indigo-600" />
                                                <span>Details</span>
                                            </a>

                                            <!-- Resend Documents -->
                                            <button wire:click="openResendModal({{ $row->id }})"
                                                @if (in_array($row->id, $sendMail)) disabled @endif
                                                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg
                           text-sm text-gray-700 hover:bg-gray-50 transition
                           disabled:opacity-50 disabled:cursor-not-allowed">
                                                <x-heroicon-o-arrow-path class="w-5 h-5 text-green-600" />
                                                <span>Resend Documents</span>
                                            </button>

                                            <!-- Resend Invoice -->
                                            <button wire:click="openResendInvoiceModal({{ $row->id }})"
                                                @if (in_array($row->id, $sendMail)) disabled @endif
                                                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg
                           text-sm text-gray-700 hover:bg-gray-50 transition
                           disabled:opacity-50 disabled:cursor-not-allowed">
                                                <x-heroicon-o-paper-airplane class="w-5 h-5 text-blue-600" />
                                                <span>Resend Invoice</span>
                                            </button>

                                            @if($daysUntilExpiry >= 0 && $daysUntilExpiry < 60)
                                            <!-- Send Reminder -->
                                            <button wire:click="openReminderModal({{ $row->id }})"
                                                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg
                           text-sm text-gray-700 hover:bg-gray-50 transition">
                                                <x-heroicon-o-bell class="w-5 h-5 text-yellow-600" />
                                                <span>Renewal Reminder</span>
                                            </button>
                                            @endif

                                            <!-- Download Invoice -->
                                            <a href="{{ route('insurance.invoice.genarate', $row->id) }}"
                                                target="_blank"
                                                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg
                          text-sm text-gray-700 hover:bg-gray-50 transition">
                                                <x-heroicon-o-arrow-down-tray class="w-5 h-5 text-gray-600" />
                                                <span>Download Invoice</span>
                                            </a>

                                            @if($daysUntilExpiry >= 0 && $daysUntilExpiry < 60)
                                            <!-- Policy Renewal -->
                                            <a href="{{ route('purchase.renewal.overview', $row->id) }}"
                                                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg
                          text-sm text-gray-700 hover:bg-gray-50 transition">
                                                <x-heroicon-o-calendar-days class="w-5 h-5 text-green-600" />
                                                <span>Policy Renewal</span>
                                            </a>
                                            @endif

                                            <!-- Check Payment -->
                                            <button wire:click="openPaymentCheckModal({{ $row->id }})"
                                                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg
                           text-sm text-gray-700 hover:bg-gray-50 transition">
                                                <x-heroicon-o-check-circle class="w-5 h-5 text-green-600" />
                                                <span>Payment Status</span>
                                            </button>

                                            <!-- Cancel Purchase -->
                                            <button wire:click="openCancelModal({{ $row->id }})"
                                                @if (in_array($row->id, $cancelledPurchases)) disabled @endif
                                                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg
                                                    text-sm text-red-600 hover:bg-red-50 transition
                                                    disabled:opacity-50 disabled:cursor-not-allowed">
                                                <x-heroicon-o-x-mark class="w-5 h-5 text-red-600" />
                                                <span>Cancel Purchase</span>
                                            </button>

                                        </div>
                                    </details>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="21" class="px-6 py-4 text-center text-sm text-gray-500">
                                No data found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 sm:px-6">
            {{ $result->links() }}
        </div>
    </div>




    <!--Cancel modal start-->
    @if ($showCancelModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white max-w-lg w-full rounded-lg shadow-lg p-6 relative">
                <button wire:click="closeCancelModal"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <x-heroicon-o-x-mark class="h-6 w-6 text-gray-500 hover:text-gray-700 border rounded-full p-1" />
                </button>

                <h2 class="text-xl font-semibold mb-4 text-gray-800">Cancel Request</h2>

                <div>
                    <label for="cancelReason" class="block text-gray-700 mb-2"><span
                            class="text-red-600 text-xl">*</span>Reason for cancellation:</label>
                    <textarea wire:model="cancelReason" id="cancelReason"
                        class="w-full h-28 border rounded p-2 text-gray-700 focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter your reason..."></textarea>
                    @error('cancelReason')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <button wire:click="closeCancelModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Close</button>
                    <button wire:click="submitCancellation"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Confirm Cancel</button>
                </div>
            </div>
        </div>
    @endif

    <!--Cancel modal end-->


    <!--Resend modal start-->
    @if ($showResendDocumentModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white max-w-lg w-full rounded-lg shadow-lg p-6 relative">
                <button wire:click="closeResendModal"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <x-heroicon-o-x-mark class="h-6 w-6 text-gray-500 hover:text-gray-700 border rounded-full p-1" />
                </button>

                <h2 class="text-xl font-semibold mb-4 text-gray-800">Resend Documents</h2>

                <div>

                    <label for="resendDocument" class="block text-gray-700"><span
                            class="text-red-600 text-xl">*</span>Emails:</label>
                    <p class="block text-gray-700 mb-2 text-sm">(Please enter the email addresses, separated by commas)
                    </p>
                    <textarea wire:model="resendDocument" id="resendDocument"
                        class="w-full h-28 border rounded p-2 text-gray-700 focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter your email..."></textarea>
                    @error('resendDocument')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <button wire:click="closeResendModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Close</button>
                    <button wire:click="submitResendingDoc"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Submit</button>
                </div>
            </div>
        </div>
    @endif
    <!--Resend modal end-->


    <!--Resend Invoice modal start-->
    @if ($showResendInvoiceModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white max-w-lg w-full rounded-lg shadow-lg p-6 relative">
                <button wire:click="closeResendInvoiceModal"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <x-heroicon-o-x-mark class="h-6 w-6 text-gray-500 hover:text-gray-700 border rounded-full p-1" />
                </button>

                <h2 class="text-xl font-semibold mb-4 text-gray-800">Resend Invoice</h2>

                <div>

                    <label for="resendInvoice" class="block text-gray-700"><span
                            class="text-red-600 text-xl">*</span>Emails:</label>
                    <p class="block text-gray-700 mb-2 text-sm">(Please enter the email addresses, separated by commas)
                    </p>
                    <textarea wire:model="resendInvoice" id="resendInvoice"
                        class="w-full h-28 border rounded p-2 text-gray-700 focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter your email..."></textarea>
                    @error('resendInvoice')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <button wire:click="closeResendInvoiceModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Close</button>
                    <button wire:click="submitResendInvoice"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Submit</button>
                </div>
            </div>
        </div>
    @endif
    <!--Resend Invoice modal end-->

    <!--Reminder modal start-->
    @if ($showReminderModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4 py-8">
            <div
                class="w-full max-w-xl rounded-3xl bg-white shadow-2xl shadow-slate-900/10 ring-1 ring-slate-200 overflow-hidden">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Reminder Email
                                Notification</p>
                            <h2 class="mt-2 text-2xl font-semibold text-slate-900">Send reminder</h2>
                            <p class="mt-2 text-sm leading-6 text-slate-600">The recipients below will be notified. Add
                                extra email addresses if needed.</p>
                        </div>
                        <button wire:click="closeReminderModal"
                            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                            <x-heroicon-o-x-mark class="h-5 w-5" />
                        </button>
                    </div>
                </div>

                <div class="px-6 py-6">
                    <div class="mb-5 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-medium text-slate-700">Recipients</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @if (!empty($reminderRecipients))
                                @foreach ($reminderRecipients as $recipient)
                                    <span
                                        class="inline-flex items-center rounded-full bg-slate-900/5 px-4 py-2 text-sm text-slate-700">{{ $recipient }}</span>
                                @endforeach
                            @else
                                <span class="text-sm text-slate-500">No recipients available.</span>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label for="reminderEmailList" class="block text-sm font-medium text-slate-700">Add additional
                            email(s) to notify separated by comma</label>
                        <input wire:model="reminderEmailList" id="reminderEmailList" type="text"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20"
                            placeholder="example1@mail.com, example2@mail.com" />
                        @error('reminderEmailList')
                            <p class="text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                        <button wire:click="closeReminderModal"
                            class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Close</button>
                        <button wire:click="submitReminder"
                            class="inline-flex items-center justify-center rounded-2xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-sky-600/20 transition hover:bg-sky-700">Send
                            Reminder</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--Reminder modal end-->


    <!-- modal  -->
    @if ($showPaymentCheckModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white max-w-lg w-full rounded-lg shadow-lg p-6 relative">
                <button wire:click="closePaymentCheckModal"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <x-heroicon-o-x-mark class="h-6 w-6 text-gray-500 hover:text-gray-700 border rounded-full p-1" />
                </button>

                <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-3">Check Payment</h2>

                <div>
                    <div class="">
                        <div class="mb-2">
                            <label class="block font-semibold mb-2 w-full">Select Payment Method</label>
                            <div class="flex items-center space-x-3">
                                <!-- Pay Later -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="paymentMethod" value="pay_later"
                                        wire:model="paymentMethod" class="peer hidden"
                                        {{ $paymentMethod == 'pay_later' ? 'checked' : '' }} />
                                    <div
                                        class="w-36 h-24 border-4 rounded-lg border-gray-300 peer-checked:border-blue-500 p-2 flex flex-col items-center justify-center hover:border-blue-400 transition-all duration-200">
                                        <img src="{{ asset('paylater.jpg') }}" alt="Pay Later" class="h-20 mb-1" />
                                    </div>
                                </label>

                                <!-- Bank Transfer -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="paymentMethod" value="bank_transfer"
                                        wire:model="paymentMethod" class="peer hidden"
                                        {{ $paymentMethod == 'bank_transfer' ? 'checked' : '' }} />
                                    <div
                                        class="w-36 h-24 border-4 rounded-lg border-gray-300 peer-checked:border-blue-500 p-2 flex flex-col items-center justify-center hover:border-blue-400 transition-all duration-200">
                                        <img src="{{ asset('bank-transper.jpg') }}" alt="Bank Transfer"
                                            class="h-20 mb-1" />
                                    </div>
                                </label>

                                <!-- Stripe -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="paymentMethod" value="stripe"
                                        wire:model="paymentMethod" class="peer hidden"
                                        {{ $paymentMethod == 'stripe' ? 'checked' : '' }} />
                                    <div
                                        class="w-36 h-24 border-4 rounded-lg border-gray-300 peer-checked:border-blue-500 p-2 flex flex-col items-center justify-center hover:border-blue-400 transition-all duration-200">
                                        <img src="{{ asset('Stripe_Logo,_revised_2016.svg.png') }}" alt="Stripe"
                                            class="h-10 mb-1" />

                                    </div>
                                </label>

                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="mb-2">
                            <label class="block font-semibold mb-2">Payment Status</label>
                            <div class="flex items-center space-x-6">
                                <!-- Paid -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="paymentStatus" value="Paid"
                                        wire:model="paymentStatus" class="peer hidden"
                                        {{ $paymentStatus == 'Paid' ? 'checked' : '' }} />
                                    <div
                                        class="w-40 h-24 border-4 rounded-lg border-gray-300 peer-checked:border-green-500 bg-green-50 peer-checked:bg-green-100 p-2 flex flex-col items-center justify-center hover:border-green-400 transition-all duration-200">
                                        <svg class="h-8 w-8 text-green-600 mb-1" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-sm font-medium text-center text-green-800">Paid</span>
                                    </div>
                                </label>

                                <!-- Unpaid -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="paymentStatus" value="Pending"
                                        wire:model="paymentStatus" class="peer hidden"
                                        {{ $paymentStatus == 'Pending' ? 'checked' : '' }} />
                                    <div
                                        class="w-40 h-24 border-4 rounded-lg border-gray-300 peer-checked:border-red-500 bg-red-50 peer-checked:bg-red-100 p-2 flex flex-col items-center justify-center hover:border-red-400 transition-all duration-200">
                                        <svg class="h-8 w-8 text-red-600 mb-1" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <span class="text-sm font-medium text-center text-red-800">Unpaid</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="mt-6 flex justify-end space-x-4">
                        <button wire:click="closePaymentCheckModal"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Close</button>
                        <button wire:click="submitPaymentCheckModal"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Submit</button>
                    </div>
                </div>
            </div>
    @endif
    <!-- modal  -->



</div>
