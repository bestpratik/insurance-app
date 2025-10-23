<x-app-layout>
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible max-w-4xl mx-auto">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif

    <div
        class="bg-white border rounded-lg col-span-2 mt-4 p-8 flex flex-wrap align-center justify-between max-w-4xl mx-auto">
        <h2 class="font-semibold text-xl text-gray-800 m-0">Add Blog Tag</h2>

        <a href="{{ route('blog.tag') }}"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 
                   focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <x-heroicon-o-arrow-left class="w-4 h-4" />
        </a>

        <form class="bg-white w-full space-y-4" method="POST" action="{{ route('save.blog.tag') }}"
            enctype="multipart/form-data">
            @csrf

            <!-- Tag name -->
            <div>
                <label class="block">Tag Name<span class="text-red-700">*</span></label>
                <input name="tag_name" type="text" class="w-full mt-1 p-2 border rounded"
                    placeholder="Enter Tag Name" value="{{ old('tag_name') }}">
                @error('tag_name')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div class="flex gap-4">
                <label class="inline-flex items-center mt-2">
                    <input type="checkbox" name="status" value="1" {{ old('status') ? 'checked' : '' }}
                        class="mr-2">
                    Active
                </label>

                <!-- Is Popular -->
                <label class="inline-flex items-center mt-2">
                    <input type="checkbox" name="is_popular" value="1" class="mr-2"> Popular
                </label>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Submit</button>
        </form>
    </div>
</x-app-layout>
