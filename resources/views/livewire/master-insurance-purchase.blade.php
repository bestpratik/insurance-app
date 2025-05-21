<div>
    <nav class="nav nav-callout justify-content-center flex-nowrap mt-3 mb-3">
        {{-- Step Navigation --}}
        <a href="#" class="nav-link @if($currentStep === 1) active @endif" data-step="Insurances">
            <i class="d-block fa-solid fa-building-shield fs-4 me-1 mb-2"></i>
            <span>Insurances</span>
        </a>
        <a href="#" class="nav-link @if($currentStep === 2) active @endif" data-step="Policy Holder Info">
            <i class="d-block fa-solid fa-building-shield fs-4 me-1 mb-2"></i>
            <span>Property Info</span>
        </a>
        <a href="#" class="nav-link @if($currentStep === 3) active @endif" data-step="Policy holder info">
            <i class="d-block fa-solid fa-user fs-4 me-1 mb-2"></i>
            <span>Policy holder Info</span>
        </a>
        <a href="#" class="nav-link @if($currentStep === 4) active @endif" data-step="Policy details">
            <i class="d-block fa-solid fa-building-user fs-4 me-1 mb-2"></i>
            <span>Policy details</span>
        </a>

        <a href="#" class="nav-link @if($currentStep === 5) active @endif" data-step="Tenant Details">
            <i class="d-block fa-solid fa-building-user fs-4 me-1 mb-2"></i>
            <span>Tenant Details</span>
        </a>

        <a href="#" class="nav-link @if($currentStep === 6) active @endif" data-step="account">
            <i class="d-block fa-regular fa-credit-card fs-4 me-1 mb-2"></i>
            <span>Payment Method</span>
        </a>

        <a href="#" class="nav-link @if($currentStep === 7) active @endif" data-step="account">
            <i class="d-block fa-solid fa-circle-info fs-4 me-1 mb-2"></i>
            <span>Summary</span>
        </a>
    </nav>

    <div class="row">
        <div class="col-md-12">


            @if($currentStep === 1)
            <label class="block">
                <span class="text-gray-700">Types<span class="text-red-600 text-xl">* </span></span>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="product_type" class="form-radio" value="Landlord">
                    <span>Landlord</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="product_type" class="form-radio" value="Agent">
                    <span>Agent</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="product_type" class="form-radio" value="Others">
                    <span>Others</span>
                </label>
            </label>
            <div class="col-md-12">
                <label class="col-form-label"><b>Insurances <span style="color:red;">*</span></b></label>
                @error('selectedinsuranceId') <br><span class="form-text text-danger">{{ $message }}</span> @enderror

                <select wire:model="selectedinsuranceId" class="w-full mt-1 p-2 border rounded-md border-[#66666660]">
                    <option value="">Choose Insurance...</option>
                    @foreach($availableInsurances as $avinsurance)
                    <option value="{{ $avinsurance->id }}">{{ $avinsurance->name }}</option>
                    @endforeach
                </select>

            </div>
            @endif



            @if($currentStep === 2)
            <div class="row">
                <p class="card-text fw-bold mb-1">Can we have the Property that you want insured?</p>
                <div class="col-md-4 mb-2">
                    <label class="col-form-label"><b>Type Of Insurance <span style="color:red;">*</span></b></label>
                    <div>
                        <input id="typeOfinsurancenew" type="radio" wire:model="insuranceType" value="new">
                        <label for="typeOfinsurancenew" class="me-3">New</label>
                        <input id="typeOfinsurancerenewal" type="radio" wire:model="insuranceType" value="renewal">
                        <label for="typeOfinsurancerenewal">Renewal</label>
                    </div>
                    @error('insuranceType') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-2">
                    <label class="col-form-label"><b>Rent Amount (£) <span style="color:red;">*</span></b></label>
                    <input class="form-control" type="text" wire:model="rentAmount" />
                    @error('rentAmount') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
                <h5 class="card-title my-3">Property Details</h5>
                <div class="col-md-4 mb-2">
                    <label class="form-label">Door No <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter..." wire:model="doorNo">
                    @error('doorNo') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-2">
                    <label class="form-label">Address 1 <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter..." wire:model="addressOne">
                    @error('addressOne') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-2">
                    <label class="form-label">Address 2</label>
                    <input type="text" class="form-control" placeholder="Enter..." wire:model="addressTwo">
                </div>

                <div class="col-md-4 mb-2">
                    <label class="form-label">Address 3</label>
                    <input type="text" class="form-control" placeholder="Enter..." wire:model="addressThree">
                </div>

                <div class="col-md-4 mb-2">
                    <label class="form-label">Post Code <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter..." wire:model="postCode">
                    @error('postCode') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            @endif


            @if($currentStep === 3)
            <div class="row" x-data="{ policyHoldertype: @entangle('policyHoldertype') }">
                <p class="card-text fw-bold mb-0">Can we have the policy holder information?</p>
                <p class="card-text">
                    This is the person that is going to make the claim, so if the property is being managed then it should be the managing agent's information
                </p>

                <div class="col-md-4 mb-2">
                    <label class="form-label">Policy holder type <span style="color: red;"> * </span></label>
                    <div>
                        <input id="policyHoldertypeOne" type="radio" x-model="policyHoldertype" value="Company">
                        <label for="policyHoldertypeOne" class="me-3">Company</label>
                        <input id="policyHoldertypeTwo" type="radio" x-model="policyHoldertype" value="Individual">
                        <label for="policyHoldertypeTwo">Individual</label>
                    </div>
                    @error('policyHoldertype') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-2" x-show="policyHoldertype === 'Company'">
                    <label class="form-label">Company Name <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter..." wire:model="companyName">
                    @error('companyName') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-2" x-show="policyHoldertype === 'Individual'">
                    <label class="col-form-label"><b>Title <span style="color:red;">*</span></b></label>
                    <select wire:model="policyholderTitle" class="form-select">
                        <option value="">Select Title</option>
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Ms">Ms</option>
                        <option value="Miss">Miss</option>
                        <option value="Dr">Dr</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('policyholderTitle') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-2" x-show="policyHoldertype === 'Individual'">
                    <label class="form-label">First Name <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter..." wire:model="policyholderFirstName">
                    @error('policyholderFirstName') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-2" x-show="policyHoldertype === 'Individual'">
                    <label class="form-label">Last Name <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter..." wire:model="policyholderLastName">
                    @error('policyholderLastName') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-2">
                    <label class="form-label">Email <span style="color:red;">*</span></label>
                    <input type="email" class="form-control" placeholder="Enter..." wire:model="policyholderEmail">
                    @error('policyholderEmail') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-2">
                    <label class="form-label">Phone Number <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter..." wire:model="policyholderPhone">
                    @error('policyholderPhone') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            @endif


            @if($currentStep === 4)
            <div class="row">
                <p class="card-text fw-bold mb-1">Policy Details</p>
                <div class="col-md-4 mb-2">
                    <label class="form-label">Start Date <span style="color:red;">*</span></label>
                    <input type="date" class="form-control" wire:model="policyStartDate">
                    @error('policyStartDate') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">End Date <span style="color:red;">*</span></label>
                    <input type="date" class="form-control" wire:model="policyEndDate">
                    @error('policyEndDate') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">Premium Amount <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" wire:model="premiumAmount">
                    @error('premiumAmount') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            @endif

            @if($currentStep === 5)
            <div class="row">
                <p class="card-text fw-bold mb-1">Tenant Details</p>
                <div class="col-md-4 mb-2">
                    <label class="form-label">Tenant Name <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" wire:model="tenantName">
                    @error('tenantName') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">Tenant Phone <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" wire:model="tenantPhone">
                    @error('tenantPhone') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">Tenant Email <span style="color:red;">*</span></label>
                    <input type="email" class="form-control" wire:model="tenantEmail">
                    @error('tenantEmail') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            @endif


            @if($currentStep === 6)
            <div class="row">
                <p class="card-text fw-bold mb-1">Payment Method</p>
                <div class="col-md-4 mb-2">
                    <label class="form-label">Select Payment Method <span style="color:red;">*</span></label>
                    <select class="form-select" wire:model="paymentMethod">
                        <option value="">-- Select Payment Method --</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">Paypal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                    @error('paymentMethod') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
                {{-- Add payment method details accordingly --}}
            </div>
            @endif


        </div>
    </div>



    <div class="pt-3 d-flex justify-content-center gap-3">
        @if($currentStep > 1)
        <button class="btn btn-light" wire:click="previousStep" type="button" wire:loading.attr="disabled">
            <span wire:loading wire:target="previousStep">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="visually-hidden">Loading...</span>
            </span>
            <span wire:loading.remove wire:target="previousStep">Back</span>
        </button>
        @endif

        @if($currentStep < 7)
            <button class="btn btn-primary" wire:click="nextStep" type="button" wire:loading.attr="disabled">
            <span wire:loading wire:target="nextStep">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="visually-hidden">Loading...</span>
            </span>
            <span wire:loading.remove wire:target="nextStep">Next</span>
            </button>
            @else
            <button class="btn btn-success" wire:click="submitForm" type="button" wire:loading.attr="disabled">
                Submit
                <span wire:loading wire:target="submitForm">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="visually-hidden">Loading...</span>
                </span>
            </button>
            @endif
    </div>

</div>