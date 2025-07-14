<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Insurance
        </h2>
    </x-slot>
    <!-- @if($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif -->

    <div class="card bg-white rounded-lg border">
        <div class="d-md-flex align-content-stretch">
            <div class="card-body flex-fill mx-md-4"> 
                @include('insurance.menu')




                @if($message = Session::get('onboarderror'))
                    <div class="alert alert-success alert-dismissible">
                        {{ $message }}
                    </div>
                @endif
                <form class="p-3 md:px-6 md:pb-6 w-full space-y-4" method="post"
                    action="{{ route('insurances.update', $insurance->uuid) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                        <label class="block lg:col-span-4">
                            <span class="text-gray-700">Type Of Insurance<span class="text-red-600 text-xl">*
                                </span></span>
                            <p class="text-gray-500" style="font-size: 12px;"> Choose whether this is a new insurance
                                policy or a renewal.</p>
                            <div class="flex items-center space-x-6 mt-2">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="type_of_insurance" class="form-radio" value="New"
                                        @if($insurance->type_of_insurance == 'New') checked @endif>
                                    <span>New</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="type_of_insurance" class="form-radio" value="Renewal"
                                        @if($insurance->type_of_insurance == 'Renewal') checked @endif>
                                    <span>Renewal</span>
                                </label>
                            </div>
                            @error('type_of_insurance')
                                <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">{{ $message }}</p>
                            @enderror
                        </label>


                        <label class="block lg:col-span-8">
                            <span class="text-gray-700">Name Of Insurance<span class="text-red-600 text-xl">*
                                </span></span>
                            <p class="text-gray-500" style="font-size: 12px;">Enter the specific name of the insurance
                                policy.</p>
                            <input name="name" type="text" class="w-full mt-1 p-2 border rounded-md border-[#66666660]"
                                placeholder="Enter the insurance name..." value="{{$insurance->name ?? ''}}">
                            @error('name')
                                <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                <label class="block">
                    <span class="text-gray-700">Provider<span class="text-red-600 text-xl">* </span></span>
                    <p class="text-gray-500" style="font-size: 12px;">Select the insurance company or provider
                                offering this policy.</p>
                    <select name="provider_type" class="w-full mt-1 p-2 border rounded-md border-[#66666660]">
                        <option value="">choose..</option>
                        @foreach($provider as $row)
                            <option value="{{ $row->id }}" @if($row->id == $insurance->provider_type) selected @endif>
                                {{ $row->name }}</option>
                        @endforeach
                    </select>
                    @error('provider_type')
                        <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">{{ $message }}</p>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-gray-700">Prefix</span>
                    <p class="text-gray-500" style="font-size: 12px;">Enter the short code or abbreviation used
                                to identify this insurance.</p>
                    <input name="prefix" type="text" class="w-full mt-1 p-2 border rounded-md border-[#66666660]"
                        placeholder="Enter.." value="{{$insurance->prefix ?? ''}}">
                </label>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                <label class="block">
                    <span class="text-gray-700">Validity<span class="text-red-600 text-xl">* </span></span>
                    <p class="text-gray-500" style="font-size: 12px;">Specify the duration the insurance is
                                valid for (e.g., 365 days).</p>
                    <input name="validity" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter.."
                        value="{{$insurance->validity ?? ''}}">
                    @error('validity')
                        <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">{{ $message }}</p>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-gray-700">Rent From <span class="text-red-600 text-xl">* </span></span>
                    <p class="text-gray-500" style="font-size: 12px;">Enter the minimum or base rent amount for this
                                insurance policy.</p>
                    <input name="rent_amount_from" type="text" class="w-full mt-1 p-2 border rounded"
                       placeholder="Enter minimum price (e.g., £-500)" value="{{$insurance->rent_amount_from ?? ''}}">
                    @error('rent_amount_from')
                        <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">{{ $message }}</p>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-gray-700">Rent To<span class="text-red-600 text-xl">* </span></span>
                     <p class="text-gray-500" style="font-size: 12px;">Enter the maximum possible rent amount for this
                                insurance policy.</p>
                    <input name="rent_amount_to" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter maximum price (e.g., £-5000)" value="{{$insurance->rent_amount_to ?? ''}}">
                    @error('rent_amount_to')
                        <p class="text-theme-xs text-red-500 mt-1.5" style="font-size: 14px;">{{ $message }}</p>
                    @enderror
                </label>



                <label class="block">
                    <span class="text-gray-700">Image</span>
                    <input type="file"
                        class="w-full px-2 py-1 border rounded-md border-[#66666660] mt-1 h-[42px] flex items-center"
                        id="customFile" name="image" onchange="loadFile(event)">
                </label>
                <img src="{{ asset('uploads/insurance/' . $insurance->image) }}" style="height:50px;width:75px;">

                 <label class="block">
                            <span class="text-gray-700">Purchase Mode<span class="text-red-600 text-xl">* </span></span>
                            <div class="flex items-center space-x-6 mt-2">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="purchase_mode" class="form-radio" value="Offline"
                                        @if($insurance->purchase_mode == 'Offline') checked @endif>
                                    <span>Offline</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="purchase_mode" class="form-radio" value="Online"
                                        @if($insurance->purchase_mode == 'Online') checked @endif>
                                    <span>Online</span>
                                </label>
                            </div>
                </label>

            </div>
            <label class="block">
                <span class="text-gray-700">Details of cover</span>
                <textarea name="details_of_cover" id=""
                    class="w-full px-2 py-1 border rounded-md border-[#66666660] mt-1 h-[42px] flex items-center summernote"
                    rows="2">{!! $insurance->details_of_cover ?? '' !!}</textarea>
            </label>

            <div class="pt-6 flex justify-center">
                <button
                    class="flex items-center justify-between text-center rounded-md md:w-[100px] w-[130px]  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">
                    <span class="text-md">Next</span>
                    <x-heroicon-o-chevron-right class="h-6 w-6" />
                </button>

            </div>
            </form>

        </div>
    </div>
    </div>


</x-app-layout>

<!-- Summernote) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<!-- Summernote) -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.summernote').summernote({
            height: 50,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const a = document.getElementById("_dm-customWizardSteps"),
            d = new Zangdar("#_dm-customWizardForm", {
                onStepChange() {
                    a.querySelectorAll(".active").forEach((a) =>
                        a.classList.remove("active")
                    );
                    const b = d.getCurrentStep().label;
                    a.querySelector(`[data-step="${b}"]`).classList.add("active");
                },
            }),
            b = document.getElementById("_dm-progWizardSteps"),
            e = new Zangdar("#_dm-progWizardForm", {
                onStepChange() {
                    b.querySelectorAll(".active").forEach((a) =>
                        a.classList.remove("active")
                    );
                    const a = e.getCurrentStep().label;
                    b.querySelector(`[data-step="${a}"]`).classList.add("active");
                },
            }),
            c = document.getElementById("_dm-validWizardSteps"),
            f = new Zangdar("#_dm-validWizardForm", {
                onStepChange() {
                    c.querySelectorAll(".active").forEach((a) =>
                        a.classList.remove("active")
                    );
                    const a = f.getCurrentStep().label;
                    c.querySelector(`[data-step="${a}"]`).classList.add("active");
                },

            });
    });
</script>