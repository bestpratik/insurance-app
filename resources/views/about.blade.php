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
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $aboutSecond->title }}</h1>
                    <p class="text-lg md:text-xl">{{ $aboutSecond->sub_title }}</p>
                </div>
            </div>
        </section>

        <!-- Company History -->
        <section class="py-16 px-6">
            <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10">
                <div>
                    <h2 class="text-3xl font-semibold text-red-600 mb-4">Our Journey</h2>
                    <p class="text-lg leading-relaxed">{!! $aboutSecond->description !!}</p>
                </div>
                <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-red-600">
                    <img src="{{ $aboutSecond->image }}" alt="" class="w-full">
                </div>
            </div>
        </section>

        <section class="bg-gray-100 py-16 px-6">
            <div class="max-w-4xl mx-auto text-center mb-10">
                <h2 class="text-3xl font-semibold text-red-600 mb-4">Why Clients Choose Us</h2>
                <p class="text-lg text-gray-700">We build relationships on trust, transparency, and long-term care.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto text-center">
                @foreach ($index->take(-3) as $row)
                    <!-- Personal Service -->
                    <div class="p-6 bg-white rounded-lg shadow-sm">
                        <div
                            class="mx-auto mb-4 flex items-center justify-center h-20 w-20 rounded-full bg-red-100 overflow-hidden">
                            <img src="{{ $row->image }}" alt="Profile Image" class="h-full w-full object-cover" />
                        </div>

                        <h3 class="text-xl font-semibold text-red-600 mb-2">{{ $row->title }}</h3>
                        <p class="text-gray-700">{{ $row->sub_title }}</p>
                    </div>
                @endforeach
            </div>
        </section>

    </x-front>
