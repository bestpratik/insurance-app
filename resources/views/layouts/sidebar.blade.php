<nav class="px-2 space-y-1">
    <!-- Dashboard -->
    <a href="{{ route('dashboard') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
              @if (request()->routeIs('dashboard')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-home
            class="mr-3 h-6 w-6 @if (request()->routeIs('dashboard')) text-white @else text-[25304e] @endif" />
        <span class="sidebar-item-text">Dashboard</span>
    </a>

    <!-- Provider -->
    <a href="{{ url('providers') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
              @if (request()->is('providers*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-user-group
            class="mr-3 h-6 w-6 @if (request()->is('providers*')) text-white @else text-[25304e] @endif" />
        <span class="sidebar-item-text">Provider</span>
    </a>

    <!-- Insurance -->
    <a href="{{ url('insurances') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
              @if (request()->is('insurances*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-shield-check
            class="mr-3 h-6 w-6 @if (request()->is('insurances*')) text-white @else text-[25304e] @endif" />
        <span class="sidebar-item-text">Insurance</span>
    </a>

    <!-- Purchase -->
    <a href="{{ url('purchases') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
              @if (request()->is('purchases*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-shopping-cart
            class="mr-3 h-6 w-6 @if (request()->is('purchases*')) text-white @else text-[25304e] @endif" />
        <span class="sidebar-item-text">Purchase</span>
    </a>
</nav>