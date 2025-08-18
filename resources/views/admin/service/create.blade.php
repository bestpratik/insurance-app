<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight max-w-4xl mx-auto">
            Add Service
        </h2>
    </x-slot> --}}
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible max-w-4xl mx-auto">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif
    <div
        class="bg-white border rounded-lg col-span-2 mt-4 p-8 flex flex-wrap align-center justify-between max-w-4xl mx-auto">
        <h2 class="font-semibold text-xl text-gray-800 m-0">
            Add Service
        </h2>
        <form class="bg-white w-full space-y-4" method="post" action="{{ route('save.service') }}"
            enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div>
                <label class="block">Title<span class="text-red-700">*</span>
                    <input name="title" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Title">
                    @if ($errors->has('title'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('title') }}</span>
                    @endif
                </label>
            </div>
            <!-- End Title -->

            <!-- Sub Title -->
            <div>
                <label class="block">Sub Title<span class="text-red-700">*</span>
                    <input name="sub_title" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Sub Title">
                    @if ($errors->has('sub_title'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('sub_title') }}</span>
                    @endif
                </label>
            </div>
            <!-- End Sub Title -->

            <!--Image file-->
            <div>
                <label class="block">Image <span class="text-red-700">*</span>
                    <input id="imageInput" name="image" type="file" class="w-full mt-1 p-2 border rounded"
                        onchange="previewImage(event)">

                    @if ($errors->has('image'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('image') }}</span>
                    @endif
                </label>

                <!-- Preview Image -->
                <img id="preview" src="{{ isset($service) && $service->image ? asset($service->image) : '' }}"
                    class="mt-2 border rounded"
                    style="height: 50px; width: 75px; {{ isset($service) && $service->image ? '' : 'display: none;' }}">
            </div>
            <!--end image file-->

            <div>
                <label class="block">Offer
                    <input name="offer" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Offer">
                    @if ($errors->has('offer'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('offer') }}</span>
                    @endif
                </label>
            </div>

            <div>
                <label class="block">
                    <span class="text-gray-700">Description</span>
                    <textarea name="description" rows="5" class="w-full mt-1 p-2 border rounded summernote" placeholder="Enter Description">{{ old('description') }}</textarea>
                </label>
            </div>

            <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Submit</button>
        </form>

    </div>
</x-app-layout>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


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
