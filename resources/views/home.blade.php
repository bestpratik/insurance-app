<x-front>
    <section class="relative w-full max-h-[450px] overflow-hidden">
        <!-- Slider Container -->
        <div id="sliderWrapper" class="flex transition-transform duration-500 ease-in-out"
            style="transform: translateX(0%)">
            <!-- Slide 1 -->
            @foreach ($banner as $row)
            <div class="min-w-full max-h-[450px] relative">
                <img src="{{ asset('uploads/banner/' . $row->image) }}" class="w-full h-[450px] object-cover" alt="Slide 1" />
                <div class="absolute inset-0 bg-black/30 flex items-center">
                    <div class="container mx-auto px-6">
                        <div class="max-w-xl text-white">
                            <h2 class="text-4xl font-bold mb-4">{{ $row->title ?? '' }}</h2>
                            <p class="text-lg text-gray-100 mb-6">{{ $row->sub_title ?? '' }}</p>
                            @if ($row->button_text)
                            <a href="{{ route('about.us') }}"
                                class="relative rounded-lg flex h-[50px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-56 hover:before:w-56">
                                <span class="relative z-1">{{ $row->button_text ?? '' }}</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Left Arrow -->
        <button id="prevBtn"
            class="absolute left-3 top-1/2 transform -translate-y-1/2 bg-red-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md z-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Right Arrow -->
        <button id="nextBtn"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-red-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md z-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:flex md:items-center md:gap-12">
            <!-- Left: Image + Badge -->
            <div class="relative md:w-1/2">
                <div
                    class="absolute -top-6 -left-6 bg-red-600 text-white text-center px-6 py-4 rounded-md shadow-md z-1 flex space-x-2 align-center">
                    <p class="text-6xl font-bold">47</p>
                    <div class="text-start">
                        <p class="text-3xl font-semibold">Years</p>
                        <p class="text-sm">Experience</p>
                    </div>
                </div>
                <img src="{{ asset('uploads/about/' . $aboutFirst->image ?? '') }}" alt="about" class="rounded-md shadow-lg">
            </div>

            <!-- Right: Text Content -->
            <div class="md:w-1/2 mt-10 md:mt-0">
                <h2 class="text-3xl md:text-4xl font-bold text-black mb-4 leading-tight">{{ $aboutFirst->title ?? '' }}
                </h2>
                <p class="text-gray-600 mb-4">
                    {!! $aboutFirst->description ?? '' !!}
                </p>
                <a href="{{ route('about.us') }}"
                    class="relative rounded-lg flex h-[50px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-56 hover:before:w-56">
                    <span class="relative z-1">More Details</span>
                </a>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-16">
        <div class="max-w-4xl mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                @foreach ($service as $row)
                <div class="bg-white rounded-xl shadow-md overflow-hidden relative ">
                    @if ($row->offer)
                        <div class="absolute top-4 left-[-30px] bg-red-600 text-white text-xs font-bold px-8 py-1 rotate-[-45deg] shadow-md">
                            {{ $row->offer }}
                        </div>
                    @endif

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

    <section class="py-16 bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-white mb-12">
                We Provide Professional <br />
                <span class="text-red-600">Insurance Services</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card Template (copy this for all) -->
                @foreach ($fact as $row)
                <div
                    class="bg-gray-900 rounded-lg shadow-lg p-6 hover:shadow-xl transition border border-gray-700 hover:backdrop-blur-2xl">
                    <div class="flex items-start gap-4">
                        <div class="bg-red-600 text-white p-3 rounded-md">
                            <img src="{{ asset('uploads/fact/' . $row->image) }}">
                        </div>
                        <div class="text-gray-400 max-w-[270px] min-w-[260px]">
                            <h3 class="text-lg font-semibold text-white">{{ $row->title }}</h3>
                            <p class="text-white text-sm mt-2">{!! $row->description !!}</p>
                            {{-- <a href="#"
                                class="inline-block mt-4 text-red-500 hover:underline text-sm font-medium">Read
                                More</a> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="clients my-12">

        <!-- Swiper Container -->
        <div class="swiper mySwiper w-full max-w-7xl mx-auto">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($client as $row)
                <div
                    class=" swiper-slide border rounded-md  hover:scale-103 transition-transform duration-300 flex items-center justify-center">
                    <img src="{{ asset('uploads/client/' . $row->image) }}" class=" px-8 py-3" alt="">
                </div>
                @endforeach
            </div>

            <!-- Optional Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>
</x-front>