<x-front>
    <!-- Banner Section -->
    <section class="relative w-full h-[450px] overflow-hidden">
        <!-- Slider Wrapper -->
        <div id="sliderWrapper" class="flex transition-transform duration-500 ease-in-out"
            style="transform: translateX(0%)">

            <!-- Slide 1 -->
            @foreach ($banner as $bann)
                <div class="min-w-full h-[450px] flex flex-col sm:flex-row bg-[#e8eae7] relative">
                    <!-- Text Content -->
                    <div
                        class="relative z-10 flex-1 flex items-center justify-center sm:justify-start px-6 sm:px-12 bg-black/40 sm:bg-transparent text-white sm:text-[#144562]">
                        <div class="max-w-4xl text-center sm:text-left md:ps-14 ps-0">
                            <h1 class="text-2xl sm:text-3xl font-bold mb-4">
                                {{ $bann->title ?? '' }}
                            </h1>
                            <div class="flex flex-wrap justify-center sm:justify-start gap-4">
                                <a href="{{ $bann->button_link }}"
                                    class="inline-block bg-[#a10c0c] border-2 border-[#a10c0c] text-white font-semibold px-8 py-3 rounded-md transition-all duration-300 hover:bg-transparent hover:text-[#a10c0c]">
                                    {{ $bann->button_text }}
                                </a>
                                <a href="{{ route('referral.form') }}"
                                    class="inline-block border-2 border-[#a10c0c] text-[#a10c0c] font-semibold px-8 py-3 rounded-md transition-all duration-300 hover:bg-[#a10c0c] hover:text-white">
                                    Get Instant Quote
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="absolute sm:static inset-0 sm:inset-auto flex-1">
                        <img src="{{ $bann->image ? asset('uploads/banner/' . $bann->image) : asset('img/default-banner.jpg') }}"
                            alt="{{ $test->image_alt ?? 'Banner - ' . ($bann->title ?? '') }}"
                            class="w-full h-full object-cover" />
                        <div class="absolute inset-0 bg-black/30 sm:hidden"></div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        <button id="prevBtn"
            class="absolute left-3 top-1/2 transform -translate-y-1/2 bg-[#a10c0c] text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md z-10 hover:bg-[#8b0a0a]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="nextBtn"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-[#a10c0c] text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md z-10 hover:bg-[#8b0a0a]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </section>

    <!--Rent Guarantee Section -->
    <section class="md:py-24 py-0 bg-white">
        <div
            class="max-w-7xl mx-auto p-8 md:flex md:items-center md:gap-12 bg-[#FAF9F2] rounded-xl border border-gray-100">
            <!-- Left: Image + Badge -->
            <div class="relative md:w-1/2">
                <img src="{{ $rent->image ? asset('uploads/rent/' . $rent->image) : asset('img/default-banner.jpg') }}"
                    alt="{{ $rent->image_alt ?? 'Rent Guarantee - ' . ($rent->title ?? '') }}"
                    class="rounded-md shadow-lg">
            </div>

            <!-- Right: Text Content -->
            <div class="md:w-1/2 mt-10 md:mt-0">
                <h2 class="text-xl md:text-2xl font-bold mb-4 leading-tight text-[#144562]">
                    {{ $rent->title ?? '' }}
                </h2>
                <p class="text-[#565656] mb-4">
                    {!! $rent->description ?? '' !!}
                </p>
                <div class="bg-[#f9f7f2]">
                    <!-- Button -->
                    <a href="{{ $rent->button_link }}"
                        class="inline-block mt-2 border-2 border-[#b91c1c] text-[#b91c1c] font-semibold px-6 py-3 rounded-md transition-all duration-300 hover:bg-[#b91c1c] hover:text-white">
                        {{ $rent->button_text }}
                    </a>

                    <!-- Call text -->
                    <p class="mt-4 text-gray-700 text-lg">
                        or call
                        <a href="tel:{{ $rentThird->phone_number ?? '' }}"
                            class="text-[#b91c1c] font-semibold hover:underline">
                            <i class="fa-solid fa-phone"></i>
                            {{ $rent->phone_number ?? '' }}
                        </a>
                        for expert assistance.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Section -->
    <section class="bg-gray-100 py-14">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-wrap justify-center gap-10">

                <!-- Card 1 -->
                @foreach ($service as $row)
                    <div
                        class="bg-white border rounded-md shadow-md overflow-hidden relative group transition-all duration-500 hover:shadow-md w-full sm:w-[48%] lg:w-[31%]">
                        <div class="relative">
                            <img src="{{ $row->image ? asset('uploads/service/' . $row->image) : asset('img/default-banner.jpg') }}"
                                alt="{{ $row->image_alt ?? 'LandLord Protection - ' . ($row->title ?? '') }}"
                                class="w-full h-64 object-cover rounded-t-md group-hover:brightness-90 transition-all duration-300">

                            <!-- 💰 Ribbon Price -->
                            <div
                                class="absolute top-5 left-[-40px] bg-red-600 text-white px-16 py-2 text-md font-semibold shadow-md rotate-[-45deg]">
                                £{{ number_format($row->price, 0) }}
                            </div>
                        </div>

                        <span
                            class="w-full bg-[#072b47] text-white px-3 py-1 text-sm font-semibold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 640 640"
                                class="w-4 h-4">
                                <path
                                    d="M256.1 72C322.4 72 376.1 125.7 376.1 192C376.1 258.3 322.4 312 256.1 312C189.8 312 136.1 258.3 136.1 192C136.1 125.7 189.8 72 256.1 72zM226.4 368L285.8 368C292.5 368 299 368.4 305.5 369.1C304.6 374 304.1 379 304.1 384.1L304.1 476.2C304.1 501.7 314.2 526.1 332.2 544.1L364.1 576L77.8 576C61.4 576 48.1 562.7 48.1 546.3C48.1 447.8 127.9 368 226.4 368zM352.1 476.2L352.1 384.1C352.1 366.4 366.4 352.1 384.1 352.1L476.2 352.1C488.9 352.1 501.1 357.2 510.1 366.2L606.1 462.2C624.8 480.9 624.8 511.3 606.1 530.1L530 606.2C511.3 624.9 480.9 624.9 462.1 606.2L366.1 510.2C357.1 501.2 352 489 352 476.3zM456.1 432C456.1 418.7 445.4 408 432.1 408C418.8 408 408.1 418.7 408.1 432C408.1 445.3 418.8 456 432.1 456C445.4 456 456.1 445.3 456.1 432z">
                                </path>
                            </svg>
                            {{ $row->tag ?? '' }}
                        </span>

                        <div class="p-6 pt-0 relative">
                            <h3
                                class="text-xl font-bold text-gray-800 mb-2 mt-2 group-hover:text-red-700 transition-all duration-300">
                                {{ $row->title ?? '' }}
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6">
                                {{ $row->sub_title ?? '' }}
                            </p>

                            <div class="flex gap-4 justify-between">
                                <a href="{{ route('service.details', $row->page_slug) }}"
                                    class="relative rounded-md flex h-[42px] w-40 items-center justify-center overflow-hidden border border-red-600 text-red-600 font-semibold transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-600 before:duration-500 before:ease-out hover:text-white hover:before:h-40 hover:before:w-56">
                                    <span class="relative z-10">Know more</span>
                                </a>

                                <a href="{{ route('policy.buyer', $row->page_slug) }}"
                                    class="relative rounded-md flex h-[42px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white font-semibold transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-lg hover:shadow-red-500/40 hover:before:h-40 hover:before:w-56">
                                    <span class="relative z-10">Buy Now</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Who Should Buy Rent Guarantee Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

            <!-- Left Text Section -->
            <div class=" md:pl-6">
                <h2 class="text-[#a10c0c] text-xl md:text-2xl font-bold mb-3 leading-tight">
                    {{ $rentSecond->title ?? '' }}
                </h2>

                <p class="text-[#144562] text-lg font-medium max-w-2xl mb-6">
                    {!! $rentSecond->description ?? '' !!}
                </p>

                <a href="{{ $rentSecond->button_link }}"
                    class="inline-block mt-2 border-2 border-[#a10c0c] text-[#a10c0c] font-semibold md:px-6 px-4 py-3 rounded-md transition-all duration-300 hover:bg-[#a10c0c] hover:text-white">
                    {{ $rentSecond->button_text }}
                </a>
            </div>

            <!-- Right Image Section -->
            <div class="flex justify-center">
                <img src="{{ $rentSecond->image ? asset('uploads/rent/' . $rentSecond->image) : asset('img/default-banner.jpg') }}"
                    alt="{{ $rentSecond->image_alt ?? 'Rent Guarantee Insurance - ' . ($rent->title ?? '') }}"
                    class="rounded-lg w-full max-w-md">
            </div>

        </div>
    </section>

    <!-- Benefit of Rent Guarantee Section -->
    <section class="bg-[#072b47] text-white py-14 relative">
        <div
            class="max-w-7xl mx-auto flex flex-col-reverse lg:flex-row items-center justify-between gap-2 md:gap-10 px-6">

            <div class="lg:w-1/2 flex justify-center">
                <img src="{{ $fact->image ? asset('uploads/fact/' . $fact->image) : asset('img/default-banner.jpg') }}"
                    alt="{{ $fact->image_alt ?? 'Group of people sitting together - ' . ($fact->title ?? '') }}"
                    class="rounded-xl shadow-xl object-cover w-full max-w-[480px] md:absolute relative md:top-12 top-5 " />
            </div>
            <div class="lg:w-1/2 space-y-4">
                <h2 class="text-2xl font-semibold mb-6">
                    {{ $fact->title ?? '' }}
                </h2>
                <ul class="space-y-3">
                    <li class="flex items-center">
                        {!! $fact->description ?? '' !!}
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Get Protected Section -->
    <section class="bg-white py-12 mt-24">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 px-6 items-center">
            <div>
                <h2 class="text-[#a10c0c] text-xl md:text-2xl font-bold mb-4 leading-tight">
                    {{ $rentThird->title ?? '' }}
                </h2>
                <p class="text-gray-600 mb-4">
                    {!! $rentThird->description ?? '' !!}
                </p>
                <a href="{{ $rentThird->button_link }}"
                    class="inline-block mt-2 bg-[#a10c0c] text-white font-semibold px-8 py-3 rounded-md transition-all duration-300 hover:bg-[#8b0a0a] hover:shadow-md">
                    {{ $rentThird->button_text }}
                </a>
                <p class="mt-4 text-gray-600">
                    or call
                    <a href="tel:{{ $rentThird->phone_number ?? '' }}"
                        class="text-[#b91c1c] font-semibold hover:underline">
                        <i class="fa-solid fa-phone"></i>
                        {{ $rentThird->phone_number ?? '' }}
                    </a>
                    for expert assistance.
                </p>
            </div>
            <div class="flex justify-center">
                <img src="{{ $rentThird->image ? asset('uploads/rent/' . $rentThird->image) : asset('img/default-banner.jpg') }}"
                    alt="{{ $rentThird->image_alt ?? 'Red house miniature - ' . ($rentThird->title ?? 'Happy Client') }}"
                    class="rounded-lg shadow-md" />
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-[#0B3C5D] mb-10">Testimonials</h2>

            <!-- Swiper Container -->
            <div class="swiper testimonialSwiper">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    @foreach ($testimonial as $test)
                        <div class="swiper-slide flex flex-col md:flex-row items-center  gap-8 text-left">
                            <div
                                class="w-40 h-40 bg-[#144562] rounded-2xl flex justify-center item-center p-3 flex-shrink-0 shadow-lg">
                                <img src="{{ $test->image ? asset('uploads/testimonial/' . $test->image) : asset('img/default-banner.jpg') }}"
                                    alt="{{ $test->image_alt ?? 'Customer testimonial - ' . ($test->name ?? 'Happy Client') }}"
                                    class="rounded-lg shadow-md" />
                            </div>
                            <div>
                                <div class="text-red-700 text-lg mb-2">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <p class="text-gray-700 mb-2 max-w-md">
                                    {!! $test->review ?? '' !!}
                                </p>
                                <p class="font-semibold text-gray-800">{{ $test->name ?? '' }},
                                    {{ $test->location ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-center mt-10 space-x-6">
                    <button
                        class="testimonial-prev !static !w-10 !h-10 bg-red-700 text-white rounded-full flex items-center justify-center hover:bg-red-800 transition">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button
                        class="testimonial-next !static !w-10 !h-10 bg-red-700 text-white rounded-full flex items-center justify-center hover:bg-red-800 transition">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-start">

            <!-- Left content -->
            <div>
                <h2 class="text-3xl font-bold text-red-700 mb-2">
                    Frequently Asked Questions
                </h2>
                <p class="font-semibold text-gray-900 mb-2">
                    Your Questions, Answered with Clarity
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    We’ve got clear, simple answers to help you understand your coverage,
                    payments, and claims—so you can stay confident and protected.
                </p>
                <a href="{{ route('faq.details') }}"
                    class="inline-block border border-red-600 text-red-600 font-semibold px-5 py-2 rounded hover:bg-red-600 hover:text-white transition">
                    View All FAQ
                </a>
            </div>

            <!-- Right content (FAQ Accordion) -->
            <div class="space-y-4" id="faqContainer">

                <!-- FAQ item -->
                @foreach ($faqs as $faq)
                    <div class="border-b border-gray-200 pb-3">
                        <button
                            class="faq-btn flex items-center justify-between w-full text-left font-medium text-lg text-gray-900 hover:text-[#144562] transition">
                            <span>{{ $loop->iteration }}. {{ $faq->question ?? '' }}</span>
                            <i class="fa-solid fa-arrow-right text-red-600 transition-transform duration-300"></i>
                        </button>
                        <div
                            class="faq-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out text-gray-600">
                            <p class="mt-3 text-gray-600 text-sm">
                                {!! $faq->answer ?? '' !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Question About Rent Guarantee Section -->
    <section class="bg-[#144562] text-white py-8 relative mt-36">
        <div class="max-w-7xl mx-auto flex  justify-between md:gap-10 gap-0 px-6">
            <div class="lg:w-1/2 flex justify-center">
                <img src="./img/Rectangle 17.png" alt="Person"
                    class="object-cover w-full max-w-[480px] absolute md:bottom-0 bottom-[50%] left-0 md:left-auto border-b border-[#255775]" />
            </div>
            <div class="lg:w-1/2 space-y-4 md:pt-0 pt-64">
                <h2 class="text-2xl md:text-3xl font-semibold mb-3">
                    Have a question about <br />
                    <span class="font-bold">Rent Guarantee Insurance?</span>
                </h2>
                <p class="text-gray-200 mb-5 leading-relaxed">
                    At Moneywise Insurance, we simplify the complex — guiding you with clarity, care,
                    and smart protection for your future.
                </p>
                <a href="tel:02085525521"
                    class="inline-flex items-center border border-white px-4 py-2 rounded-md hover:bg-white hover:text-[#0c4a6e] transition">
                    <i class="fa-solid fa-phone mr-2"></i>
                    Get in touch: 020 8552 5521
                </a>
            </div>
        </div>
    </section>

    <!-- Client Section -->
    <section class="clients bg-gray-50 md:py-16 py-8">

        <!-- Swiper Container -->
        <div class="swiper mySwiper w-full max-w-7xl mx-auto px-6">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($client as $row)
                    <div
                        class=" swiper-slide border rounded-md  hover:scale-103 transition-transform duration-300 flex items-center justify-center">
                        <img src="{{ $row->image ? asset('uploads/client/' . $row->image) : asset('img/default-banner.jpg') }}"
                            alt="{{ $row->image_alt ?? 'Client - ' . ($row->title ?? '') }}" class=" px-5 py-3">
                    </div>
                @endforeach
            </div>

            <!-- Optional Pagination -->
            <div class="flex justify-center mt-6 space-x-6">
                <button
                    class="testimonial-prev !static !w-10 !h-10 bg-red-700 text-white rounded-full flex items-center justify-center hover:bg-red-800 transition">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <button
                    class="testimonial-next !static !w-10 !h-10 bg-red-700 text-white rounded-full flex items-center justify-center hover:bg-red-800 transition">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </section>
</x-front>


