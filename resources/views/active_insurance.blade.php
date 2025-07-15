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


            <div class="flex-1 overflow-x-scroll"> 
                <livewire:active-insurance /> 
            </div>
            <!-- Main Content -->
             
          

        </div>
    </section>

</x-front>
<script>
    Livewire.on('swal:message', data => {
        Swal.fire({
            title: 'Purchase cancelled successfully!',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>