<x-front>
    <section class="max-w-4xl mx-auto py-10 px-4">
        <!-- Blog Title -->
        <h1 class="text-2xl md:text-3xl font-semibold text-center text-gray-800 mb-4">
            {{ $blogs->title ?? '' }}
        </h1>

        <!-- Author Info -->
        <div class="flex items-center justify-center space-x-3 mb-6">
            <img src="{{ asset('uploads/blogs/' . $blogs->author_image) ?? '' }}" alt="Author"
                class="w-10 h-10 rounded-full">
            <div class="text-sm text-gray-600">
                <p class="font-medium text-gray-800">{{ $blogs->blog_author ?? '' }}</p>
                <p>{{ $blogs->date ?? '' }} • 5 min read</p>
            </div>
            <div class="flex space-x-3 ml-4">
                <a href="#" class="text-gray-500 hover:text-blue-600"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="text-gray-500 hover:text-blue-500"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="text-gray-500 hover:text-pink-500"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="text-gray-500 hover:text-blue-700"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>

        <!-- Feature Image -->
        <div class="mb-8">
            <img src="{{ asset('uploads/blogs/' . $blogs->image)}}"
                alt="Financial Planning" class="w-full rounded-lg shadow">
        </div>

        <!-- Blog Content -->
        <article class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {!! $blogs->description !!}
        </article>

        <!-- Related Posts -->
        @if ($relatedBlogs->count())
            <div class="mt-12">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Related Posts</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($relatedBlogs as $related)
                        <a href="{{ route('blog.details', [$type, $related->slug]) }}"
                            class="bg-white shadow rounded-lg overflow-hidden hover:shadow-md transition">
                            <img src="{{ asset('uploads/blogs/' . $related->image) ?? '' }}"
                                alt="{{ $related->title }}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h4 class="text-gray-800 font-semibold text-base mb-1 line-clamp-2">
                                    {{ $related->title }}
                                </h4>
                                <p class="text-gray-600 text-sm line-clamp-3">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($related->description), 120) !!}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</x-front>
