<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight max-w-4xl mx-auto">
            Add About
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
            Add Fact
        </h2>
        <a href="{{ route('fact') }}"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 
                   focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <x-heroicon-o-arrow-left class="w-4 h-4" />
        </a>
        <form class="bg-white w-full space-y-4" method="post" action="{{ route('save.fact') }}"
            enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div>
                <label class="block">Title<span class="text-red-700">*</span>
                    <input name="title" type="text" value="{{ old('title') }}"
                        class="w-full mt-1 p-2 border rounded" placeholder="Enter Title">
                    @if ($errors->has('title'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('title') }}</span>
                    @endif
                </label>
            </div>
            <!-- End Title -->

            <!--Image file-->
            <div>
                <label class="block">Image<span class="text-red-700">*</span>
                    <small class="text-gray-500 block mt-1">Recommended size: 600×591px</small>
                    <input id="imageInput" name="image" type="file" class="w-full mt-1 p-2 border rounded"
                        onchange="previewImage(event)">

                    @if ($errors->has('image'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('image') }}</span>
                    @endif
                </label>

                <!-- Preview Image -->
                <img id="preview" src="{{ isset($fact) && $fact->image ? asset($fact->image) : '' }}"
                    class="h-16 w-16 bg-gray-600 p-4 rounded-md border"
                    style="height: 50px; width: 75px; {{ isset($fact) && $fact->image ? '' : 'display: none;' }}">
            </div>
            <!--end Image file-->

            <!-- Image Alt Text for SEO -->
            <div>
                <label class="block mt-3">Alt Text (for SEO) <span class="text-red-700 text-sm">*</span>
                    <input type="text" name="image_alt"
                        value="{{ old('image_alt', isset($fact) ? $fact->image_alt : '') }}"
                        class="w-full mt-1 p-2 border rounded" placeholder="Enter image alt text (SEO friendly)">
                    @if ($errors->has('image_alt'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('image_alt') }}</span>
                    @endif
                </label>
            </div>

            <!-- Description -->
            <div>
                <label class="block">
                    <span class="text-gray-700">Description</span>
                    <textarea name="description" id="" rows="5" class="w-full mt-1 p-2 border rounded summernote"
                        placeholder="Enter Description">{{ old('description') }}</textarea>
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
    $(document).ready(function() {
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
