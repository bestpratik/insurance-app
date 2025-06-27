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
                <h1 class="text-4xl md:text-5xl font-bold mb-4">About Moneywise Investments</h1>
                <p class="text-lg md:text-xl">Building lasting financial relationships since 1978</p>
            </div>
        </div>
    </section>

    <!-- Company History -->
    <section class="py-16 px-6">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10">
            <div>
                <h2 class="text-3xl font-semibold text-red-600 mb-4">Our Journey</h2>
                <p class="text-lg leading-relaxed">
                    In March of 1978, Moneywise Investments was formed by husband-wife team Pankaj and Shashi Adatia,
                    and has continued to flourish over the decades.
                </p>
                <p class="text-gray-700 text-lg">
                    While Pankaj and his team specialise in <strong>Investments, Life Insurance</strong>, and all
                    sectors of <strong>Financial Services</strong>, Shashi’s expertise lies in <strong>General
                        Insurance</strong> — including Car, Home, and Business Insurance.
                </p>
            </div>
            <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-red-600">
                <img src="https://www.moneywiseplc.co.uk/static/img/about.png" alt="" class="w-full">
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-16 px-6">
        <div class="max-w-4xl mx-auto text-center mb-10">
            <h2 class="text-3xl font-semibold text-red-600 mb-4">Why Clients Choose Us</h2>
            <p class="text-lg text-gray-700">We build relationships on trust, transparency, and long-term care.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto text-center">

            <!-- Personal Service -->
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <div
                    class="mx-auto mb-4 flex items-center justify-center h-20 w-20 rounded-full bg-red-100 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A7.966 7.966 0 0112 15c2.21 0 4.21.896 5.656 2.344M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-red-600 mb-2">Personal Service</h3>
                <p class="text-gray-700">Friendly, human, and consistent support you can count on.</p>
            </div>

            <!-- Lasting Relationships -->
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <div
                    class="mx-auto mb-4 flex items-center justify-center h-20 w-20 rounded-full bg-red-100 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.1-1.8-4-3-4-5a4 4 0 118 0c0 2-2.9 3.2-4 5zm0 0v12" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-red-600 mb-2">Lasting Relationships</h3>
                <p class="text-gray-700">Open, honest, and built to last for generations.</p>
            </div>

            <!-- Multi-lingual Support -->
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <div
                    class="mx-auto mb-4 flex items-center justify-center h-20 w-20 rounded-full bg-red-100 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 12c2.485 0 4.5-2.015 4.5-4.5S14.485 3 12 3 7.5 5.015 7.5 7.5 9.515 12 12 12zm0 0v9m-6-4.5h12" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-red-600 mb-2">Multi-lingual Support</h3>
                <p class="text-gray-700">Diverse communication, so you feel heard and understood.</p>
            </div>

        </div>
    </section>

</x-front>