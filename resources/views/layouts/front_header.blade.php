<section class="bg-white px-6 py-4 flex justify-between items-center shadow-sm sticky top-0 z-40 backdrop-blur-2xl">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
        <img src="{{asset('logo.jpg')}}" alt="Logo" class="h-14 w-auto" />
    </div>

    <!-- Desktop Nav -->
    <nav class="hidden lg:flex bg-gray-200 px-6 py-3 rounded-lg text-lg text-gray-600 space-x-10 items-center">
        <a href="{{ route('home') }}"
            class="{{ request()->routeIs('home') ? 'text-red-600 font-medium' : 'hover:text-red-600' }}">Home</a>
        <a href="{{ route('about.us') }}"
            class="{{ request()->routeIs('about.us') ? 'text-red-600 font-medium' : 'hover:text-red-600' }}">About
            Us</a>
        <a href="{{ route('service') }}"
            class="{{ request()->routeIs('service') ? 'text-red-600 font-medium' : 'hover:text-red-600' }}">Buy
            Insurance Now</a>
        <a href="{{ route('contact.us') }}"
            class="{{ request()->routeIs('contact.us') ? 'text-red-600 font-medium' : 'hover:text-red-600' }}">Contact
            Us</a>

        <!-- ✅ Account Dropdown -->
        <div class="relative ml-auto">
            <button id="accountBtn" class="flex items-center space-x-2 border-l-2 border-red-700 pl-3 focus:outline-none
        {{ Auth::check() ? 'text-red-600 font-medium' : 'hover:text-red-600' }} ">
                <!-- User Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="font-medium">
                    @auth
                        {{ Auth::user()->name }}
                    @else
                        Account
                    @endauth
                </span>
                <svg class="w-4 h-4 pt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Dropdown -->
            <div id="accountMenu"
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50 hidden">
                @if(Auth::check())
                    <a href="{{ route('dashboard.frontend') }}"
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 space-x-2">
                        <!-- Dashboard Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('user.logout') }}"
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 space-x-2">
                        <!-- Logout Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>

                        <span>Logout</span>
                    </a>
                @else
                    <a href="{{ route('user.login') }}"
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 space-x-2">
                        <!-- Login Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>

                        <span>Login</span>
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <script>
        const accountBtn = document.getElementById('accountBtn');
        const accountMenu = document.getElementById('accountMenu');

        accountBtn.addEventListener('click', () => {
            accountMenu.classList.toggle('hidden');
        });

        window.addEventListener('click', (e) => {
            if (!accountBtn.contains(e.target) && !accountMenu.contains(e.target)) {
                accountMenu.classList.add('hidden');
            }
        });
    </script>






    <!-- Quote Button -->
    <a href="{{route('referral.form')}}"
        class="hidden lg:flex relative rounded-lg h-[50px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-56 hover:before:w-56">
        <span class="relative z-10">Get A Quote</span>
    </a>

    <!-- Mobile Toggle -->
    <button id="menuToggle" class="lg:hidden text-2xl text-red-600">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" class="size-8"
            x="0" y="0" viewBox="0 0 464.205 464.205" style="enable-background:new 0 0 512 512" xml:space="preserve"
            class="">
            <g>
                <path
                    d="M435.192 406.18H29.013C12.989 406.18 0 393.19 0 377.167s12.989-29.013 29.013-29.013h406.18c16.023 0 29.013 12.99 29.013 29.013-.001 16.023-12.99 29.013-29.014 29.013zM435.192 261.115H29.013C12.989 261.115 0 248.126 0 232.103s12.989-29.013 29.013-29.013h406.18c16.023 0 29.013 12.989 29.013 29.013s-12.99 29.012-29.014 29.012zM435.192 116.051H29.013C12.989 116.051 0 103.062 0 87.038s12.989-29.013 29.013-29.013h406.18c16.023 0 29.013 12.989 29.013 29.013s-12.99 29.013-29.014 29.013z"
                    fill="#ab0000" opacity="1" data-original="#000000" class=""></path>
            </g>
        </svg>
    </button>
</section>