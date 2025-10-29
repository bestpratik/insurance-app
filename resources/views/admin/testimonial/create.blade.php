<x-app-layout>
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible max-w-4xl mx-auto">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif
    <div
        class="bg-white border rounded-lg col-span-2 mt-4 p-8 flex flex-wrap align-center justify-between max-w-4xl mx-auto">
        <h2 class="font-semibold text-xl text-gray-800 m-0">
            Add Testimonial
        </h2>
        <a href="{{ route('testimonial') }}"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500  dark:hover:bg-blue-500 dark:focus:ring-blue-800">
            <x-heroicon-o-arrow-left class="w-4 h-4" />
        </a>
        <form class="bg-white w-full space-y-4" method="post" action="{{ route('save.testimonial') }}"
            enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div>
                <label class="block">Name<span class="text-red-700">*</span>
                    <input name="name" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter Name"
                        value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('name') }}</span>
                    @endif
                </label>
            </div>
            <!-- End Title -->

            <!--Image file-->
            <div>
                <label class="block"> <span class="text-gray-700">Image</span>
                    <small class="text-gray-500 block mt-1">Recommended size: 542×542px</small>
                    <input id="imageInput" name="image" type="file" class="w-full mt-1 p-2 border rounded"
                        onchange="previewImage(event)">
                </label>

                <!-- Preview Image -->
                <img id="preview"
                    src="{{ isset($testimonial) && $testimonial->image ? asset($testimonial->image) : '' }}"
                    class="mt-2 border rounded"
                    style="height: 50px; width: 75px; {{ isset($testimonial) && $testimonial->image ? '' : 'display: none;' }}">
            </div>
            <!--end image file-->

            <!--Location-->
            <div>
                <label class="block">Location
                    <span class="text-red-700">*</span>
                    <input name="location" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Location" value="{{ old('location') }}">
                    @if ($errors->has('location'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('location') }}</span>
                    @endif
                </label>
            </div>

            <!--Review-->
            <div>
                <label class="block">
                    <span class="text-gray-700">Review</span>
                    <textarea name="review" rows="5" class="w-full mt-1 p-2 border rounded summernote" placeholder="Enter Review">{{ old('review') }}</textarea>
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
