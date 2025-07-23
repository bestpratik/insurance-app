<div class="mt-5">
   
    <div class="bg-white rounded-lg p-6 shadow overflow-hidden">
         <h4 class="text-xl font-bold text-start">Policy sold in 7 days</h4>
        <div class="sm:w-64 my-3">
            <label for="storeFilter" class="text-sm font-medium text-gray-700 mb-1">Per Page</label>
            <select wire:model.live="perPage" class="pbg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 inline min-w-[60px] py-1">
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sl No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Policy No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Insurance
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Insurance Price
                        </th>
                        {{--<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Payble Amount
                        </th>--}}
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Providers
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Policy Term
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Property
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rent Amount
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Landlord/Agency
                        </th>
                        {{--<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Landlord/Agency Address
                        </th>--}}
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Landlord/Agency Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Policy Start Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Policy End Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            AST Start Date
                        </th>
                        {{--<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Days Inspected
                        </th>--}}
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Purchase Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Purchased By
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Invoice No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Payment Method
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                            @if($row->insurance)
                                {{ $row->insurance->name }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($row->insurance)
                                {{ $row->insurance->total_premium }}
                            @endif
                        </td>
                        {{--<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $row->insurance->payable_amount ?? '' }}
                        </td>--}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($row->insurance && $row->insurance->provider)
                                {{ $row->insurance->provider->name }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $row->policy_term }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $row->door_no.' '.$row->address_one.' '.$row->address_two.' '.$row->address_three.' '.$row->post_code }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $row->rent_amount }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($row->policy_holder_type == 'Company')
                                {{ $row->company_name }}
                            @elseif($row->policy_holder_type == 'Individual')
                                {{ $row->policy_holder_title }} {{ $row->policy_holder_fname }} {{ $row->policy_holder_lname }}
                            @else
                                {{ $row->company_name }} <br>
                                {{ $row->policy_holder_title }} {{ $row->policy_holder_fname }} {{ $row->policy_holder_lname }}
                            @endif
                        </td>
                        {{--<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $row->policy_holder_address }}
                        </td>--}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $row->policy_holder_email }}
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
                        {{--<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @php
                                $target_date_one = strtotime($row->purchase_date);
                                $target_date_two = strtotime($row->policy_start_date);
                                $days_incepted = (($target_date_two - $target_date_one) / (60 * 60 * 24));
                            @endphp
                            @if($days_incepted < -5)
                            <span class="text-red-500">{{ $days_incepted }} days</span>
                            @else
                            <span class="text-green-500">{{ $days_incepted }} days</span>
                            @endif
                        </td>--}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('jS F Y', strtotime($row->purchase_date)) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            N/A
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($row->invoice)
                                {{ $row->invoice->invoice_no }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($row->payment_method == 'bank_transfer')
                                Bank Transfer
                            @elseif($row->payment_method == 'pay_later')
                                Pay later
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <!-- <a href="{{route('purchase.edit',$row->policy_no)}}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                                </a> -->
                                <a href="{{route('purchase.details', $row->id)}}" class="text-indigo-600 hover:text-indigo-900" title="Details View">
                                    <x-heroicon-o-eye class="w-5 h-5" />
                                </a>

                                <button wire:click="openPaymentCheckModal({{ $row->id }})" 
                                    class="text-green-600 hover:text-yellow-900 focus:outline-none" 
                                    title="Check Payment">
                                  <x-heroicon-o-check-circle class="w-5 h-5 text-green-600" />
                                </button>
                              

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


        <!-- modal  -->
    @if($showPaymentCheckModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white max-w-lg w-full rounded-lg shadow-lg p-6 relative">
                <button wire:click="closePaymentCheckModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <x-heroicon-o-x-mark class="h-6 w-6 text-gray-500 hover:text-gray-700 border rounded-full p-1" />
                </button>

                <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-3">Check Payment</h2>

                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-2">
                            <label class="block font-semibold mb-2 w-full">Select Payment Method</label>
                            <div class="flex items-center space-x-6">
                                <!-- Pay Later -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="paymentMethod" value="pay_later" wire:model="paymentMethod"
                                        class="peer hidden" />
                                    <div class="w-40 h-24 border-4 rounded-lg border-gray-300 peer-checked:border-blue-500 p-2 flex flex-col items-center justify-center hover:border-blue-400 transition-all duration-200">
                                        <img src="{{asset('paylater.jpg')}}" alt="Pay Later" class="h-20 mb-1" />
                                    </div>
                                </label>

                                <!-- Bank Transfer -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="paymentMethod" value="bank_transfer" wire:model="paymentMethod"
                                        class="peer hidden" />
                                    <div class="w-40 h-24 border-4 rounded-lg border-gray-300 peer-checked:border-blue-500 p-2 flex flex-col items-center justify-center hover:border-blue-400 transition-all duration-200">
                                        <img src="{{asset('bank-transper.jpg')}}" alt="Bank Transfer" class="h-20 mb-1" />
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
                                    <input type="radio" name="paymentStatus" value="1" wire:model="paymentStatus"
                                        class="peer hidden" />
                                    <div class="w-40 h-24 border-4 rounded-lg border-gray-300 peer-checked:border-green-500 bg-green-50 peer-checked:bg-green-100 p-2 flex flex-col items-center justify-center hover:border-green-400 transition-all duration-200">
                                        <svg class="h-8 w-8 text-green-600 mb-1" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-sm font-medium text-center text-green-800">Paid</span>
                                    </div>
                                </label>

                                <!-- Unpaid -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="paymentStatus" value="0" wire:model="paymentStatus"
                                        class="peer hidden" />
                                    <div class="w-40 h-24 border-4 rounded-lg border-gray-300 peer-checked:border-red-500 bg-red-50 peer-checked:bg-red-100 p-2 flex flex-col items-center justify-center hover:border-red-400 transition-all duration-200">
                                        <svg class="h-8 w-8 text-red-600 mb-1" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
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
                        <button wire:click="closePaymentCheckModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Close</button>
                        <button wire:click="submitPaymentCheckModal" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Submit</button>
                    </div>
                </div>
        </div>
    @endif
    <!-- modal  -->

    
</div>

<script>
    Livewire.on('showModal', () => {
        let modal = new bootstrap.Modal(document.getElementById('checkPayment'));
        modal.show();
    });

    Livewire.on('hideModal', () => {
        let modalEl = document.getElementById('checkPayment');
        let modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    });
</script>


