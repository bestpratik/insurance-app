<x-app-layout>
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible max-w-4xl mx-auto">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif

    <div class="bg-white border rounded-lg col-span-2 mt-4 p-8 flex flex-wrap justify-between max-w-4xl mx-auto">
        <h2 class="font-semibold text-xl text-gray-800 m-0">Edit Blog Tag</h2>
        <a href="{{ route('blog.tag') }}"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
            <x-heroicon-o-arrow-left class="w-4 h-4" />
        </a>

        <form class="bg-white w-full space-y-4" method="post" action="{{ route('update.blog.tag', $tag->id) }}"
            enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- Tag name --}}
            <div>
                <label class="block">Tag Name<span class="text-red-700">*</span>
                    <input name="tag_name" value="{{ $tag->tag_name }}" type="text"
                        class="w-full mt-1 p-2 border rounded">
                </label>
            </div>

            {{-- Status --}}
            <div class="flex gap-4">
                <label class="inline-flex items-center mt-2">
                    <input type="checkbox" name="status" value="1" {{ $tag->status ? 'checked' : '' }}
                        class="mr-2">
                    Active
                </label>
            {{-- Is Popular --}}
                <label class="inline-flex items-center mt-2">
                    <input type="checkbox" name="is_popular" value="1" class="mr-2"
                        {{ $tag->is_popular ? 'checked' : '' }}> Popular
                </label>
            </div>

            <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Update</button>
        </form>
    </div>
</x-app-layout>
