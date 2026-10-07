<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Add Council
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Create a new council and add its basic information.
                </p>
            </div>

            <a href="{{ route('councils') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium
                       text-gray-700 bg-white border border-gray-200 rounded-lg
                       hover:bg-gray-50 transition">
                <x-heroicon-o-arrow-left class="w-4 h-4" />
                Back to Councils
            </a>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if ($message = Session::get('message'))
                <div
                    class="mb-5 flex items-center justify-between rounded-xl
                            border border-green-200 bg-green-50 px-4 py-3 text-green-700">

                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-8 w-8 items-center justify-center
                                    rounded-full bg-green-100">
                            <x-heroicon-o-check class="h-5 w-5 text-green-600" />
                        </div>

                        <span class="text-sm font-medium">
                            {{ $message }}
                        </span>
                    </div>

                    <button type="button" class="text-green-500 hover:text-green-700" data-bs-dismiss="alert">
                        <x-heroicon-o-x-mark class="h-5 w-5" />
                    </button>
                </div>
            @endif


            {{-- Main Card --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                {{-- Card Header --}}
                <div class="border-b border-gray-100 bg-gradient-to-r from-[#f8faff] to-white px-6 py-5">
                    <div class="flex items-center gap-4">

                        <div
                            class="flex h-12 w-12 items-center justify-center
                                    rounded-xl bg-blue-50">
                            <x-heroicon-o-building-office-2 class="h-6 w-6 text-[#112695]" />
                        </div>

                        <div>
                            <h3 class="text-base font-semibold text-gray-900">
                                Council Information
                            </h3>

                            <p class="mt-0.5 text-sm text-gray-500">
                                Enter the council's basic details below.
                            </p>
                        </div>

                    </div>
                </div>


                {{-- Form --}}
                {{-- Form --}}
                <form method="POST" action="{{ route('store.council') }}">
                    @csrf

                    <div class="p-6 sm:p-8">

                        {{-- Basic Information --}}
                        <div class="mb-8">
                            <h4 class="text-sm font-semibold text-gray-900 mb-1">
                                Basic Information
                            </h4>
                            <p class="text-sm text-gray-500">
                                Enter the council's basic contact details.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Council Name --}}
                            <div>
                                <label for="council_name" class="mb-2 block text-sm font-medium text-gray-700">
                                    Council Name
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0
                                flex items-center pl-3.5">
                                        <x-heroicon-o-building-office class="h-5 w-5 text-gray-400" />
                                    </div>

                                    <input id="council_name" name="council_name" type="text"
                                        value="{{ old('council_name') }}" placeholder="Enter council name"
                                        class="block w-full rounded-xl border border-gray-200
                               bg-gray-50 py-3 pl-11 pr-4 text-sm text-gray-900
                               placeholder:text-gray-400
                               focus:border-[#112695]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#112695]/10
                               transition">
                                </div>

                                @error('council_name')
                                    <p class="mt-1.5 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Council Email --}}
                            <div>
                                <label for="council_email" class="mb-2 block text-sm font-medium text-gray-700">
                                    Email Address
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0
                                flex items-center pl-3.5">
                                        <x-heroicon-o-envelope class="h-5 w-5 text-gray-400" />
                                    </div>

                                    <input id="council_email" name="council_email" type="email"
                                        value="{{ old('council_email') }}" placeholder="Enter council email"
                                        class="block w-full rounded-xl border border-gray-200
                               bg-gray-50 py-3 pl-11 pr-4 text-sm text-gray-900
                               placeholder:text-gray-400
                               focus:border-[#112695]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#112695]/10
                               transition">
                                </div>

                                @error('council_email')
                                    <p class="mt-1.5 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>


                        {{-- Billing Information --}}
                        <div class="mt-10 mb-6 border-t border-gray-100 pt-8">
                            <h4 class="text-sm font-semibold text-gray-900 mb-1">
                                Billing Information
                            </h4>
                            <p class="text-sm text-gray-500">
                                These details will be automatically used when Council is selected for billing.
                            </p>
                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Billing Email --}}
                            <div>
                                <label for="council_billing_email" class="mb-2 block text-sm font-medium text-gray-700">
                                    Billing Email
                                </label>

                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0
                                flex items-center pl-3.5">
                                        <x-heroicon-o-envelope class="h-5 w-5 text-gray-400" />
                                    </div>

                                    <input id="council_billing_email" name="council_billing_email" type="email"
                                        value="{{ old('council_billing_email') }}" placeholder="Enter billing email"
                                        class="block w-full rounded-xl border border-gray-200
                               bg-gray-50 py-3 pl-11 pr-4 text-sm text-gray-900
                               placeholder:text-gray-400
                               focus:border-[#112695]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#112695]/10
                               transition">
                                </div>

                                @error('council_billing_email')
                                    <p class="mt-1.5 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Billing Phone --}}
                            <div>
                                <label for="council_billing_phone" class="mb-2 block text-sm font-medium text-gray-700">
                                    Billing Phone
                                </label>

                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0
                                flex items-center pl-3.5">
                                        <x-heroicon-o-phone class="h-5 w-5 text-gray-400" />
                                    </div>

                                    <input id="council_billing_phone" name="council_billing_phone" type="text"
                                        value="{{ old('council_billing_phone') }}" placeholder="Enter billing phone"
                                        class="block w-full rounded-xl border border-gray-200
                               bg-gray-50 py-3 pl-11 pr-4 text-sm text-gray-900
                               placeholder:text-gray-400
                               focus:border-[#112695]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#112695]/10
                               transition">
                                </div>

                                @error('council_billing_phone')
                                    <p class="mt-1.5 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Billing Address --}}
                            <div>
                                <label for="council_billing_address"
                                    class="mb-2 block text-sm font-medium text-gray-700">
                                    Billing Address
                                </label>

                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute top-3.5 left-0
                                flex items-center pl-3.5">
                                        <x-heroicon-o-map-pin class="h-5 w-5 text-gray-400" />
                                    </div>

                                    <textarea id="council_billing_address" name="council_billing_address" rows="3" placeholder="Enter billing address"
                                        class="block w-full rounded-xl border border-gray-200
                               bg-gray-50 py-3 pl-11 pr-4 text-sm text-gray-900
                               placeholder:text-gray-400
                               focus:border-[#112695]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#112695]/10
                               transition">{{ old('council_billing_address') }}</textarea>
                                </div>

                                @error('council_billing_address')
                                    <p class="mt-1.5 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Billing Postcode --}}
                            <div>
                                <label for="council_billing_postcode"
                                    class="mb-2 block text-sm font-medium text-gray-700">
                                    Billing Postcode
                                </label>

                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0
                                flex items-center pl-3.5">
                                        <x-heroicon-o-map class="h-5 w-5 text-gray-400" />
                                    </div>

                                    <input id="council_billing_postcode" name="council_billing_postcode"
                                        type="text" value="{{ old('council_billing_postcode') }}"
                                        placeholder="Enter billing postcode"
                                        class="block w-full rounded-xl border border-gray-200
                               bg-gray-50 py-3 pl-11 pr-4 text-sm text-gray-900
                               placeholder:text-gray-400
                               focus:border-[#112695]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#112695]/10
                               transition">
                                </div>

                                @error('council_billing_postcode')
                                    <p class="mt-1.5 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div
                        class="flex flex-col-reverse gap-3 border-t border-gray-100
                bg-gray-50/70 px-6 py-4 sm:flex-row sm:justify-end">

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2
                   rounded-xl bg-[#112695] px-6 py-2.5
                   text-sm font-semibold text-white
                   hover:bg-[#0d1d78]
                   focus:outline-none focus:ring-2
                   focus:ring-[#112695]/30
                   transition">

                            <x-heroicon-o-check class="h-5 w-5" />

                            Create Council
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
