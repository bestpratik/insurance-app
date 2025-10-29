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
            Add Client
        </h2>
        <a href="{{ route('client') }}"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 
                   focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <x-heroicon-o-arrow-left class="w-4 h-4" />
        </a>
        <form class="bg-white w-full space-y-4" method="post" action="{{ route('save.client') }}"
            enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div>
                <label class="block"><span class="text-gray-700">Title</span>
                    <input name="title" type="text" class="w-full mt-1 p-2 border rounded"
                        placeholder="Enter Title">
                </label>
            </div>
            <!-- End Title -->

            <!--Image file-->
            <div>
                <label class="block">Image<span class="text-red-700">*</span>
                    <small class="text-gray-500 block mt-1">Recommended size: 136×100px</small>
                    <input id="imageInput" name="image" type="file" class="w-full mt-1 p-2 border rounded"
                        onchange="previewImage(event)">

                    @if ($errors->has('image'))
                        <span class="mt-1 text-sm text-red-500">{{ $errors->first('image') }}</span>
                    @endif
                </label>

                <!-- Preview Image -->
                <img id="preview" src="{{ isset($client) && $client->image ? asset($client->image) : '' }}"
                    class="mt-2 border rounded"
                    style="height: 50px; width: 75px; {{ isset($client) && $client->image ? '' : 'display: none;' }}">
            </div>
            <!--end image file-->

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
