<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight max-w-4xl mx-auto">
            Add Banner
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
            Add Banner
        </h2>
        <form class="bg-white w-full space-y-4" method="post" action="{{ route('save.banner') }}"
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
                <img id="preview" src="{{ isset($banner) && $banner->image ? asset($banner->image) : '' }}"
                    class="mt-2 border rounded"
                    style="height: 50px; width: 75px; {{ isset($banner) && $banner->image ? '' : 'display: none;' }}">
            </div>
            <!--end image file-->

             <div>
                <label class="block">Button Text<span class="text-red-700"></span>
                    <input name="button_text" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Button Text">
                </label>
            </div>

             <div>
                <label class="block">Button Link<span class="text-red-700"></span>
                    <input name="button_link" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Button Link">
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
