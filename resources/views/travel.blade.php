<x-front>
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
    <!-- Script -->
    <section class="relative bg-[url('/service-details.jpg')] bg-cover bg-center bg-no-repeat text-white">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative z-1 py-24 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Travel Insurance</h2>
                <p class="text-lg md:text-xl mb-8">Protect your travels with our comprehensive travel insurance coverage.
                </p>

            </div>
    </section>
    <div class="bg-gray-100 py-12 px-6">
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md p-6 md:p-8">

            <!-- Image (Float Left) -->
            <img src="{{ asset('img/travel.jpg') }}" alt="Travel Insurance"
                class="w-full md:max-w-[600px] float-none md:float-left md:mr-6 mb-4 rounded-xl object-cover">

            <!-- Content -->
            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Travel Insurance Made Simple
            </h1>
            <div class="border-b-4 border-red-500 w-10 mb-4"></div>

            <p class="text-sm text-gray-600 mb-4">
                Get Covered in Minutes with Moneywise
            </p>

            <p class="text-sm text-gray-600 mb-4">
                Travel with confidence knowing you’re protected against the unexpected.
            </p>

            <!-- Buttons -->
            <div class="flex gap-3 flex-wrap mb-6">
                <a href="https://moneywise.aneevo.com/" target="_blank"
                    class="relative rounded-md flex h-[40px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-40 hover:before:w-56">
                    <span class="relative z-1">Buy Now</span>
                </a>
            </div>

            <!-- Why Choose -->
            <h2 class="text-xl font-semibold text-gray-800 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-shield-halved text-red-600"></i>
                Why Choose Moneywise Travel Insurance?
            </h2>

            <ul class="text-sm text-gray-700 mb-6 space-y-2">
                <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Fast, simple online quotes</li>
                <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Flexible cover options</li>
                <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Trusted insurance providers</li>
                <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Protection when you need it most</li>
            </ul>

            <!-- Clear float -->
            <div class="clear-both"></div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- What's Covered Card -->
                <div class="bg-white border rounded-xl shadow-sm p-5 hover:shadow-md transition">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-globe text-red-600"></i>
                        What’s Covered
                    </h2>

                    <ul class="text-sm text-gray-700 space-y-3">
                        <li><i class="fa-solid fa-plane-departure text-blue-500 mr-2"></i>Trip cancellation &
                            curtailment</li>
                        <li><i class="fa-solid fa-hospital text-red-500 mr-2"></i>Emergency medical expenses abroad</li>
                        <li><i class="fa-solid fa-suitcase text-yellow-500 mr-2"></i>Lost or delayed baggage</li>
                        <li><i class="fa-solid fa-clock text-purple-500 mr-2"></i>Travel delays & disruption</li>
                        <li><i class="fa-solid fa-scale-balanced text-gray-600 mr-2"></i>Personal liability</li>
                    </ul>
                </div>

                <!-- Traveller Types Card -->
                <div class="bg-white border rounded-xl shadow-sm p-5 hover:shadow-md transition">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-users text-red-600"></i>
                        Cover for Every Traveller
                    </h2>

                    <ul class="text-sm text-gray-700 space-y-3">
                        <li><i class="fa-solid fa-user text-gray-600 mr-2"></i>Single trips</li>
                        <li><i class="fa-solid fa-repeat text-gray-600 mr-2"></i>Annual multi-trip</li>
                        <li><i class="fa-solid fa-people-group text-gray-600 mr-2"></i>Families & couples</li>
                        <li><i class="fa-solid fa-user text-gray-600 mr-2"></i>Individuals</li>
                    </ul>
                </div>

                <!-- Steps Card -->
                <div class="bg-white border rounded-xl shadow-sm p-5 hover:shadow-md transition">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-bolt text-yellow-500"></i>
                        Get Covered in 3 Easy Steps
                    </h2>

                    <ol class="text-sm text-gray-700 space-y-3 list-inside">
                        <li><i class="fa-solid fa-pen mr-2 text-gray-500"></i>Enter your trip details</li>
                        <li><i class="fa-solid fa-list-check mr-2 text-gray-500"></i>Compare your options</li>
                        <li><i class="fa-solid fa-file-circle-check mr-2 text-green-500"></i>Get instant cover</li>
                    </ol>
                </div>

                <!-- Final CTA Card -->
                <div
                    class="bg-white border rounded-xl shadow-sm p-5 hover:shadow-md transition flex flex-col justify-between col-span-1 md:col-span-3">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-bullseye text-red-600"></i>
                            Don’t Travel Without Protection
                        </h2>

                        <p class="text-sm text-gray-600 mb-4">
                            Unexpected events can cost thousands. For a small premium, protect your trip, your money,
                            and your peace of mind.
                        </p>
                    </div>

                    <a href="https://moneywise.aneevo.com/" target="_blank"
                        class="text-red-600 font-semibold flex items-center gap-2 mt-auto">
                        <i class="fa-solid fa-arrow-right"></i>
                        Start your quote today
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-front>
