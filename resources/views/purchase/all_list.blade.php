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

<script>
    document.addEventListener('DOMContentLoaded', function() {

        function closeAllMenus() {
            document.querySelectorAll('.action-menu[open]').forEach(function(menu) {
                menu.removeAttribute('open');

                const dropdown = menu.querySelector('.action-dropdown');

                if (dropdown) {
                    dropdown.classList.add('hidden');
                }
            });
        }

        function positionMenu(menu) {

            const button = menu.querySelector('summary');
            const dropdown = menu.querySelector('.action-dropdown');

            if (!button || !dropdown) return;

            const buttonRect = button.getBoundingClientRect();

            // Show temporarily so we can calculate its height
            dropdown.classList.remove('hidden');

            const dropdownRect = dropdown.getBoundingClientRect();

            const gap = 8;
            const viewportHeight = window.innerHeight;
            const viewportWidth = window.innerWidth;

            const spaceBelow = viewportHeight - buttonRect.bottom;
            const spaceAbove = buttonRect.top;

            let top;

            /*
             * If there is enough room below,
             * open BELOW the button.
             */
            if (spaceBelow >= dropdownRect.height + gap) {

                top = buttonRect.bottom + gap;

            }
            /*
             * Otherwise open ABOVE the button.
             */
            else if (spaceAbove >= dropdownRect.height + gap) {

                top = buttonRect.top - dropdownRect.height - gap;

            }
            /*
             * If there isn't enough room either side,
             * choose the side with more space.
             */
            else {

                if (spaceBelow > spaceAbove) {
                    top = buttonRect.bottom + gap;
                } else {
                    top = buttonRect.top - dropdownRect.height - gap;
                }
            }

            /*
             * Horizontal positioning
             */
            let left = buttonRect.right - dropdownRect.width;

            // Prevent going outside right side
            if (left + dropdownRect.width > viewportWidth - 10) {
                left = viewportWidth - dropdownRect.width - 10;
            }

            // Prevent going outside left side
            if (left < 10) {
                left = 10;
            }

            dropdown.style.top = `${top}px`;
            dropdown.style.left = `${left}px`;
        }

        function initActionMenus() {

            document.querySelectorAll('.action-menu').forEach(function(menu) {

                if (menu.dataset.initialized === 'true') {
                    return;
                }

                menu.dataset.initialized = 'true';

                menu.addEventListener('toggle', function() {

                    const dropdown = menu.querySelector('.action-dropdown');

                    if (!menu.open) {

                        if (dropdown) {
                            dropdown.classList.add('hidden');
                        }

                        return;
                    }

                    // Close every other menu
                    document.querySelectorAll('.action-menu[open]').forEach(function(
                        otherMenu) {

                        if (otherMenu !== menu) {

                            otherMenu.removeAttribute('open');

                            const otherDropdown =
                                otherMenu.querySelector('.action-dropdown');

                            if (otherDropdown) {
                                otherDropdown.classList.add('hidden');
                            }
                        }
                    });

                    // Position current menu
                    requestAnimationFrame(function() {
                        positionMenu(menu);
                    });

                });

            });
        }

        // Initial load
        initActionMenus();


        /*
         * Close when clicking outside
         */
        document.addEventListener('click', function(event) {

            if (!event.target.closest('.action-menu')) {
                closeAllMenus();
            }

        });


        /*
         * Reposition open menu when scrolling
         */
        window.addEventListener('scroll', function() {

            const openMenu = document.querySelector('.action-menu[open]');

            if (openMenu) {
                positionMenu(openMenu);
            }

        }, true);


        /*
         * Reposition when browser resizes
         */
        window.addEventListener('resize', function() {

            const openMenu = document.querySelector('.action-menu[open]');

            if (openMenu) {
                positionMenu(openMenu);
            }

        });


        /*
         * Livewire update
         */
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
