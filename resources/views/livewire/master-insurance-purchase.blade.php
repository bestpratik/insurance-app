<div class="pb-4">
    @if (session()->has('message'))
    <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg shadow-sm" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <nav class="flex justify-center space-x-1 md:space-x-2 mt-3 mb-3 border-b">
        {{-- Step 1: Insurances --}}
        <a href="#" class="flex items-center text-center px-4 py-2 transition-all duration-300 font-medium
               @if($currentStep === 1)
                   border-b-2 border-blue-500 text-blue-600
               @else
                   text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500
               @endif">
            <x-heroicon-o-shield-check class="h-6 w-6 " />
            <span class="text-sm hidden md:inline">Insurances</span>
        </a>

        {{-- Step 2: Property Info --}}
        <a href="#" class="flex items-center text-center px-4 py-2 transition-all duration-300 font-medium
               @if($currentStep === 2)
                   border-b-2 border-blue-500 text-blue-600
               @else
                   text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500
               @endif">
            <x-heroicon-o-home class="h-6 w-6 " />
            <span class="text-sm hidden md:inline">Property Info</span>
        </a>

        {{-- Step 3: Policy Holder Info --}}
        <a href="#" class="flex items-center text-center px-4 py-2 transition-all duration-300 font-medium
               @if($currentStep === 3)
                   border-b-2 border-blue-500 text-blue-600
               @else
                   text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500
               @endif">
            <x-heroicon-o-user class="h-6 w-6 " />
            <span class="text-sm hidden md:inline">Policy Holder Info</span>
        </a>

        {{-- Step 4: Policy Details --}}
        <a href="#" class="flex items-center text-center px-4 py-2 transition-all duration-300 font-medium
               @if($currentStep === 4)
                   border-b-2 border-blue-500 text-blue-600
               @else
                   text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500
               @endif">
            <x-heroicon-o-document-text class="h-6 w-6 " />
            <span class="text-sm hidden md:inline">Policy Details</span>
        </a>

        {{-- Step 5: Tenant Details --}}
        <a href="#" class="flex items-center text-center px-4 py-2 transition-all duration-300 font-medium
               @if($currentStep === 5)
                   border-b-2 border-blue-500 text-blue-600
               @else
                   text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500
               @endif">
            <x-heroicon-o-users class="h-6 w-6 " />
            <span class="text-sm hidden md:inline">Tenant Details</span>
        </a>

        {{-- Step 6: Payment Method --}}
        <a href="#" class="flex items-center text-center px-4 py-2 transition-all duration-300 font-medium
               @if($currentStep === 6)
                   border-b-2 border-blue-500 text-blue-600
               @else
                   text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500
               @endif">
            <x-heroicon-o-credit-card class="h-6 w-6 " />
            <span class="text-sm hidden md:inline">Payment Method</span>
        </a>

        {{-- Step 7: Billing Department --}}
        <a href="#" class="flex items-center text-center px-4 py-2 transition-all duration-300 font-medium
               @if($currentStep === 7)
                   border-b-2 border-blue-500 text-blue-600
               @else
                   text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500
               @endif">
            <x-heroicon-o-banknotes class="h-6 w-6" />
            <span class="text-sm hidden md:inline">Billing Department</span>
        </a>

        {{-- Step 8: Summary --}}
        <a href="#" class="flex items-center text-center px-4 py-2 transition-all duration-300 font-medium
               @if($currentStep === 8)
                   border-b-2 border-blue-500 text-blue-600
               @else
                   text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500
               @endif">
            <x-heroicon-o-chart-bar class="h-6 w-6 " />
            <span class="text-sm hidden md:inline">Summary</span>
        </a>
    </nav>



    <div class="px-4 pb-6">
        <div class="col-md-12">


            @if($currentStep === 1)
            <!-- <div class="space-y-4"> -->
            <div class="grid grid-cols-2 gap-4">
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
            </div>

            @endif



            @if($currentStep === 2)
            <div class="grid grid-cols-1 gap-4">
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

            @endif


            @if($currentStep === 3)
            <div class="grid grid-cols-1 " x-data="{ policyHoldertype: @entangle('policyHoldertype') }">
                <p class="font-bold mb-0">Can we have the policy holder information?</p>
                <p class="text-gray-700 mb-4">
                    This is the person that is going to make the claim, so if the property is being managed then it
                    should be the managing agent's information
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
                        <input type="text" placeholder="Enter..." wire:model="policyholderCompanyEmail"
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
                        <input type="text" placeholder="Enter..." wire:model="policyholderCompanyEmail"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">

                    </div>

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





                </div>
            </div>

            @endif


            @if($currentStep === 4)
            <div class="space-y-4">
                <p class="font-semibold text-gray-800 mb-1">Policy Details</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Policy Start Date <span
                                class="text-red-600">*</span></label>
                        <input type="date"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            wire:model="policyStartDate">
                        @error('policyStartDate')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ast Start Date <span
                                class="text-red-600">*</span></label>
                        <input type="date"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
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
                            <div class="flex items-center">
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
                            </div>
                        </div>
                        @error('policyTerm')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            @endif

            @if($currentStep === 5)
            <div class="space-y-4">
                <p class="font-semibold text-gray-800 mb-1">Tenant Details</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tenant Name</label>
                        <input type="text"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            wire:model="tenantName">
                        @error('tenantName')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tenant Phone</label>
                        <input type="text"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            wire:model="tenantPhone">
                        @error('tenantPhone')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tenant Email</label>
                        <input type="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            wire:model="tenantEmail">
                        @error('tenantEmail')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            @endif


            @if($currentStep === 6)
            <div class="space-y-4">
                <p class="font-semibold text-gray-800 mb-1">Payment Method</p>

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

            @endif


            @if($currentStep === 7)
            <div class="space-y-4">
                <p class="font-semibold text-gray-800 mb-1">Billing Department</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Billing Name<span class="text-red-600 text-lg">*</span></label>
                        <input type="text"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            wire:model="billingName">
                        @error('billingName')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Billing Email<span class="text-red-600 text-lg">*</span></label>
                        <input type="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            wire:model="billingEmail">
                        @error('billingEmail')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Billing Phone<span class="text-red-600 text-lg">*</span></label>
                        <input type="text"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
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
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            wire:model="billingPostcode">
                          @error('billingPostcode')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pon No</label>
                        <input type="text"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            wire:model="ponNo">
                          @error('ponNo')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block">
                            <span class="text-sm text-gray-600">Send Invoice</span>
                            <input type="checkbox" wire:model="isInvoice" class="form-checkbox text-blue-600">
                        </label>
                    </div>
                </div>
            </div>

            @endif

            @if($currentStep === 8)
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
            @endif



        </div>
    </div>



    <div class="pt-3 flex justify-center gap-3 border-t">
        @if($currentStep > 1)
        <button type="button" wire:click="previousStep" wire:loading.attr="disabled"
            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md shadow hover:bg-gray-200 transition inline-flex items-center gap-2">
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

        @if($currentStep < 8)
            <button type="button" wire:click="nextStep" wire:loading.attr="disabled"
            class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition inline-flex items-center gap-2">
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
            <button type="button" wire:click="submitForm" wire:loading.attr="disabled"
                class="px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition inline-flex items-center gap-2">
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

</div>

