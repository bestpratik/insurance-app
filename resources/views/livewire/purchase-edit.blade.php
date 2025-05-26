<div>
    <form class="p-3 md:px-6 md:pb-6 w-full space-y-4" wire:submit.prevent="update"
        enctype="multipart/form-data">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
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


            <label class="block">
                <span class="text-gray-700"> Insurance<span class="text-red-600 text-xl">* </span></span>
                <label class="block">
                    <select wire:model="selectedinsuranceId"
                        class="w-full mt-1 p-2 border rounded-md border-[#66666660]">
                        <option value="">choose..</option>
                        @foreach ($insuranceList as $insurance)
                            <option value="{{ $insurance->id }}"
                                {{ $purchaseData->insurance_id == $insurance->id ? 'selected' : '' }}>
                                {{ $insurance->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedinsuranceId')
                        <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </label>

            </label>

        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="mb-2">
                <h6 class="block font-semibold mb-4">
                    Type Of Insurance <span class="text-red-600">*</span>
                </h6>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <input id="typeOfinsurancenew" type="radio" wire:model="insuranceType" value="new"
                            class="mr-1">
                        <label for="typeOfinsurancenew">New</label>
                    </div>
                    <div class="flex items-center">
                        <input id="typeOfinsurancerenewal" type="radio" wire:model="insuranceType" value="renewal"
                            class="mr-1">
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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
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
                <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote" wire:model="addressOne"
                    id=""></textarea>
                @error('addressOne')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-2">
                <label class="block mb-1">Address 2</label>
                <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote" wire:model="addressTwo"
                    id=""></textarea>
            </div>

            <div class="mb-2">
                <label class="block mb-1">Address 3</label>
                <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote" wire:model="addressThree"
                    id=""></textarea>
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

        <div class="grid grid-cols-1 " x-data="{ policyHoldertype: @entangle('policyHoldertype') }">
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold mb-1">
                        Policy holder type <span class="text-red-600">*</span>
                    </label>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input id="policyHoldertypeOne" type="radio" x-model="policyHoldertype"
                                value="Company" class="mr-1">
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
                    <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote" wire:model="policyholderAddress1"
                        id=""></textarea>
                </div>

                <div>
                    <label class="block mb-1">Address2</label>
                    <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote" wire:model="policyholderAddress2"
                        id=""></textarea>
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


        <div class="space-y-4">
            <p class="font-semibold text-gray-800 mb-1">Tenant Details</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tenant Name<span
                            class="text-red-600 text-lg">*</span></label>
                    <input type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        wire:model="tenantName">
                    @error('tenantName')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tenant Phone<span
                            class="text-red-600 text-lg">*</span></label>
                    <input type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        wire:model="tenantPhone">
                    @error('tenantPhone')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tenant Email<span
                            class="text-red-600 text-lg">*</span></label>
                    <input type="email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        wire:model="tenantEmail">
                    @error('tenantEmail')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>


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


        <div class="space-y-4">
            <p class="font-semibold text-gray-800 mb-1">Billing Department</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Billing Name<span
                            class="text-red-600 text-lg">*</span></label>
                    <input type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        wire:model="billingName">
                    @error('billingName')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Billing Email<span
                            class="text-red-600 text-lg">*</span></label>
                    <input type="email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        wire:model="billingEmail">
                    @error('billingEmail')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Billing Phone<span
                            class="text-red-600 text-lg">*</span></label>
                    <input type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        wire:model="billingPhone">
                    @error('billingPhone')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Billing Address One</label>
                    <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote" wire:model="billingAddressOne"
                        id=""></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Billing Address Two</label>
                    <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote" wire:model="billingAddressTwo"
                        id=""></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Billing Postcode</label>
                    <input type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        wire:model="billingPostcode">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pon No</label>
                    <input type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        wire:model="ponNo">
                </div>

            </div>
        </div>


        <div class="pt-6 flex justify-center">
            <button
                class="flex items-center justify-between text-center rounded-md md:w-[100px] w-[130px]  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">
                <span class="text-md">Update</span>
                <x-heroicon-o-chevron-right class="h-6 w-6" />
            </button>

        </div>
    </form>
</div>







