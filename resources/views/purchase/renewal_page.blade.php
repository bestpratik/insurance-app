<x-app-layout>
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12">
            <!-- Table Four -->
            @if (session('success'))
                <div class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50  dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 ">
                <div class="flex flex-col gap-5 px-6 mb-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-lg font-semibold  /90">
                            {{-- Manage Purchase --}}
                            {{ $purchase->policy_no }}
                        </h3>
                    </div>

                </div>

                <!-- content here -->
                <livewire:insurance-purchase-renewal :purchaseId="$purchase->id" />     
                <!-- content here -->
            </div>
            <!-- Table Four -->
        </div>
    </div>
</x-app-layout>

<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initAutocomplete&libraries=places&v=weekly" defer></script>

<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this data ?');
    }
</script>

