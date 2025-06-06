<div>
     <!-- Dashboard Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Policies Sold -->
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                            <!-- Document Duplicate Icon -->
                            <x-heroicon-o-document-duplicate class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-lg font-bold">{{ $this->policySold() }}</div>
                            <div class="text-sm text-gray-500">Policies Sold</div>
                        </div>
                    </div>
                </div>

                <!-- Premium Collected -->
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-100 text-green-600 p-3 rounded-full">
                            <!-- Banknotes Icon -->
                            <x-heroicon-o-banknotes class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-lg font-bold">£{{$this->paidPurchaseAmount}}</div>
                            <div class="text-sm text-gray-500">Premium Collected</div>
                        </div>
                    </div>
                </div>

                <!-- Pending Claims -->
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                            <!-- Exclamation Circle Icon -->
                            <x-heroicon-o-exclamation-circle class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-lg font-bold">{{$this->unPaidPurchase}}</div>
                            <div class="text-sm text-gray-500">Pending Claims</div>
                        </div>
                    </div>
                </div>

                <!-- Total Clients -->
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                            <!-- Users Icon -->
                            <x-heroicon-o-users class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-lg font-bold">{{$this->totalClient}}</div>
                            <div class="text-sm text-gray-500">Total Clients</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Welcome Box -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-10">
                <div class="flex flex-col  justify-start w-full p-6 bg-white rounded-lg border">
                    <div class="flex items-end justify-between w-full">
                        <!-- Left Side -->
                        <div>
                            <h2 class="text-xl font-bold">Purchased Insurances</h2>
                            <!-- <span class="text-sm font-semibold text-gray-500">2025</span> -->
                        </div>

                        <!-- Right Side (Legend) -->
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <span class="block w-4 h-4 bg-indigo-400"></span>
                                <span class="ml-1 text-xs font-medium">Temple</span>
                            </div>
                            <div class="flex items-center">
                                <span class="block w-4 h-4 bg-indigo-300"></span>
                                <span class="ml-1 text-xs font-medium">RSA</span>
                            </div>
                            <div class="flex items-center">
                                <span class="block w-4 h-4 bg-indigo-200"></span>
                                <span class="ml-1 text-xs font-medium">Others</span>
                            </div>
                        </div>
                    </div>
 
                    <div class="flex items-end flex-grow w-full mt-2 space-x-2 sm:space-x-3">
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£37,500</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-6 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-16 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Jan</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£45,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-6 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-20 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Feb</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£47,500</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-20 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Mar</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£50,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-6 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-24 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Apr</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£47,500</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-20 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">May</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£55,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-24 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Jun</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£60,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-16 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-20 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Jul</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£57,500</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-24 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Aug</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£67,500</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-32 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Sep</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£65,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow bg-indigo-400 h-28"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Oct</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£70,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-40 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Nov</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">£75,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-40 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Dec</span>
                        </div>
                    </div>

                </div>

                <div class="flex flex-col w-full p-6 bg-white rounded-lg border">
                    <h2 class="text-xl font-bold text-start">Revenue </h2>
                    <!-- <span class="text-sm font-semibold text-gray-500">2025</span> -->
                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>

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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Payble Amount
                        </th>
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Landlord/Agency Address
                        </th>
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Days Inspected
                        </th>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $row->insurance->payable_amount ?? '' }}
                        </td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $row->policy_holder_address }}
                        </td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                        </td>
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

            <h2 class="text-xl font-semibold mb-4 text-gray-800">Check Payment</h2>

            <div>
                
                <label for="checkPayment" class="block text-gray-700"><span
                                    class="text-red-600 text-xl">*</span>Payment Method:</label>
               
                @error('checkPayment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <button wire:click="closePaymentCheckModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Close</button>
                <button wire:click="submitResendInvoice" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Submit</button>
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
