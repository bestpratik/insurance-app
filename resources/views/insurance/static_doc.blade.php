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
                @include('insurance.menu')




                @if($message = Session::get('onboarderror'))
                    <div class="alert alert-success alert-dismissible">
                        {{ $message }}
                    </div>
                @endif
                <form class="p-3 md:px-6 md:pb-6 w-full space-y-4" method="post"
                    action="{{route('insurance.static.document.submit', $insurance->id)}}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                        <label class="block">
                            <span class="text-gray-700">Title<span class="text-red-600 text-xl">* </span></span>
                            <input class="w-full mt-1 p-2 border rounded-md border-[#66666660]" type="text" name="title"
                                value="{{ old('title') }}" placeholder="Enter the document title.." />

                            @error('title')
                                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </label>


                        <label class="block">
                            <span class="text-gray-700">Documents<span class="text-red-600 text-xl">* </span> <span
                                    class="text-gray-400" style="font-size: 12px;">(PDF or DOCX only)</span> </span>

                            <input type="file" name="document"
                                class="w-full px-2 py-1 border rounded-md border-[#66666660] mt-1 h-[42px] flex items-center  cursor-pointer">
                            @error('document')
                                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </label>
                        <div>
                            <span class="text-gray-700">&nbsp;</span>
                            <button
                                class="flex items-center justify-between text-center rounded-md md:w-[100px] w-[130px] mt-3  px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 transition-all duration-300">
                                <span class="text-md">Save</span>
                                <x-heroicon-o-arrow-down-tray class="h-6 w-6" />
                            </button>

                        </div>

                    </div>

                    <div class="pt-6 flex justify-center space-x-4">
                        <a href="{{route('insurance.pricing', $insurance->id)}}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md shadow hover:bg-gray-200 transition inline-flex items-center gap-2">
                            <x-heroicon-o-chevron-left class="h-6 w-6" />
                            <span class="text-md">Previous</span>
                        </a>


                        <a href="{{route('insurance.dynamic.document', $insurance->id)}}"
                            class="flex items-center justify-between text-center rounded-md md:w-[110px] w-[140px]  px-3 py-2 bg-green-800 text-white rounded hover:bg-green-600 transition-all duration-300">
                            <span class="text-md">Next</span>
                            <x-heroicon-o-chevron-right class="h-6 w-6" />
                        </a>
                    </div>
                </form>

            </div>
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


                        @forelse ($insurancedoc as $row)
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
                                    @php
                                        $documentUrl = url('/') . '/uploads/insurance_document/' . $row->document;
                                        $extension = pathinfo($row->document, PATHINFO_EXTENSION);
                                    @endphp

                                    @if($row->document)
                                        <div class="flex items-center gap-3">
                                            <div>
                                                <span class="text-theme-sm mb-0.5 block font-medium text-gray-700">
                                                    <a class="flex items-center" target="_blank" href="{{ $documentUrl }}">
                                                        @if(in_array(strtolower($extension), ['doc', 'docx']))
                                                            <x-heroicon-o-document-text class="h-6 w-6 text-blue-800 mr-2" />
                                                        @elseif(strtolower($extension) === 'pdf')
                                                            <x-heroicon-o-document class="h-6 w-6 text-red-600 mr-2" />
                                                        @else
                                                            <x-heroicon-o-document class="h-6 w-6 text-gray-600 mr-2" />
                                                        @endif
                                                        <span>Download uploaded document</span>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                </td>

                                <td class="px-6 py-3 whitespace-nowrap">
                                    <!-- <a class="btn btn-danger" style="padding: 3px 6px;" onclick="return confirmDelete('Are you sure you want to delete data ?')"
                                                                        title="Delete"
                                                                        href="{{ route('insurance.static.delete',$row->id) }}"><x-heroicon-o-trash class="h-6 w-6 text-red-600" />
                                                    </a> -->

                                    <div class="flex items-center justify-center">
                                        <form action="{{ route('insurance.static.delete', $row->id) }}" method="POST"
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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