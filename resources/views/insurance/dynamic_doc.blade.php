<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dynamic Document
        </h2>
    </x-slot>
    @if($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif

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
                    <a href="{{route('insurance.pricing', $insurance->id)}}"
                        class=" flex items-center text-center px-4 py-2 text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300">
                        <x-heroicon-o-currency-dollar class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Pricing</span>
                    </a>
                    <a href="{{route('insurance.static.document', $insurance->id)}}"
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
                <form class="p-3 md:px-6 md:pb-6 w-full space-y-4" method="post"
                    action="{{route('insurance.dynamic.document.submit', $insurance->id)}}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                        <label class="block">
                            <span class="text-gray-700">Title<span class="text-red-600 text-xl">* </span></span>
                            <input class="w-full mt-1 p-2 border rounded-md border-[#66666660]" type="text" name="title"
                                value="{{ old('title') }}" placeholder="Enter.." />

                            @error('title')
                                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>

                    <label class="block">
                        <span class="text-gray-700">Header</span>
                        <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote" name="header"
                            id="" rows="2">{{ old('header') }}</textarea>

                        @error('header')
                            <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </label>
                    <div class="flex flex-wrap gap-4">
                        <input type="hidden" value="%InsuranceName%" id="insuranceName">
                        <button onclick="myFunction('insuranceName')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Insurance
                            Name</button>

                        <input type="hidden" value="%policyNo%" id="policyNo">
                        <button onclick="myFunction('policyNo')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Policy
                            No</button>
                        <input type="hidden" value="%landlordagentName%" id="landlordagentName">
                        <button onclick="myFunction('landlordagentName')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Landlord/Agent/Affiliate
                            Name</button>
                        <input type="hidden" value="%landlordagentAddress%" id="landlordagentAddress">
                        <button onclick="myFunction('landlordagentAddress')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Landlord/Agent/Affiliate
                            Address</button>
                        <input type="hidden" value="%riskAddress%" id="riskAddress">
                        <button onclick="myFunction('riskAddress')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Risk
                            Address</button>
                        <input type="hidden" value="%policyStartdate%" id="policyStartdate">
                        <button onclick="myFunction('policyStartdate')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Policy
                            start date</button>
                        <input type="hidden" value="%policyEnddate%" id="policyEnddate">
                        <button onclick="myFunction('policyEnddate')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Policy
                            end/expiry date</button>
                        <input type="hidden" value="%purchaseDate%" id="purchaseDate">
                        <button onclick="myFunction('purchaseDate')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Purchase
                            date</button>
                        <input type="hidden" value="%insurerTitle%" id="insurerTitle">
                        <button onclick="myFunction('insurerTitle')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Insurer
                            title</button>
                        <input type="hidden" value="%insurerDescription%" id="insurerDescription">
                        <button onclick="myFunction('insurerDescription')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Insurer
                            description</button>
                        <input type="hidden" value="%detailsofCover%" id="detailsofCover">
                        <button onclick="myFunction('detailsofCover')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Details
                            of Cover</button>
                        <input type="hidden" value="%policyTerm%" id="policyTerm">
                        <button onclick="myFunction('policyTerm')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Policy
                            Term</button>

                        <!--New fields added-->
                        <input type="hidden" value="%netAnnualpremium%" id="netAnnualpremium">
                        <button onclick="myFunction('netAnnualpremium')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Net
                            Annual Premium</button>

                        <input type="hidden" value="%insurancePremiumtax%" id="insurancePremiumtax">
                        <button onclick="myFunction('insurancePremiumtax')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Insurance
                            Premium Tax</button>

                        <input type="hidden" value="%grossPremium%" id="grossPremium">
                        <button onclick="myFunction('grossPremium')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Gross
                            Premium</button>

                        <input type="hidden" value="%rentAmount%" id="rentAmount">
                        <button onclick="myFunction('rentAmount')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Rent
                            Amount</button>

</div>

                        <label class="block">
                            <span class="text-gray-700">Description<span class="text-red-600 text-xl">* </span></span>
                            <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote"
                                name="description" id="" rows="2">{{ old('description') }}</textarea>

                            @error('description')
                                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Footer</span>
                            <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote"
                                name="footer" id="" rows="2">{{ old('footer') }}</textarea>

                            @error('footer')
                                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </label>

                    </div>

                    <div class="pt-2 pb-4 flex justify-center space-x-4">
                        <a href="{{route('insurance.static.document', $insurance->id)}}"
                            class="flex items-center justify-between text-center rounded-md md:w-[110px] w-[140px]  px-3 py-2 bg-gray-800 text-white rounded hover:bg-gray-600 transition-all duration-300">
                            <x-heroicon-o-chevron-left class="h-6 w-6" />
                            <span class="text-md">Previous</span>
                        </a>

                        <button
                            class="flex items-center justify-between text-center rounded-md  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">
                            <span class="text-md">Save</span>
                            <x-heroicon-o-arrow-down-tray class="h-6 w-6" />
                        </button>

                        <a href="{{route('insurance.email.template', $insurance->id)}}"
                            class="flex items-center justify-between text-center rounded-md md:w-[110px] w-[140px]  px-3 py-2 bg-green-800 text-white rounded hover:bg-green-600 transition-all duration-300">
                            <span class="text-md">Next</span>
                            <x-heroicon-o-chevron-right class="h-6 w-6" />
                        </a>
                    </div>
                </form>

            
        </div>
    </div>

    <div class="col-span-12">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 ">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="min-w-full">
                    <!-- table header start -->
                    <thead class="border-gray-100 border-y bg-gray-50 ">
                        <tr>
                            <th class="px-6 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <span class="block font-medium text-gray-500 text-theme-xs ">
                                                #
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th class="px-6 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs ">
                                        Title
                                    </p>
                                </div>
                            </th>

                            <th class="px-6 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs ">
                                        Document
                                    </p>
                                </div>
                            </th>

                            <th class="px-6 py-3 whitespace-nowrap">
                                <div class="flex items-center justify-center">
                                    <p class="font-medium text-gray-500 text-theme-xs ">
                                        Action
                                    </p>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <!-- table header end -->

                    <!-- table body start -->
                    <tbody class="divide-y divide-gray-100 ">
                        @php
                            $i = 0;
                            //dd($insurancedoc);
                        @endphp


                        @forelse ($insurancedynamicdoc as $row)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex items-center gap-3">

                                            <div>
                                                <span class="block font-medium text-gray-700 text-theme-sm ">
                                                    {{$i}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex items-center gap-3">
                                            <div>
                                                <span class="text-theme-sm mb-0.5 block font-medium text-gray-700 ">
                                                    {{$row->title ?? ''}}
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <span class="text-theme-sm mb-0.5 block font-medium text-gray-700">
                                                {!! $row->description ?? '' !!}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-3 whitespace-nowrap">
                                    <!-- <a class="btn btn-danger" style="padding: 3px 6px;" onclick="return confirmDelete('Are you sure you want to delete data ?')"
                                                                    title="Delete"
                                                                    href="{{ route('insurance.static.delete',$row->id) }}"><x-heroicon-o-trash class="h-6 w-6 text-red-600" />
                                                </a> -->

                                    <div class="flex items-center justify-center">
                                        <form action="{{ route('insurance.static.delete', $row->id) }}" method="POST"
                                            onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Delete" class="btn btn-flat btn-sm btn-danger rounded"
                                                type="submit"><x-heroicon-o-trash class="h-6 w-6 text-red-600" /></button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center px-6 py-4 text-gray-500 ">
                                    No data found.
                                </td>
                            </tr>
                        @endforelse


                    </tbody>
                    <!-- table body end -->
                </table>
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

<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this data ?');
    }
</script>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6y3AjuZl-L8qR8Mnm4DR5Fv2Xzl8IHjE&callback=initAutocomplete&libraries=places&v=weekly"
    defer></script>
<script src="{{ asset('js/autocomplete.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
    integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<script type="text/javascript">
    $('.dropify').dropify();
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<script type="text/javascript">
    function myFunction(targetId) {
        //alert(targetId);
        / Get the text field /
        var copyText = document.getElementById(targetId);

        / Select the text field /
        copyText.select();
        //copyText.setSelectionRange(0, 99999); / For mobile devices /

        / Copy the text inside the text field /
        navigator.clipboard.writeText(copyText.value);

        / Alert the copied text /
        swal("Text is coppied " + copyText.value);
    }
</script>