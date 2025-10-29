<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight max-w-4xl mx-auto">
            Add Contact
        </h2>
    </x-slot> --}}
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible max-w-4xl mx-auto">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif
    <div
        class="bg-white border rounded-lg col-span-2 mt-4 p-8 flex flex-wrap align-center justify-between max-w-4xl mx-auto">
        <h2 class="font-semibold text-xl text-gray-800 m-0">
            Contact Information
        </h2>
        <a href="{{ route('contact') }}"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 
                   focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <x-heroicon-o-arrow-left class="w-4 h-4" />
        </a>
        <form class="bg-white w-full space-y-4" method="post" action="{{ route('save.contact') }}">
            @csrf

            <!-- Address -->
            <div>
                <label class="block">Address<span class="text-red-700">*</span>
                    <input name="address" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Address" value="{{ old('address') }}">
                    @if ($errors->has('address'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('address') }}</span>
                    @endif
                </label>
            </div>

            <!-- Phone -->
            <div>
                <label class="block">Phone Number<span class="text-red-700">*</span>
                    <input name="phone" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Phone Number" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('phone') }}</span>
                    @endif
                </label>
            </div>

            <!-- Email -->
            <div>
                <label class="block">Email<span class="text-red-700">*</span>
                    <input name="email" type="email" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('email') }}</span>
                    @endif
                </label>
            </div>

            <!-- Extra Links -->
            @for ($i = 1; $i <= 4; $i++)
                <label class="block">
                    <span class="text-gray-700">Extra Link {{ $i }}</span>
                    <input name="link{{ $i }}" type="url" class="w-full mt-1 p-2 border rounded"
                        placeholder="https://example.com" value="{{ old('link' . $i) }}">
                </label>
            @endfor

            <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Save Contact</button>
        </form>
    </div>
</x-app-layout>
