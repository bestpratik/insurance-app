<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DGPOS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile sidebar (hidden by default) -->
        <div id="mobile-sidebar" class="fixed inset-0 z-40 hidden md:hidden">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true" id="mobile-sidebar-backdrop"></div>
            <div class="relative flex flex-col max-w-xs w-full bg-white h-full">
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button id="close-sidebar"
                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    @include('layouts.sidebar')
                </div>
            </div>
        </div>

        <!-- Desktop Sidebar -->
        <div id="desktop-sidebar"
            class="hidden md:flex md:flex-col md:w-64 bg-white border-r border-gray-200 transition-all duration-300 ease-in-out ">
            {{-- <div class="flex flex-col h-full"> --}}
                <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200">
                    <div class="sidebar-logo flex items-center">
                        <img src="{{ asset('/img/logo.jpg') }}" alt="logo" class="h-10 object-contain w-[150px]">
                        {{-- <span class="ml-2 text-xl font-semibold text-gray-900 sidebar-text">
                                {{ config('app.name', 'Laravel') }}
                            </span> --}}
                    </div>
                    <button id="toggle-sidebar"
                        class="p-1 rounded-md text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto pt-4">
                    @include('layouts.sidebar')
                </div>
            {{-- </div> --}}
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <div class="bg-white shadow-sm">
                <div class="px-4 py-3 flex items-center justify-between">
                    <!-- Mobile menu button -->
                    <div class="flex items-center">
                        <button id="open-sidebar"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>

                    @include('layouts.navigation')
                </div>
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
                <!-- Page Heading -->
           

                <div class="max-w-7xl mx-auto min-h-[80vh]">
                    @isset($header)
                    <header class="bg-white shadow mb-4 rounded-lg">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset
                    {{ $slot }}

                </div>
                <footer class=" mt-12 pt-4 border-t text-center text-gray-600 text-sm">
                    <p>Insurance APP © {{ date("Y") }} All rights reserved. <a href="#"
                            class="text-blue-500 hover:underline">Privacy
                            Policy</a> | <a href="#" class="text-blue-500 hover:underline">T&amp;C</a> | <a
                            href="#" class="text-blue-500 hover:underline">System Status</a></p>
                </footer>
            </main>
        </div>
    </div>

    @livewireScripts
</body>

</html>
