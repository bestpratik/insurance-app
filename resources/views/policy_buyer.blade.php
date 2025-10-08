    <x-front>
    
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
    <!-- Hero Section with Gradient Overlay -->
    <section
        class="relative bg-[url('https://images.unsplash.com/photo-1570129477492-45c003edd2be')] bg-cover bg-center bg-no-repeat text-white">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative z-1 py-24 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Policy Purchase</h1>
                <p class="text-lg md:text-xl">Building lasting financial relationships since 1978</p>
            </div>
        </div>
    </section>

    <!-- TAB MENU -->


     <livewire:policy-buyer-component :insuranceId="$insuranceId" />



</x-front>   