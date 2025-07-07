<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Contact Information
        </h2>
    </x-slot>

    @if (session('message'))
        <div class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white border rounded-lg mt-4 p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Contact List</h3>
            <a href="{{ route('create.contact') }}"
                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                Add Contact
            </a>
        </div>

        <div class="max-w-full overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Sl no.</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Address</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Phone</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Links</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($contact as $index => $contact)
                        <tr>
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $contact->address }}</td>
                            <td class="px-6 py-4">{{ $contact->phone }}</td>
                            <td class="px-6 py-4">{{ $contact->email }}</td>
                            <td class="px-6 py-4">
                                <ul class="list-disc ml-4 text-blue-600">
                                    @for ($i = 1; $i <= 4; $i++)
                                        @php $link = $contact["link$i"]; @endphp
                                        @if ($link)
                                            <li><a href="{{ $link }}" target="_blank"
                                                    class="underline">{{ $link }}</a></li>
                                        @endif
                                    @endfor
                                </ul>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('edit.contact', $contact->id) }}"
                                        class="cursor-pointer hover:text-blue-500 dark:hover:text-blue-400">
                                        <x-heroicon-o-pencil-square class="w-6 h-6 text-gray-700 " />
                                    </a>
                                    <form action="{{ route('delete.contact', $contact->id) }}" method="POST"
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
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No contact information available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this contact entry?');
    }
</script>
