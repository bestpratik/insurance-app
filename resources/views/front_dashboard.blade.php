    <x-front>
    
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
    <!-- Hero Section with Gradient Overlay -->
    <section class="h-[2px] bg-red-400"></section>
    <section class=" min-h-[450px] my-12">
        <div class="flex min-h-[450px] flex-col md:flex-row max-w-7xl mx-auto">

            <aside id="sidebar" class="w-full md:w-64 bg-gray-200 rounded-md shadow border sticky top-0 flex flex-col ">
                <!-- User Info -->
                <div class="flex items-center space-x-4 px-6 pt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <div>
                        <p class="text-sm font-semibold text-gray-800">John Doe</p>
                        <p class="text-xs text-gray-600">Logged in</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="space-y-2 px-4 py-10 flex-1 text-gray-700">
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-red-600 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        Dashboard
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-red-600 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        Applied Insurances
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-red-600 hover:text-white transition">
                        <!-- Pending/Inactive Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>

                        Inactive Insurances
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-red-600 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        Cancelled Insurances
                    </a>
                </nav>

                <!-- Logout Button -->
                <div class="px-4 pb-5">
                   <a href="{{route('user.logout')}}">
                         <button
                        class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 transition">
                        <!-- Logout Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                        </svg>
                        Logout
                    </button>
                   </a>
                </div>
            </aside>



            <!-- Main Content -->
            <main class="flex-1 p-6">
                <h1 class="text-3xl font-bold text-red-600 mb-3">Welcome to the Dashboard</h1>
                <p class="mb-4 text-gray-800">This dashboard provides a comprehensive overview of your insurance
                    policies. Stay informed and up to date with the current status of your coverage at a glance.</p>

                <!-- Sample Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl shadow p-5 border border-b-4 border-green-500">
                        <h2 class="text-xl font-semibold mb-2">Active Insurances</h2>
                        <p class="text-gray-600">Total: 5 policies</p>
                    </div>
                    <div class="bg-white rounded-xl shadow p-5 border border-b-4 border-red-500">
                        <h2 class="text-xl font-semibold mb-2">Inactive Insurances</h2>
                        <p class="text-gray-600">Total: 24 policies</p>
                    </div>

                    <div class="bg-white rounded-xl shadow p-5 border border-b-4 border-yellow-500">
                        <h2 class="text-xl font-semibold mb-2">Cancelled Insurances</h2>
                        <p class="text-gray-600">Total: 12 policies</p>
                    </div>

                </div>
            </main>

        </div>
    </section>

</x-front>