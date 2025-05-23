<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Insurance Summary
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
                    <a href="#"
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
                 <form id="_dm-customWizardForm" class="p-xl-3 profile-info" action="" method="post">
                            @csrf

                            <div class="row mb-3">
                                @if($insurance->type_of_insurance ?? '')
                                <label class="block">
                                    <span class="text-gray-700">Type Of Insurance:</span>
                                    <div>
                                        {{$insurance->type_of_insurance}}
                                    </div>

                                </label>
                                @endif

                                @if($insurance->insurer_title ?? '')
                                <label class="block">
                                    <span class="text-gray-700">Name Of Insurance:</span>
                                    <div>
                                        {{$insurance->insurer_title}}
                                    </div>

                                </label>
                                @endif
                                
                            </div>

                            <div class="row mb-3">
                                @if($insurance->prefix ?? '')
                                <label class="block">
                                    <span class="text-gray-700">Prefix:</span>
                                    <div>
                                        {{$insurance->prefix}}
                                    </div>

                                </label>
                                @endif
                                @if($insurance->validity ?? '')
                                <label class="block">
                                    <span class="text-gray-700">Validity (In Days):</span>
                                    <div>
                                        {{$insurance->validity}}
                                    </div>

                                </label>
                                @endif
                                @if($insurance->provider_id ?? '')
                                <label class="block">
                                    <span class="text-gray-700">Provider:</span>
                                    <div>
                                       {{$insurance->provider->name}}
                                    </div>

                                </label>
                                @endif
                            </div>

                            <div class="row mb-3">
                                <h5>Rent Amount(£)</h5>
                                @if($insurance->rent_amount_from ?? '')
                                <label class="block">
                                    <span class="text-gray-700">From:</span>
                                    <div>
                                        {{$insurance->rent_amount_from}}
                                    </div>

                                </label>
                                @endif
                                @if($insurance->rent_amount_to ?? '')
                                <label class="block">
                                    <span class="text-gray-700">To:</span>
                                    <div>
                                        {{$insurance->rent_amount_to}}
                                    </div>

                                </label>
                                @endif
                            </div>

                            <div class="row mb-3">
                                @if($insurance->details_of_cover ?? '')
                                <label class="block">
                                    <span class="text-gray-700">Details of cover:</span>
                                    <div>
                                        {{$insurance->details_of_cover}}
                                    </div>

                                </label>
                                @endif
                            </div>
                          
                            <div class="pt-3 d-flex gap-2">
                                <a href="{{route('insurance.email.template',$insurance->id)}}" class="btn btn-light ms-auto">
                                    Previous</a>
                                <a href="{{route('insurance.success')}}" class="btn btn-primary" type="submit">
                                    Submit
                                </a>
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