<x-app-layout>
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible max-w-4xl mx-auto">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif

    <div class="bg-white border rounded-lg col-span-2 mt-4 p-8 flex flex-wrap justify-between max-w-4xl mx-auto">
        <h2 class="font-semibold text-xl text-gray-800 m-0">Edit Blog</h2>
        <a href="{{ route('blog.index') }}"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
            <x-heroicon-o-arrow-left class="w-4 h-4" />
        </a>

        <form class="bg-white w-full space-y-4" method="post" action="{{ route('update.blog', $blog->id) }}"
            enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- Title --}}
            <div>
                <label class="block">Title<span class="text-red-700">*</span>
                    <input name="title" value="{{ $blog->title }}" type="text"
                        class="w-full mt-1 p-2 border rounded">
                </label>
            </div>

            {{-- Image --}}
            <div>
                <label class="block">Blog Image
                    <input id="blogImageInput" name="image" type="file" class="w-full mt-1 p-2 border rounded"
                        onchange="previewImage(event, 'blogPreview')">
                </label>
                <small class="text-gray-500 block mt-1">Recommended size: 1200×896px</small>
                <img id="blogPreview" class="mt-2 border rounded" style="height: 50px; width: 75px;"
                    src="{{ asset('uploads/blogs/' . $blog->image) }}" />
            </div>

            <!-- Image Alt Text for SEO -->
            <div>
                <label class="block mt-3">Alt Text (for SEO)
                    <input type="text" name="image_alt"
                        value="{{ old('image_alt', isset($blog) ? $blog->image_alt : '') }}"
                        class="w-full mt-1 p-2 border rounded" placeholder="Enter image alt text (SEO friendly)">
                </label>
            </div>

            {{-- Description --}}
            <div>
                <label class="block">Description</label>
                <textarea name="description" class="summernote w-full mt-1 p-2 border rounded">{{ $blog->description }}</textarea>
            </div>

            {{-- Blog Author --}}
            <div>
                <label class="block">Blog Author
                    <input name="blog_author" value="{{ $blog->blog_author }}" type="text"
                        class="w-full mt-1 p-2 border rounded">
                </label>
            </div>

            {{-- Author Image --}}
            <div>
                <label class="block">Author Image
                    <input id="authorImageInput" name="author_image" type="file"
                        class="w-full mt-1 p-2 border rounded" onchange="previewImage(event, 'authorPreview')">
                </label>
                <small class="text-gray-500 block mt-1">Recommended size: 1600×1600px</small>
                <img id="authorPreview" class="mt-2 border rounded" style="height: 50px; width: 75px;"
                    src="{{ asset('uploads/blogs/' . $blog->author_image) }}" />
            </div>

            <!-- Image Alt Text for SEO -->
            <div>
                <label class="block mt-3">Alt Text (for SEO)
                    <input type="text" name="img_alt"
                        value="{{ old('img_alt', isset($blog) ? $blog->img_alt : '') }}"
                        class="w-full mt-1 p-2 border rounded" placeholder="Enter image alt text (SEO friendly)">
                </label>
            </div>

            {{-- Date --}}
            <div>
                <label class="block">Date
                    <input name="date" value="{{ $blog->date }}" type="date"
                        class="w-full mt-1 p-2 border rounded">
                </label>
            </div>

            {{-- Type --}}
            <div>
                <label class="block font-medium mb-1">Type<span class="text-red-700">*</span></label>
                <select name="type" class="w-full mt-1 p-2 border rounded">
                    <option value="">Select Type</option>
                    <option value="blog" {{ $blog->type == 'blog' ? 'selected' : '' }}>Blog</option>
                    <option value="resource" {{ $blog->type == 'resource' ? 'selected' : '' }}>Resource</option>
                </select>
            </div>

            {{-- ✅ Categories Multi-select --}}
            <div>
                <label class="block">Categories</label>
                <select name="categories[]" multiple class="select2 w-full mt-1 p-2 border rounded">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                            {{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            {{-- ✅ Tags Multi-select --}}
            <div>
                <label class="block">Tags</label>
                <select name="tags[]" multiple class="select2 w-full mt-1 p-2 border rounded">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>
                            {{ $tag->tag_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            {{-- <label class="inline-flex items-center mt-2">
                <input type="checkbox" name="status" value="1" {{ $blog->status ? 'checked' : '' }}
                    class="mr-2"> Active
            </label> --}}

            <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Update</button>
        </form>
    </div>
</x-app-layout>

<!-- Image Preview -->
<script>
    function previewImage(event, previewId) {
        const input = event.target;
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>

<!-- jQuery + Summernote + Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 100,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['fontsize', 'color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });

        // Initialize Select2 for multi-selects
        $('.select2').select2({
            placeholder: "Select options",
            allowClear: true,
            width: '100%'
        });
    });
</script>
