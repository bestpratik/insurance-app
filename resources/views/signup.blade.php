    <x-front>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded-md bg-green-100 text-green-800 border border-green-200 relative">
            <strong class="font-semibold"></strong> {{ session('success') }}
            <button type="button" onclick="this.parentElement.remove();" class="absolute top-2 right-3 text-green-800 hover:text-green-600">
                &times;
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 px-4 py-3 rounded-md bg-red-100 text-red-800 border border-red-200 relative">
            <strong class="font-semibold"></strong> {{ session('error') }}
            <button type="button" onclick="this.parentElement.remove();" class="absolute top-2 right-3 text-red-800 hover:text-red-600">
                &times;
            </button>
        </div>
    @endif
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
    <!-- Hero Section with Gradient Overlay -->

    <section class="min-h-[600px] flex items-center justify-center bg-gray-100 ">
        <div class="bg-white rounded-2xl shadow-lg flex w-full max-w-4xl overflow-hidden my-16">
            <!-- Sign Up Form -->
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-bold text-center text-black mb-2">Create Your Account</h2>
                <p class="mb-4 text-center text-base">Join to manage your insurance policies with ease.</p>

                <form class="space-y-6 mb-5" action="{{route('user.register.submit')}}" method="post">
                    @csrf
                    <!-- Name -->
                    <div class="relative">
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="peer w-full border border-gray-300 rounded-md px-4 pt-5 pb-2 text-sm placeholder-transparent focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Full Name" />
                        <label for="name" class="absolute left-4 -top-2.5 text-gray-500 text-md transition-all bg-white px-3">
                            Full Name
                        </label>
                        @if($errors->has('name'))
						    <span style="color: red">{{ $errors->first('name') }}</span>
						@endif
                    </div>

                    <!-- Email -->
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="peer w-full border border-gray-300 rounded-md px-4 pt-5 pb-2 text-sm placeholder-transparent focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Email Address" />
                        <label for="email"
                            class="absolute left-4 -top-2.5 text-gray-500 text-md transition-all bg-white px-3">
                            Email Address
                        </label>
                        @if($errors->has('email'))
						    <span style="color: red">{{ $errors->first('email') }}</span>
						@endif
                    </div>
                    <!-- Password -->
                    <div class="relative">
                        <input type="password" id="signupPassword" name="password"
                            class="peer w-full border border-gray-300 rounded-md px-4 pt-5 pb-2 text-sm placeholder-transparent focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Password" />
                        <label for="signupPassword"
                            class="absolute left-4 -top-2.5 text-gray-500 text-md transition-all bg-white px-3">
                            Password
                        </label>
                        <!-- @if($errors->has('password'))
						    <span style="color: red">{{ $errors->first('password') }}</span>
						@endif -->
                        <!-- <button type="button" id="toggleSignupPassword"
                            class="absolute right-3 top-4 text-gray-500 hover:text-black">
                      
                            <svg id="eyeOpen1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 block" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                  
                            <svg id="eyeOff1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19.5C7.523 19.5 3.732 16.557 2.458 12a10.094 10.094 0 012.456-4.118M6.635 6.635A9.964 9.964 0 0112 4.5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-1.174 2.45M15 12a3 3 0 00-3-3m-1.5.514a3 3 0 104.477 4.477M3 3l18 18" />
                            </svg>
                        </button> -->
                    </div>

                    <!-- Confirm Password -->
                    <div class="relative">
                        <input type="password" id="signupConfirmPassword" name="password_confirmation"
                            class="peer w-full border border-gray-300 rounded-md px-4 pt-5 pb-2 text-sm placeholder-transparent focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Confirm Password" />
                        <label for="signupConfirmPassword"
                            class="absolute left-4 -top-2.5 text-gray-500 text-md transition-all bg-white px-3">
                            Confirm Password
                        </label>
                        @if($errors->has('password'))
                            <span style="color: red">{{ $errors->first('password') }}</span>
                        @endif
                        <!-- <button type="button" id="toggleSignupConfirmPassword"
                            class="absolute right-3 top-4 text-gray-500 hover:text-black">
                    
                            <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 block" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                
                            <svg id="eyeOff2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19.5C7.523 19.5 3.732 16.557 2.458 12a10.094 10.094 0 012.456-4.118M6.635 6.635A9.964 9.964 0 0112 4.5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-1.174 2.45M15 12a3 3 0 00-3-3m-1.5.514a3 3 0 104.477 4.477M3 3l18 18" />
                            </svg>
                        </button> -->
                    </div>

                        <!-- <div class="relative">
                            <select id="type" name="type"
                                class="peer w-full border border-gray-300 rounded-md px-4 pt-5 pb-2 text-sm placeholder-transparent focus:outline-none focus:ring-2 focus:ring-red-600"
                                >
                                <option value="">Choose Type</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                            @if($errors->has('type'))
                                <span style="color: red">{{ $errors->first('type') }}</span>
                            @endif
                        </div> -->


                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-black transition">Sign
                        Up</button>
                </form>

                <!-- <p class="text-center text-sm text-gray-500 mb-4">or sign up using social platforms</p> -->

                <!-- Social Login -->
                <div class="flex justify-center gap-4 my-6">
                    <!-- Google -->
                    <!-- <a href="{{ route('auth.google', 'google') }}" class="w-full max-w-xs">
                        <button class="flex items-center justify-center gap-3 w-full bg-white border border-red-500 py-2 px-3 rounded-md hover:shadow transition duration-200">
                            <img class="w-4 h-4" src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google">
                            <span class="text-sm font-medium text-gray-700">Continue with Google</span>
                        </button>
                    </a> -->
                   
 
                    <!-- Facebook -->
                    <!-- <a href="{{ route('auth.facebook', 'facebook') }}">
                        <button class="flex items-center gap-2 border px-4 py-2 rounded-full hover:bg-gray-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24" height="24" x="0" y="0" viewBox="0 0 152 152"
                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <linearGradient id="a" x1="49.252" x2="118.558" y1="114.48" y2="45.175"
                                        gradientTransform="matrix(1 0 0 -1 0 154)" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#42a5f5"></stop>
                                        <stop offset="1" stop-color="#1565c0"></stop>
                                    </linearGradient>
                                    <path fill="url(#a)"
                                        d="M60.4 84.5H44.3c-2.6 0-3.4-1-3.4-3.4V61.4c0-2.6 1-3.6 3.4-3.6h16.1V43.5c-.2-6.3 1.3-12.7 4.4-18.4 3.3-5.7 8.5-9.9 14.5-12 4.1-1.5 8.1-2.1 12.4-2.1h15.9c2.3 0 3.3 1 3.3 3.3v18.5c0 2.3-1 3.3-3.3 3.3-4.4 0-8.8 0-13.2.2s-6.7 2.1-6.7 6.7c-.2 4.9 0 9.6 0 14.6h18.7c2.6 0 3.6 1 3.6 3.6v19.7c0 2.6-.8 3.6-3.6 3.6H87.9v52.9c0 2.8-1 3.7-3.7 3.7H63.9c-2.4 0-3.4-1-3.4-3.4V84.5z"
                                        opacity="1" data-original="url(#a)" class=""></path>
                                </g>
                            </svg>
                            <span class="text-sm">Facebook</span>
                        </button>
                    </a> -->
                </div>

            </div>

            <!-- Right Panel -->
            <div
                class="hidden md:flex w-1/2 bg-gradient-to-tr from-black to-red-700 items-center justify-center text-white p-8 rounded-l-[100px]">
                <div class="text-center space-y-4">
                    <h2 class="text-3xl font-bold">Welcome!</h2>
                    <p class="text-sm">Already have an account? Sign in to manage your policies and claims.</p>
                    <a href="{{route('user.login')}}">
                        <button
                        class="border border-white px-6 py-2 rounded-full hover:bg-white hover:text-red-700 transition">
                        SIGN IN
                    </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

</x-front>