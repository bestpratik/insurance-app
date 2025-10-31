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
            Add Claim Management
        </h2>
        <a href="{{ route('claim') }}"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 
                   focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <x-heroicon-o-arrow-left class="w-4 h-4" />
        </a>
        <form class="bg-white w-full space-y-4" method="post" action="{{ route('save.claim') }}"
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
