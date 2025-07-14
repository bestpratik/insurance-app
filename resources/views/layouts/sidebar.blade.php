<nav class="px-2 space-y-1">
    <!-- Dashboard -->
    <a href="{{ route('dashboard') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
              @if (request()->routeIs('dashboard')) mb-2 bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-home
            class="mr-3 h-6 w-6 @if (request()->routeIs('dashboard')) text-white @else text-[25304e] @endif" />
        <span class="sidebar-item-text">Dashboard</span>
    </a>



    <div x-data="{ open: {{ request()->is('insurances*') ? 'true' : 'false' }} }" x-init="open = {{ request()->is('insurances*') ? 'true' : 'false' }}" class="mb-2">
        <button @click="open = !open"
            class="group mb-2 flex justify-between items-center w-full px-2 py-2 text-sm font-medium rounded-md 
        {{ request()->is('insurances*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-blue-100 hover:text-blue-700' }}">
            <div class="flex items-center">
                <x-heroicon-o-shield-check
                    class="mr-3 h-6 w-6 {{ request()->is('insurances*') ? 'text-blue-700' : 'text-[#25304e]' }}" />
                <span class="sidebar-item-text">Insurances</span>
            </div>
            <svg class="h-5 w-5 {{ request()->is('insurances*') ? 'text-blue-700' : 'text-gray-400' }}"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <div x-show="open" class="pl-8 space-y-1">
            <a href="{{ route('insurances.create') }}"
                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md
            {{ request()->is('insurances/create') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700' }}">
                <x-heroicon-o-user-plus class="mr-3 h-5 w-5 text-gray-400" />
                <span class="sidebar-item-text">Create an Insurance</span>
            </a>

            <a href="{{ url('insurances') }}"
                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md
            {{ request()->is('insurances') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700' }}">
                <x-heroicon-o-bars-3 class="mr-3 h-5 w-5 text-gray-400" />
                <span class="sidebar-item-text">List of Insurances</span>
            </a>
        </div>
    </div>

    <a href="{{ url('purchases') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md 
    @if (request()->is('purchases') && !request()->is('purchases/list*')) bg-[#112695] text-white 
    @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-credit-card
            class="mr-3 h-5 w-5 
        @if (request()->is('purchases') && !request()->is('purchases/list*')) text-white 
        @else text-[#25304e] @endif" />
        <span class="sidebar-item-text">Process an Insurance Policy</span>
    </a>

    <a href="{{ route('purchase.list') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md 
    @if (request()->is('purchases/list*')) bg-[#112695] text-white 
    @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-bars-3
            class="mr-3 h-5 w-5 
        @if (request()->is('purchases/list*')) text-white 
        @else text-[#25304e] @endif" />
        <span class="sidebar-item-text">Purchased List</span>
    </a>

    <a href="{{ route('purchase.cancel.list') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md 
    @if (request()->is('purchases/list*')) bg-[#112695] text-white 
    @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-bars-3
            class="mr-3 h-5 w-5 
        @if (request()->is('purchases/list*')) text-white 
        @else text-[#25304e] @endif" />
        <span class="sidebar-item-text">Cancelled List</span>
    </a>

    <a href="{{ route('purchase.datewise') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md 
    @if (request()->is('date-wise-purchase-report')) bg-[#112695] text-white 
    @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-bars-3
            class="mr-3 h-5 w-5 
        @if (request()->is('date-wise-purchase-report')) text-white 
        @else text-[#25304e] @endif" />
        <span class="sidebar-item-text">Bordereau Report</span>
    </a>


    <!-- Provider -->
    <a href="{{ url('providers') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
              @if (request()->is('providers*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-user-group
            class="mr-3 h-6 w-6 @if (request()->is('providers*')) text-white @else text-[25304e] @endif" />
        <span class="sidebar-item-text">Provider</span>
    </a>

    <a href="{{ url('online-purchase') }}"
    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md
    @if (request()->is('online-purchase') || request()->is('online-purchase/*')) bg-[#112695] text-white 
    @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-credit-card
            class="mr-3 h-5 w-5
            @if (request()->is('online-purchase') || request()->is('online-purchase/*')) text-white 
            @else text-[#25304e] @endif" />
        <span class="sidebar-item-text">Online Purchase list</span>
    </a>

    <a href="{{ url('offline-purchase') }}"
    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md
    @if (request()->is('offline-purchase') || request()->is('offline-purchase/*')) bg-[#112695] text-white 
    @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-credit-card
            class="mr-3 h-5 w-5
            @if (request()->is('offline-purchase') || request()->is('offline-purchase/*')) text-white 
            @else text-[#25304e] @endif" />
        <span class="sidebar-item-text">Offline Purchase list</span>
    </a>


    @php
    $frontendActive = request()->is('about*')
                    || request()->is('banner*')
                    || request()->is('fact*')
                    || request()->is('services*')
                    || request()->is('client*')
                    || request()->is('contact') || request()->is('contact/')
                    || request()->is('content*')
                    || request()->is('contactform_list*')
                    || request()->is('newsletter_list*');
    @endphp

    <div x-data="{ open: {{ $frontendActive ? 'true' : 'false' }} }"
        x-init="open = {{ $frontendActive ? 'true' : 'false' }}"
        class="mb-2">

        <button @click="open = !open"
            class="group mb-2 flex justify-between items-center w-full px-2 py-2 text-sm font-medium rounded-md 
        {{ $frontendActive ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-blue-100 hover:text-blue-700' }}">
            <div class="flex items-center">
                <x-heroicon-o-eye class="mr-3 h-6 w-6 {{ $frontendActive ? 'text-blue-700' : 'text-[#25304e]' }}" />
                <span class="sidebar-item-text">Frontend</span>
            </div>
            <svg class="h-5 w-5 {{ $frontendActive ? 'text-blue-700' : 'text-gray-400' }}"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <div x-show="open" class="pl-8 space-y-1">

            <!-- About -->
            <a href="{{ url('about') }}"
                class="flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
           @if (request()->is('about*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
                <x-heroicon-o-information-circle
                    class="w-5 h-5 mr-3 flex-shrink-0 
                @if (request()->is('about*')) text-white @else text-[25304e] @endif" />
                <span>About</span>
            </a>

            <!-- Banner -->
            <a href="{{ url('banner') }}"
                class="flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
           @if (request()->is('banner*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
                <x-heroicon-o-photo
                    class="w-5 h-5 mr-3 flex-shrink-0 
                @if (request()->is('banner*')) text-white @else text-[25304e] @endif" />
                <span>Banner</span>
            </a>

            <!-- Fact -->
            <a href="{{ url('fact') }}"
                class="flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
           @if (request()->is('fact*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
                <x-heroicon-o-chart-bar
                    class="w-5 h-5 mr-3 flex-shrink-0 
                @if (request()->is('fact*')) text-white @else text-[25304e] @endif" />
                <span>Fact</span>
            </a>

            <!-- Service -->
            <a href="{{ url('services') }}"
                class="flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
           @if (request()->is('services*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
                <x-heroicon-o-cog
                    class="w-5 h-5 mr-3 flex-shrink-0 
                @if (request()->is('services*')) text-white @else text-[25304e] @endif" />
                <span>Service</span>
            </a>

            <!-- Client -->
            <a href="{{ url('client') }}"
                class="flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
           @if (request()->is('client*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
                <x-heroicon-o-users
                    class="w-5 h-5 mr-3 flex-shrink-0 
                @if (request()->is('client*')) text-white @else text-[25304e] @endif" />
                <span>Client</span>
            </a>

            <!-- Contact -->
            <a href="{{ url('contact') }}"
                class="flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
           @if (request()->is('contact') || request()->is('contact/')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
                <x-heroicon-o-user-circle
                    class="w-5 h-5 mr-3 flex-shrink-0 
                @if (request()->is('contact') || request()->is('contact/')) text-white @else text-[25304e] @endif" />
                <span>Contact</span>
            </a>

            <!-- Content -->
            <a href="{{ url('content') }}"
                class="flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
            @if (request()->is('content*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">

                <x-heroicon-o-document-check
                    class="w-5 h-5 mr-3 flex-shrink-0
            @if (request()->is('content*')) text-white @else text-[25304e] @endif" />

                <span>Terms & Conditions</span>
            </a>

            <!-- Contact Form -->
            <a href="{{ route('contactform.list') }}"
                class="flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
           @if (request()->is('contactform_list*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
                <x-heroicon-o-bars-3
                    class="w-5 h-5 mr-3 flex-shrink-0 
                @if (request()->is('contactform_list*')) text-white @else text-[25304e] @endif" />
                <span>Contact Form List</span>
            </a>

            <!-- Newsletter -->
            <a href="{{ route('newsletter.list') }}"
                class="flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
           @if (request()->is('newsletter_list*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
                <x-heroicon-o-newspaper
                    class="w-5 h-5 mr-3 flex-shrink-0 
                @if (request()->is('newsletter_list*')) text-white @else text-[25304e] @endif" />
                <span>News Letter List</span>
            </a>

        </div>
    </div>




    <!-- Insurance -->
    <!-- <a href="{{ url('insurances') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
              @if (request()->is('insurances*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-shield-check
            class="mr-3 h-6 w-6 @if (request()->is('insurances*')) text-white @else text-[25304e] @endif" />
        <span class="sidebar-item-text">Insurance</span>
    </a> -->

    <!-- Purchase -->
    <!-- <a href="{{ url('purchases') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
              @if (request()->is('purchases*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-shopping-cart
            class="mr-3 h-6 w-6 @if (request()->is('purchases*')) text-white @else text-[25304e] @endif" />
        <span class="sidebar-item-text">Purchase</span>
    </a> -->

</nav>
