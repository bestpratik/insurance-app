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
            Edit SEO Entry
        </h2>

        <a href="{{ route('seo') }}"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 
                   focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <x-heroicon-o-arrow-left class="w-4 h-4" />
        </a>

        <form class="bg-white w-full space-y-4" method="post" action="{{ route('update.seo', $seo->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label>Page Title<span class="text-red-700">*</span></label>
                <input type="text" name="page_title" value="{{ old('page_title', $seo->page_title ?? '') }}"
                    class="w-full border rounded px-3 py-2">
                @if ($errors->has('page_title'))
                    <span class="mt-1 text-sm text-red-500">{{ $errors->first('page_title') }}</span>
                @endif
            </div>

            {{-- Meta Info --}}
            <div>
                <label>Meta Title<span class="text-red-700">*</span></label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $seo->meta_title ?? '') }}"
                    class="w-full border rounded px-3 py-2">
                @if ($errors->has('meta_title'))
                    <span class="mt-1 text-sm text-red-500">{{ $errors->first('meta_title') }}</span>
                @endif
            </div>
            <div>
                <label>Meta Keywords</label>
                <input type="text" name="meta_keyword" value="{{ old('meta_keyword', $seo->meta_keyword ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            <div class="col-span-2">
                <label>Meta Description</label>
                <textarea name="meta_description" class="w-full mt-1 p-2 border rounded summernote" rows="3">{{ old('meta_description', $seo->meta_description ?? '') }}</textarea>
            </div>

            {{-- SEO Title & Locale --}}
            <div>
                <label>SEO Title<span class="text-red-700">*</span></label>
                <input type="text" name="seo_title" value="{{ old('seo_title', $seo->seo_title ?? '') }}"
                    class="w-full border rounded px-3 py-2">
                @if ($errors->has('seo_title'))
                    <span class="mt-1 text-sm text-red-500">{{ $errors->first('seo_title') }}</span>
                @endif
            </div>
            <div>
                <label>Locale</label>
                <input type="text" name="locale" value="{{ old('locale', $seo->locale ?? 'en') }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            {{-- Page Type & Site Name --}}
            <div>
                <label>Page Type</label>
                <input type="text" name="page_type" value="{{ old('page_type', $seo->page_type ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label>Site Name</label>
                <input type="text" name="site_name" value="{{ old('site_name', $seo->site_name ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            {{-- OG (Open Graph) Info --}}
            <div>
                <label>OG Title</label>
                <input type="text" name="ogtitle" value="{{ old('ogtitle', $seo->ogtitle ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block">OG Image
                    <input id="ogImageInput" name="ogimage" type="file"
                        value="{{ old('ogimage', $seo->ogimage ?? '') }}" class="w-full mt-1 p-2 border rounded"
                        onchange="previewImage(event, 'ogPreview')">
                </label>
                <img id="ogPreview" class="mt-2 border rounded" style="height: 50px; width: 75px;"
                    src="{{ $seo->ogimage ? asset('uploads/seo/' . $seo->ogimage) : asset('img/default-banner.jpg') }}" />
            </div>

            <!-- Image Alt Text for SEO -->
            <div>
                <label class="block mt-3">Alt Text (for SEO)
                    <input type="text" name="image_alt"
                        value="{{ old('image_alt', isset($seo) ? $seo->image_alt : '') }}"
                        class="w-full mt-1 p-2 border rounded" placeholder="Enter image alt text (SEO friendly)">
                </label>
            </div>

            {{-- Twitter Info --}}
            <div>
                <label>Twitter Card</label>
                <input type="text" name="twitter_card" value="{{ old('twitter_card', $seo->twitter_card ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label>Twitter Site</label>
                <input type="text" name="twitter_site" value="{{ old('twitter_site', $seo->twitter_site ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label>Twitter Title</label>
                <input type="text" name="twitter_title"
                    value="{{ old('twitter_title', $seo->twitter_title ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block">Twitter Image
                    <input id="twitterImageInput" name="twitter_image" type="file"
                        value="{{ old('twitter_image', $seo->twitter_image ?? '') }}"
                        class="w-full mt-1 p-2 border rounded" onchange="previewImage(event, 'twitterPreview')">
                </label>
                <img id="twitterPreview" class="mt-2 border rounded" style="height: 50px; width: 75px;"
                    src="{{ $seo->twitter_image ? asset('uploads/seo/' . $seo->twitter_image) : asset('img/default-banner.jpg') }}" />
            </div>

            <!-- Image Alt Text for SEO -->
            <div>
                <label class="block mt-3">Alt Text (for SEO)
                    <input type="text" name="img_alt" value="{{ old('img_alt', isset($seo) ? $seo->img_alt : '') }}"
                        class="w-full mt-1 p-2 border rounded" placeholder="Enter image alt text (SEO friendly)">
                </label>
            </div>

            <div class="col-span-2">
                <label>Twitter Description</label>
                <textarea name="twitter_description" class="w-full mt-1 p-2 border rounded summernote" rows="3">{{ old('twitter_description', $seo->twitter_description ?? '') }}</textarea>
            </div>

            {{-- Short Slug --}}
            {{-- <div>
                <label>Has Short Slug?</label>
                <select name="has_short_slug" class="w-full border rounded px-3 py-2">
                    <option value="0"
                        {{ old('has_short_slug', $seo->has_short_slug ?? 0) == 0 ? 'selected' : '' }}>No</option>
                    <option value="1"
                        {{ old('has_short_slug', $seo->has_short_slug ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <div>
                <label>Short Slug</label>
                <input type="text" name="short_slug" value="{{ old('short_slug', $seo->short_slug ?? '') }}"
                    class="w-full border rounded px-3 py-2">
            </div> --}}

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
