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

    <div class="card bg-white rounded-lg border">
        <div class="d-md-flex align-content-stretch">
            <div class="card-body flex-fill mx-md-4">
                <nav id="" class="flex justify-center space-x-1 md:space-x-8 mt-3 mb-3 border-b ">
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
                <form class="p-3 md:px-6 md:pb-6 w-full space-y-4" method="post" action="{{ route('insurances.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <label class="block">
                            <span class="text-gray-700">Name</span>
                            <input name="name" type="text" class="w-full mt-1 p-2 border rounded-md border-[#66666660]"
                                placeholder="Enter name">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Provider Type</span>
                            <select name="provider_type" class="w-full mt-1 p-2 border rounded-md border-[#66666660]">
                                <option value="">choose..</option>
                                @foreach($provider as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Prefix</span>
                            <input name="prefix" type="text" class="w-full mt-1 p-2 border rounded-md border-[#66666660]"
                                placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Net Premium</span>
                            <input name="net_premium" type="text"
                                class="w-full mt-1 p-2 border rounded-md border-[#66666660]" placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Commission</span>
                            <input name="commission" type="text"
                                class="w-full mt-1 p-2 border rounded-md border-[#66666660]" placeholder="Enter..">
                        </label>

                        <label class="block">
                            <span class="text-gray-700">Image</span>
                            <input type="file" class="w-full px-2 py-1 border rounded-md border-[#66666660] mt-1 h-[42px] flex items-center" id="customFile" name="image"
                                onchange="loadFile(event)">
                        </label>
                    </div>

                    <div class="pt-6 flex justify-center">
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