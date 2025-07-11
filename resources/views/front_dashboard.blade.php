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
                    @php 
                        $user = Auth::user()->name;
                        //dd($user);
                    @endphp
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $user }}</p>
                        <p class="text-xs text-gray-600">Logged in</p>
                    </div>
                </div>

                <!-- Navigation -->
                 @include('front_sidebar')
                <!-- Logout Button -->
                
            </aside>



            <!-- Main Content -->
            <main class="flex-1 p-6">
                <h1 class="text-3xl font-bold text-red-600 mb-3">Welcome to the Dashboard</h1>
                <p class="mb-4 text-gray-800">This dashboard provides a comprehensive overview of your insurance
                    policies. Stay informed and up to date with the current status of your coverage at a glance.</p>

                <!-- Sample Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="{{route('active.insurance')}}">
                        <div class="bg-white rounded-xl shadow p-5 border border-b-4 border-green-500">
                            <h2 class="text-xl font-semibold mb-2">Active Insurances</h2>
                            <p class="text-gray-600">Total: {{ $totalActive }} policies</p>
                        </div>
                    </a>
                    
                    <a href="{{route('inactive.insurance')}}">
                        <div class="bg-white rounded-xl shadow p-5 border border-b-4 border-red-500">
                            <h2 class="text-xl font-semibold mb-2">Inactive Insurances</h2>
                            <p class="text-gray-600">Total: {{ $totalInactive }} policies</p>
                        </div>
                    </a>

                    <a href="{{route('cancel.insurance')}}">
                        <div class="bg-white rounded-xl shadow p-5 border border-b-4 border-yellow-500">
                            <h2 class="text-xl font-semibold mb-2">Cancelled Insurances</h2>
                            <p class="text-gray-600">Total: 0 policies</p>
                        </div>
                    </a>

                </div>
            </main>

        </div>
    </section>

</x-front>