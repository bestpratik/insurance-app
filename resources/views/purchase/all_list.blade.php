<x-app-layout>
    <style>
        /* Council modal animation */
        @keyframes councilModalEnter {
            from {
                opacity: 0;
                transform: translateY(12px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-council-modal {
            animation: councilModalEnter 0.22s ease-out;
        }

        /* Select2 container */
        #councilSelect2+.select2-container {
            width: 100% !important;
        }

        /* Dropdown field */
        .select2-container--default .select2-selection--single {
            height: 48px !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 12px !important;
            background-color: #ffffff !important;
            display: flex !important;
            align-items: center !important;
            padding: 0 42px 0 14px !important;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        /* Focus state */
        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12) !important;
            outline: none !important;
        }

        /* Selected text */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #334155 !important;
            font-size: 14px !important;
            line-height: normal !important;
            padding: 0 !important;
        }

        /* Placeholder */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #94a3b8 !important;
        }

        /* Dropdown arrow */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px !important;
            right: 10px !important;
            top: 0 !important;
        }

        /* Searchable dropdown panel */
        .select2-container--default .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 12px !important;
            overflow: hidden !important;
            background: #ffffff !important;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12) !important;
            margin-top: 5px !important;
        }

        /* Search input */
        .select2-container--default .select2-search--dropdown {
            padding: 10px !important;
            background: #ffffff !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            height: 40px !important;
            padding: 8px 12px !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            color: #334155 !important;
            font-size: 14px !important;
            outline: none !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.10) !important;
        }

        /* Council options */
        .select2-container--default .select2-results__option {
            padding: 11px 14px !important;
            font-size: 14px !important;
            color: #475569 !important;
            transition: background-color 0.15s;
        }

        /* Hover and keyboard selection */
        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #eef2ff !important;
            color: #4338ca !important;
        }

        /* Selected option */
        .select2-container--default .select2-results__option--selected {
            background-color: #e0e7ff !important;
            color: #4338ca !important;
            font-weight: 600 !important;
        }

        /* No results */
        .select2-container--default .select2-results__message {
            padding: 14px !important;
            color: #64748b !important;
            font-size: 13px !important;
        }

        /* Responsive modal */
        @media (max-width: 640px) {
            .select2-container--default .select2-selection--single {
                height: 46px !important;
            }
        }
    </style>
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

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (skip if already loaded in your layout) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
    Livewire.on('swal:successmsg', data => {
        Swal.fire({
            title: 'Council assigned successfully!',
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


<script>
    function initializeCouncilSelect2() {
        const $select = $('#councilSelect2');

        if (!$select.length) {
            return;
        }

        // Destroy the previous instance if it exists.
        if ($select.hasClass('select2-hidden-accessible')) {
            $select.select2('destroy');
        }

        // Initialize Select2 inside the modal.
      
        $select.select2({
            placeholder: 'Search or select a council',
            allowClear: true,
            width: '100%',
            dropdownParent: $select.closest('.fixed')
        });

        // Send the selected council ID to Livewire.
        $select.off('change.council').on('change.council', function() {
            const componentElement = $select.closest('[wire\\:id]')[0];

            if (!componentElement) {
                return;
            }

            const component = Livewire.find(
                componentElement.getAttribute('wire:id')
            );

            if (component) {
                component.set('selectedCouncilId', $(this).val() || '');
            }
        });
    }

    document.addEventListener('livewire:init', function() {
        initializeCouncilSelect2();

        Livewire.hook('morph.updated', () => {
            setTimeout(initializeCouncilSelect2, 100);
        });
    });

    document.addEventListener('livewire:navigated', function() {
        setTimeout(initializeCouncilSelect2, 100);
    });

    // Initialize if Livewire has already started.
    if (window.Livewire) {
        setTimeout(initializeCouncilSelect2, 100);
    }
</script>
