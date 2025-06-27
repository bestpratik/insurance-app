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
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
                <p class="text-lg md:text-xl">Building lasting financial relationships since 1978</p>
            </div>
        </div>
    </section>

    <section class="py-12 my-12">
        <h2 class="text-3xl font-bold text-center text-red-600 mb-4">
            Let’s Secure Your Peace of Mind
        </h2>
        <p class="max-w-4xl text-center mx-auto mb-12">Your protection is our priority. Let’s discuss the best
            insurance options for your needs, budget, and future.</p>
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left: Contact Info -->
            <div class="space-y-6">
                <!-- Address -->
                <div class="flex items-start bg-red-100 p-4 rounded-md">
                    <div class="p-2 bg-red-600 rounded-md text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                            stroke="currentColor" class="size-6">
                            <path strokeLinecap="round" strokeLinejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path strokeLinecap="round" strokeLinejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>

                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-800">Our Address</h4>
                        <p class="text-gray-600 text-sm">442 Romford Road, London, E78DF</p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex items-start bg-red-100 p-4 rounded-md">
                    <div class="p-2 bg-red-600 rounded-md text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>

                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-800">Phone Number</h4>
                        <p class="text-gray-600 text-sm">020 8552 5521</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start bg-red-100 p-4 rounded-md">
                    <div class="p-2 bg-red-600 rounded-md text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>

                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-800">Email Us</h4>
                        <p class="text-gray-600 text-sm">enquiries@moneywiseplc.co.uk</p>
                    </div>
                </div>
            </div>

            <!-- Middle: Image -->
            <div class="hidden lg:block max-h-[360px] overflow-hidden ">
                <img src="{{asset('contact.jpg')}}" alt="Representative" class="object-cover w-full rounded-md shadow-sm">
            </div>

            <!-- Right: Contact Form -->
            <div class="space-y-4">
                <!-- Name and Phone -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" placeholder="Name"
                        class="p-3 rounded border border-gray-300 bg-white w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                    <input type="text" placeholder="Phone"
                        class="p-3 rounded border border-gray-300 bg-white w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>

                <!-- Email -->
                <input type="email" placeholder="Email"
                    class="p-3 rounded border border-gray-300 bg-white w-full focus:outline-none focus:ring-2 focus:ring-red-500">

                <!-- Message -->
                <textarea placeholder="Messages" rows="5"
                    class="p-3 rounded border border-gray-300 bg-white w-full focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>

                <!-- Submit Button -->
                <button
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded transition duration-300">
                    SUBMIT NOW
                </button>
            </div>

        </div>
    </section>

</x-front>