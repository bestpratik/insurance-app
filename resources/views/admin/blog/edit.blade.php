<x-app-layout>
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible max-w-4xl mx-auto">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif

    <div class="bg-white border rounded-lg col-span-2 mt-4 p-8 flex flex-wrap justify-between max-w-4xl mx-auto">
        <h2 class="font-semibold text-xl text-gray-800 m-0">Edit Blog</h2>
        <a href="{{ route('blog') }}"
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
                <label class="block">Image
                    <input id="blogImageInput" name="image" type="file" class="w-full mt-1 p-2 border rounded"
                        onchange="previewImage(event, 'blogPreview')">
                </label>
                @if ($blog->image)
                    <img id="blogPreview" class="h-16 w-16 object-cover rounded-full mt-2"
                        src="{{ asset('uploads/blogs/' . $blog->image) }}" />
                @endif
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
                @if ($blog->author_image)
                    <img id="authorPreview" class="h-16 w-16 object-cover rounded-full mt-2"
                        src="{{ asset('uploads/blogs/' . $blog->author_image) }}" />
                @endif
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
                <label class="block font-medium mb-1">Categories</label>
                <select name="categories[]" multiple class="w-full mt-1 p-2 border rounded">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ in_array($cat->id, $selectedCategories) ? 'selected' : '' }}>
                            {{ $cat->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- ✅ Tags Multi-select --}}
            <div>
                <label class="block font-medium mb-1">Tags</label>
                <select name="tags[]" multiple class="w-full mt-1 p-2 border rounded">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>
                            {{ $tag->tag_name }}
                        </option>
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

{{-- Scripts --}}
<script>
    function previewImage(e, id) {
        const reader = new FileReader();
        reader.onload = r => document.getElementById(id).src = r.target.result;
        reader.readAsDataURL(e.target.files[0]);
    }
</script>

{{-- Summernote --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script>
    $('.summernote').summernote({
        height: 100
    });
</script>
