<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Insurance
        </h2>
    </x-slot>

    <div class="card bg-white rounded-lg border">
        <div class="d-md-flex align-content-stretch">
            <div class="card-body flex-fill mx-md-4">
                @include('insurance.menu')




                @if($message = Session::get('onboarderror'))
                    <div class="alert alert-success alert-dismissible">
                        {{ $message }}
                    </div>
                @endif
                <form class="p-3 md:px-6 md:pb-6 w-full space-y-4" method="post" action="{{route('insurance.pricing.submit', $insurance->uuid)}}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <label class="block">
                            <span class="text-gray-700">Net Premium<span class="text-red-600 text-xl">* </span></span>
                            <input name="net_premium" type="text"
                                class="w-full mt-1 p-2 border rounded-md border-[#66666660]" placeholder="Enter net premium amount .." value="{{ old('net_premium', $insurance->net_premium) }}">
                            @error('net_premium')
                                <p class="text-theme-xs text-red-500 mt-1.5"  style="font-size: 14px;">{{ $message }}</p>
                            @enderror
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Commission<span class="text-red-600 text-xl">* </span></span>
                            <input name="commission" type="text"
                                class="w-full mt-1 p-2 border rounded-md border-[#66666660]" placeholder="Enter commission amount .." value="{{ old('commission', $insurance->commission) }}">
                            @error('commission')
                                <p class="text-theme-xs text-red-500 mt-1.5"  style="font-size: 14px;">{{ $message }}</p>
                            @enderror
                        </label>


                        <label class="block">
                            <span class="text-gray-700">Gross Premium <span class="text-gray-500" style="font-size: 12px;">(Gross Premium = Net Premium + Commission)</span> </span>
                            <input name="gross_premium" type="text" class="w-full mt-1 p-2 border border-[#66666660]  rounded" placeholder="Gross Premium = Net Premium + Commission" value="{{ old('gross_premium', $insurance->gross_premium) }}" readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">IPT <span class="text-gray-500" style="font-size: 12px;">(12% of Gross Premium)</span> </span>
                            <input name="ipt" type="text" class="w-full mt-1 p-2 border border-[#66666660] rounded" placeholder="Enter name" value="{{ old('ipt', $insurance->ipt) }}" readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Total Premium</span>
                            <input name="total_premium" type="text" class="w-full mt-1 p-2 border border-[#66666660] rounded" placeholder="Enter name" value="{{ old('total_premium', $insurance->total_premium) }}" readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Admin Fee</span>
                            <input name="admin_fee" type="number" class="w-full mt-1 p-2 border border-[#66666660] rounded" placeholder="Enter admin fee" value="{{ old('admin_fee', $insurance->admin_fee) }}">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Billable Amount</span>
                            <input name="payable_amount" type="number" step="0.01" class="w-full mt-1 p-2 border border-[#66666660] rounded" placeholder="Enter final amount to be paid" value="{{ old('payable_amount', $insurance->payable_amount) }}">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">IPT on Billable Amount</span>
                            <input name="ipt_on_billable_amount" type="number" class="w-full mt-1 p-2 border border-[#66666660] rounded" placeholder="Enter final amount to be paid" value="{{ old('ipt_on_billable_amount', $insurance->ipt_on_billable_amount) }}" readonly>
                        </label>

                    </div>

                    <div class="pt-6 flex justify-center space-x-4">
                        <a class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md shadow hover:bg-gray-200 transition inline-flex items-center gap-2" href="{{route('insurances.edit',$insurance->uuid)}}">
                        
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
        const iptOnPayableAmountInput = document.querySelector('input[name="ipt_on_billable_amount"]');

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
            payableAmountInput.value = totalPremiumInput.value; 
            iptOnPayableAmountInput.value = iptInput.value;
            // iptOnPayableAmountInput.value = payableAmountInput.value - ipt;
        }

        netPremiumInput.addEventListener('input', calculatePremiums);
        commissionInput.addEventListener('input', calculatePremiums);
    });
</script>
