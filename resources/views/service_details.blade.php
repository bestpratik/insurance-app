<x-front>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>

    <!-- Script -->




    <section class="relative bg-[url('/service-details.jpg')] bg-cover bg-center bg-no-repeat text-white">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative z-1 py-24 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Service Details</h2>
                <p class="text-lg md:text-xl mb-8">Professional-grade insurance for everyday landlords.</p>

            </div>
    </section>

    <div class="bg-gray-100 py-12 px-6">
        <div
            class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden grid grid-cols-1 md:grid-cols-2 md:p-8">

            <div class="relative">
                <img src="{{ asset('uploads/service/' . $service->image) }}" alt="Landlord Protection" class="w-full object-cover rounded-l-xl">
            </div>

            <!-- Right: Content -->
            <div class="p-6 flex flex-col justify-center">
                <!-- Border Highlight -->


                <!-- Title -->
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    {{ $service->title }}
                </h1>
                <div class="border-b-4 border-red-500 w-10 mb-4"></div>

                <!-- Intro -->
                <p class="text-sm text-gray-600 mb-4">
                    {{$service->sub_title}}
                </p>

                <!-- Buttons -->
                <div class="flex gap-3 flex-wrap mb-6">
                    <a href="{{route('policy.buyer')}}"
                        class="relative rounded-md flex h-[40px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-40 hover:before:w-56">
                        <span class="relative z-1">Buy Now</span>
                    </a>
                </div>

                <!-- Features -->
                <h2 class="text-xl font-semibold text-gray-800 mb-3">{!! $service->description !!}</h2>
            </div>
        </div>
    </div>
</x-front>
