<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-seo-meta />
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

        /* Skeleton Loader Styles */
        @keyframes shimmer {
            100% {
                transform: translateX(200%);
            }
        }

        @keyframes fadeInFast {
            from {
                opacity: 0;
                transform: scale(0.99);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in {
            animation: fadeInFast .25s ease forwards;
        }

        .skeleton-shimmer {
            position: relative;
            background-color: #e8e8e8;
            overflow: hidden;
        }

        .skeleton-shimmer::after {
            content: "";
            position: absolute;
            top: 0;
            left: -150%;
            height: 100%;
            width: 150%;
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0),
                    rgba(255, 255, 255, 0.6),
                    rgba(255, 255, 255, 0));
            animation: shimmer 1.3s linear infinite;
        }

        /* Fade Out */
        #skeletonLoader.fade-out {
            opacity: 0;
            transition: opacity .6s ease, visibility .6s ease;
            visibility: hidden;
            pointer-events: none;
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

    {{ $slot }}

    @include('layouts.front_footer')


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
            tabWrapper.scrollBy({
                left: -150,
                behavior: 'smooth'
            });
        });

        scrollRight.addEventListener('click', () => {
            tabWrapper.scrollBy({
                left: 150,
                behavior: 'smooth'
            });
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

    @livewireScripts
</body>

</html>