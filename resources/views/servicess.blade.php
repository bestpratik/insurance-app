  <x-front>  
    
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>

    <!-- Script -->




    <section
        class="relative bg-[url('/service-details.jpg')] bg-cover bg-center bg-no-repeat text-white">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative z-1 py-24 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Buy Directly</h2>
                <p class="text-lg md:text-xl mb-8">Tailored financial solutions to help you grow, protect, and manage
                    your wealth.</p>

            </div>
    </section>


    <section class="bg-gray-100 py-16">
        <div class="max-w-4xl mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                @foreach ($services as $row)                                 
                <div class="bg-white rounded-xl shadow-md overflow-hidden relative ">
                    <img src="{{ asset('uploads/service/' . $row->image) }}" alt="Landlord Protection" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="border-b-4 border-red-500 w-10 mb-4"></div>
                        <h3 class="text-lg font-bold mb-2">{{ $row->title }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $row->sub_title }}</p>
                        <div class="flex gap-2">
                            <a href="{{ route('service.details', $row->page_slug) }}"
                                class="relative rounded-md flex h-[40px] w-40 items-center justify-center overflow-hidden border border-red-600 text-red-600 transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-600 before:duration-500 before:ease-out hover:text-white hover:before:h-40 hover:before:w-56">
                                <span class="relative z-10">Know more</span>
                            </a>
                            <a href="{{route('policy.buyer')}}"
                                class="relative rounded-md flex h-[40px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-40 hover:before:w-56">
                                <span class="relative z-1">Buy Now</span>
                            </a>
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
        </div>
    </section>

</x-front>
