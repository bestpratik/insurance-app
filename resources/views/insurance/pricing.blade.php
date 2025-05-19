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
    <section id="content" class="content">
        <div class="bg-white border rounded-lg col-span-2 mt-4 p-4 flex flex-wrap align-center justify-between ">
            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card">
                        <div class="d-md-flex align-content-stretch">
                            <div class="card-body flex-fill mx-md-4">
                                <nav id="_dm-customWizardSteps"
                                    class="nav nav-callout justify-content-center flex-nowrap mt-3 mb-3">

                                    <a href="#" class="nav-link active" data-step="preferredArea">
                                        <i class="d-block demo-pli-building fs-4 me-1 mb-2"></i>
                                        <span>General Details</span>
                                    </a>
                                    <a href="#" class="nav-link" data-step="account">
                                        <i class="d-block demo-pli-information fs-4 me-1 mb-2"></i>
                                        <span>Pricing</span>
                                    </a>
                                    <a href="#" class="nav-link" data-step="profile">
                                        <i class="d-block text-center fa fa-user-o fs-4 me-1 mb-2"></i>
                                        <span>Static Documents</span>
                                    </a>
                                    <a href="#" class="nav-link" data-step="address">
                                        <i class="d-block demo-pli-home fs-4 me-1 mb-2"></i>
                                        <span>Dynamic Documents</span>
                                    </a>
                                    <a href="#" class="nav-link" data-step="about">
                                        <i class="d-block demo-pli-male fs-4 me-1 mb-2"></i>
                                        <span>Email Template
                                        </span>
                                    </a>

                                    <a href="#" class="nav-link" data-step="finish">
                                        <i class="d-block demo-pli-medal-2 fs-4 me-1 mb-2"></i>
                                        <span>Summary</span>
                                    </a>
                                </nav>

                                @if($message = Session::get('onboarderror'))
                                <div class="alert alert-success alert-dismissible">
                                    {{ $message }}
                                </div>
                                @endif
                                <form class="bg-white p-6 rounded-lg border w-full max-w-lg space-y-4" method="post" action="{{route('insurance.pricing',$insurance->id)}}">
                                    @csrf

                                    <label class="block">
                                        <span class="text-gray-700">Gross Premium (£)</span>
                                        <input name="gross_premium" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->gross_premium}}" readonly>
                                    </label>

                                    <label class="block">
                                        <span class="text-gray-700">IPT (£)</span>
                                        <input name="ipt" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->ipt}}" readonly>
                                    </label>

                                    <label class="block">
                                        <span class="text-gray-700">Total Premium (£)</span>
                                        <input name="total_premium" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->total_premium}}" readonly>
                                    </label>

                                    <label class="block">
                                        <span class="text-gray-700">Payable Amount (£)</span>
                                        <input name="payable_amount" type="text" class="w-full mt-1 p-2 border rounded" value="{{$insurance->payable_amount}}" readonly>
                                    </label>


                                    <div class="pt-3 d-flex gap-2 justify-content-center">
                                     <a href="{{url('insurances', $insurance->id)}}" class="btn btn-light ">
                                        Previous</a>
                                    <button class="btn btn-primary" type="submit" >
                                        Next
                                    </button>
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

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