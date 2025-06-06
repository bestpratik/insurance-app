<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dynamic Document
        </h2>
    </x-slot>
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif

    <div class="card bg-white rounded-lg border">
        <div class="d-md-flex align-content-stretch">
            <div class="card-body flex-fill mx-md-4">
                @include('insurance.menu')

                @if ($message = Session::get('onboarderror'))
                    <div class="alert alert-success alert-dismissible">
                        {{ $message }}
                    </div>
                @endif
                <form class="pb-3 md:px-6 md:pb-6 w-full space-y-4" method="post"
                    action="{{ route('insurance.dynamic.document.submit', $insurance->uuid) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label class="block">
                            <span class="text-gray-700">Title<span class="text-red-600 text-xl">* </span></span>
                            <p class="text-gray-400" style="font-size: 14px;">Enter the main topic or title of your
                                document to help identify its purpose quickly.</p>
                            <input class="w-full mt-1 p-2 border rounded-md border-[#66666660]" type="text" name="title"
                                value="{{ old('title') }}" placeholder="Enter Title Name.." />

                            @error('title')
                                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>

                    <!-- <label class="block">
                        <span class="text-gray-700">Header</span>
                        <p class="text-gray-400" style="font-size: 14px;">Enter your template header.</p>
                        <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote bg-white"
                            name="header" id="" rows="2">{{ old('header') }}</textarea>

                        @error('header')
                        <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </label> -->

                    <div class="flex flex-wrap gap-2">
                        <p class="text-gray-400" style="font-size: 14px;">You can use the following field tags and their
                            descriptions when filling out your insurance document. These tags will help structure the
                            document content dynamically and ensure consistency.</p>

                        <input type="hidden" value="%InsuranceName%" id="insuranceName">
                        <button onclick="myFunction('insuranceName')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Insurance
                            Name</button>

                        <input type="hidden" value="%policyNo%" id="policyNo">
                        <button onclick="myFunction('policyNo')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Policy
                            No</button>

                        <input type="hidden" value="%policyHolderAddress1%" id="policyHolderAddress1">
                        <button onclick="myFunction('policyHolderAddress1')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Policy
                            Address</button>

                        <input type="hidden" value="%policyStartdate%" id="policyStartdate">
                        <button onclick="myFunction('policyStartdate')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Policy
                            start date</button>

                        <input type="hidden" value="%policyEnddate%" id="policyEnddate">
                        <button onclick="myFunction('policyEnddate')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Policy
                            end/expiry date</button>

                        <input type="hidden" value="%purchaseDate%" id="purchaseDate">
                        <button onclick="myFunction('purchaseDate')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Purchase
                            date</button>

                        <input type="hidden" value="%policyTerm%" id="policyTerm">
                        <button onclick="myFunction('policyTerm')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Policy
                            Term</button>

                        <!--New fields added-->
                        <input type="hidden" value="%netAnnualpremium%" id="netAnnualpremium">
                        <button onclick="myFunction('netAnnualpremium')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Net
                            Annual Premium</button>

                        <input type="hidden" value="%insurancePremiumtax%" id="insurancePremiumtax">
                        <button onclick="myFunction('insurancePremiumtax')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Insurance
                            Premium Tax</button>

                        <input type="hidden" value="%grossPremium%" id="grossPremium">
                        <button onclick="myFunction('grossPremium')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Gross
                            Premium</button>

                        <input type="hidden" value="%rentAmount%" id="rentAmount">
                        <button onclick="myFunction('rentAmount')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Rent
                            Amount</button>

                        <!-- new add -->
                        <input type="hidden" value="%riskAddress%" id="riskAddress">
                        <button onclick="myFunction('riskAddress')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Risk
                            Address</button>

                        <input type="hidden" value="%insurerTitle%" id="insurerTitle">
                        <button onclick="myFunction('insurerTitle')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Insurer
                            title</button>

                        <input type="hidden" value="%detailsofCover%" id="detailsofCover">
                        <button onclick="myFunction('detailsofCover')" type="button"
                            class="flex items-center justify-between text-center rounded-md  px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">Details
                            of Cover</button>

                    </div>

                    <label class="block">
                        <span class="text-gray-700">Description<span class="text-red-600 text-xl">* </span></span>
                        <p class="text-gray-400" style="font-size: 14px;">Use this area to add detailed notes or
                            explanations about the insurance coverage, terms, or any other important information you
                            want to highlight.</p>
                        <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote"
                            name="description" id="" rows="2">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </label>

                    <!-- <label class="block"> 
                        <span class="text-gray-700">Footer</span>
                        <p class="text-gray-400" style="font-size: 14px;">Enter your template footer.</p>
                        <textarea class="w-full mt-1 p-2 border rounded-md border-[#66666660] summernote" name="footer"
                            id="" rows="2">{{ old('footer') }}</textarea>

                        @error('footer')
                        <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </label> -->

                    <div class="">
                        <button
                            class="flex items-center justify-between text-center rounded-md w-[130px]  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">
                            <span class="text-md">Save</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 6.75v-1.5A2.25 2.25 0 0015 3H6.75A2.25 2.25 0 004.5 5.25v13.5A2.25 2.25 0 006.75 21h10.5A2.25 2.25 0 0019.5 18.75V8.25L17.25 6.75zM15 3v4.5H9V3h6z" />
                            </svg>
                        </button>
                    </div>


                    <div class="pt-2 pb-4 flex justify-center space-x-4">
                        <a href="{{ route('insurance.static.document', $insurance->uuid) }}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md shadow hover:bg-gray-200 transition inline-flex items-center gap-2">
                            <x-heroicon-o-chevron-left class="h-6 w-6" />
                            <span class="text-md">Previous</span>
                        </a>



                        <a href="{{ route('insurance.email.template', $insurance->uuid) }}"
                            class="flex items-center justify-between text-center rounded-md md:w-[110px] w-[140px]  px-3 py-2 bg-green-800 text-white rounded hover:bg-green-600 transition-all duration-300">
                            <span class="text-md">Next</span>
                            <x-heroicon-o-chevron-right class="h-6 w-6" />
                        </a>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <div class="col-span-12 mt-4">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 ">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="min-w-full">
                    <!-- table header start -->
                    <thead class="border-gray-100 border-y bg-gray-50 ">
                        <tr>
                            <th class="px-6 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="block font-medium text-gray-500 text-theme-xs">#</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 whitespace-nowrap">
                                <p class="font-medium text-gray-500 text-theme-xs">Title</p>
                            </th>
                            <th class="px-6 py-3 whitespace-nowrap text-center">
                                <p class="font-medium text-gray-500 text-theme-xs">Action</p>
                            </th>
                        </tr>
                    </thead>
                    <!-- table header end -->

                    <!-- table body start -->
                    <tbody class="divide-y divide-gray-100">
                        @php $i = 0; @endphp
                        @forelse ($insurancedynamicdoc as $row)
                            @php $i++; @endphp

                            <tr>
                                <td class="px-6 py-3 whitespace-nowrap">
                                    <span class="block font-medium text-gray-700 text-theme-sm">{{ $i }}</span>
                                </td>

                                <td class="px-6 py-3 whitespace-nowrap">
                                    <span class="text-theme-sm mb-0.5 block font-medium text-gray-700">
                                        {{ $row->title ?? '' }}
                                    </span>
                                </td>

                                <td class="px-6 py-3 whitespace-nowrap">

                                    <div class="flex items-center justify-center gap-3">
                                        <!-- edit button -->
                                        <button type="button" class="text-yellow-600 hover:text-yellow-800"
                                            data-id="{{ $row->id }}" data-insurance-id="{{ $row->insurance_id }}"
                                            data-title="{{ $row->title }}" data-description="{{ $row->description }}"
                                            onclick="openEditModal(this)">
                                            <x-heroicon-o-pencil-square class="h-6 w-6" />
                                        </button>


                                        <!-- View Button -->
                                        <button type="button" class="text-blue-600 hover:text-blue-800"
                                            data-description="{{ $row->description }}" onclick="openModal(this)">
                                            <x-heroicon-o-eye class="h-6 w-6" />
                                        </button>


                                        <!-- Delete Form -->
                                        <form action="{{ route('insurance.dynamic.delete', $row->id) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete"
                                                class="btn btn-flat btn-sm btn-danger rounded">
                                                <x-heroicon-o-trash class="h-6 w-6 text-red-600" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center px-6 py-4 text-gray-500">
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


    <div id="previewModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white max-w-2xl w-full rounded-lg shadow-lg p-8 relative">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <x-heroicon-o-x-mark class="h-6 w-6 text-gray-500 hover:text-gray-700 border rounded-full p-1" />
            </button>
            <div id="modalContent" class="text-gray-800 max-h-[70vh] overflow-y-auto">
                <!-- Content goes here -->
            </div>
        </div>
    </div>

    <!-- edit modal -->

    <div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white max-w-2xl w-full rounded-lg shadow-lg p-8 relative">
            <button onclick="closeEditModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <x-heroicon-o-x-mark class="h-6 w-6 text-gray-500 hover:text-gray-700 border rounded-full p-1" />
            </button>

            <form id="editForm" method="POST" class="text-gray-800 max-h-[70vh] overflow-y-auto">
                @csrf
                @method('PUT')
                <input type="hidden" name="insurance_id" id="editInsuranceId" />

                <input type="hidden" name="doc_id" id="editDocId" />

                <div class="mb-4">
                    <label class="block text-gray-700">Title</label>
                    <input type="text" id="editTitle" name="title" class="w-full border p-2 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Description</label>
                    <textarea id="editDescription" name="description" rows="4"
                        class="w-full border p-2 rounded summernote min-h-[10vh]"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-1 bg-blue-800 text-white rounded hover:bg-blue-600 transition">Update</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // stop regular form submit
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // continue submit
                    }
                });
            });
        });
    });



    function openModal(button) {
        const description = button.getAttribute('data-description');
        document.getElementById('modalContent').innerHTML = description;
        document.getElementById('previewModal').classList.remove('hidden');
        document.getElementById('previewModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('previewModal').classList.add('hidden');
        document.getElementById('previewModal').classList.remove('flex');
        document.body.style.overflow = '';
    }




</script>

<!-- <script>
    function openEditModal(button) {
        const docId = button.getAttribute('data-id'); 
        const insuranceId = button.getAttribute('data-insurance-id');
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');
        // const updateUrl = `insurance/dynamic/update/${insuranceId}/${docId}`;
        // console.log(updateUrl);
        // console.log(title);
        document.getElementById('editDocId').value = docId;
        document.getElementById('editTitle').value = title;
         console.log(docId);
        $('#editDescription').summernote('code', description);
        // $('#editForm').attr('action', updateUrl); 
        document.getElementById('editModal').classList.remove('hidden');
    }

     $(document).ready(function () {
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            // const url = form.attr('action');
            const formData = form.serialize();
          
            $.ajax({
                type: 'POST',
                url: "insurance/dynamic/update/" + insuranceId/docId,
                data: formData,
                success: function (response) {
                    // Close modal
                    // console.log(response);
                    closeEditModal();

                    // Optional: Reset the form
                    form[0].reset();
                    $('#editDescription').summernote('code', '');

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'The document has been updated successfully.',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Optionally, reload table/list or update DOM
                },
                error: function (xhr) {
                    // Handle error
                    Swal.fire({
                        icon: 'error',
                        title: 'Update Failed',
                        text: xhr.responseJSON?.message || 'Something went wrong.',
                    });
                }
            });
        });
    });

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script> -->


<script>
    function openEditModal(button) {
        const docId = button.getAttribute('data-id');
        const insuranceId = button.getAttribute('data-insurance-id');
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');

        document.getElementById('editDocId').value = docId;
        document.getElementById('editInsuranceId').value = insuranceId;
        document.getElementById('editTitle').value = title;
        $('#editDescription').summernote('code', description);

        document.getElementById('editModal').classList.remove('hidden');
    }



    $('#editForm').on('submit', function (e) {
        e.preventDefault();

        const insuranceId = $('#editInsuranceId').val();
        const docId = $('#editDocId').val();
        const form = $(this);
        const formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: `/insurance/dynamic/update/${insuranceId}/${docId}`,
            data: formData,
            success: function (response) {
                closeEditModal();
                form[0].reset();
                $('#editDescription').summernote('code', '');

                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'The document has been updated successfully.',
                    timer: 2000,
                    showConfirmButton: false,
                    willClose: () => {
                        location.reload();
                    }
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: xhr.responseJSON?.message || 'Something went wrong.',
                });
            }
        });
    });

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

</script>


<!-- Summernote) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<!-- Summernote) -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.summernote').summernote({
            height: 200,
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

<!-- <script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this data ?');
    }
</script> -->

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
<script type="text/javascript">
    function myFunction(targetId) {
        //alert(targetId);
        / Get the text field /
        var copyText = document.getElementById(targetId);

        / Select the text field /
        copyText.select();
        //copyText.setSelectionRange(0, 99999); / For  mobile devices /

        / Copy the text inside the text field /
        navigator.clipboard.writeText(copyText.value);

        / Alert the copied text /
        swal("Text is coppied " + copyText.value);
    }
</script>