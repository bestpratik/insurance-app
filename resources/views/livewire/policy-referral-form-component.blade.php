<div>
    @if ($successMessage)
        <div class="bg-green-100 text-green-800 p-3 rounded mb-3">
            {{ $successMessage }}
        </div>
    @endif
    <section class="my-16">
        <div class="max-w-7xl mx-auto rounded-md p-2">
            <div class="relative">
                <button id="scrollLeft"
                    class="absolute left-0 top-0 bottom-0 z-10 px-2 hidden md:flex items-center bg-red-600 text-white shadow-md rounded-l-md hover:bg-red-700 transition">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="scrollRight"
                    class="absolute right-0 top-0 bottom-0 z-10 px-2 hidden md:flex items-center bg-red-600 text-white shadow-md rounded-r-md hover:bg-red-700 transition">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div id="tabWrapper" class="overflow-x-auto no-scrollbar">
                    <nav id="tabMenu" class="flex whitespace-nowrap space-x-1 md:space-x-2 border-b px-6 py-2">
                        <!-- Tab Button Template -->

                        <a href="#" data-tab="tab1"
                            class="tab-btn flex items-center text-center px-4 py-2 font-medium 
                                @if($currentStep === 1)
                                    border-b-2 border-red-500 text-red-600
                                @else
                                    text-gray-600 hover:text-red-600 hover:border-b-2 hover:border-red-500
                                @endif">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                            <span class="text-sm hidden md:inline ml-1">Insurances</span>
                        </a>

                        <a href="#" data-tab="tab2"
                            class="tab-btn flex items-center text-center px-4 py-2 font-medium 
                                @if($currentStep === 2)
                                    border-b-2 border-red-500 text-red-600
                                @else
                                    text-gray-600 hover:text-red-600 hover:border-b-2 hover:border-red-500
                                @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="text-sm hidden md:inline ml-1">Property Info</span>
                        </a>

                        <a href="#" data-tab="tab3"
                            class="tab-btn flex items-center text-center px-4 py-2 font-medium 
                                @if($currentStep === 3)
                                    border-b-2 border-red-500 text-red-600
                                @else
                                    text-gray-600 hover:text-red-600 hover:border-b-2 hover:border-red-500
                                @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <span class="text-sm hidden md:inline ml-1">Policy Holder Info</span>
                        </a>

                        <a href="#" data-tab="tab4"
                            class="tab-btn flex items-center text-center px-4 py-2 font-medium 
                                @if($currentStep === 4)
                                    border-b-2 border-red-500 text-red-600
                                @else
                                    text-gray-600 hover:text-red-600 hover:border-b-2 hover:border-red-500
                                @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            <span class="text-sm hidden md:inline ml-1">Policy Details</span>
                        </a>

                        <a href="#" data-tab="tab5"
                            class="tab-btn flex items-center text-center px-4 py-2 font-medium 
                                @if($currentStep === 5)
                                    border-b-2 border-red-500 text-red-600
                                @else
                                    text-gray-600 hover:text-red-600 hover:border-b-2 hover:border-red-500
                                @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            <span class="text-sm hidden md:inline ml-1">Tenant Details</span>
                        </a>

                        <!-- <a href="#" data-tab="tab6"
                            class="tab-btn flex items-center text-center px-4 py-2 font-medium 
                                @if($currentStep === 6)
                                    border-b-2 border-red-500 text-red-600
                                @else
                                    text-gray-600 hover:text-red-600 hover:border-b-2 hover:border-red-500
                                @endif">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path
                                    d="M3.75 6.75h16.5a.75.75 0 0 1 .75.75v9a.75.75 0 0 1-.75.75H3.75a.75.75 0 0 1-.75-.75v-9a.75.75 0 0 1 .75-.75zM3 9.75h18" />
                            </svg>
                            <span class="text-sm hidden md:inline ml-1">Payment Method</span>
                        </a> -->

                        <a href="#" data-tab="tab6"
                            class="tab-btn flex items-center text-center px-4 py-2 font-medium 
                                @if($currentStep === 6)
                                    border-b-2 border-red-500 text-red-600
                                @else
                                    text-gray-600 hover:text-red-600 hover:border-b-2 hover:border-red-500
                                @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                            <span class="text-sm hidden md:inline ml-1">Billing Information</span>
                        </a>

                        <a href="#" data-tab="tab7"
                            class="tab-btn flex items-center text-center px-4 py-2 font-medium 
                                @if($currentStep === 7)
                                    border-b-2 border-red-500 text-red-600
                                @else
                                    text-gray-600 hover:text-red-600 hover:border-b-2 hover:border-red-500
                                @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>
                            <span class="text-sm hidden md:inline ml-1">Summary</span>
                        </a>
                    </nav>
                </div>

            </div>
            <!-- TAB CONTENTS -->
            @if($currentStep === 1)
            <div id="tab1" class="tab-content bg-white p-6 rounded shadow">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
                    <!-- Types (Radio Buttons) -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Types <span class="text-red-600 text-lg">*</span>
                        </label>
                        <div class="flex space-x-5">
                            <label class="flex items-center space-x-2 px-3 py-1 rounded-full bg-[#66666610]">
                                <input type="radio" wire:model="productType" class="text-blue-600 focus:ring-blue-500"
                                    value="Landlord">
                                <span>Landlord</span>
                            </label>
                            <label class="flex items-center space-x-2 px-3 py-1 rounded-full bg-[#66666610]">
                                <input type="radio" wire:model="productType" class="text-blue-600 focus:ring-blue-500"
                                    value="Agent">
                                <span>Agent</span>
                            </label>
                            <label class="flex items-center space-x-2 px-3 py-1 rounded-full bg-[#66666610]">
                                <input type="radio" wire:model="productType" class="text-blue-600 focus:ring-blue-500"
                                    value="Others">
                                <span>Others</span>
                            </label>
                        </div>
                        @error('productType')
                        <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Insurances (Dropdown) -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Insurances <span class="text-red-600">*</span>
                        </label>
                        <select wire:model="selectedinsuranceId"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Choose Insurance...</option>
                            @foreach($availableInsurances as $avinsurance)
                            <option value="{{ $avinsurance->id }}">{{ $avinsurance->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedinsuranceId')
                        <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Insurances Required For <span class="text-red-600">*</span>
                        </label>

                        <div class="flex items-center space-x-6">
                            <label for="homeemergency" class="flex items-center space-x-2">
                                <input id="homeemergency" type="radio" wire:model="insurancesRequired" value="Home Emergency"
                                    class="text-blue-600 focus:ring-blue-500">
                                <span>Home Emergency</span>
                            </label>

                            <label for="maliciousdamage" class="flex items-center space-x-2">
                                <input id="maliciousdamage" type="radio" wire:model="insurancesRequired" value="Malicious Damage/Contents"
                                    class="text-blue-600 focus:ring-blue-500">
                                <span>Malicious Damage/Contents</span>
                            </label>

                        </div>

                        @error('insurancesRequired')
                        <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <div class="pt-4 flex justify-end gap-3 border-t mt-6" style="display: none;">
                    <button type="button"
                        class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">

                        <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Save and Next</span>
                    </button>
                </div>
            </div>
            @endif

            @if($currentStep === 2)
            <div id="tab2" class="tab-content bg-white p-6 rounded shadow">
                <div class="grid grid-cols-1 gap-4 mt-5">
                    <!-- Title -->
                    <p class="font-bold mb-1">Can we have the Property that you want insured?</p>

                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="mb-2">
                            <label class="block font-semibold mb-1">
                                Type Of Insurance <span class="text-red-600">*</span>
                            </label>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input id="typeOfinsurancenew" type="radio" wire:model="insuranceType" value="new"
                                        class="mr-1">
                                    <label for="typeOfinsurancenew">New</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="typeOfinsurancerenewal" type="radio" wire:model="insuranceType"
                                        value="renewal" class="mr-1">
                                    <label for="typeOfinsurancerenewal">Renewal</label>
                                </div>
                            </div>
                            @error('insuranceType')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block font-semibold mb-1">
                                Rent Amount (£) <span class="text-red-600">*</span>
                            </label>
                            <input type="text" wire:model="rentAmount"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('rentAmount')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <h5 class="text-lg font-semibold my-3">Property Details</h5>

                    <div class="grid md:grid-cols-3 gap-4">
                        @if($insurancesRequired === 'Malicious Damage/Contents')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-2">
                                <label class="block mb-1">Year of Purchase <span class="text-red-600">*</span></label>
                                <input type="number" placeholder="Enter year..." wire:model="yearOfPurchase"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                                @error('yearOfPurchase')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label class="block mb-1">Year of Build <span class="text-red-600">*</span></label>
                                <input type="number" placeholder="Enter year..." wire:model="yearOfBuild"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                                @error('yearOfBuild')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif



                        <div class="mb-2">
                            <label class="block mb-1">Door No <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="doorNo"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('doorNo')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block mb-1">Address 1 <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter address..." wire:model="addressOne"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('addressOne')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block mb-1">Address 2</label>
                            <input type="text" placeholder="Enter address..." wire:model="addressTwo"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                        </div>

                        <div class="mb-2">
                            <label class="block mb-1">Address 3</label>
                            <input type="text" placeholder="Enter address..." wire:model="addressThree"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                        </div>

                        <div class="mb-2">
                            <label class="block mb-1">Post Code <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="postCode"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('postCode')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="pt-4 flex justify-end gap-3 border-t mt-6" style="display: none;">
                    <button type="button"
                        class="px-4 py-2 bg-black text-white rounded-md shadow hover:bg-gray-900 transition inline-flex items-center gap-2">

                        <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Back</span>
                    </button>
                    <button type="button"
                        class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">

                        <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Save and Next</span>
                    </button>
                </div>
            </div>
            @endif

            {{--
            @if($currentStep === 3)
            <div id="tab3" class="tab-content bg-white p-6 rounded shadow">
                <div class="grid grid-cols-1 gap-4 mt-6" x-data="{ policyHoldertype: @entangle('policyHoldertype') }">
                    <p class="font-bold mb-0">Can we have the policy holder information?</p>
                    <p class="text-gray-700 mb-4">
                        This is the person who will make the claim. If the property is managed, enter the managing
                        agent's
                        information.
                    </p>

                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold mb-1">
                                Policy holder type <span class="text-red-600">*</span>
                            </label>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input id="policyHoldertypeOne" type="radio" x-model="policyHoldertype" value="Company"
                                        class="mr-1">
                                    <label for="policyHoldertypeOne">Company</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="policyHoldertypeTwo" type="radio" x-model="policyHoldertype"
                                        value="Individual" class="mr-1">
                                    <label for="policyHoldertypeTwo">Individual</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="policyHoldertypeThree" type="radio" x-model="policyHoldertype"
                                        value="Both" class="mr-1">
                                    <label for="policyHoldertypeThree">Both</label>
                                </div>
                            </div>
                            @error('policyHoldertype')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Company'">
                            <label class="block mb-1">Company Name <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="companyName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('companyName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div x-show="policyHoldertype === 'Company'">
                            <label class="block mb-1">Company email <span class="text-red-600">*</span></label>
                            <input type="email" placeholder="Enter..." wire:model="policyholderCompanyEmail"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderCompanyEmail')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Individual'">
                            <label class="block font-semibold mb-1">Title <span class="text-red-600">*</span></label>
                            <select wire:model="policyholderTitle"
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring focus:ring-blue-200">
                                <option value="">Select Title</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                                <option value="Miss">Miss</option>
                                <option value="Dr">Dr</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('policyholderTitle')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Individual'">
                            <label class="block mb-1">First Name <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderFirstName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderFirstName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Individual'">
                            <label class="block mb-1">Last Name <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderLastName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderLastName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Individual'">
                            <label class="block mb-1">Contact Email <span class="text-red-600">*</span></label>
                            <input type="email" placeholder="Enter..." wire:model="policyholderEmail"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderEmail')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block font-semibold mb-1">Title</label>
                            <select wire:model="policyholderTitle"
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring focus:ring-blue-200">
                                <option value="">Select Title</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                                <option value="Miss">Miss</option>
                                <option value="Dr">Dr</option>
                                <option value="Other">Other</option>
                            </select>

                        </div>

                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block mb-1">First Name</label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderFirstName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">

                        </div>

                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block mb-1">Last Name</label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderLastName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">

                        </div>

                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block mb-1">Contact Email</label>
                            <input type="email" placeholder="Enter..." wire:model="policyholderEmail"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">

                        </div>

                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block mb-1">Company Name</label>
                            <input type="text" placeholder="Enter..." wire:model="companyName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">

                        </div>
                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block mb-1">Company email</label>
                            <input type="email" placeholder="Enter..." wire:model="policyholderCompanyEmail"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">

                        </div>

                        <div>
                            <label class="block mb-1">Contact Phone <span class="text-red-600">*</span></label>
                            <input type="number" placeholder="Enter..." wire:model="policyholderPhone"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderPhone')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1">Alternative Phone</label>
                            <input type="number" placeholder="Enter..." wire:model="policyholderAlternativePhone"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">

                        </div>

                        <div>
                            <label class="block mb-1">Address1</label>
                            <input type="text" placeholder="Enter address..." wire:model="policyholderAddress1"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label class="block mb-1">Address2</label>
                            <input type="text" placeholder="Enter address..." wire:model="policyholderAddress2"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label class="block mb-1">Postcode<span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderPostcode"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderPostcode')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1">Copy email</label>
                            <p class="text-gray-500" style="font-size: 12px;">Enter email ids, separated by comma, if you need to send documents to additional people other than policy holder</p>
                            <textarea id=""
                                class="w-full px-2 py-1 border rounded-md border-[#66666660] mt-1 h-[42px] flex items-center" wire:model="copyEmail"
                                rows="2"></textarea>

                            <!-- <input type="text" placeholder="Enter..." wire:model="copyEmail"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"> -->

                        </div>





                    </div>
                </div>
                <div class="pt-4 flex justify-end gap-3 border-t mt-6" style="display: none;">
                    <button type="button"
                        class="px-4 py-2 bg-black text-white rounded-md shadow hover:bg-gray-900 transition inline-flex items-center gap-2">

                        <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Back</span>
                    </button>

                    <button type="button"
                        class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">

                        <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Save and Next</span>
                    </button>
                </div>
            </div>
            @endif
            --}}

              @if($currentStep === 3)
            <div id="tab3" class="tab-content bg-white p-6 rounded shadow">
                <div class="grid grid-cols-1 gap-4 mt-6" x-data="{ policyHoldertype: @entangle('policyHoldertype') }">
                    <!-- <p class="font-bold mb-0">Can we have the policy holder information?</p> -->
                    <p class="text-gray-700 mb-4">
                        <!-- This is the person who will make the claim. If the property is managed, enter the managing
                        agent's
                        information. -->

                        This is the person who will make the claim. If the property is managed, enter the managing agent's information and whomever the tenancy agreement is under (Landlord name)
                    </p>

                    <div class="grid md:grid-cols-3 gap-4">
                        @if($productType != 'Agent')
                        <div>
                            <label class="block font-semibold mb-1">
                                Policy holder type <span class="text-red-600">*</span>
                            </label>

                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input id="policyHoldertypeOne" type="radio" x-model="policyHoldertype" value="Company"
                                        class="mr-1">
                                    <label for="policyHoldertypeOne">Company</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="policyHoldertypeTwo" type="radio" x-model="policyHoldertype"
                                        value="Individual" class="mr-1">
                                    <label for="policyHoldertypeTwo">Individual</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="policyHoldertypeThree" type="radio" x-model="policyHoldertype"
                                        value="Both" class="mr-1">
                                    <label for="policyHoldertypeThree">Both</label>
                                </div>
                            </div>

                            @error('policyHoldertype')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif

                        @if(in_array($policyHoldertype, ['Company', 'Both']))
                        <div x-show="policyHoldertype === 'Company'">
                            <label class="block mb-1">Company Name <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="companyName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('companyName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div x-show="policyHoldertype === 'Company'">
                            <label class="block mb-1">Company email <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderCompanyEmail"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderCompanyEmail')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif

                        @if(in_array($policyHoldertype, ['Individual', 'Both']))
                        <div x-show="policyHoldertype === 'Individual'">
                            <label class="block font-semibold mb-1">Title <span class="text-red-600">*</span></label>
                            <select wire:model="policyholderTitle"
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring focus:ring-blue-200">
                                <option value="">Select Title</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                                <option value="Miss">Miss</option>
                                <option value="Dr">Dr</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('policyholderTitle')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Individual'">
                            <label class="block mb-1">First Name <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderFirstName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderFirstName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Individual'">
                            <label class="block mb-1">Last Name <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderLastName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderLastName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Individual'">
                            <label class="block mb-1">Contact Email <span class="text-red-600">*</span></label>
                            <input type="email" placeholder="Enter..." wire:model="policyholderEmail"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderEmail')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block font-semibold mb-1">Title <span class="text-red-600">*</span></label>
                            <select wire:model="policyholderTitle"
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring focus:ring-blue-200">
                                <option value="">Select Title</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                                <option value="Miss">Miss</option>
                                <option value="Dr">Dr</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('policyholderTitle')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block mb-1">First Name <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderFirstName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderFirstName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block mb-1">Last Name <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderLastName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderLastName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block mb-1">Contact Email <span class="text-red-600">*</span></label>
                            <input type="email" placeholder="Enter..." wire:model="policyholderEmail"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderEmail')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block mb-1">Company Name <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="companyName"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('companyName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div x-show="policyHoldertype === 'Both'">
                            <label class="block mb-1">Company email <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderCompanyEmail"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderCompanyEmail')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif

                        <div>
                            <label class="block mb-1">Contact Phone <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderPhone"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderPhone')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1">Alternative Phone</label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderAlternativePhone"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">

                        </div>

                        <div>
                            <label class="block mb-1">Address1</label>
                            <input type="text" placeholder="Enter address..." wire:model="policyholderAddress1"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label class="block mb-1">Address2</label>
                            <input type="text" placeholder="Enter address..." wire:model="policyholderAddress2"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label class="block mb-1">Postcode<span class="text-red-600">*</span></label>
                            <input type="text" placeholder="Enter..." wire:model="policyholderPostcode"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            @error('policyholderPostcode')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1">Copy email</label>

                            <textarea id=""
                                class="w-full px-2 py-1 border rounded-md border-[#66666660] mt-1 h-[42px] flex items-center" wire:model="copyEmail"
                                rows="2"></textarea>
                            <p class="text-gray-500" style="font-size: 12px;">Enter email ids, separated by comma, if you need to send documents to additional people other than policy holder</p>

                            <!-- <input type="text" placeholder="Enter..." wire:model="copyEmail"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"> -->

                        </div>





                    </div>
                </div>
                <div class="pt-4 flex justify-end gap-3 border-t mt-6" style="display: none;">
                    <button type="button"
                        class="px-4 py-2 bg-black text-white rounded-md shadow hover:bg-gray-900 transition inline-flex items-center gap-2">

                        <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Back</span>
                    </button>

                    <button type="button"
                        class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">

                        <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Save and Next</span>
                    </button>
                </div>
            </div>
            @endif

            @if($currentStep === 4)
            <div id="tab4" class="tab-content bg-white p-6 rounded shadow">
                <div class="space-y-4 mt-6">
                    <p class="font-semibold text-gray-800 mb-1 text-lg">Policy Details</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Policy Start Date <span
                                    class="text-red-600">*</span></label>
                            <input type="date" min="{{ now()->toDateString() }}"
                                class="mt-1 py-1.5 px-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                wire:model="policyStartDate">
                            @error('policyStartDate')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>



                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ast Start Date <span
                                    class="text-red-600">*</span></label>
                            <input type="date"
                                class="mt-1 py-1.5 px-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                wire:model="astStartDate">
                            @error('astStartDate')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="block font-semibold mb-1">
                                Policy Term <span class="text-red-600">*</span>
                            </label>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input id="policyterm1" type="radio" wire:model="policyTerm" value="1"
                                        class="mr-1">
                                    <label for="policyterm1">1 Year</label>
                                </div>
                                {{-- <div class="flex items-center">
                                    <input id="policyterm2" type="radio" wire:model="policyTerm" value="2"
                                        class="mr-1">
                                    <label for="policyterm2">2 Year</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="policyterm3" type="radio" wire:model="policyTerm" value="3"
                                        class="mr-1">
                                    <label for="policyterm3">3 Year</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="policyterm4" type="radio" wire:model="policyTerm" value="4"
                                        class="mr-1">
                                    <label for="policyterm4">4 Year</label>
                                </div> --}}
                            </div>
                            @error('policyTerm')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="pt-4 flex justify-end gap-3 border-t mt-6" style="display: none;">
                        <button type="button"
                            class="px-4 py-2 bg-black text-white rounded-md shadow hover:bg-gray-900 transition inline-flex items-center gap-2">

                            <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span>Back</span>
                        </button>

                        <button type="button"
                            class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">

                            <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span>Save and Next</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            @if($currentStep === 5)
            <div id="tab5" class="tab-content bg-white p-6 rounded shadow">
                <div class="space-y-4 mt-6">
                    <p class="font-semibold text-gray-800 text-lg mb-1">Tenant Details</p><small>(optional)</small>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tenant Name</label>
                            <input type="text"
                                class="mt-1 py-1.5 px-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                wire:model="tenantName">
                            @error('tenantName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tenant Phone</label>
                            <input type="number"
                                class="mt-1 py-1.5 px-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                wire:model="tenantPhone">
                            @error('tenantPhone')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tenant Email</label>
                            <input type="email"
                                class="mt-1 py-1.5 px-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                wire:model="tenantEmail">
                            @error('tenantEmail')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="pt-4 flex justify-end gap-3 border-t mt-6" style="display: none;">

                        <button type="button"
                            class="px-4 py-2 bg-black text-white rounded-md shadow hover:bg-gray-900 transition inline-flex items-center gap-2">

                            <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span>Back</span>
                        </button>

                        <button type="button"
                            class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">

                            <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span>Save and Next</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            {{-- @if($currentStep === 6)
            <div id="tab6" class="tab-content bg-white p-6 rounded shadow" style="display: none;">
                <div class="space-y-4 mt-6">
                    <p class="font-semibold text-gray-800 text-lg mb-1">Payment Method</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Select Payment Method <span
                                    class="text-red-600">*</span></label>
                            <select
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                wire:model="paymentMethod">
                                <option value="">-- Select Payment Method --</option>
                                <option value="pay_later">Paylater</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                            @error('paymentMethod')
                            <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
</div>
</div>
</div>
@endif --}}

@if($currentStep === 6)
<div id="tab7" class="tab-content bg-white p-6 rounded shadow">
    <div class="space-y-4 mt-6">
        <p class="font-semibold text-gray-800 text-lg mb-1">Billing Information</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Billing Name<span class="text-red-600 text-lg">*</span></label>
                <input type="text"
                    class="mt-1 py-1.5 px-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    wire:model="billingName">
                @error('billingName')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Billing Email<span class="text-red-600 text-lg">*</span></label>
                <input type="email"
                    class="mt-1 py-1.5 px-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    wire:model="billingEmail">
                @error('billingEmail')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block mb-1">Copy email</label>
                <p class="text-gray-500" style="font-size: 12px;">Enter email ids, separated by comma, if you need to send invoice to additional people other than billing email</p>
                <textarea id=""
                    class="w-full px-2 py-1 border rounded-md border-[#66666660] mt-1 h-[42px] flex items-center" wire:model="copyBillingEmail"
                    rows="2"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Billing Phone<span class="text-red-600 text-lg">*</span></label>
                <input type="number"
                    class="mt-1 py-1.5 px-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    wire:model="billingPhone">
                @error('billingPhone')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Billing Address One<span class="text-red-600 text-lg">*</span></label>
                <input type="text" placeholder="Enter address..." wire:model="billingAddressOne"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                @error('billingAddressOne')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Billing Address Two</label>
                <input type="text" placeholder="Enter address..." wire:model="billingAddressTwo"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                @error('billingAddressTwo')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Billing Postcode<span class="text-red-600 text-lg">*</span></label>
                <input type="text"
                    class="mt-1 py-1.5 px-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    wire:model="billingPostcode">
                @error('billingPostcode')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div>
                            <label class="block text-sm font-medium text-gray-700">Pon No</label>
                            <input type="text"
                                class="mt-1 py-1.5 px-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                wire:model="ponNo">
                            @error('ponNo')
                            <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div> --}}

        {{--<div>
                            <label class="block">
                                <span class="text-sm text-gray-600">Send Invoice</span>
                                <input type="checkbox" wire:model="isInvoice" class="form-checkbox text-blue-600">
                            </label>
                        </div>--}}
    </div>
    <div class="pt-4 flex justify-end gap-3 border-t mt-6" style="display: none;">

        <button type="button"
            class="px-4 py-2 bg-black text-white rounded-md shadow hover:bg-gray-900 transition inline-flex items-center gap-2">

            <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <span>Back</span>
        </button>

        <button type="button"
            class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">

            <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <span>Save and Next</span>
        </button>
    </div>
</div>
</div>
@endif

@if($currentStep === 7)
<div id="tab8" class="tab-content bg-white p-6 rounded shadow">
    <div class="summary-section p-6 bg-white rounded-xl shadow-md border border-gray-200">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Review Your Summary</h3>

        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($summaryData as $key => $value)
            <li class="p-4 bg-gray-50 rounded-lg border border-gray-200 shadow-sm">
                <h6 class="text-sm font-semibold text-gray-600 uppercase mb-1 tracking-wide">{{ $key }}</h6>
                <p class="text-gray-800 text-base">{{ $value }}</p>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="pt-4 flex justify-end gap-3 border-t mt-6" style="display: none;">

        <button type="button"
            class="px-4 py-2 bg-black text-white rounded-md shadow hover:bg-gray-900 transition inline-flex items-center gap-2">

            <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <span>Back</span>
        </button>

        <button type="button"
            class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">

            <svg class="hidden animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <span>Submit</span>
        </button>
    </div>
</div>
@endif
</div>

<div class="pt-3 flex justify-center gap-3 border-t">
    @if($currentStep > 1)
    <button type="button" wire:click="previousStep" wire:loading.attr="disabled"
        class="px-4 py-2 bg-black text-white rounded-md shadow hover:bg-gray-900 transition inline-flex items-center gap-2">
        <span wire:loading wire:target="previousStep" class="inline">
            <svg class="animate-spin h-4 w-4 text-gray-600 inline-flex" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            Loading...
        </span>
        <span wire:loading.remove wire:target="previousStep">Back</span>
    </button>
    @endif

    @if($currentStep < 7)
        <button type="button" wire:click="nextStep" wire:loading.attr="disabled"
        class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">
        <span wire:loading wire:target="nextStep" class="inline">
            <svg class="animate-spin h-4 w-4 text-white inline-flex" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            Loading...
        </span>
        <span wire:loading.remove wire:target="nextStep">Next</span>
        </button>
        @else
        {{--<button type="button" wire:click="submitForm" wire:loading.attr="disabled"
                class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">
                <span wire:loading wire:target="submitForm" class="inline">
                    <svg class="animate-spin h-4 w-4 text-white inline-flex" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    Loading...
                </span>
                <span wire:loading.remove wire:target="submitForm">Submit</span> 
            </button>--}}
        @endif

        @if($currentStep == 7)
        <button type="button" wire:click="submitForm" wire:loading.attr="disabled"
            class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition inline-flex items-center gap-2">
            <span wire:loading wire:target="submitForm" class="inline">
                <svg class="animate-spin h-4 w-4 text-white inline-flex" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                Loading...
            </span>
            <span wire:loading.remove wire:target="submitForm">Submit</span>
        </button>
        @endif
</div>
</section>

</div>