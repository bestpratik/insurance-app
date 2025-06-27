  <section class="bg-white px-6 py-4 flex justify-between items-center shadow-sm sticky top-0 z-10 backdrop-blur-2xl">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="{{asset('logo.jpg')}}" alt="Logo" class="h-14 w-auto" />
        </div>

        <!-- Desktop Nav -->
        <nav class="hidden lg:flex bg-gray-200 px-6 py-3 rounded-lg text-lg text-gray-600 space-x-10">
            <a href="#" class="text-red-600 font-medium">Home</a>
            <a href="{{route('about.us')}}" class="hover:text-red-600">About Us</a>
            <a href="{{route('service')}}" class="hover:text-red-600">Our Services</a>
            <!--<div class="relative group">-->
            <!--    <button class="hover:text-red-600 flex items-center">-->
            <!--        Pages <i class="ml-1 fas fa-chevron-down"></i>-->
            <!--    </button>-->
            <!--    <div-->
            <!--        class="absolute left-0 mt-2 bg-white border rounded shadow-md hidden group-hover:block min-w-[120px]">-->
            <!--        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Page 1</a>-->
            <!--        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Page 2</a>-->
            <!--    </div>-->
            <!--</div>--> 
            <a href="{{route('policy.buyer')}}" class="hover:text-red-600">Policy Buyer Form</a>
            <a href="{{route('contact.us')}}" class="hover:text-red-600">Contact Us</a>
        </nav>

        <!-- Quote Button -->
        <a href="#"
            class="hidden lg:flex relative rounded-lg h-[50px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-56 hover:before:w-56">
            <span class="relative z-10">Get A Quote</span>
        </a>

        <!-- Mobile Toggle -->
        <button id="menuToggle" class="lg:hidden text-2xl text-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                class="size-8" x="0" y="0" viewBox="0 0 464.205 464.205" style="enable-background:new 0 0 512 512"
                xml:space="preserve" class="">
                <g>
                    <path
                        d="M435.192 406.18H29.013C12.989 406.18 0 393.19 0 377.167s12.989-29.013 29.013-29.013h406.18c16.023 0 29.013 12.99 29.013 29.013-.001 16.023-12.99 29.013-29.014 29.013zM435.192 261.115H29.013C12.989 261.115 0 248.126 0 232.103s12.989-29.013 29.013-29.013h406.18c16.023 0 29.013 12.989 29.013 29.013s-12.99 29.012-29.014 29.012zM435.192 116.051H29.013C12.989 116.051 0 103.062 0 87.038s12.989-29.013 29.013-29.013h406.18c16.023 0 29.013 12.989 29.013 29.013s-12.99 29.013-29.014 29.013z"
                        fill="#ab0000" opacity="1" data-original="#000000" class=""></path>
                </g>
            </svg>
        </button>
    </section>