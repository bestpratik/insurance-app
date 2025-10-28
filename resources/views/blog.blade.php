<x-front>
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
    <!-- Hero Section with Gradient Overlay -->
    <section
        class="relative bg-[url('https://images.unsplash.com/photo-1570129477492-45c003edd2be')] bg-cover bg-center bg-no-repeat text-white">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative z-10 py-24 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $blogs->title ?? '' }}</h1>
                {{-- <p class="text-lg md:text-xl">Sub Title</p> --}}
            </div>
        </div>
    </section>
    <section class="py-10">
        <div class="max-w-7xl mx-auto">
            <!-- Blog Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                @foreach ($blogs as $blog)
                    <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-md transition">
                        <img src="{{ asset('uploads/blogs/' . $blog->image) ?? '' }}" alt="Blog Image"
                            class="w-full h-48 object-cover">
                        <div class="p-4">
                            @if ($blog->categories->isNotEmpty())
                                @foreach ($blog->categories as $category)
                                    <span
                                        class="inline-block text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-medium mb-2">
                                        {{ $category->title }}
                                    </span>
                                @endforeach
                            @else
                                <span
                                    class="inline-block text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded-full font-medium mb-2 hidden">
                                    Uncategorized 
                                </span>
                            @endif

                            <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                                {!! \Illuminate\Support\Str::limit(strip_tags($blog->description), 120) !!}
                            </p>
                            <a href="{{ route('blog.details', [$type, $blog->slug]) }}"
                                class="text-indigo-600 text-sm font-medium hover:underline">
                                Read more..
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            {{-- <div class="text-center mt-10">
                <button class="bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-2 rounded-full transition">
                    Load More
                </button>
            </div> --}}
        </div>
    </section>
</x-front>
