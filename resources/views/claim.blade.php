    <x-front>
        <!-- Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
        <!-- Hero Section with Gradient Overlay -->
        <section
            class="relative bg-[url('https://images.unsplash.com/photo-1570129477492-45c003edd2be')] bg-cover bg-center bg-no-repeat text-white">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

            <!-- Content -->
            <div class="relative z-10 py-24 px-6">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">How to Make a Claim</h1>
                    <p class="text-lg md:text-xl">Read if You need to Make a Claim</p>
                </div>
            </div>
        </section>

        <!-- Company History -->
        <section class="py-16 px-6">
            <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10">
                <div>
                    <h2 class="text-3xl font-semibold text-red-600 mb-4">{{ $claims->title ?? '' }}</h2>
                    <p class="text-lg leading-relaxed">{!! $claims->description ?? '' !!}</p>
                </div>
                <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-red-600">
                    <img src="./img/Rectangle 17.png" alt="Person" class="w-full" />
                </div>
            </div>
        </section>
    </x-front>
