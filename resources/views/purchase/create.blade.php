<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Purchase
        </h2>
    </x-slot>
    @if($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif
    <div class="bg-white border rounded-lg col-span-2 mt-4 p-4 flex flex-wrap align-center justify-between ">

                    <form class="bg-white p-6 rounded-lg border w-full max-w-lg space-y-4" method="post" action="{{route('purchases.store')}}">
                        @csrf

                        <label class="block">
                            <span class="text-gray-700">Insurance Name</span>
                            <select name="insurance_id" id="" class="w-full mt-1 p-2 border rounded">
                                <option value="">choose..</option>
                                @foreach($insurance as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option> 
                                @endforeach
                            </select>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Provider Type</span>
                            <select name="provider_type" id="" class="w-full mt-1 p-2 border rounded">
                                <option value="">choose..</option>
                                @foreach($provider as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Policy No</span>
                            <input name="policy_no" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter.." readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Policy Holder Type</span>
                            <select name="policy_holder_type" id="" class="w-full mt-1 p-2 border rounded">
                                <option value="">choose..</option>
                                <option value="individual">Individual</option>
                                <option value="company">Company</option>
                            </select>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Policy Holder Title</span>
                            <input name="policy_holder_title" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Policy Holder Firstname</span>
                            <input name="policy_holder_fname" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Policy Holder Lastname</span>
                            <input name="policy_holder_lname" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Policy Holder Name</span>
                            <input name="policy_holder_name" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Company Name</span>
                            <input name="company_name" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
                        </label>

                         <label class="block">
                            <span class="text-gray-700">Policy Holder Address</span>
                            <input name="policy_holder_address" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
                        </label>
                        
                         <label class="block">
                            <span class="text-gray-700">Policy Holder Email</span>
                            <input name="policy_holder_email" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
                        </label>

                         <label class="block">
                            <span class="text-gray-700">Policy Holder Phone</span>
                            <input name="policy_holder_phone" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
                        </label>

                         <label class="block">
                            <span class="text-gray-700">Policy Start Date</span>
                            <input name="policy_start_date" type="date" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
                        </label>

                         <label class="block">
                            <span class="text-gray-700">Policy End Date</span>
                            <input name="policy_end_date" type="date" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
                        </label>

                         <label class="block">
                            <span class="text-gray-700">Transaction Type</span>
                            <select name="transaction_type" id="" class="w-full mt-1 p-2 border rounded">
                                <option value="">choose..</option>
                                <option value="new business">New Business</option>
                            </select>
                        </label>

                         <label class="block">
                            <span class="text-gray-700">Payable Amount</span>
                            <input name="payable_amount" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
                        </label>

                         <label class="block">
                            <span class="text-gray-700">Property Address</span>
                            <input name="property_address" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
                        </label>

                        
                    

                        <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Submit</button>
                    </form>

    </div>
</x-app-layout>
