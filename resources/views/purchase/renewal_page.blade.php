<x-app-layout>

    <div class="grid py-10 bg-gradient-to-br from-slate-100 via-blue-50 to-white">
        {{-- <div class="grid grid-cols-12 gap-4 md:gap-6"> --}}

        <div class="max-w-7xl mx-auto px-5">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-300 bg-green-50 px-5 py-4 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Page Heading -->

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-slate-800">
                    Policy Overview
                </h1>

                <p class="mt-2 text-gray-500">
                    View complete policy information, customer details,
                    property information and downloadable documents.
                </p>

            </div>

            <!-- Main Card -->

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">

                <!-- Top Blue Header -->

                <div class="bg-gradient-to-r from-blue-800 to-blue-600 px-8 py-6">

                    <div class="flex justify-between items-center">

                        <div>

                            <h2 class="text-2xl font-semibold text-white">

                                Insurance Purchase Details

                            </h2>

                            <p class="text-blue-100 mt-1">

                                Policy Number :
                                <strong>{{ $purchase->policy_no }}</strong>

                            </p>

                        </div>

                        <div>

                            <span class="px-4 py-2 rounded-full bg-white/20 text-white font-semibold">

                                Active Policy

                            </span>

                        </div>

                    </div>

                </div>

                <!-- Page Content -->

                <div class="p-8 space-y-10">

                    <!-- ===========================================
     Policy Information
============================================ -->

                    <div class="dashboard-card rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">

                        <!-- Card Header -->
                        <div class="flex items-center gap-3 px-6 py-4 bg-blue-50 border-b">

                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">

                                <x-heroicon-o-document-text class="h-6 w-6 text-blue-700" />

                            </div>

                            <div>

                                <h2 class="text-xl font-semibold text-blue-700">
                                    Policy Information
                                </h2>

                                <p class="text-sm text-gray-500">
                                    Basic insurance policy information
                                </p>

                            </div>

                        </div>

                        <!-- Card Body -->

                        <div class="p-6">

                            <div class="grid md:grid-cols-2 gap-x-14 gap-y-5">

                                <!-- Policy Number -->

                                <div class="flex">

                                    <div class="w-48">

                                        <p class="text-sm font-semibold text-gray-600">
                                            Policy Number
                                        </p>

                                    </div>

                                    <div>

                                        <p class="text-gray-800">
                                            {{ $purchase->policy_no }}
                                        </p>

                                    </div>

                                </div>

                                <!-- Insurance Name -->

                                {{-- <div class="flex">

                                    <div class="w-48">

                                        <p class="text-sm font-semibold text-gray-600">
                                            Insurance Name
                                        </p>

                                    </div>

                                    <div>

                                        <p class="text-gray-800">
                                            {{ $purchase->insurance->name ?? '' }}
                                        </p>

                                    </div>

                                </div> --}}

                                <div class="grid grid-cols-12 gap-4">

                                    <div class="col-span-4">
                                        <p class="font-semibold text-gray-600">
                                            Insurance Name
                                        </p>
                                    </div>

                                    <div class="col-span-8 break-words">
                                        {{ $purchase->insurance->name }}
                                    </div>

                                </div>

                                <!-- Insurance Price -->

                                <div class="flex">

                                    <div class="w-48">

                                        <p class="text-sm font-semibold text-gray-600">
                                            Insurance Price
                                        </p>

                                    </div>

                                    <div>

                                        <span
                                            class="inline-flex rounded-full bg-green-100 px-3 py-1 text-green-700 font-semibold">

                                            £{{ number_format($purchase->insurance_price ?? 0, 2) }}

                                        </span>

                                    </div>

                                </div>

                                <!-- Provider -->

                                <div class="flex">

                                    <div class="w-48">

                                        <p class="text-sm font-semibold text-gray-600">
                                            Provider
                                        </p>

                                    </div>

                                    <div>

                                        <p class="text-gray-800">

                                            {{ $purchase->insurance->provider->name ?? '-' }}

                                        </p>

                                    </div>

                                </div>

                                <!-- Insurance Type -->

                                <div class="flex">

                                    <div class="w-48">

                                        <p class="text-sm font-semibold text-gray-600">
                                            Insurance Type
                                        </p>

                                    </div>

                                    <div>

                                        <span
                                            class="rounded-full bg-blue-100 px-3 py-1 text-blue-700 text-sm font-semibold">

                                            {{ $purchase->insurance->type_of_insurance ?? '-' }}

                                        </span>

                                    </div>

                                </div>

                                <!-- Policy Status -->

                                {{-- <div class="flex">

                                    <div class="w-48">

                                        <p class="text-sm font-semibold text-gray-600">
                                            Policy Status
                                        </p>

                                    </div>

                                    <div>

                                        <span
                                            class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-green-700 font-semibold">

                                            ● Active

                                        </span>

                                    </div>

                                </div> --}}

                            </div>

                        </div>

                    </div>

                    <!-- ===========================================
     Purchase Details
============================================ -->

                    <div class="dashboard-card rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="flex items-center gap-3 px-6 py-4 bg-blue-50 border-b">

                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">

                                <x-heroicon-o-shopping-cart class="h-6 w-6 text-blue-700" />

                            </div>

                            <div>

                                <h2 class="text-xl font-semibold text-blue-700">
                                    Purchase Details
                                </h2>

                                <p class="text-sm text-gray-500">
                                    Policy purchase information and important dates
                                </p>

                            </div>

                        </div>

                        <!-- Body -->

                        <div class="p-6">

                            <div class="grid md:grid-cols-2 gap-x-14 gap-y-5">

                                <!-- Purchased By -->
                                <div class="flex">
                                    <div class="w-48">
                                        <p class="uppercase text-xs tracking-wider font-bold text-gray-500">
                                            Purchased By
                                        </p>
                                    </div>

                                    <div>
                                        <p class="font-medium text-gray-800">
                                            {{ auth()->user()->name ?? '-' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Purchase Date -->
                                <div class="flex">
                                    <div class="w-48">
                                        <p class="uppercase text-xs tracking-wider font-bold text-gray-500">
                                            Purchase Date
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-gray-800">
                                            {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Policy Start Date -->
                                <div class="flex">
                                    <div class="w-48">
                                        <p class="uppercase text-xs tracking-wider font-bold text-gray-500">
                                            Policy Start
                                        </p>
                                    </div>

                                    <div>
                                        <span
                                            class="inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">
                                            {{ \Carbon\Carbon::parse($purchase->policy_start_date)->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Policy End Date -->
                                <div class="flex">
                                    <div class="w-48">
                                        <p class="uppercase text-xs tracking-wider font-bold text-gray-500">
                                            Policy End
                                        </p>
                                    </div>

                                    <div>
                                        <span
                                            class="inline-flex rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                            {{ \Carbon\Carbon::parse($purchase->policy_end_date)->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- AST Start Date -->
                                <div class="flex">
                                    <div class="w-48">
                                        <p class="uppercase text-xs tracking-wider font-bold text-gray-500">
                                            AST Start Date
                                        </p>
                                    </div>

                                    <div>
                                        <span
                                            class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">
                                            {{ \Carbon\Carbon::parse($purchase->ast_start_date)->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Policy Duration -->
                                <div class="flex">
                                    <div class="w-48">
                                        <p class="uppercase text-xs tracking-wider font-bold text-gray-500">
                                            Duration
                                        </p>
                                    </div>

                                    <div>
                                        @php
                                            $start = \Carbon\Carbon::parse($purchase->policy_start_date);
                                            $end = \Carbon\Carbon::parse($purchase->policy_end_date);
                                        @endphp

                                        <span
                                            class="inline-flex rounded-full bg-indigo-100 px-3 py-1 text-sm font-semibold text-indigo-700">
                                            {{ $start->diffInMonths($end) }} Months
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- ===========================================
     Property Details
============================================ -->

                    @php
                        $address = implode(
                            ', ',
                            array_filter([
                                $purchase->door_no,
                                $purchase->address_one,
                                $purchase->address_two,
                                $purchase->address_three,
                            ]),
                        );
                    @endphp

                    <div class="dashboard-card rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="flex items-center gap-3 px-6 py-4 bg-blue-50 border-b">

                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">

                                <x-heroicon-o-home class="w-6 h-6 text-blue-700" />

                            </div>

                            <div>

                                <h2 class="text-xl font-semibold text-blue-700">
                                    Property Details
                                </h2>

                                <p class="text-sm text-gray-500">
                                    Insured property information
                                </p>

                            </div>

                        </div>

                        <!-- Body -->

                        <div class="p-6">

                            <div class="grid md:grid-cols-2 gap-x-14 gap-y-6">

                                <!-- Full Address -->

                                <div class="md:col-span-2">

                                    <p class="uppercase text-xs tracking-widest font-bold text-gray-500 mb-2">

                                        Property Address

                                    </p>

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">

                                            <x-heroicon-o-map-pin class="w-5 h-5 text-blue-700" />

                                        </div>

                                        <div>

                                            <p class="font-semibold text-gray-800">

                                                {{ $address }}

                                            </p>

                                            <p class="text-gray-500 text-sm">

                                                {{ $purchase->post_code }}

                                            </p>

                                        </div>

                                    </div>

                                </div>

                                <!-- Door Number -->

                                <div>

                                    <p class="uppercase text-xs tracking-widest font-bold text-gray-500">

                                        Door Number

                                    </p>

                                    <p class="mt-2 text-gray-800">

                                        {{ $purchase->door_no ?: '-' }}

                                    </p>

                                </div>

                                <!-- Post Code -->

                                <div>

                                    <p class="uppercase text-xs tracking-widest font-bold text-gray-500">

                                        Post Code

                                    </p>

                                    <span
                                        class="inline-flex mt-2 rounded-full bg-blue-100 px-4 py-1 text-sm font-semibold text-blue-700">

                                        {{ $purchase->post_code }}

                                    </span>

                                </div>

                                <!-- Address One -->

                                <div>

                                    <p class="uppercase text-xs tracking-widest font-bold text-gray-500">

                                        Address Line 1

                                    </p>

                                    <p class="mt-2 text-gray-800">

                                        {{ $purchase->address_one ?: '-' }}

                                    </p>

                                </div>

                                <!-- Address Two -->

                                <div>

                                    <p class="uppercase text-xs tracking-widest font-bold text-gray-500">

                                        Address Line 2

                                    </p>

                                    <p class="mt-2 text-gray-800">

                                        {{ $purchase->address_two ?: '-' }}

                                    </p>

                                </div>

                                <!-- Address Three -->

                                <div class="md:col-span-2">

                                    <p class="uppercase text-xs tracking-widest font-bold text-gray-500">

                                        Address Line 3

                                    </p>

                                    <p class="mt-2 text-gray-800">

                                        {{ $purchase->address_three ?: '-' }}

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ===========================================
     Landlord / Agency Details
============================================ -->

                    @php

                        if ($purchase->policy_holder_type == 'Company') {
                            $displayName = $purchase->company_name;
                        } elseif ($purchase->policy_holder_type == 'Individual') {
                            $displayName = trim(
                                ($purchase->policy_holder_title ?? '') .
                                    ' ' .
                                    ($purchase->policy_holder_fname ?? '') .
                                    ' ' .
                                    ($purchase->policy_holder_lname ?? ''),
                            );
                        } else {
                            $displayName = $purchase->company_name;
                        }

                        $initial = strtoupper(substr($displayName, 0, 1));
                    @endphp

                    <div class="dashboard-card rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">

                        <!-- Header -->

                        <div class="flex items-center gap-3 px-6 py-4 bg-blue-50 border-b">

                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">

                                <x-heroicon-o-user class="w-6 h-6 text-blue-700" />

                            </div>

                            <div>

                                <h2 class="text-xl font-semibold text-blue-700">

                                    Landlord / Agency Details

                                </h2>

                                <p class="text-sm text-gray-500">

                                    Policy holder information

                                </p>

                            </div>

                        </div>

                        <!-- Body -->

                        <div class="p-6">

                            <div class="grid lg:grid-cols-12 gap-8">

                                <!-- Left Profile -->

                                <div class="lg:col-span-4">

                                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-6 text-center">

                                        <div
                                            class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-600 text-3xl font-bold text-white">

                                            {{ $initial }}

                                        </div>

                                        <h3 class="mt-4 text-xl font-semibold text-gray-800">

                                            {{ $displayName }}

                                        </h3>

                                        <span
                                            class="mt-2 inline-flex rounded-full bg-blue-100 px-4 py-1 text-sm font-semibold text-blue-700">

                                            {{ $purchase->policy_holder_type }}

                                        </span>

                                    </div>

                                </div>

                                <!-- Right Details -->

                                <div class="lg:col-span-8">

                                    <div class="grid md:grid-cols-2 gap-x-10 gap-y-6">

                                        <!-- Company -->

                                        <div>

                                            <p class="uppercase text-xs font-bold tracking-widest text-gray-500">

                                                Company

                                            </p>

                                            <p class="mt-2 text-gray-800">

                                                {{ $purchase->company_name ?: '-' }}

                                            </p>

                                        </div>

                                        <!-- Full Name -->

                                        <div>

                                            <p class="uppercase text-xs font-bold tracking-widest text-gray-500">

                                                Contact Person

                                            </p>

                                            <p class="mt-2 text-gray-800">

                                                {{ trim(($purchase->policy_holder_title ?? '') . ' ' . ($purchase->policy_holder_fname ?? '') . ' ' . ($purchase->policy_holder_lname ?? '')) ?: '-' }}

                                            </p>

                                        </div>

                                        <!-- Address -->

                                        <div class="md:col-span-2">

                                            <p class="uppercase text-xs font-bold tracking-widest text-gray-500">

                                                Registered Address

                                            </p>

                                            <div class="mt-3 rounded-lg bg-gray-50 p-4 border">

                                                <div class="flex gap-3">

                                                    <x-heroicon-o-map-pin class="w-5 h-5 text-blue-600 mt-0.5" />

                                                    <span class="text-gray-700">

                                                        {{ $purchase->policy_holder_address ?: 'N/A' }}

                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    @if (!empty($purchase->tenant_name || $purchase->tenant_email || $purchase->tenant_phone))
                        @php
                            $tenantInitial = strtoupper(substr($purchase->tenant_name ?? 'T', 0, 1));
                        @endphp

                        <!-- ===========================================
     Tenant Details
============================================ -->

                        <div
                            class="dashboard-card rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">

                            <!-- Header -->
                            <div class="flex items-center gap-3 px-6 py-4 bg-blue-50 border-b">

                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">

                                    <x-heroicon-o-users class="w-6 h-6 text-blue-700" />

                                </div>

                                <div>

                                    <h2 class="text-xl font-semibold text-blue-700">
                                        Tenant Details
                                    </h2>

                                    <p class="text-sm text-gray-500">
                                        Current tenant information
                                    </p>

                                </div>

                            </div>

                            <!-- Body -->

                            <div class="p-6">

                                <div class="grid lg:grid-cols-12 gap-8">

                                    <!-- Left Profile Card -->

                                    <div class="lg:col-span-4">

                                        <div
                                            class="rounded-xl border border-gray-200 bg-gradient-to-b from-blue-50 to-white p-6 text-center">

                                            <div
                                                class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-600 text-3xl font-bold text-white">

                                                {{ $tenantInitial }}

                                            </div>

                                            <h3 class="mt-5 text-xl font-semibold text-gray-800">

                                                {{ $purchase->tenant_name }}

                                            </h3>

                                            <span
                                                class="mt-3 inline-flex rounded-full bg-green-100 px-4 py-1 text-sm font-semibold text-green-700">

                                                Active Tenant

                                            </span>

                                        </div>

                                    </div>

                                    <!-- Right Details -->

                                    <div class="lg:col-span-8">

                                        <div class="grid md:grid-cols-2 gap-x-10 gap-y-6">

                                            <!-- Tenant Name -->

                                            <div>

                                                <p class="uppercase text-xs tracking-widest font-bold text-gray-500">
                                                    Tenant Name
                                                </p>

                                                <p class="mt-2 text-gray-800 font-medium">

                                                    {{ $purchase->tenant_name ?: '-' }}

                                                </p>

                                            </div>

                                            <!-- Phone -->

                                            <div>

                                                <p class="uppercase text-xs tracking-widest font-bold text-gray-500">
                                                    Phone Number
                                                </p>

                                                <p class="mt-2 text-gray-800">

                                                    {{ $purchase->tenant_phone ?: '-' }}

                                                </p>

                                            </div>

                                            <!-- Email -->

                                            <div class="md:col-span-2">

                                                <p class="uppercase text-xs tracking-widest font-bold text-gray-500">
                                                    Email Address
                                                </p>

                                                <div
                                                    class="mt-2 flex items-center gap-3 rounded-lg border bg-gray-50 p-4">

                                                    <x-heroicon-o-envelope class="h-5 w-5 text-blue-600" />

                                                    <span class="text-gray-800">

                                                        {{ $purchase->tenant_email ?: '-' }}

                                                    </span>

                                                </div>

                                            </div>

                                            <!-- Status -->

                                            <div>

                                                <p class="uppercase text-xs tracking-widest font-bold text-gray-500">
                                                    Tenant Status
                                                </p>

                                                <span
                                                    class="mt-2 inline-flex rounded-full bg-green-100 px-4 py-1 text-sm font-semibold text-green-700">

                                                    Verified

                                                </span>

                                            </div>

                                            <!-- Property -->

                                            <div>

                                                <p class="uppercase text-xs tracking-widest font-bold text-gray-500">
                                                    Occupying Property
                                                </p>

                                                <p class="mt-2 text-gray-800">

                                                    {{ $purchase->door_no }},
                                                    {{ $purchase->address_one }}

                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    @endif


                    <!-- ===========================================
     Billing Details
============================================ -->

                    <div class="dashboard-card rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">

                        <!-- Header -->

                        <div class="flex items-center gap-3 px-6 py-4 bg-blue-50 border-b">

                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">

                                <x-heroicon-o-credit-card class="w-6 h-6 text-blue-700" />

                            </div>

                            <div>

                                <h2 class="text-xl font-semibold text-blue-700">

                                    Billing Details

                                </h2>

                                <p class="text-sm text-gray-500">

                                    Invoice and billing information

                                </p>

                            </div>

                        </div>

                        <!-- Body -->

                        <div class="p-6">

                            <div class="grid lg:grid-cols-2 gap-6">

                                <!-- Billing Contact -->

                                <div class="rounded-xl border border-gray-200 p-6">

                                    <h3 class="text-lg font-semibold text-gray-800 mb-6">

                                        Billing Contact

                                    </h3>

                                    <div class="space-y-5">

                                        <div class="flex items-start gap-4">

                                            <div
                                                class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">

                                                <x-heroicon-o-user class="h-5 w-5 text-blue-700" />

                                            </div>

                                            <div>

                                                <p class="text-xs uppercase tracking-widest font-bold text-gray-500">
                                                    Billing Name
                                                </p>

                                                <p class="mt-1 text-gray-800 font-medium">

                                                    {{ $purchase->invoice->billing_name ?? '-' }}

                                                </p>

                                            </div>

                                        </div>

                                        <div class="flex items-start gap-4">

                                            <div
                                                class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">

                                                <x-heroicon-o-envelope class="h-5 w-5 text-green-700" />

                                            </div>

                                            <div>

                                                <p class="text-xs uppercase tracking-widest font-bold text-gray-500">
                                                    Email Address
                                                </p>

                                                <p class="mt-1 text-gray-800">

                                                    {{ $purchase->invoice->billing_email ?? '-' }}

                                                </p>

                                            </div>

                                        </div>

                                        <div class="flex items-start gap-4">

                                            <div
                                                class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">

                                                <x-heroicon-o-phone class="h-5 w-5 text-yellow-700" />

                                            </div>

                                            <div>

                                                <p class="text-xs uppercase tracking-widest font-bold text-gray-500">
                                                    Phone Number
                                                </p>

                                                <p class="mt-1 text-gray-800">

                                                    {{ $purchase->invoice->billing_phone ?? '-' }}

                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-- Billing Address -->

                                <div class="rounded-xl border border-gray-200 p-6">

                                    <h3 class="text-lg font-semibold text-gray-800 mb-6">

                                        Billing Address

                                    </h3>

                                    @php

                                        $billingAddress = implode(
                                            ', ',
                                            array_filter([
                                                $purchase->invoice->billing_address_one ?? '',
                                                $purchase->invoice->billing_address_two ?? '',
                                                $purchase->invoice->billing_postcode ?? '',
                                            ]),
                                        );

                                    @endphp

                                    <div class="rounded-lg bg-gray-50 border p-5">

                                        <div class="flex gap-4">

                                            <div
                                                class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">

                                                <x-heroicon-o-map-pin class="h-5 w-5 text-red-700" />

                                            </div>

                                            <div>

                                                <p class="text-xs uppercase tracking-widest font-bold text-gray-500">

                                                    Registered Billing Address

                                                </p>

                                                <p class="mt-2 leading-7 text-gray-700">

                                                    {{ $billingAddress ?: '-' }}

                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ===========================================
     Policy Documents
============================================ -->

                    <div class="dashboard-card rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">

                        <!-- Header -->

                        <div class="flex items-center gap-3 px-6 py-4 bg-blue-50 border-b">

                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">

                                <x-heroicon-o-folder-open class="w-6 h-6 text-blue-700" />

                            </div>

                            <div>

                                <h2 class="text-xl font-semibold text-blue-700">
                                    Policy Documents
                                </h2>

                                <p class="text-sm text-gray-500">
                                    Download all policy related documents
                                </p>

                            </div>

                        </div>

                        <div class="p-6">

                            <!-- Static Documents -->

                            <div>

                                <div class="flex items-center justify-between mb-5">

                                    <h3 class="text-lg font-semibold text-gray-800">

                                        Static Documents

                                    </h3>

                                    <span
                                        class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">

                                        {{ $purchase->insurance->staticdocuments->count() }}

                                    </span>

                                </div>

                                @if ($purchase->insurance && $purchase->insurance->staticdocuments->count())

                                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">

                                        @foreach ($purchase->insurance->staticdocuments as $doc)
                                            <div
                                                class="rounded-xl border border-gray-200 hover:border-blue-500 hover:shadow-lg transition duration-300">

                                                <div class="p-5">

                                                    <div class="flex items-center gap-4">

                                                        <div
                                                            class="h-14 w-14 rounded-xl bg-red-100 flex items-center justify-center">

                                                            <svg class="w-8 h-8 text-red-600" fill="currentColor"
                                                                viewBox="0 0 24 24">

                                                                <path
                                                                    d="M7 2h7l5 5v15a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" />

                                                            </svg>

                                                        </div>

                                                        <div>

                                                            <h4 class="font-semibold text-gray-800">

                                                                {{ $doc->title }}

                                                            </h4>

                                                            <p class="text-sm text-gray-500">

                                                                PDF Document

                                                            </p>

                                                        </div>

                                                    </div>

                                                    <a href="{{ asset('uploads/insurance_document/' . $doc->document) }}"
                                                        target="_blank"
                                                        class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 transition">

                                                        <x-heroicon-o-arrow-down-tray class="w-5 h-5" />

                                                        Download

                                                    </a>

                                                </div>

                                            </div>
                                        @endforeach

                                    </div>
                                @else
                                    <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center">

                                        <x-heroicon-o-document class="mx-auto h-12 w-12 text-gray-400" />

                                        <p class="mt-3 text-gray-500">

                                            No Static Documents Available

                                        </p>

                                    </div>

                                @endif

                            </div>

                            <!-- Divider -->

                            <div class="my-10 border-t"></div>

                            <!-- Dynamic Documents -->

                            <div>

                                <div class="flex items-center justify-between mb-5">

                                    <h3 class="text-lg font-semibold text-gray-800">

                                        Dynamic Documents

                                    </h3>

                                    <span
                                        class="rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">

                                        {{ $purchase->insurance->dynamicdocument->count() }}

                                    </span>

                                </div>

                                @if ($purchase->insurance->dynamicdocument->count())

                                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">

                                        @foreach ($purchase->insurance->dynamicdocument as $document)
                                            <div
                                                class="rounded-xl border border-gray-200 hover:border-green-500 hover:shadow-lg transition">

                                                <div class="p-5">

                                                    <div class="flex items-center gap-4">

                                                        <div
                                                            class="h-14 w-14 rounded-xl bg-green-100 flex items-center justify-center">

                                                            <x-heroicon-o-document-text
                                                                class="w-8 h-8 text-green-700" />

                                                        </div>

                                                        <div>

                                                            <h4 class="font-semibold text-gray-800">

                                                                {{ $document->title }}

                                                            </h4>

                                                            <p class="text-sm text-gray-500">

                                                                Generated Document

                                                            </p>

                                                        </div>

                                                    </div>

                                                    <a href="{{ route('insurance.document.download', ['purchase_id' => $purchase->id, 'document_id' => $document->id]) }}"
                                                        target="_blank"
                                                        class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 transition">

                                                        <x-heroicon-o-arrow-down-tray class="w-5 h-5" />

                                                        Download

                                                    </a>

                                                </div>

                                            </div>
                                        @endforeach

                                    </div>
                                @else
                                    <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center">

                                        <x-heroicon-o-document class="mx-auto h-12 w-12 text-gray-400" />

                                        <p class="mt-3 text-gray-500">

                                            No Dynamic Documents Available

                                        </p>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>


                    <!-- ===========================================
     Action Center
============================================ -->

                    <div class="dashboard-card rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">

                        <!-- Header -->

                        <div class="flex items-center gap-3 px-6 py-4 bg-blue-50 border-b">

                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">

                                <x-heroicon-o-document-duplicate class="w-6 h-6 text-blue-700" />

                            </div>

                            <div>

                                <h2 class="text-xl font-semibold text-blue-700">

                                    Action Center

                                </h2>

                                <p class="text-sm text-gray-500">

                                    Download invoice and manage your insurance policy

                                </p>

                            </div>

                        </div>

                        <!-- Body -->

                        <div class="p-8">

                            <div class="grid lg:grid-cols-2 gap-8">

                                <!-- Invoice Card -->

                                <div
                                    class="rounded-xl border border-blue-200 bg-gradient-to-r from-blue-50 to-white p-6">

                                    <div class="flex items-start gap-5">

                                        <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-blue-600">

                                            <x-heroicon-o-document-text class="h-8 w-8 text-white" />

                                        </div>

                                        <div>

                                            <h3 class="text-xl font-semibold text-gray-800">

                                                Insurance Invoice

                                            </h3>

                                            <p class="mt-2 text-sm leading-6 text-gray-500">

                                                Download your official invoice in PDF format.
                                                This document contains complete payment details
                                                and policy information.

                                            </p>

                                        </div>

                                    </div>

                                    <a href="{{ route('insurance.invoice.genarate', $purchase->id) }}"
                                        target="_blank"
                                        class="mt-6 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700 transition">

                                        <x-heroicon-o-arrow-down-tray class="w-5 h-5" />

                                        Download Invoice

                                    </a>

                                </div>

                                <!-- Quick Actions -->

                                {{-- <div class="rounded-xl border border-gray-200 bg-gray-50 p-6">

                                    <h3 class="text-lg font-semibold text-gray-800 mb-6">

                                        Quick Actions

                                    </h3>

                                    <div class="grid grid-cols-2 gap-4">

                                        <!-- Print -->

                                        <button onclick="window.print()"
                                            class="rounded-lg border border-gray-300 bg-white p-4 hover:border-blue-500 hover:bg-blue-50 transition">

                                            <x-heroicon-o-printer class="mx-auto h-7 w-7 text-blue-600" />

                                            <p class="mt-3 font-medium">

                                                Print

                                            </p>

                                        </button>

                                        <!-- Download -->

                                        <a href="{{ route('insurance.invoice.genarate', $purchase->id) }}"
                                            target="_blank"
                                            class="rounded-lg border border-gray-300 bg-white p-4 hover:border-green-500 hover:bg-green-50 transition text-center">

                                            <x-heroicon-o-arrow-down-tray class="mx-auto h-7 w-7 text-green-600" />

                                            <p class="mt-3 font-medium">

                                                Download

                                            </p>

                                        </a>

                                        <!-- Back -->

                                        <a href="{{ url()->previous() }}"
                                            class="rounded-lg border border-gray-300 bg-white p-4 hover:border-yellow-500 hover:bg-yellow-50 transition text-center">

                                            <x-heroicon-o-arrow-left class="mx-auto h-7 w-7 text-yellow-600" />

                                            <p class="mt-3 font-medium">

                                                Back

                                            </p>

                                        </a>

                                        <!-- Process -->

                                        <button
                                            class="rounded-lg border border-gray-300 bg-white p-4 hover:border-purple-500 hover:bg-purple-50 transition">

                                            <x-heroicon-o-check-badge class="mx-auto h-7 w-7 text-purple-600" />

                                            <p class="mt-3 font-medium">

                                                Process

                                            </p>

                                        </button>

                                    </div>

                                </div> --}}

                            </div>

                        </div>

                    </div>

                    <div class="flex flex-wrap justify-end gap-4 mt-8">

                        {{-- <a href="{{ url()->previous() }}"
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-3 font-medium text-gray-700 shadow-sm hover:bg-gray-100">

                            <x-heroicon-o-arrow-left class="w-5 h-5" />

                            Back

                        </a>

                        <button onclick="window.print()"
                            class="inline-flex items-center gap-2 rounded-lg bg-gray-700 px-6 py-3 font-medium text-white shadow hover:bg-gray-800">

                            <x-heroicon-o-printer class="w-5 h-5" />

                            Print Policy

                        </button>

                        <a href="{{ route('insurance.invoice.genarate', $purchase->id) }}" target="_blank"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 font-medium text-white shadow hover:bg-blue-700">

                            <x-heroicon-o-arrow-down-tray class="w-5 h-5" />

                            Download Invoice

                        </a> --}} 

                        <a href="" target="_blank"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 font-medium text-white shadow hover:bg-blue-700">

                            <x-heroicon-o-check-badge class="w-5 h-5" />

                            Process

                        </a>

                        {{-- <button
                            class="rounded-lg border border-gray-300 bg-white p-4 hover:border-purple-500 hover:bg-purple-50 transition">

                            <x-heroicon-o-check-badge class="mx-auto h-7 w-7 text-purple-600" />

                            <p class="mt-3 font-medium">

                                Process

                            </p>

                        </button> --}}

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
