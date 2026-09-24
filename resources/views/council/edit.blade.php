<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Council
        </h2>
    </x-slot>

    <div class="bg-white border rounded-lg col-span-2 mt-4 p-4">

                    <form class="bg-white p-6 rounded-lg border w-full space-y-4" method="post" action="{{route('update.council', $council->id)}}">
                        @csrf
                        @method('PUT')

                        <label class="block">
                            <span class="text-gray-700">Council Name</span>
                            <input name="council_name" type="text" class="w-full mt-1 p-2 border rounded" value="{{$council->council_name}}" placeholder="Enter council name">
                            @error('council_name')
                                <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">{{ $message }}</p>
                            @enderror
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Email</span>
                            <input name="council_email" type="text" class="w-full mt-1 p-2 border rounded" value="{{$council->council_email}}" placeholder="Enter email">
                            @error('council_email')
                                <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">{{ $message }}</p>
                            @enderror
                        </label>

                        <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Submit</button>
                    </form>

    </div>
</x-app-layout>
