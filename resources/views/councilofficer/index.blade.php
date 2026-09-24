<x-app-layout>

    <div class="grid grid-cols-12 gap-4 md:gap-6">

        <div class="col-span-12">

            {{-- Success Message --}}
            @if (session('success'))
                <div
                    class="mb-5 flex items-center gap-3 rounded-xl
                            border border-green-200 bg-green-50
                            px-4 py-3 text-sm font-medium text-green-700">

                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center
                                rounded-full bg-green-100">
                        <x-heroicon-o-check class="h-5 w-5 text-green-600" />
                    </div>

                    <span>{{ session('success') }}</span>
                </div>
            @endif


            {{-- Main Card --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                {{-- Header --}}
                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        {{-- Title --}}
                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center
                                        rounded-xl bg-blue-50">

                                <x-heroicon-o-users class="h-6 w-6 text-[#112695]" />

                            </div>

                            <div>

                                <h3 class="text-lg font-semibold text-gray-900">
                                    Manage Council Officers
                                </h3>

                                <p class="mt-0.5 text-sm text-gray-500">
                                    Manage council officers and their account information.
                                </p>

                            </div>

                        </div>


                        {{-- Add Button --}}
                        <a href="{{ route('council-officers.create') }}"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-xl bg-[#112695] px-5 py-2.5
                                   text-sm font-semibold text-white
                                   shadow-sm transition
                                   hover:bg-[#0d1d78]
                                   focus:outline-none
                                   focus:ring-2 focus:ring-[#112695]/30">

                            <x-heroicon-o-user-plus class="h-5 w-5" />

                            Add Officer

                        </a>

                    </div>

                </div>


                {{-- Summary --}}
                <div class="border-b border-gray-100 bg-gray-50/60 px-6 py-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-9 w-9 items-center justify-center
                                    rounded-lg border border-gray-200 bg-white">

                            <x-heroicon-o-users class="h-5 w-5 text-gray-500" />

                        </div>

                        <div>

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Total Officers
                            </p>

                            <p class="text-lg font-semibold text-gray-800">
                                {{ $CouncilOfficers->count() }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Table --}}
                <div class="max-w-full overflow-x-auto custom-scrollbar">

                    <table class="min-w-full">

                        {{-- Header --}}
                        <thead class="border-b border-gray-100 bg-gray-50">

                            <tr>

                                <th class="w-16 px-6 py-4 text-left">
                                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        #
                                    </span>
                                </th>

                                <th class="px-6 py-4 text-left">
                                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Officer
                                    </span>
                                </th>

                                <th class="px-6 py-4 text-left">
                                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Council
                                    </span>
                                </th>

                                <th class="px-6 py-4 text-left">
                                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Email Address
                                    </span>
                                </th>

                                <th class="w-28 px-4 py-4 text-center">
                                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Actions
                                    </span>
                                </th>

                            </tr>

                        </thead>


                        {{-- Body --}}
                        <tbody class="divide-y divide-gray-100">

                            @forelse ($CouncilOfficers as $index => $row)
                                <tr class="group transition hover:bg-gray-50/70">

                                    {{-- Number --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <span
                                            class="flex h-8 w-8 items-center justify-center
                                                     rounded-lg bg-gray-100
                                                     text-xs font-semibold text-gray-500">

                                            {{ $index + 1 }}

                                        </span>

                                    </td>


                                    {{-- Officer --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center
                                                        rounded-xl bg-blue-50">

                                                <x-heroicon-o-user class="h-5 w-5 text-[#112695]" />

                                            </div>

                                            <div>

                                                <p class="text-sm font-semibold text-gray-800">
                                                    {{ $row->user->name ?? '—' }}
                                                </p>

                                                <p class="mt-0.5 text-xs text-gray-400">
                                                    Council Officer
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Council --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center gap-2">

                                            <div
                                                class="flex h-8 w-8 items-center justify-center
                                                        rounded-lg bg-gray-50">

                                                <x-heroicon-o-building-office class="h-4 w-4 text-gray-500" />

                                            </div>

                                            <span class="text-sm font-medium text-gray-700">
                                                {{ $row->council->council_name ?? '—' }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- Email --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center gap-2">

                                            <x-heroicon-o-envelope class="h-4 w-4 text-gray-400" />

                                            <span class="text-sm text-gray-600">
                                                {{ $row->user->email ?? '—' }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- Actions --}}
                                    {{-- Actions --}}
                                    <td class="w-24 px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center gap-2">

                                            {{-- Edit --}}
                                            <a href="{{ route('council-officers.edit', $row->id) }}"
                                                title="Edit Officer"
                                                class="inline-flex h-8 w-8 items-center justify-center
                                                rounded-lg border border-gray-200
                                                bg-white text-gray-500
                                                transition-all duration-200
                                                hover:border-blue-200
                                                hover:bg-blue-50
                                                hover:text-[#112695]">

                                                <x-heroicon-o-pencil class="h-4 w-4" />

                                            </a>


                                            {{-- Delete --}}
                                            <form action="{{ route('council-officers.destroy', $row->id) }}"
                                                method="POST" onsubmit="return confirmDelete()" class="m-0">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" title="Delete Officer"
                                                    class="inline-flex h-8 w-8 items-center justify-center
                       rounded-lg border border-gray-200
                       bg-white text-gray-500
                       transition-all duration-200
                       hover:border-red-200
                       hover:bg-red-50
                       hover:text-red-500">

                                                    <x-heroicon-o-trash class="h-4 w-4" />

                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="5" class="px-6 py-14">

                                        <div class="flex flex-col items-center justify-center text-center">

                                            <div
                                                class="flex h-16 w-16 items-center justify-center
                                                        rounded-2xl bg-gray-100">

                                                <x-heroicon-o-users class="h-8 w-8 text-gray-400" />

                                            </div>

                                            <h4 class="mt-4 text-sm font-semibold text-gray-800">
                                                No council officers found
                                            </h4>

                                            <p class="mt-1 max-w-sm text-sm text-gray-500">
                                                There are currently no council officers.
                                                Create your first officer to get started.
                                            </p>

                                            <a href="{{ route('council-officers.create') }}"
                                                class="mt-5 inline-flex items-center gap-2
                                                       rounded-lg bg-[#112695] px-4 py-2
                                                       text-sm font-medium text-white
                                                       transition hover:bg-[#0d1d78]">

                                                <x-heroicon-o-user-plus class="h-4 w-4" />

                                                Add Officer

                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>


<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this council officer?');
    }
</script>
