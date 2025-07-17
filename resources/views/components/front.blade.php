<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{'Money Wise Plc'}}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- (Optional) Tailwind Config for Custom Theme -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0d9488',
                    }
                }
            }
        }
    </script>
    <style>
        /* Hide scrollbars on scroll container */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <style>
        .note-editor.note-airframe .note-editing-area .note-editable,
        .note-editor.note-frame .note-editing-area .note-editable {
            background: #fff;
        }
    </style>
    @livewireStyles
</head>

<body>
    @include('layouts.front_navigation')
    @include('layouts.front_header')

    {{ $slot }}

    @include('layouts.front_footer')
    <!-- Mobile Menu Drawer -->
    <div id="mobileMenu"
        class="fixed top-0 right-0 w-64 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-40">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">Menu</h3>
            <button id="menuClose" class="text-red-600 text-xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="flex flex-col p-4 space-y-4 text-gray-700">
            <a href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'text-red-600 font-bold' : '' }}">Home</a>
            <a href="{{ route('about.us') }}"
                class="{{ request()->routeIs('about.us') ? 'text-red-600 font-bold' : '' }}">About Us</a>
            <a href="{{ route('service') }}"
                class="{{ request()->routeIs('service') ? 'text-red-600 font-bold' : '' }}">Our Services</a>
            <a href="{{ route('contact.us') }}"
                class="{{ request()->routeIs('contact.us') ? 'text-red-600 font-bold' : '' }}">Contact Us</a>
            <a href="{{route('policy.buyer')}}"
                class="{{ request()->routeIs('policy.buyer') ? 'text-red-600 font-bold' : '' }} mt-4 block text-center bg-red-600 text-white py-2 rounded-lg">Get
                A Quote</a>
        </nav>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>

    <button id="scrollToTopBtn"
        class="fixed bottom-6 right-6 z-50 hidden bg-red-600 text-white p-3 w-10 h-10 flex justify-center align-center rounded-full shadow-lg hover:bg-red-800 transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
        </svg>

    </button>


    <!-- Swiper JS -->

    <script>
        const swiper = new Swiper('.mySwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true, // or false if it jumps at loop point
            speed: 10000, // super slow and smooth
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
            freeMode: true,
            freeModeMomentum: false,
            grabCursor: true,
            breakpoints: {
                640: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                1024: { slidesPerView: 5 },
            },
        });

        // Pause on hover
        const swiperEl = document.querySelector('.mySwiper');
        swiperEl.addEventListener('mouseenter', () => swiper.autoplay.stop());
        swiperEl.addEventListener('mouseleave', () => swiper.autoplay.start());
    </script>

    <script>
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
        const sliderWrapper = document.getElementById('sliderWrapper');
        const slides = sliderWrapper.children;
        const totalSlides = slides.length;
        let currentIndex = 0;

        const updateSlider = () => {
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
    <!-- this is a simple script to handle the scroll to top button -->
    <script>
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
    </script>
    <!-- ===================================this is tab menu script ======================================== -->
    <script>
        const tabButtons = document.querySelectorAll(".tab-btn");
        const tabContents = document.querySelectorAll(".tab-content");

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
    </script>

    <!-- ----------------------------------------this is tab menu script end-------------------------------------------- -->
    <script>
        const tabWrapper = document.getElementById('tabWrapper');
        const scrollLeft = document.getElementById('scrollLeft');
        const scrollRight = document.getElementById('scrollRight');

        function updateButtons() {
            const maxScrollLeft = tabWrapper.scrollWidth - tabWrapper.clientWidth;
            scrollLeft.style.display = tabWrapper.scrollLeft > 0 ? 'inline' : 'none';
            scrollRight.style.display = tabWrapper.scrollLeft < maxScrollLeft - 5 ? 'inline' : 'none';
        }

        scrollLeft.addEventListener('click', () => {
            tabWrapper.scrollBy({ left: -150, behavior: 'smooth' });
        });

        scrollRight.addEventListener('click', () => {
            tabWrapper.scrollBy({ left: 150, behavior: 'smooth' });
        });

        tabWrapper.addEventListener('scroll', updateButtons);
        window.addEventListener('resize', updateButtons);
        window.addEventListener('load', updateButtons);
    </script>
    <script>
        const wrapper = document.getElementById('tabWrapper');
        const leftBtn = document.getElementById('scrollLeft');
        const rightBtn = document.getElementById('scrollRight');
        const tabButtons = document.querySelectorAll('.tab-btn');

        function updateArrowVisibility() {
            const scrollLeft = wrapper.scrollLeft;
            const scrollWidth = wrapper.scrollWidth;
            const clientWidth = wrapper.clientWidth;
            leftBtn.style.display = scrollLeft > 5 ? 'flex' : 'none';
            rightBtn.style.display = scrollLeft + clientWidth < scrollWidth - 5 ? 'flex' : 'none';
        }

        function scrollTab(direction = 'left') {
            wrapper.scrollBy({
                left: direction === 'left' ? -150 : 150,
                behavior: 'smooth'
            });
        }

        leftBtn.addEventListener('click', () => scrollTab('left'));
        rightBtn.addEventListener('click', () => scrollTab('right'));
        wrapper.addEventListener('scroll', updateArrowVisibility);
        window.addEventListener('resize', updateArrowVisibility);
        window.addEventListener('load', () => {
            updateArrowVisibility();
            const active = document.querySelector('.active-tab');
            if (active) {
                active.scrollIntoView({ behavior: 'smooth', inline: 'center' });
            }
        });

        // Optional: Handle active tab change and center
        tabButtons.forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                document.querySelector('.active-tab')?.classList.remove('text-red-600', 'border-red-500', 'active-tab');
                btn.classList.add('text-red-600', 'border-red-500', 'active-tab');
                btn.scrollIntoView({ behavior: 'smooth', inline: 'center' });
            });
        });
    </script>
    @livewireScripts
</body>

</html>