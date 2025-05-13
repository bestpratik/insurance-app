<nav class="px-2 space-y-1">
    <!-- Dashboard -->
    <a href="{{ route('dashboard') }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all
              @if (request()->routeIs('dashboard')) bg-[#112695] text-white @else text-gray-600 hover:bg-blue-100 hover:text-blue-700 @endif">
        <x-heroicon-o-squares-2x2 class="mr-3 h-6 w-6 @if (request()->routeIs('dashboard')) text-white @else text-[25304e] @endif" />
        <span class="sidebar-item-text">Dashboard</span>
    </a>
</nav>