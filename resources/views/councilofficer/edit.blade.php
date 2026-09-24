<x-app-layout>

    {{-- Select2 CSS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
    />

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Edit Council Officer
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Update the council officer's account and assignment details.
                </p>
            </div>

            <a href="{{ route('council-officers.index') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-gray-200
                       bg-white px-4 py-2 text-sm font-medium text-gray-700
                       transition hover:bg-gray-50">

                <x-heroicon-o-arrow-left class="h-4 w-4" />

                Back to Officers

            </a>

        </div>

    </x-slot>


    <div class="py-6">

        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if ($message = Session::get('message'))

                <div class="mb-5 flex items-center gap-3 rounded-xl
                            border border-green-200 bg-green-50
                            px-4 py-3 text-sm font-medium text-green-700">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center
                                rounded-full bg-green-100">

                        <x-heroicon-o-check class="h-5 w-5 text-green-600" />

                    </div>

                    <span>
                        {{ $message }}
                    </span>

                </div>

            @endif


            {{-- Main Card --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200
                        bg-white shadow-sm">


                {{-- Card Header --}}
                <div class="border-b border-gray-100
                            bg-gradient-to-r from-[#f8faff] to-white
                            px-6 py-5">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center
                                    rounded-xl bg-blue-50">

                            <x-heroicon-o-pencil-square
                                class="h-6 w-6 text-[#112695]" />

                        </div>

                        <div>

                            <h3 class="text-base font-semibold text-gray-900">
                                Officer Information
                            </h3>

                            <p class="mt-0.5 text-sm text-gray-500">
                                Update the officer's council and account details.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Form --}}
                <form method="POST"
                    action="{{ route('council-officers.update', $councilOfficer->id) }}">

                    @csrf
                    @method('PUT')


                    <div class="p-6 sm:p-8">


                        {{-- Council Assignment --}}
                        <div class="mb-8">

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center
                                            rounded-lg bg-blue-50">

                                    <x-heroicon-o-building-office
                                        class="h-5 w-5 text-[#112695]" />

                                </div>

                                <div>

                                    <h4 class="text-sm font-semibold text-gray-800">
                                        Council Assignment
                                    </h4>

                                    <p class="text-xs text-gray-500">
                                        Select the council this officer belongs to.
                                    </p>

                                </div>

                            </div>


                            <div>

                                <label for="council_id"
                                    class="mb-2 block text-sm font-medium text-gray-700">

                                    Council
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="relative">

                                    <div class="pointer-events-none absolute inset-y-0 left-0
                                                z-10 flex items-center pl-3.5">

                                        <x-heroicon-o-building-office
                                            class="h-5 w-5 text-gray-400" />

                                    </div>

                                    <select
                                        name="council_id"
                                        id="council_id"
                                        class="council-select w-full">

                                        <option value=""></option>

                                        @foreach ($councils as $council)

                                            <option value="{{ $council->id }}"
                                                {{ old('council_id', $councilOfficer->council_id) == $council->id ? 'selected' : '' }}>

                                                {{ $council->council_name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                                @error('council_id')
                                    <p class="mt-1.5 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        {{-- Officer Details --}}
                        <div class="mb-8">

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center
                                            rounded-lg bg-blue-50">

                                    <x-heroicon-o-user
                                        class="h-5 w-5 text-[#112695]" />

                                </div>

                                <div>

                                    <h4 class="text-sm font-semibold text-gray-800">
                                        Officer Details
                                    </h4>

                                    <p class="text-xs text-gray-500">
                                        Update the officer's basic contact information.
                                    </p>

                                </div>

                            </div>


                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                                {{-- Officer Name --}}
                                <div>

                                    <label for="name"
                                        class="mb-2 block text-sm font-medium text-gray-700">

                                        Officer Name
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0
                                                    flex items-center pl-3.5">

                                            <x-heroicon-o-user
                                                class="h-5 w-5 text-gray-400" />

                                        </div>

                                        <input
                                            id="name"
                                            name="name"
                                            type="text"
                                            value="{{ old('name', $councilOfficer->user->name ?? '') }}"
                                            placeholder="Enter officer name"
                                            class="block w-full rounded-xl border border-gray-200
                                                   bg-gray-50 py-3 pl-11 pr-4 text-sm
                                                   text-gray-900 placeholder:text-gray-400
                                                   transition
                                                   focus:border-[#112695]
                                                   focus:bg-white
                                                   focus:ring-2
                                                   focus:ring-[#112695]/10">

                                    </div>

                                    @error('name')
                                        <p class="mt-1.5 text-sm text-red-500">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Email --}}
                                <div>

                                    <label for="email"
                                        class="mb-2 block text-sm font-medium text-gray-700">

                                        Email Address
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0
                                                    flex items-center pl-3.5">

                                            <x-heroicon-o-envelope
                                                class="h-5 w-5 text-gray-400" />

                                        </div>

                                        <input
                                            id="email"
                                            name="email"
                                            type="email"
                                            value="{{ old('email', $councilOfficer->user->email ?? '') }}"
                                            placeholder="Enter email address"
                                            class="block w-full rounded-xl border border-gray-200
                                                   bg-gray-50 py-3 pl-11 pr-4 text-sm
                                                   text-gray-900 placeholder:text-gray-400
                                                   transition
                                                   focus:border-[#112695]
                                                   focus:bg-white
                                                   focus:ring-2
                                                   focus:ring-[#112695]/10">

                                    </div>

                                    @error('email')
                                        <p class="mt-1.5 text-sm text-red-500">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- Login Security --}}
                        <div>

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center
                                            rounded-lg bg-blue-50">

                                    <x-heroicon-o-lock-closed
                                        class="h-5 w-5 text-[#112695]" />

                                </div>

                                <div>

                                    <h4 class="text-sm font-semibold text-gray-800">
                                        Login Security
                                    </h4>

                                    <p class="text-xs text-gray-500">
                                        Change the password if you want to update
                                        the officer's login credentials.
                                    </p>

                                </div>

                            </div>


                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                                {{-- Password --}}
                                <div>

                                    <label for="password"
                                        class="mb-2 block text-sm font-medium text-gray-700">

                                        New Password

                                        <span class="text-gray-400 font-normal">
                                            (Optional)
                                        </span>

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0
                                                    z-10 flex items-center pl-3.5">

                                            <x-heroicon-o-lock-closed
                                                class="h-5 w-5 text-gray-400" />

                                        </div>

                                        <input
                                            id="password"
                                            name="password"
                                            type="password"
                                            placeholder="Enter new password"
                                            class="block w-full rounded-xl border border-gray-200
                                                   bg-gray-50 py-3 pl-11 pr-12 text-sm
                                                   text-gray-900 placeholder:text-gray-400
                                                   transition
                                                   focus:border-[#112695]
                                                   focus:bg-white
                                                   focus:ring-2
                                                   focus:ring-[#112695]/10">

                                        {{-- Eye --}}
                                        <button
                                            type="button"
                                            onclick="togglePassword('password', 'passwordEye')"
                                            class="absolute inset-y-0 right-0 flex items-center
                                                   px-3 text-gray-400
                                                   hover:text-[#112695] transition">

                                            <x-heroicon-o-eye
                                                id="passwordEye"
                                                class="h-5 w-5" />

                                        </button>

                                    </div>

                                    @error('password')
                                        <p class="mt-1.5 text-sm text-red-500">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Confirm Password --}}
                                <div>

                                    <label for="password_confirmation"
                                        class="mb-2 block text-sm font-medium text-gray-700">

                                        Confirm New Password

                                        <span class="text-gray-400 font-normal">
                                            (Optional)
                                        </span>

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0
                                                    z-10 flex items-center pl-3.5">

                                            <x-heroicon-o-lock-closed
                                                class="h-5 w-5 text-gray-400" />

                                        </div>

                                        <input
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            type="password"
                                            placeholder="Confirm new password"
                                            class="block w-full rounded-xl border border-gray-200
                                                   bg-gray-50 py-3 pl-11 pr-12 text-sm
                                                   text-gray-900 placeholder:text-gray-400
                                                   transition
                                                   focus:border-[#112695]
                                                   focus:bg-white
                                                   focus:ring-2
                                                   focus:ring-[#112695]/10">

                                        {{-- Eye --}}
                                        <button
                                            type="button"
                                            onclick="togglePassword(
                                                'password_confirmation',
                                                'confirmPasswordEye'
                                            )"
                                            class="absolute inset-y-0 right-0 flex items-center
                                                   px-3 text-gray-400
                                                   hover:text-[#112695] transition">

                                            <x-heroicon-o-eye
                                                id="confirmPasswordEye"
                                                class="h-5 w-5" />

                                        </button>

                                    </div>

                                    @error('password_confirmation')
                                        <p class="mt-1.5 text-sm text-red-500">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>

                            </div>


                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100
                                bg-gray-50/70 px-6 py-4
                                sm:flex-row sm:justify-end">

                      

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-xl bg-[#112695] px-6 py-2.5
                                   text-sm font-semibold text-white shadow-sm
                                   transition
                                   hover:bg-[#0d1d78]
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#112695]/30">

                            <x-heroicon-o-check class="h-5 w-5" />

                            Update Officer

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>

        /* Select2 */
        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            height: 48px !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 12px !important;
            background: #f9fafb !important;
            display: flex !important;
            align-items: center !important;
            padding-left: 42px !important;
            transition: all 0.2s ease;
        }

        .select2-container
        .select2-selection--single
        .select2-selection__rendered {
            color: #111827 !important;
            font-size: 14px !important;
            line-height: 48px !important;
            padding-left: 0 !important;
        }

        .select2-container
        .select2-selection--single
        .select2-selection__placeholder {
            color: #9ca3af !important;
        }

        .select2-container
        .select2-selection--single
        .select2-selection__arrow {
            height: 46px !important;
            right: 12px !important;
        }

        .select2-container--default.select2-container--open
        .select2-selection--single,
        .select2-container--focus
        .select2-selection--single {
            border-color: #112695 !important;
            background: #ffffff !important;
            box-shadow: 0 0 0 3px rgba(17, 38, 149, 0.08) !important;
        }

        .select2-dropdown {
            border: 1px solid #e5e7eb !important;
            border-radius: 12px !important;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .select2-results__option {
            padding: 10px 14px !important;
            font-size: 14px !important;
        }

        .select2-results__option--highlighted {
            background: #eef4ff !important;
            color: #112695 !important;
        }

        .select2-results__option[aria-selected="true"] {
            background: #eef4ff !important;
            color: #112695 !important;
            font-weight: 500;
        }

    </style>


    <script>

        $(document).ready(function () {

            $('#council_id').select2({
                placeholder: 'Select Council',
                allowClear: true,
                width: '100%'
            });

        });


        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {

                input.type = 'text';

                icon.outerHTML = `
                    <svg id="${iconId}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-5 w-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.644
                            C3.423 7.51 7.36 5 12 5
                            c4.64 0 8.577 2.51 9.964 6.678
                            .07.21.07.434 0 .644
                            C20.577 16.49 16.64 19 12 19
                            c-4.64 0-8.577-2.51-9.964-6.678z" />

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0
                            3 3 0 016 0z" />

                    </svg>
                `;

            } else {

                input.type = 'password';

                icon.outerHTML = `
                    <svg id="${iconId}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-5 w-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.644
                            C3.423 7.51 7.36 5 12 5
                            c4.64 0 8.577 2.51 9.964 6.678
                            .07.21.07.434 0 .644
                            C20.577 16.49 16.64 19 12 19
                            c-4.64 0-8.577-2.51-9.964-6.678z" />

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0
                            3 3 0 016 0z" />

                    </svg>
                `;

            }

        }

    </script>

</x-app-layout>