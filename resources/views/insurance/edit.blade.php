<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Insurance
        </h2>
    </x-slot>

    <div class="bg-white border rounded-lg col-span-2 mt-4 p-4 flex flex-wrap align-center justify-between ">

                    <form class="bg-white p-6 rounded-lg border w-full max-w-lg space-y-4" method="post" action="{{route('insurances.update', $insurance->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <label class="block">
                            <span class="text-gray-700">Name</span>
                            <input name="name" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->name}}" placeholder="Enter name">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Provider Type</span>
                            <select name="provider_type" id="" class="w-full mt-1 p-2 border rounded">
                                <option value="">choose..</option>
                                @foreach($provider as $row)
                                    <option value="{{$row->id}}" {{ $insurance->provider_type == $row->id ? 'selected' : '' }}>{{$row->name}}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Prefix</span>
                            <input name="prefix" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->prefix}}" placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Net Premium</span>
                            <input name="net_premium" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->net_premium}}" placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Commission</span>
                            <input name="commission" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->commission}}" placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Gross Premium</span>
                            <input name="gross_premium" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->gross_premium}}" placeholder="Enter.." readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">IPT</span>
                            <input name="ipt" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->ipt}}" placeholder="Enter.." readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Total Premium</span>
                            <input name="total_premium" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->total_premium}}" placeholder="Enter.." readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Payable Amount</span>
                            <input name="payable_amount" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->payable_amount}}" placeholder="Enter.." readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Image</span>
                            <input type="file" class="custom-file-input" id="customFile" name="image" onchange="loadFile(event)">
                        </label>
                       <label class="block">
                            <input type="hidden" name="old_bnr_img" value="">
                            <div style="border: 1px solid #333; height: 52px; width: 77px; margin-left: 5px;">
                                <img id="output" src="{{ asset('uploads/insurance/'.$insurance->image ) }}"  style="height:50px;width:75px;">
                            </div>
                        </label>

                        <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Submit</button>
                    </form>

    </div>
</x-app-layout>
