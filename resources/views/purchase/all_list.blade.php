<x-app-layout>
    <div class="grid grid-cols-12 gap-4 md:gap-6">

        <div class="col-span-12">
            <!-- Table Four -->
            @if (session('message'))
                <div class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50  dark:text-green-400">
                    {{ session('message') }}
                </div>
            @endif
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 ">
                <div class="flex flex-col gap-5 px-6 mb-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-lg font-semibold  /90">
                            All Purchases
                        </h3>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <div>
                            <!-- <a href="{{route('insurances.create')}}"
                                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500  dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                                Add
                            </a> -->
                        </div>
                    </div>
                </div>
                


               <livewire:purchase-list />   
                
            </div>
        </div>
        </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script>
    Livewire.on('swal:success', data => {
        Swal.fire({
            title: 'Documents resend successfully!',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>

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

<script>
    Livewire.on('swal:messages', data => {
        Swal.fire({
            title: 'Invoice has been resent successfully!',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>