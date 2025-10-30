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
            Edit Service
        </h2>
        <a href="{{ route('services') }}"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 
                   focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <x-heroicon-o-arrow-left class="w-4 h-4" />
        </a>
        <form class="bg-white w-full space-y-4" method="post" action="{{ route('update.service', $service->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label class="block">Insurance <span class="text-red-700">*</span></label>
                <select name="insurance_id" class="w-full mt-1 p-2 border rounded">
                    <option value="">Choose Insurance...</option>
                    @foreach ($insurances as $row)
                        <option value="{{ $row->id }}"
                            {{ old('insurance_id', $service->insurance_id) == $row->id ? 'selected' : '' }}>
                            {{ $row->name }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('insurance_id'))
                    <span class="mt-1 text-sm text-red-500">{{ $errors->first('insurance_id') }}</span>
                @endif
            </div>


            <div>
                <label class="block">Title
                    <span class="text-red-700">*</span>
                    <input name="title" type="text" class="w-full mt-1 p-2 border rounded"
                        value="{{ $service->title }}" placeholder="Enter Title">
                    @if ($errors->has('title'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('title') }}</span>
                    @endif
                </label>
            </div>

            <div>
                <label class="block">Sub Title
                    <span class="text-red-700">*</span>
                    <input name="sub_title" type="text" class="w-full mt-1 p-2 border rounded"
                        value="{{ $service->sub_title }}" placeholder="Enter Sub Title">
                    @if ($errors->has('sub_title'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('sub_title') }}</span>
                    @endif
                </label>
            </div>

            <div>
                <label class="block">
                    <span class="text-gray-700">Image</span>
                    <small class="text-gray-500 block mt-1">Recommended size: 1200×896px</small>
                    <input name="image" type="file" onchange="loadFile(event)"
                        class="w-full mt-1 p-2 border rounded">
                </label>
                <div class="shrink-0">
                    <img id='preview_img' class="h-16 w-16 object-cover rounded-full"
                        src="{{ asset('uploads/service/' . $service->image) }}" alt="Current photo" />
                    @if ($errors->has('image'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('image') }}</span>
                    @endif
                </div>
            </div>

            <!-- Image Alt Text for SEO -->
            <div>
                <label class="block mt-3">Alt Text (for SEO)
                    <input type="text" name="image_alt"
                        value="{{ old('image_alt', isset($service) ? $service->image_alt : '') }}"
                        class="w-full mt-1 p-2 border rounded" placeholder="Enter image alt text (SEO friendly)">
                </label>
            </div>

            <div>
                <label class="block"><span class="text-gray-700">Tag</span>
                    <input name="tag" type="text" class="w-full mt-1 p-2 border rounded" placeholder="Enter Tag"
                        value="{{ $service->tag }}">
                </label>
            </div>

            <div>
                <label class="block"><span class="text-gary-700">Price</span>
                    <input name="price" type="number" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Price" value="{{ $service->price }}">
                </label>
            </div>

            <div>
                <label class="block">Offer
                    <input name="offer" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Offer" value="{{ $service->offer }}">
                    @if ($errors->has('offer'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('offer') }}</span>
                    @endif
                </label>
            </div>

            <div>
                <label class="block">
                    <span class="text-gray-700">Description</span>
                    <textarea name="description" id="summernote" type="text" class="w-full mt-1 p-2 border rounded summernote"
                        placeholder="Enter Description">{{ old('description', $service->description) }}</textarea>
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
