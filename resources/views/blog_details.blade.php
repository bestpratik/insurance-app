<x-front>
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
    <!-- Hero Section with Gradient Overlay -->
    <section
        class="relative bg-[url('https://images.unsplash.com/photo-1570129477492-45c003edd2be')] bg-cover bg-center bg-no-repeat text-white">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative z-10 py-6 px-6">
            <div class="max-w-7xl mx-auto">
                <nav class="text-sm text-gray-300 mb-3">
                    @php
                        $sectionName = $type === 'resource' || $type === 'resources' ? 'Resource' : 'Blog';
                    @endphp
                    <a href="{{ route('blogs', $type) }}" class="hover:text-white transition">{{ $sectionName }}</a>
                    <span class="mx-2">/</span>
                    <span class="text-white font-medium">
                        {{ \Illuminate\Support\Str::limit($blogs->title, 40) }}
                    </span>
                </nav>
                <h1 class="text-2xl md:text-3xl font-bold mb-4">{{ $blogs->title ?? '' }}</h1>
                {{-- <p class="text-lg md:text-xl">Discover the latest trends, tips, and stories shaping our journey forward.
                </p> --}}
            </div>
        </div>
    </section>
    <section class="max-w-7xl mx-auto py-10 px-4 grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Left: Blog Content -->
        <div class="lg:col-span-8">
            <!-- Blog Title -->
            <h1 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-4">
                {{ $blogs->title ?? '' }}
            </h1>

            <!-- Author Info -->
            @php
                $shareUrl = urlencode(request()->fullUrl());
                $shareTitle = urlencode($blogs->title ?? 'Check out this blog!');
            @endphp

            <div class="flex items-center justify-between pb-3">
                <!-- Author Info -->
                <div class="flex items-center space-x-3 mb-2">
                    <img src="{{ $blogs->image ? asset('uploads/blogs/' . $blogs->author_image) : asset('img/default-banner.jpg') }}"
                        alt="{{ $blogs->img_alt ?? 'Blog Author - ' . ($blogs->title ?? '') }}"
                        class="w-14 h-14 rounded-full object-cover">
                    <div class="text-sm text-gray-600">
                        <p class="font-medium text-gray-800">{{ $blogs->blog_author ?? '' }}</p>
                        <p>{{ $blogs->date ?? '' }}</p>
                    </div>
                </div>

                <!-- Social Share Icons -->
                <div class="flex items-center space-x-2 ml-auto">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                        rel="noopener noreferrer"
                        class="w-9 h-9 flex items-center justify-center border border-gray-300 rounded-full text-gray-500 hover:bg-blue-600 hover:text-white transition">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <!-- Twitter (X) -->
                    <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"
                        target="_blank" rel="noopener noreferrer"
                        class="w-9 h-9 flex items-center justify-center border border-gray-300 rounded-full text-gray-500 hover:bg-sky-500 hover:text-white transition">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>

                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank"
                        rel="noopener noreferrer"
                        class="w-9 h-9 flex items-center justify-center border border-gray-300 rounded-full text-gray-500 hover:bg-blue-700 hover:text-white transition">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}"
                        target="_blank" rel="noopener noreferrer"
                        class="w-9 h-9 flex items-center justify-center border border-gray-300 rounded-full text-gray-500 hover:bg-green-600 hover:text-white transition">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <!-- Feature Image -->
            <div class="mb-8">
                <img src="{{ $blogs->image ? asset('uploads/blogs/' . $blogs->image) : asset('img/default-banner.jpg') }}"
                    alt="{{ $blogs->image_alt ?? 'Blog Image - ' . ($blogs->title ?? '') }}"
                    class="w-full rounded-lg object-cover">
            </div>

            <!-- Blog Content -->
            <article class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! $blogs->description !!}
            </article>
        </div>

        <!-- Right: Related Posts -->
        @if ($relatedBlogs->count())
            <aside class="lg:col-span-4">
                <div class="sticky top-40">
                    <h2 class="text-xl font-semibold text-red-800 mb-4 border-b border-red-500 pb-2">Related Posts</h2>
                    <div class="space-y-4">
                        @foreach ($relatedBlogs as $related)
                            <a href="{{ route('blog.details', [$type, $related->slug]) }}"
                                class="flex items-center bg-white border rounded-md shadow-sm hover:shadow-md transition p-2">
                                <img src="{{ $related->image ? asset('uploads/blogs/' . $related->image) : asset('img/default-banner.jpg') }}"
                                    alt="{{ $related->image_alt ?? 'Blog Image - ' . ($related->title ?? '') }}"
                                    class="w-20 h-20 rounded object-cover flex-shrink-0">
                                <div class="ml-3">
                                    <h4 class="text-gray-800 font-semibold text-sm line-clamp-2">
                                        {{ $related->title }}
                                    </h4>
                                    <p class="text-gray-600 text-xs mt-1 line-clamp-2">
                                        {!! \Illuminate\Support\Str::limit(strip_tags($related->description), 80) !!}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        @endif
    </section>

</x-front>
