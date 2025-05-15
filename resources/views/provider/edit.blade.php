<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Provider
        </h2>
    </x-slot>

    <div class="bg-white border rounded-lg col-span-2 mt-4 p-4 flex flex-wrap align-center justify-between ">

                    <form class="bg-white p-6 rounded-lg border w-full max-w-lg space-y-4" method="post" action="{{route('providers.update', $provider->id)}}">
                        @csrf
                        @method('PUT')

                        <label class="block">
                            <span class="text-gray-700">Name</span>
                            <input name="name" type="text" class="w-full mt-1 p-2 border rounded" value="{{$provider->name}}" placeholder="Enter name">
                        </label>

                        <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Submit</button>
                    </form>

    </div>
</x-app-layout>
