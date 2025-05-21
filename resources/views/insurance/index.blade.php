<x-app-layout>
    <div class="grid grid-cols-12 gap-4 md:gap-6">

        <div class="col-span-12">
            <!-- Table Four -->
            @if (session('message'))
                <div class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50  dark:text-green-400">
                    {{ session('message') }}
                </div>
            @endif
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 ">
                <div class="flex flex-col gap-5 px-6 mb-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-lg font-semibold  /90">
                            Manage Insurances
                        </h3>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <div>
                            <a href="{{route('insurances.create')}}"
                                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500  dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                                Add
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-full overflow-x-auto custom-scrollbar">
                    <table class="min-w-full">
                        <!-- table header start -->
                        <thead class="border-gray-100 border-y bg-gray-50 ">
                            <tr>
                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex items-center gap-3">
                                            <div>
                                                <span class="block font-medium text-gray-500 text-theme-xs ">
                                                    #
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Name
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Provider Type
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Prefix
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Net Premium
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Commission
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Gross Premium
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            IPT
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Total Premium  
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Payable Amount  
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Action
                                        </p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- table header end -->

                        <!-- table body start -->
                        <tbody class="divide-y divide-gray-100 ">
                            @php
                                $i = 0;
                            @endphp
                        
                           @forelse ($insurances as $row)
                            @php
                                $i++;
                            @endphp
                                <tr>
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">

                                                <div>
                                                    <span class="block font-medium text-gray-700 text-theme-sm ">
                                                        {{$i}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <span class="text-theme-sm mb-0.5 block font-medium text-gray-700 ">
                                                       {{$row->name}}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                     <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <span class="text-theme-sm mb-0.5 block font-medium text-gray-700 ">
                                                       {{$row->provider->name ?? ''}}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                     <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <span class="text-theme-sm mb-0.5 block font-medium text-gray-700 ">
                                                       {{$row->prefix}}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                     <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <span class="text-theme-sm mb-0.5 block font-medium text-gray-700 ">
                                                       {{$row->net_premium}}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                     <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <span class="text-theme-sm mb-0.5 block font-medium text-gray-700 ">
                                                       {{$row->commission}}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                     <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <span class="text-theme-sm mb-0.5 block font-medium text-gray-700 ">
                                                       {{$row->gross_premium}}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                     <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <span class="text-theme-sm mb-0.5 block font-medium text-gray-700 ">
                                                       {{$row->ipt}}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                     <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <span class="text-theme-sm mb-0.5 block font-medium text-gray-700 ">
                                                       {{$row->total_premium}}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                     <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <span class="text-theme-sm mb-0.5 block font-medium text-gray-700 ">
                                                       {{$row->payable_amount}}
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <a href="{{route('insurances.edit', $row->id)}}"
                                                class="cursor-pointer hover:text-blue-500 dark:hover:text-blue-400">
                                                <x-heroicon-o-pencil-square class="w-6 h-6 text-gray-700 " />
                                            </a>
                                            <form action="{{ route('insurances.destroy', $row->id) }}"
                                                    method="POST" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button title="Delete" class="btn btn-flat btn-sm btn-danger rounded"
                                                        type="submit"><i class="fas fa-trash-alt me-1"></i>Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                          @empty
                                <tr>
                                    <td colspan="9" class="text-center px-6 py-4 text-gray-500 ">
                                        No data found.
                                    </td>
                                </tr>
                        @endforelse


                        </tbody>
                        <!-- table body end -->
                    </table>
                </div>
            </div>
            <!-- Table Four -->
        </div>
        </div>
</x-app-layout>
<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this data ?');
    }
</script>