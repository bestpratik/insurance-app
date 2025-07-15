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
            Edit Fact
        </h2>
        <form class="bg-white w-full space-y-4" method="post" action="{{ route('update.fact', $fact->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label class="block">
                    <span class="text-gray-700">Title</span>
                    <input name="title" type="text" class="w-full mt-1 p-2 border rounded"
                        value="{{ $fact->title }}" placeholder="Enter Title">
                </label>
            </div>

            <div>
                <label class="block">
                    <span class="text-gray-700">Image</span>
                    <input name="image" type="file" onchange="loadFile(event)"
                        class="w-full mt-1 p-2 border rounded">
                </label>
                <div class="shrink-0">
                    <img id='preview_img' class="h-16 w-16 bg-gray-600 p-4 rounded-md border" src="{{ asset('uploads/fact/' . $fact->image) }}"
                        alt="Current photo" />
                </div>
            </div>

            <div>
                <label class="block">
                    <span class="text-gray-700">Description</span>
                    <textarea name="description" id="summernote" type="text" class="w-full mt-1 p-2 border rounded summernote"
                        placeholder="Enter Description">{{ old('description', $fact->description) }}</textarea>
                </label>
            </div>

            <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Update</button>
        </form>
    </div>

</x-app-layout>


<script>
    var loadFile = function(event) {

        var input = event.target;
        var file = input.files[0];
        var type = file.type;

        var output = document.getElementById('preview_img');


        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
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
