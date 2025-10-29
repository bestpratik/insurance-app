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
                            Manage Contact Information List
                        </h3>
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
                                                    Sl no.
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
                                            Phone
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Email
                                        </p>
                                    </div>
                                </th>

                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Comment
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

                            @forelse ($contactform_list as $row)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">

                                                <div>
                                                    <span class="block font-medium text-gray-700 text-theme-sm ">
                                                        {{ $i }}
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
                                                        {{ $row->name }}
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
                                                        {{ $row->phone }}
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
                                                        {{ $row->email }}
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
                                                        {!! \Illuminate\Support\Str::limit(strip_tags($row->comment), 30) !!}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <form action="{{ route('contactform.delete', $row->id) }}" method="POST"
                                                onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Delete"
                                                    class="ml-3 cursor-pointer hover:text-red-500 dark:hover:text-red-400">
                                                    <x-heroicon-o-trash class="w-6 h-6 text-gray-700" />
                                                </button>
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
