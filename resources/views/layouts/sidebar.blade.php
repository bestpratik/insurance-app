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

    <div x-data="{ open: false }">
        <button @click="open = !open" 
                class="group flex justify-between items-center w-full px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-blue-100 hover:text-blue-700">
            <div class="flex items-center">
               <x-heroicon-o-shield-check
            class="mr-3 h-6 w-6 @if (request()->is('insurances*')) text-white @else text-[25304e] @endif" />
                <span class="sidebar-item-text">Insurances</span>
            </div>
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        <div x-show="open" class="pl-8 space-y-1">
            <a href="{{route('insurances.create')}}" 
               class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-blue-50 hover:text-blue-700">
                <x-heroicon-o-user-plus class="mr-3 h-5 w-5 text-gray-400" />
                <span class="sidebar-item-text">create in Insurance</span>
            </a>
            <a href="{{url('insurances')}}" 
               class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-blue-50 hover:text-blue-700">
                <x-heroicon-o-bars-3 class="mr-3 h-5 w-5 text-gray-400" />
                <span class="sidebar-item-text">list of Insurance</span>
            </a>
            <a href="{{url('purchases')}}" 
               class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-blue-50 hover:text-blue-700">
                <x-heroicon-o-credit-card class="mr-3 h-5 w-5 text-gray-400" />
                <span class="sidebar-item-text">Process & Insurance Policy </span>
            </a>
            <!-- <a href="" 
               class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-blue-50 hover:text-blue-700">
                 <x-heroicon-o-bars-3 class="mr-3 h-5 w-5 text-gray-400" />
                <span class="sidebar-item-text">Purchase List</span>
            </a> -->
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
    <a href="{{ url('purchases') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
              @if (request()->is('purchases*')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-shopping-cart
            class="mr-3 h-6 w-6 @if (request()->is('purchases*')) text-white @else text-[25304e] @endif" />
        <span class="sidebar-item-text">Purchase</span>
    </a>
</nav>