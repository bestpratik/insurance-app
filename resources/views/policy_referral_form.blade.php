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
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Referral Form</h1>
                    <p class="text-lg md:text-xl">Building lasting financial relationships since 1978</p>
                </div>
            </div>
        </section>
        

        <!-- TAB MENU -->
         <livewire:policy-referral-form-component />    
        <!-- SCRIPT -->
        <!-- <script>
        const tabButtons = document.querySelectorAll(".tab-btn");
        const tabContents = document.querySelectorAll(".tab-content"); 

        tabButtons.forEach(button => {
            button.addEventListener("click", (e) => {
                e.preventDefault();

                // Remove active styling
                tabButtons.forEach(btn => {
                    btn.classList.remove("text-red-600", "border-red-500");
                    btn.classList.add("text-gray-600", "border-transparent");
                });

                // Hide all contents
                tabContents.forEach(content => content.classList.add("hidden"));

                // Activate clicked tab
                button.classList.remove("text-gray-600", "border-transparent");
                button.classList.add("text-red-600", "border-red-500");

                // Show relevant content
                const tabId = button.getAttribute("data-tab");
                document.getElementById(tabId).classList.remove("hidden");
            });
        });
    </script> -->

    </x-front>