<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-seo-meta :seo="$seo ?? null" :model="$model ?? null" />
    <!-- ✅ Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: "Istok Web", sans-serif;
            font-weight: 400;
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
        }
    </style>

    <!-- (Optional) Tailwind Config for Custom Theme -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#300303ff',
                    }
                }
            }
        }
    </script>
</head>

<body>

    @include('layouts.front_navigation')
    @include('layouts.front_header')

    <main id="main-content" role="main">
        {{ $slot }}
    </main>

    @include('layouts.front_footer')

    @php
        $service = serviceHelper();
        //dd($service);


        $icons = [
            [
                'icon' => 'fa-users',
                'icon_bg' => 'bg-red-50',
                'icon_border' => 'border-red-100',
                'icon_color' => 'text-red-600',
                'hover_border' => 'hover:border-red-300',
                'hover_bg' => 'group-hover:bg-red-600',
                'badge' => 'bg-red-100 text-red-700',
            ],
            [
                'icon' => 'fa-shield-halved',
                'icon_bg' => 'bg-blue-50',
                'icon_border' => 'border-blue-100',
                'icon_color' => 'text-[#144562]',
                'hover_border' => 'hover:border-blue-300',
                'hover_bg' => 'group-hover:bg-[#144562]',
                'badge' => 'bg-blue-100 text-[#144562]',
            ],
        ];
    @endphp


    <!-- ================= LEFT FLOATING SQUARE TRIGGER (MOBILE ONLY) ================= -->
    <div class="fixed left-0 top-1/2 -translate-y-1/2 z-40 md:hidden">
        <button id="quotePopupTrigger" aria-label="Quick Quote"
            class="flex flex-col items-center justify-center w-14 h-16 bg-white text-[#a10c0c] rounded-r-xl shadow-2xl border-y border-r border-red-100 ring-1 ring-black/5 active:scale-95 transition-all duration-200">
            <div class="relative">
                <span class="absolute -top-1 -right-1 flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-600"></span>
                </span>
                <i class="fa-solid fa-file-invoice text-red-600 text-sm"></i>
            </div>
            <span
                class="text-[10px] font-extrabold tracking-tight uppercase mt-1 leading-tight text-center text-[#144562]">
                Get a Quote
            </span>
        </button>
    </div>

    <!-- ================= PREMIUM WHITE BOTTOM SHEET POPUP ================= -->
    <div id="quoteSheetOverlay"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden">
    </div>

    <div id="quoteSheetDrawer"
        class="fixed bottom-0 left-0 right-0 z-50 bg-white rounded-t-3xl shadow-[0_-12px_40px_rgba(0,0,0,0.18)] border-t border-gray-100 p-5 transform translate-y-full transition-transform duration-300 ease-out md:hidden">

        <!-- Header -->
        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
            <div class="flex items-center space-x-2">
                <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                <h3 class="text-base font-bold text-[#144562]">Get an Instant Quote</h3>
            </div>
            <button id="quoteSheetClose" aria-label="Close"
                class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:text-gray-800 transition">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <p class="text-xs text-gray-500 mt-2 mb-4">Choose your policy type to proceed:</p>

        <!-- 3 White Action Cards -->
        <div class="space-y-3">

            @foreach ($service as $index => $item)

            @php
                $style = $icons[$index] ?? $icons[0];
            @endphp
            <!-- Option 1: DSS / Benefit Tenants -->
            <a href="{{ url('/policy-buyer/' . $item->page_slug) }}"
                class="group flex items-center justify-between p-3.5 rounded-2xl bg-white border border-gray-200/90 shadow-sm {{ $style['hover_border'] }} hover:shadow-md active:scale-[0.98] transition-all">

                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl {{ $style['icon_bg'] }} border {{ $style['icon_border'] }} flex items-center justify-center {{ $style['icon_color'] }}">
                        <i class="fa-solid {{ $style['icon'] }} text-sm"></i>
                    </div>
                  
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-bold text-gray-900 tracking-tight">
                                {{ ucfirst(preg_replace('/^For\s+/i', '', $item->tag)) }}
                            </span>
                            <span
                                class="text-[10px] font-bold px-1.5 py-0.5 rounded {{ $style['badge'] }}">£{{ number_format((float) $item->price, 0) }}</span>
                        </div>
                        <span class="text-[11px] text-gray-500 block">{{ $item->title }}</span>
                    </div>
                </div>
                <div
                    class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </a>

            @endforeach

            <!-- Option 2: Standard Tenants -->
            {{-- <a href="https://insurance.moneywiseplc.co.uk/policy-buyer/standard-landlord-legal-expenses-rent-guarantee-insurance"
                class="group flex items-center justify-between p-3.5 rounded-2xl bg-white border border-gray-200/90 shadow-sm hover:border-blue-300 hover:shadow-md active:scale-[0.98] transition-all">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-[#144562]">
                        <i class="fa-solid fa-shield-halved text-sm"></i>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-bold text-gray-900 tracking-tight">Standard Tenants</span>
                            <span
                                class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-blue-100 text-[#144562]">£156</span>
                        </div>
                        <span class="text-[11px] text-gray-500 block">Standard Rent Guarantee Protection</span>
                    </div>
                </div>
                <div
                    class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 flex items-center justify-center group-hover:bg-[#144562] group-hover:text-white transition-colors">
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </a> --}}

            <!-- Option 3: Travel Insurance (Highlighted Green Badge) -->
            <a href="https://moneywise.aneevo.com/"
                class="group flex items-center justify-between p-3.5 rounded-2xl bg-emerald-50/50 border-2 border-emerald-500/40 shadow-sm hover:border-emerald-500 hover:shadow-md active:scale-[0.98] transition-all">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-emerald-100 border border-emerald-200 flex items-center justify-center text-emerald-700">
                        <i class="fa-solid fa-plane-departure text-sm"></i>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-bold text-emerald-950 tracking-tight">Travel Insurance</span>
                            <span
                                class="text-[9px] font-extrabold uppercase tracking-wider px-1.5 py-0.5 rounded bg-emerald-600 text-white">Instant</span>
                        </div>
                        <span class="text-[11px] text-emerald-800/80 block">Single &amp; Annual multi-trip cover</span>
                    </div>
                </div>
                <div
                    class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center group-hover:bg-emerald-700 transition-colors">
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </a>

        </div>

        <!-- Bottom Direct Helpline -->
        <div class="mt-4 pt-3 border-t border-gray-100 text-center">
            <a href="tel:02085525521"
                class="inline-flex items-center gap-2 text-xs font-semibold text-gray-700 hover:text-red-700">
                <i class="fa-solid fa-phone text-red-600"></i> Expert Advice: <span class="text-red-700 underline">020
                    8552 5521</span>
            </a>
        </div>
    </div>

    <script>
        (function() {
            const trigger = document.getElementById('quotePopupTrigger');
            const overlay = document.getElementById('quoteSheetOverlay');
            const drawer = document.getElementById('quoteSheetDrawer');
            const closeBtn = document.getElementById('quoteSheetClose');

            function openSheet() {
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                drawer.classList.remove('translate-y-full');
                document.body.classList.add('overflow-hidden');
            }

            function closeSheet() {
                overlay.classList.add('opacity-0', 'pointer-events-none');
                drawer.classList.add('translate-y-full');
                document.body.classList.remove('overflow-hidden');
            }

            if (trigger && overlay && drawer && closeBtn) {
                trigger.addEventListener('click', openSheet);
                closeBtn.addEventListener('click', closeSheet);
                overlay.addEventListener('click', closeSheet);
            }
        })();
    </script>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>

    <!-- Back to Top Button -->
    <button id="backToTop" aria-label="Back to top"
        class="hidden fixed right-6 bottom-6 z-50 p-3 rounded-full bg-red-600 text-white shadow-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 transition-opacity duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        (function() {
            const btn = document.getElementById('backToTop');
            const showAfter = 300; // px scrolled

            function updateVisibility() {
                if (window.scrollY > showAfter) {
                    btn.classList.remove('hidden');
                } else {
                    btn.classList.add('hidden');
                }
            }

            // Smooth scroll to top
            function scrollTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // Init
            window.addEventListener('scroll', updateVisibility, {
                passive: true
            });
            btn.addEventListener('click', scrollTop);
            btn.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    scrollTop();
                }
            });

            // Make sure visibility is correct on load
            updateVisibility();
        })();
    </script>

    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 2,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 40,
                },
            },
            navigation: {
                nextEl: ".testimonial-next",
                prevEl: ".testimonial-prev",
            },
            speed: 800,
            grabCursor: true,
        });
    </script>

    <script>
        // Mobile Menu Functionality
        const menuToggle = document.getElementById('menuToggle');
        const menuClose = document.getElementById('menuClose');
        const mobileMenu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
        });

        menuClose.addEventListener('click', () => {
            mobileMenu.classList.add('translate-x-full');
            overlay.classList.add('hidden');
        });

        overlay.addEventListener('click', () => {
            mobileMenu.classList.add('translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>

    <script>
        // banner Slider Functionality
        var sliderWrapper = document.getElementById('sliderWrapper');
        var slides = sliderWrapper.children;
        var totalSlides = slides.length;
        let currentIndex = 0;

        var updateSlider = () => {
            sliderWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
        };

        document.getElementById('prevBtn').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlider();
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider();
        });
    </script>

    <script>
        // FAQ Accordion Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const faqs = document.querySelectorAll('.faq-btn');
            faqs.forEach(btn => {
                btn.addEventListener('click', () => {
                    const content = btn.nextElementSibling;
                    const icon = btn.querySelector('i');
                    document.querySelectorAll('.faq-content').forEach(c => {
                        if (c !== content) {
                            c.style.maxHeight = null;
                            c.previousElementSibling.querySelector('i').classList.remove(
                                'rotate-90');
                        }
                    });
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                        icon.classList.remove('rotate-90');
                    } else {
                        content.style.maxHeight = content.scrollHeight + 'px';
                        icon.classList.add('rotate-90');
                    }
                });
            });
        });
    </script>

    <script>
        // Testimonial Swiper Initialization
        const testimonialSwiper = new Swiper(".testimonialSwiper", {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".testimonial-next",
                prevEl: ".testimonial-prev",
            },
            slidesPerView: 1,
            spaceBetween: 30,
            centeredSlides: true,
            breakpoints: {
                768: {
                    slidesPerView: 1,
                    centeredSlides: false,
                },
                1100: {
                    slidesPerView: 2,
                    centeredSlides: false,
                },
            },
        });
    </script>

    <script>
        const accountBtn = document.getElementById('accountBtn');
        const accountMenu = document.getElementById('accountMenu');

        accountBtn.addEventListener('click', () => {
            accountMenu.classList.toggle('hidden');
        });

        window.addEventListener('click', (e) => {
            if (!accountBtn.contains(e.target) && !accountMenu.contains(e.target)) {
                accountMenu.classList.add('hidden');
            }
        });
    </script>

    <!-- Swiper JS -->




    <!-- this is a simple script to handle the scroll to top button -->
    <!-- <script>
        const btn = document.getElementById("scrollToTopBtn");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 100) {
                btn.classList.remove("hidden");
            } else {
                btn.classList.add("hidden");
            }
        });

        btn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script> -->

    <!-- ===================================this is tab menu script ======================================== -->
    <!-- <script>
        var tabButtons = document.querySelectorAll(".tab-btn");
        var tabContents = document.querySelectorAll(".tab-content");

        tabButtons.forEach(button => {
            button.addEventListener("click", () => {
                // Remove active class from all
                tabButtons.forEach(btn => btn.classList.remove("tab-active"));
                tabContents.forEach(content => content.classList.add("hidden"));

                // Activate current
                button.classList.add("tab-active");
                document.getElementById(button.dataset.tab).classList.remove("hidden");
            });
        });
    </script> -->

    <!-- ----------------------------------------this is tab menu script end-------------------------------------------- -->
    <script>
        const tabWrapper = document.getElementById('tabWrapper');
        const scrollLeft = document.getElementById('scrollLeft');
        const scrollRight = document.getElementById('scrollRight');

        function updateButtons() {
            // const maxScrollLeft = tabWrapper.scrollWidth - tabWrapper.clientWidth;
            // scrollLeft.style.display = tabWrapper.scrollLeft > 0 ? 'inline' : 'none';
            // scrollRight.style.display = tabWrapper.scrollLeft < maxScrollLeft - 5 ? 'inline' : 'none';
        }

        // scrollLeft.addEventListener('click', () => {
        //     tabWrapper.scrollBy({
        //         left: -150,
        //         behavior: 'smooth'
        //     });
        // });

        // scrollRight.addEventListener('click', () => {
        //     tabWrapper.scrollBy({
        //         left: 150,
        //         behavior: 'smooth'
        //     });
        // });

        // tabWrapper.addEventListener('scroll', updateButtons);
        window.addEventListener('resize', updateButtons);
        window.addEventListener('load', updateButtons);
    </script>

    <script>
        const wrapper = document.getElementById('tabWrapper');
        const leftBtn = document.getElementById('scrollLeft');
        const rightBtn = document.getElementById('scrollRight');
        const tabButtons = document.querySelectorAll('.tab-btn');

        function updateArrowVisibility() {
            // const scrollLeft = wrapper.scrollLeft;
            // const scrollWidth = wrapper.scrollWidth;
            // const clientWidth = wrapper.clientWidth;
            // leftBtn.style.display = scrollLeft > 5 ? 'flex' : 'none';
            // rightBtn.style.display = scrollLeft + clientWidth < scrollWidth - 5 ? 'flex' : 'none';
        }

        function scrollTab(direction = 'left') {
            wrapper.scrollBy({
                left: direction === 'left' ? -150 : 150,
                behavior: 'smooth'
            });
        }

        // leftBtn.addEventListener('click', () => scrollTab('left'));
        // rightBtn.addEventListener('click', () => scrollTab('right'));
        // wrapper.addEventListener('scroll', updateArrowVisibility);
        window.addEventListener('resize', updateArrowVisibility);
        window.addEventListener('load', () => {
            updateArrowVisibility();
            const active = document.querySelector('.active-tab');
            if (active) {
                active.scrollIntoView({
                    behavior: 'smooth',
                    inline: 'center'
                });
            }
        });

        // Optional: Handle active tab change and center
        tabButtons.forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                document.querySelector('.active-tab')?.classList.remove('text-red-600', 'border-red-500',
                    'active-tab');
                btn.classList.add('text-red-600', 'border-red-500', 'active-tab');
                btn.scrollIntoView({
                    behavior: 'smooth',
                    inline: 'center'
                });
            });
        });
    </script>

    <script>
        const accountBtnMobile = document.getElementById("accountBtnMobile");
        const accountMenuMobile = document.getElementById("accountMenuMobile");

        if (accountBtnMobile && accountMenuMobile) {
            accountBtnMobile.addEventListener("click", () => {
                accountMenuMobile.classList.toggle("hidden");
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const accountBtn = document.getElementById("accountBtn1Btn");
            const accountMenu = document.getElementById("accountBtn1Menu");

            // Toggle dropdown
            accountBtn.addEventListener("click", function(e) {
                e.stopPropagation(); // prevent closing immediately
                accountMenu.classList.toggle("hidden");
            });

            // Close when clicking outside
            document.addEventListener("click", function(e) {
                if (!accountMenu.contains(e.target) && !accountBtn.contains(e.target)) {
                    accountMenu.classList.add("hidden");
                }
            });
        });
    </script>


    @livewireScripts
</body>

</html>
