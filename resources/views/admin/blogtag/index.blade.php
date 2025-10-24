<x-app-layout>
    <div class="grid grid-cols-12 gap-4 md:gap-6">

        <div class="col-span-12">
            <!-- Table Four -->
            @if (session('success'))
                <div class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50  dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 ">
                <div class="flex flex-col gap-5 px-6 mb-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-lg font-semibold  /90">
                            Manage Blog Tags
                        </h3>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <div>
                            <a href="{{ route('create.blog.tag') }}"
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
                                                    Sl no.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs ">
                                            Tag Name
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

                            @forelse ($tag as $row)
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
                                                        {!! \Illuminate\Support\Str::limit(strip_tags($row->tag_name), 30) !!}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <a href="{{ route('edit.blog.tag', $row->id) }}"
                                                class="cursor-pointer hover:text-blue-500 dark:hover:text-blue-400">
                                                <x-heroicon-o-pencil-square class="w-6 h-6 text-gray-700 " />
                                            </a>
                                            <form action="{{ route('tag.status', $row->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" onchange="this.form.submit()"
                                                        class="sr-only peer" {{ $row->status ? 'checked' : '' }}>
                                                    <div
                                                        class="ml-1 w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-500 
                                                                peer-focus:ring-2 peer-focus:ring-green-300 relative 
                                                                after:content-[''] after:absolute after:top-[2px] after:start-[2px] 
                                                                after:bg-white after:border-gray-300 after:border 
                                                                after:rounded-full after:h-5 after:w-5 after:transition-all 
                                                                peer-checked:after:translate-x-full peer-checked:after:border-white">
                                                    </div>
                                                </label>
                                            </form>
                                            <form action="{{ route('tag.ispopular', $row->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="group relative flex items-center gap-2 px-3 py-1.5 rounded-full border border-gray-300 
               hover:border-yellow-400 transition-all duration-300 bg-white shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5 text-gray-400 group-hover:text-yellow-400 transition-colors duration-300
                {{ $row->is_popular ? 'fill-yellow-400 text-yellow-400' : '' }}"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.8" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polygon
                                                            points="12 2 15 9 22 9 17 14 19 22 12 18 5 22 7 14 2 9 9 9" />
                                                    </svg>
                                                    <span
                                                        class="text-sm {{ $row->is_popular ? 'text-yellow-500 font-medium' : 'text-gray-500' }}">
                                                        {{ $row->is_popular ? 'Popular' : 'Mark Popular' }}
                                                    </span>
                                                </button>
                                            </form>

                                            <form action="{{ route('delete.blog.tag', $row->id) }}" method="POST"
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
