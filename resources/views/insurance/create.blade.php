<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Insurance
        </h2>
    </x-slot>
    @if($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif
    <div class="bg-white border rounded-lg col-span-2 mt-4 p-4 flex flex-wrap align-center justify-between ">

                    <form class="bg-white p-6 rounded-lg border w-full max-w-lg space-y-4" method="post" action="{{route('insurances.store')}}" enctype="multipart/form-data">
                        @csrf

                        <label class="block">
                            <span class="text-gray-700">Name</span>
                            <input name="name" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
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
                            <span class="text-gray-700">Prefix</span>
                            <input name="prefix" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Net Premium</span>
                            <input name="net_premium" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Commission</span>
                            <input name="commission" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Gross Premium</span>
                            <input name="gross_premium" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter.." readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">IPT</span>
                            <input name="ipt" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name" readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Total Premium</span>
                            <input name="total_premium" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name" readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Payable Amount</span>
                            <input name="payable_amount" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter name" readonly>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Image</span>
                             <input type="file" class="custom-file-input" id="customFile" name="image" onchange="loadFile(event)">
                        </label>
                    

                        <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Submit</button>
                    </form>

    </div>
</x-app-layout>
