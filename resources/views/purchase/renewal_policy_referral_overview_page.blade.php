<x-app-layout>

<style>
    /* Premium Corporate — Referral Policy Overview */
    .referral-overview-page {
        min-height: 100vh;
        padding: 2rem 0 3.5rem;
        background:
            radial-gradient(circle at 8% 0%, rgba(219,234,254,.75), transparent 28rem),
            linear-gradient(135deg, #f8fafc 0%, #eef4fb 52%, #f8fafc 100%);
    }
    .referral-overview-page .referral-page-container { max-width: 86rem; }
    .referral-overview-page .referral-page-title {
        display:flex; align-items:flex-start; gap:1rem; margin-bottom:1.75rem;
    }
    .referral-overview-page .referral-title-icon {
        display:flex; align-items:center; justify-content:center; flex-shrink:0;
        width:3.25rem; height:3.25rem; border-radius:1rem; color:#fff;
        background:linear-gradient(145deg,#173b70,#2563a8);
        box-shadow:0 10px 22px rgba(30,64,120,.18);
    }
    .referral-overview-page .referral-page-title h1 {
        margin:0; color:#10233f; font-size:clamp(1.65rem,2.5vw,2.15rem);
        font-weight:800; letter-spacing:-.035em; line-height:1.2;
    }
    .referral-overview-page .referral-page-title p { margin-top:.5rem; max-width:48rem; color:#64748b; line-height:1.65; }
    .referral-overview-page .referral-main-card {
        overflow:hidden; border:1px solid #dce5f0; border-radius:1.4rem;
        background:#fff; box-shadow:0 24px 65px rgba(15,35,65,.09);
    }
    .referral-overview-page .referral-main-header {
        position:relative; overflow:hidden; padding:2rem 2.25rem;
        color:#fff; background:linear-gradient(115deg,#10294b 0%,#17477b 58%,#2563a8 100%);
    }
    .referral-overview-page .referral-main-header:after {
        content:""; position:absolute; width:17rem; height:17rem; right:-5rem; top:-9rem;
        border:1px solid rgba(255,255,255,.16); border-radius:50%;
        box-shadow:0 0 0 2rem rgba(255,255,255,.035),0 0 0 4rem rgba(255,255,255,.025);
        pointer-events:none;
    }
    .referral-overview-page .referral-main-header h2 { position:relative; z-index:1; font-size:clamp(1.25rem,2vw,1.7rem); font-weight:750; letter-spacing:-.025em; }
    .referral-overview-page .referral-main-header p { position:relative; z-index:1; color:#dbeafe; }
    .referral-overview-page .referral-policy-number {
        display:inline-flex; align-items:center; gap:.5rem; margin-top:.85rem; padding:.45rem .8rem;
        border:1px solid rgba(255,255,255,.22); border-radius:.65rem; background:rgba(255,255,255,.09);
        font-size:.875rem;
    }
    .referral-overview-page .referral-main-body { padding:clamp(1rem,3vw,2.25rem); }
    .referral-overview-page .dashboard-card {
        border:1px solid #e0e8f2 !important; border-radius:1rem !important;
        background:#fff; box-shadow:0 5px 18px rgba(15,35,65,.035) !important;
        transition:border-color .2s ease, box-shadow .2s ease;
    }
    .referral-overview-page .dashboard-card:hover { border-color:#c5d7eb !important; box-shadow:0 10px 26px rgba(15,35,65,.065) !important; }
    .referral-overview-page .dashboard-card > .flex.items-center.gap-3.px-6.py-4 {
        padding:1.15rem 1.4rem !important; background:linear-gradient(90deg,#f0f6fd,#f8fbff) !important;
        border-bottom:1px solid #e2eaf4 !important;
    }
    .referral-overview-page .dashboard-card > .flex.items-center.gap-3.px-6.py-4 h2 {
        color:#173b68 !important; font-size:1.02rem !important; font-weight:750 !important; letter-spacing:-.01em;
    }
    .referral-overview-page .dashboard-card > .flex.items-center.gap-3.px-6.py-4 p { margin-top:.2rem; color:#718096 !important; font-size:.82rem; }
    .referral-overview-page .dashboard-card > .flex.items-center.gap-3.px-6.py-4 .rounded-full {
        width:2.65rem; height:2.65rem; border-radius:.8rem !important; background:#dcecff !important;
    }
    .referral-overview-page .dashboard-card > .p-6 { padding:clamp(1rem,2.3vw,1.6rem) !important; }
    .referral-overview-page .dashboard-card .uppercase.text-xs { color:#718096 !important; font-size:.68rem !important; letter-spacing:.095em; }
    .referral-overview-page .dashboard-card .font-medium.text-gray-800,
    .referral-overview-page .dashboard-card .font-semibold.text-gray-800 { color:#1e293b !important; font-weight:650; overflow-wrap:anywhere; }
    .referral-overview-page .dashboard-card .text-gray-500 { color:#64748b !important; }
    .referral-overview-page .dashboard-card .border-t { border-color:#edf2f7 !important; }
    .referral-overview-page .referral-action-footer {
        display:flex; justify-content:flex-end; gap:.75rem; flex-wrap:wrap;
        padding:1.35rem clamp(1rem,3vw,2.25rem); border-top:1px solid #e6edf5; background:#f8fafc;
    }
    .referral-overview-page .referral-process-button {
        display:inline-flex; align-items:center; justify-content:center; gap:.6rem;
        padding:.85rem 1.25rem; border:1px solid #1d4f91; border-radius:.75rem;
        color:#fff; font-weight:700; text-decoration:none;
        background:linear-gradient(135deg,#1d4f91,#2563b8); box-shadow:0 7px 16px rgba(37,99,184,.2);
        transition:transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }
    .referral-overview-page .referral-process-button:hover { color:#fff; filter:brightness(1.06); transform:translateY(-1px); box-shadow:0 10px 22px rgba(37,99,184,.26); }
    .referral-overview-page .referral-process-button:focus-visible { outline:3px solid #93c5fd; outline-offset:3px; }
    @media(max-width:640px) {
        .referral-overview-page { padding-top:1.25rem; }
        .referral-overview-page .referral-main-header { padding:1.35rem 1.2rem; }
        .referral-overview-page .referral-page-title { gap:.75rem; }
        .referral-overview-page .referral-title-icon { width:2.75rem; height:2.75rem; border-radius:.8rem; }
        .referral-overview-page .referral-action-footer > * { width:100%; }
    }
    @media print {
        .referral-overview-page { padding:0; background:#fff; }
        .referral-overview-page .referral-main-card, .referral-overview-page .dashboard-card { box-shadow:none !important; }
        .referral-overview-page .referral-action-footer { display:none !important; }
    }
</style>


    <div class="referral-overview-page">
        {{-- <div class="grid grid-cols-12 gap-4 md:gap-6"> --}}

        <div class="referral-page-container max-w-7xl mx-auto px-5">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-300 bg-green-50 px-5 py-4 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Page Heading -->

            <div class="referral-page-title">
                <div class="referral-title-icon">
                    <x-heroicon-o-shield-check class="h-7 w-7" />
                </div>
                <div>
                    <h1>Referral Policy Overview</h1>
                    <p>Review policy information, purchase details, property and customer records in one place.</p>
                </div>
            </div>

            <!-- Main Card -->

            <div class="referral-main-card">

                <!-- Top Blue Header -->

                <div class="referral-main-header">

                    <div class="flex justify-between items-center">

                        <div>

                            <h2 class="text-2xl font-semibold text-white">

                                Referral Insurance Purchase Details

                            </h2>

                            <div class="referral-policy-number">
                                <span class="font-medium">Referral Policy Number</span>
                                <strong>{{ $referralPurchase->policy_no ?? '—' }}</strong>
                            </div>

                        </div>

                        {{-- <div>

                            <span class="px-4 py-2 rounded-full bg-white/20 text-white font-semibold">

                                Active Policy

                            </span>

                        </div> --}}

                    </div>

                </div>

                <!-- Page Content -->

                <div class="referral-main-body space-y-7">

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
                                    Referral Policy Information
                                </h2>

                                <p class="text-sm text-gray-500">
                                    Basic referral insurance policy information
                                </p>

                            </div>

                        </div>

                        <!-- Card Body -->

                        <div class="p-6">

                            <div class="grid md:grid-cols-2 gap-x-14 gap-y-5">

                                <!-- Policy Number -->

                                {{-- <div class="flex">

                                    <div class="w-48">

                                        <p class="text-sm font-semibold text-gray-600">
                                            Policy Number
                                        </p>

                                    </div>

                                    <div>

                                        <p class="text-gray-800">
                                            {{ $referralPurchase->policy_no }}
                                        </p>

                                    </div>

                                </div> --}}

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
                                        {{ $referralPurchase->insurance->name }}
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

                                            £{{ number_format($referralPurchase->rent_amount ?? 0, 2) }}

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

                                            {{ $referralPurchase->insurance->provider->name ?? '-' }}

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

                                            {{ $referralPurchase->insurance->type_of_insurance ?? '-' }}

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
                                    Referral Purchase Details
                                </h2>

                                <p class="text-sm text-gray-500">
                                    Referral policy purchase information and important dates
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
                                            {{ \Carbon\Carbon::parse($referralPurchase->purchase_date)->format('d M Y') }}
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
                                            {{ \Carbon\Carbon::parse($referralPurchase->policy_start_date)->format('d M Y') }}
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
                                            {{ \Carbon\Carbon::parse($referralPurchase->policy_end_date)->format('d M Y') }}
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
                                            {{ \Carbon\Carbon::parse($referralPurchase->ast_start_date)->format('d M Y') }}
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
                                            $start = \Carbon\Carbon::parse($referralPurchase->policy_start_date);
                                            $end = \Carbon\Carbon::parse($referralPurchase->policy_end_date);
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
                                $referralPurchase->door_no,
                                $referralPurchase->address_one,
                                $referralPurchase->address_two,
                                $referralPurchase->address_three,
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

                                                {{ $referralPurchase->post_code }}

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

                                        {{ $referralPurchase->door_no ?: '-' }}

                                    </p>

                                </div>

                                <!-- Post Code -->

                                <div>

                                    <p class="uppercase text-xs tracking-widest font-bold text-gray-500">

                                        Post Code

                                    </p>

                                    <span
                                        class="inline-flex mt-2 rounded-full bg-blue-100 px-4 py-1 text-sm font-semibold text-blue-700">

                                        {{ $referralPurchase->post_code }}

                                    </span>

                                </div>

                                <!-- Address One -->

                                <div>

                                    <p class="uppercase text-xs tracking-widest font-bold text-gray-500">

                                        Address Line 1

                                    </p>

                                    <p class="mt-2 text-gray-800">

                                        {{ $referralPurchase->address_one ?: '-' }}

                                    </p>

                                </div>

                                <!-- Address Two -->

                                <div>

                                    <p class="uppercase text-xs tracking-widest font-bold text-gray-500">

                                        Address Line 2

                                    </p>

                                    <p class="mt-2 text-gray-800">

                                        {{ $referralPurchase->address_two ?: '-' }}

                                    </p>

                                </div>

                                <!-- Address Three -->

                                <div class="md:col-span-2">

                                    <p class="uppercase text-xs tracking-widest font-bold text-gray-500">

                                        Address Line 3

                                    </p>

                                    <p class="mt-2 text-gray-800">

                                        {{ $referralPurchase->address_three ?: '-' }}

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ===========================================
     Landlord / Agency Details
============================================ -->

                    @php

                        if ($referralPurchase->policy_holder_type == 'Company') {
                            $displayName = $referralPurchase->company_name;
                        } elseif ($referralPurchase->policy_holder_type == 'Individual') {
                            $displayName = trim(
                                ($referralPurchase->policy_holder_title ?? '') .
                                    ' ' .
                                    ($referralPurchase->policy_holder_fname ?? '') .
                                    ' ' .
                                    ($referralPurchase->policy_holder_lname ?? ''),
                            );
                        } else {
                            $displayName = $referralPurchase->company_name;
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

                                            {{ $referralPurchase->policy_holder_type }}

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

                                                {{ $referralPurchase->company_name ?: '-' }}

                                            </p>

                                        </div>

                                        <!-- Full Name -->

                                        <div>

                                            <p class="uppercase text-xs font-bold tracking-widest text-gray-500">

                                                Contact Person

                                            </p>

                                            <p class="mt-2 text-gray-800">

                                                {{ trim(($referralPurchase->policy_holder_title ?? '') . ' ' . ($referralPurchase->policy_holder_fname ?? '') . ' ' . ($purchase->policy_holder_lname ?? '')) ?: '-' }}

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

                                                        {{ $referralPurchase->policy_holder_address ?: 'N/A' }}

                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    @if (!empty($referralPurchase->tenant_name || $referralPurchase->tenant_email || $referralPurchase->tenant_phone))
                        @php
                            $tenantInitial = strtoupper(substr($referralPurchase->tenant_name ?? 'T', 0, 1));
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

                                                {{ $referralPurchase->tenant_name }}

                                            </h3>

                                            {{-- <span
                                                class="mt-3 inline-flex rounded-full bg-green-100 px-4 py-1 text-sm font-semibold text-green-700">

                                                Active Tenant

                                            </span> --}}

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

                                                    {{ $referralPurchase->tenant_name ?: '-' }}

                                                </p>

                                            </div>

                                            <!-- Phone -->

                                            <div>

                                                <p class="uppercase text-xs tracking-widest font-bold text-gray-500">
                                                    Phone Number
                                                </p>

                                                <p class="mt-2 text-gray-800">

                                                    {{ $referralPurchase->tenant_phone ?: '-' }}

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

                                                        {{ $referralPurchase->tenant_email ?: '-' }}

                                                    </span>

                                                </div>

                                            </div>

                                            <!-- Status -->
                                            {{-- 
                                            <div>

                                                <p class="uppercase text-xs tracking-widest font-bold text-gray-500">
                                                    Tenant Status
                                                </p>

                                                <span
                                                    class="mt-2 inline-flex rounded-full bg-green-100 px-4 py-1 text-sm font-semibold text-green-700">

                                                    Verified

                                                </span>

                                            </div> --}}

                                            <!-- Property -->

                                            <div>

                                                <p class="uppercase text-xs tracking-widest font-bold text-gray-500">
                                                    Occupying Property
                                                </p>

                                                <p class="mt-2 text-gray-800">

                                                    {{-- {{ $referralPurchase->door_no }},
                                                    {{ $referralPurchase->address_one }} --}}

                                                    {{ collect([$referralPurchase->door_no, $referralPurchase->address_one])->filter()->implode(', ') }}

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

                                                    {{ $referralPurchase->invoice->billing_name ?? '-' }}

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

                                                    {{ $referralPurchase->invoice->billing_email ?? '-' }}

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

                                                    {{ $referralPurchase->invoice->billing_phone ?? '-' }}

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
                                                $referralPurchase->invoice->billing_address_one ?? '',
                                                $referralPurchase->invoice->billing_address_two ?? '',
                                                $referralPurchase->invoice->billing_postcode ?? '',
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

                    {{-- <div class="dashboard-card rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">

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

                            <div>

                                <div class="flex items-center justify-between mb-5">

                                    <h3 class="text-lg font-semibold text-gray-800">

                                        Static Documents

                                    </h3>

                                    <span
                                        class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">

                                        {{ $referralPurchase->insurance->staticdocuments->count() }}

                                    </span>

                                </div>

                                @if ($referralPurchase->insurance && $referralPurchase->insurance->staticdocuments->count())

                                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">

                                        @foreach ($referralPurchase->insurance->staticdocuments as $doc)
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

                            <div class="my-10 border-t"></div>

                            <div>

                                <div class="flex items-center justify-between mb-5">

                                    <h3 class="text-lg font-semibold text-gray-800">

                                        Dynamic Documents

                                    </h3>

                                    <span
                                        class="rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">

                                        {{ $referralPurchase->insurance->dynamicdocument->count() }}

                                    </span>

                                </div>

                                @if ($referralPurchase->insurance->dynamicdocument->count())

                                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">

                                        @foreach ($referralPurchase->insurance->dynamicdocument as $document)
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

                                                    <a href="{{ route('insurance.document.download', ['purchase_id' => $referralPurchase->id, 'document_id' => $document->id]) }}"
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

                    </div> --}}


                    <!-- ===========================================
                        Action Center
                    ============================================ -->

                    {{-- <div class="dashboard-card rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">

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


                        <div class="p-8">

                            <div class="grid lg:grid-cols-2 gap-8">

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

                                    <a href="{{ route('insurance.invoice.genarate', $referralPurchase->id) }}"
                                        target="_blank"
                                        class="mt-6 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700 transition">

                                        <x-heroicon-o-arrow-down-tray class="w-5 h-5" />

                                        Download Invoice

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div> --}}

                    <div class="referral-action-footer">

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

                        <a href="{{ route('insurance.invoice.genarate', $referralPurchase->id) }}" target="_blank"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 font-medium text-white shadow hover:bg-blue-700">

                            <x-heroicon-o-arrow-down-tray class="w-5 h-5" />

                            Download Invoice

                        </a> --}}

                        {{-- <a href="{{ route('renewal.insurance.policyreferral', $referralPurchase->id) }}" target="_blank"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 font-medium text-white shadow hover:bg-blue-700">

                            <x-heroicon-o-check-badge class="w-5 h-5" />

                            Process


                        </a> --}}

                        <a href="{{ route('renewal.insurance.policyreferral', $referralPurchase->id) }}"
                            target="_blank"
                            class="referral-process-button">
                            <x-heroicon-o-check-badge class="w-5 h-5" />
                            <span>Process</span>
                            <x-heroicon-o-arrow-right class="w-4 h-4" />
                        </a> 

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
