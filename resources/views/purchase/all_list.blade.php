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
                            <!-- <a href="{{ route('insurances.create') }}"
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

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {

        function initActionMenus() {

            const menus = document.querySelectorAll('.action-menu');

            menus.forEach(menu => {

                if (menu.dataset.initialized) {
                    return;
                }

                menu.dataset.initialized = 'true';

                menu.addEventListener('toggle', function() {

                    if (!menu.open) {
                        return;
                    }

                    // Close all other menus
                    document.querySelectorAll('.action-menu[open]').forEach(otherMenu => {
                        if (otherMenu !== menu) {
                            otherMenu.removeAttribute('open');
                        }
                    });

                    // Position the menu
                    positionActionMenu(menu);
                });
            });
        }

        function positionActionMenu(menu) {

            const dropdown = menu.querySelector('.action-dropdown');

            if (!dropdown) {
                return;
            }

            // Reset position first
            dropdown.classList.remove('bottom-full', 'top-11', 'mb-2', 'mt-2');
            dropdown.classList.add('top-11');

            // Wait for browser to calculate menu height
            requestAnimationFrame(() => {

                const button = menu.querySelector('summary');
                const buttonRect = button.getBoundingClientRect();
                const dropdownRect = dropdown.getBoundingClientRect();

                const viewportHeight = window.innerHeight;

                const spaceBelow = viewportHeight - buttonRect.bottom;
                const spaceAbove = buttonRect.top;

                // If not enough space below but enough space above
                if (
                    spaceBelow < dropdownRect.height + 20 &&
                    spaceAbove > dropdownRect.height + 20
                ) {
                    dropdown.classList.remove('top-11', 'mt-2');
                    dropdown.classList.add('bottom-full', 'mb-2');
                } else {
                    dropdown.classList.remove('bottom-full', 'mb-2');
                    dropdown.classList.add('top-11', 'mt-2');
                }
            });
        }

        // Initial load
        initActionMenus();

        // Reinitialize after Livewire updates
        document.addEventListener('livewire:navigated', initActionMenus);

        if (window.Livewire) {
            Livewire.hook('morph.updated', () => {
                setTimeout(() => {
                    initActionMenus();
                }, 50);
            });
        }

    });
</script> --}}

{{-- <script>
    document.addEventListener('click', function(event) {

        // Check if the click happened inside an action menu
        const clickedMenu = event.target.closest('.action-menu');

        // Close all open menus
        document.querySelectorAll('.action-menu[open]').forEach(function(menu) {

            // Keep the clicked menu open
            if (menu !== clickedMenu) {
                menu.removeAttribute('open');
            }

        });

    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        function initActionMenus() {

            document.querySelectorAll('.action-menu').forEach(function(menu) {

                if (menu.dataset.initialized) {
                    return;
                }

                menu.dataset.initialized = 'true';

                menu.addEventListener('toggle', function() {

                    if (!menu.open) {
                        return;
                    }

                    // Close all other menus
                    document.querySelectorAll('.action-menu[open]').forEach(function(
                    otherMenu) {

                        if (otherMenu !== menu) {
                            otherMenu.removeAttribute('open');
                        }

                    });

                });

            });

        }

        initActionMenus();


        // Close menu when clicking outside
        document.addEventListener('click', function(event) {

            const clickedMenu = event.target.closest('.action-menu');

            document.querySelectorAll('.action-menu[open]').forEach(function(menu) {

                if (menu !== clickedMenu) {
                    menu.removeAttribute('open');
                }

            });

        });


        // Reinitialize after Livewire updates
        document.addEventListener('livewire:navigated', function() {
            initActionMenus();
        });

        if (window.Livewire) {

            Livewire.hook('morph.updated', function() {

                setTimeout(function() {
                    initActionMenus();
                }, 50);

            });

        }

    });
</script>


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
    Livewire.on('swal:successss', data => {
        Swal.fire({
            title: 'Reminder email sent successfully!',
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

<script>
    Livewire.on('swal:successs', data => {
        Swal.fire({
            title: 'Payment information updated successfully!',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>
