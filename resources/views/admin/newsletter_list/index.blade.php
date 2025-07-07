<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Contact Information List
        </h2>
    </x-slot>

    @if (session('message'))
        <div class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white border rounded-lg mt-4 p-4">
        <div class="max-w-full overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Sl no.</th>                       
                        <th width=30% class="px-6 py-3 text-left text-sm font-medium text-gray-500">Email ID</th>                      
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($newsletter_list as $index => $news)
                        <tr>
                            <td class="px-6 py-4">{{ $index + 1 }}</td>                           
                            <td class="px-6 py-4">{{ $news->email_id }}</td>                           
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
