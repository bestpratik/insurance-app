<x-front>
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
    <!-- Hero Section with Gradient Overlay -->
    <section
        class="relative bg-[url('https://images.unsplash.com/photo-1570129477492-45c003edd2be')] bg-cover bg-center bg-no-repeat text-white">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative z-1 py-16 px-6">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">We’re Here to Help</h1>
                <p class="text-lg md:text-xl">Get clear, quick answers to the most common questions our customers ask.
                </p>
            </div>
        </div>
    </section>
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">

            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-red-700 mb-3">
                    Frequently Asked Questions
                </h1>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    We’ve compiled answers to the most common questions to help you understand our services better.
                </p>
            </div>

            <!-- Search bar -->
            <div class="mb-10 max-w-2xl mx-auto">
                <div class="relative">
                    <input type="text" id="faqSearch"
                        class="w-full border border-gray-300 rounded-full py-3 px-5 pl-12 focus:outline-none focus:ring-2 focus:ring-red-600"
                        placeholder="Search your question...">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-gray-400"></i>
                </div>
            </div>

            <!-- FAQ List -->
            <div id="faqList" class="space-y-4">
                @foreach ($faqs as $faq)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition p-6">
                        <button
                            class="faq-btn flex justify-between items-center w-full text-left font-semibold text-lg text-gray-900 hover:text-red-600 transition">
                            <span>{{ $loop->iteration }}. {{ $faq->question }}</span>
                            <i class="fa-solid fa-arrow-right text-red-600 transition-transform duration-300"></i>
                        </button>
                        <div
                            class="faq-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out mt-3 text-gray-700 leading-relaxed">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-14">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 text-red-700 font-semibold border-b-2 border-transparent hover:border-red-700 hover:text-red-800 transition-all duration-300">
                    <i class="fa-solid fa-arrow-left-long"></i> Back to Home
                </a>
            </div>
        </div>
    </section>
    <script>
        // Search functionality
        const searchInput = document.getElementById('faqSearch');
        const faqItems = document.querySelectorAll('#faqList > div');

        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase();
            faqItems.forEach(item => {
                const question = item.querySelector('button span').textContent.toLowerCase();
                item.style.display = question.includes(query) ? '' : 'none';
            });
        });
    </script>
</x-front>
