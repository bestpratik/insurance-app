<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Insurance
        </h2>
    </x-slot>

    <div class="card bg-white rounded-lg border">
        <div class="d-md-flex align-content-stretch">
            <div class="card-body flex-fill mx-md-4">
                <nav id="_dm-customWizardSteps" class="flex justify-center space-x-1 md:space-x-8 mt-3 mb-3 border-b ">
                    <!-- Active tab -->
                    <a href="#"
                        class=" flex items-center text-center px-4 py-2 border-b-2 border-blue-500 text-blue-600 font-medium transition-all duration-300">
                        <x-heroicon-o-identification class="h-6 w-6 me-2 text-blue-600" />
                        <span class="text-sm hidden md:inline">General Details</span>
                    </a>

                    <!-- Inactive tabs -->
                    <a href="#"
                        class=" flex items-center text-center px-4 py-2 text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300">
                        <x-heroicon-o-currency-dollar class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Pricing</span>
                    </a>
                    <a href="{{route('insurance.static.document',$insurance->id)}}"
                        class=" flex items-center text-center px-4 py-2 text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300">
                        <x-heroicon-o-document class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Static Documents</span>
                    </a>
                    <a href="#"
                        class=" flex items-center text-center px-4 py-2 text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300">
                        <x-heroicon-o-document-text class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Dynamic Documents</span>
                    </a>
                    <a href="#"
                        class=" flex items-center text-center px-4 py-2 text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300">
                        <x-heroicon-o-envelope class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Email Template</span>
                    </a>
                    <a href="#"
                        class=" flex items-center text-center px-4 py-2 text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300">
                        <x-heroicon-o-chart-bar class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Summary</span>
                    </a>
                </nav>




                @if($message = Session::get('onboarderror'))
                    <div class="alert alert-success alert-dismissible">
                        {{ $message }}
                    </div>
                @endif
                <form class="p-3 md:px-6 md:pb-6 w-full space-y-4" method="post" action="{{route('insurance.pricing.submit', $insurance->id)}}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <label class="block">
                            <span class="text-gray-700">Net Premium<span class="text-red-600 text-xl">* </span></span>
                            <input name="net_premium" type="text"
                                class="w-full mt-1 p-2 border rounded-md border-[#66666660]" placeholder="Enter.." value="{{$insurance->net_premium}}">
                            @error('net_premium')
                                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Commission<span class="text-red-600 text-xl">* </span></span>
                            <input name="commission" type="text"
                                class="w-full mt-1 p-2 border rounded-md border-[#66666660]" placeholder="Enter.." value="{{$insurance->commission}}">
                            @error('commission')
                                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </label>


                        <label class="block">
                            <span class="text-gray-700">Gross Premium</span>
                            <input name="gross_premium" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter.." value="{{$insurance->gross_premium}}" readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">IPT</span>
                            <input name="ipt" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name" value="{{$insurance->ipt}}" readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Total Premium</span>
                            <input name="total_premium" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name" value="{{$insurance->total_premium}}" readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Payable Amount</span>
                            <input name="payable_amount" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name" value="{{$insurance->payable_amount}}" readonly>
                        </label>
                        
                    </div>

                    <div class="pt-6 flex justify-center space-x-4">
                        <a class="flex items-center justify-between text-center rounded-md md:w-[110px] w-[140px]  px-3 py-2 bg-gray-800 text-white rounded hover:bg-blue-600 transition-all duration-300" href="{{route('insurances.edit',$insurance->id)}}">
                        
                            <x-heroicon-o-chevron-left class="h-6 w-6" />
                            <span class="text-md">Previous</span>
                        
                        </a>

                        <!-- <a href="{{route('insurances.edit',$insurance->id)}}" class="btn btn-light ">
                                        Previous</a> -->

                        <button class="flex items-center justify-between text-center rounded-md md:w-[100px] w-[130px]  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">
                        <span class="text-md">Next</span>
                        <x-heroicon-o-chevron-right class="h-6 w-6" />
                        </button>
                    </div>


                </form>

            </div>
        </div>
    </div>


</x-app-layout>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const netPremiumInput = document.querySelector('input[name="net_premium"]');
        const commissionInput = document.querySelector('input[name="commission"]');
        const grossPremiumInput = document.querySelector('input[name="gross_premium"]');
        const iptInput = document.querySelector('input[name="ipt"]');
        const totalPremiumInput = document.querySelector('input[name="total_premium"]');
        const payableAmountInput = document.querySelector('input[name="payable_amount"]');

        function calculatePremiums() {
            const netPremium = parseFloat(netPremiumInput.value) || 0;
            const commission = parseFloat(commissionInput.value) || 0;

            const grossPremium = netPremium + commission;
            const ipt = grossPremium * 0.12;
            const totalPremium = grossPremium + ipt;
            const payableAmount = totalPremium - commission;

            grossPremiumInput.value = grossPremium.toFixed(2);
            iptInput.value = ipt.toFixed(2);
            totalPremiumInput.value = totalPremium.toFixed(2);
            payableAmountInput.value = payableAmount.toFixed(2);
        }

        netPremiumInput.addEventListener('input', calculatePremiums);
        commissionInput.addEventListener('input', calculatePremiums);
    });
</script>
