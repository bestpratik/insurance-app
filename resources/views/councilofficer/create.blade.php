<x-app-layout>
    
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
    />
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Council Officer
        </h2>
    </x-slot>

    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif

    <div class="bg-white border rounded-lg col-span-12 mt-4 p-4">

        <form class="bg-white p-6 rounded-lg border w-full space-y-4" method="post"
            action="{{ route('council-officers.store') }}">
            @csrf

            {{-- Council --}}
            <label class="block">
                <span class="text-gray-700">Council</span>

                <select name="council_id" id="council_id" class="w-full mt-1 p-2 border rounded">
                    <option value="">Select Council</option>

                    @foreach ($councils as $council)
                        <option value="{{ $council->id }}" {{ old('council_id') == $council->id ? 'selected' : '' }}>
                            {{ $council->council_name }}
                        </option>
                    @endforeach
                </select>

                @error('council_id')
                    <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">
                        {{ $message }}
                    </p>
                @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Council Officer Name</span>

                <input name="name" type="text" class="w-full mt-1 p-2 border rounded"
                    placeholder="Enter council officer name">
                @error('name')
                    <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">{{ $message }}</p>
                @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Email</span>

                <input name="email" type="email" class="w-full mt-1 p-2 border rounded" placeholder="Enter email">
                @error('email')
                    <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">{{ $message }}</p>
                @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Password</span>

                <input name="password" type="password" class="w-full mt-1 p-2 border rounded"
                    placeholder="Enter password">

                @error('password')
                    <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">
                        {{ $message }}
                    </p>
                @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Confirm Password</span>

                <input name="password_confirmation" type="password" class="w-full mt-1 p-2 border rounded"
                    placeholder="Confirm password">

                @error('password_confirmation')
                    <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">
                        {{ $message }}
                    </p>
                @enderror
            </label>

            <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">
                Submit
            </button>
        </form>

    </div>
    
</x-app-layout>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#council_id').select2({
                placeholder: 'Select Council',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
