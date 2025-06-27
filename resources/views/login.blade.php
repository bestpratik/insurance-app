    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
    <!-- Hero Section with Gradient Overlay -->

    <section class="min-h-[600px] flex items-center justify-center bg-gray-100">

        <div class="bg-white rounded-2xl shadow-lg flex w-full max-w-4xl overflow-hidden">
            <!-- Sign In Form -->
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-bold text-center text-black mb-2">Sign In to Your Account</h2>
                <p class="mb-4 text-center text-base">Use your email and password to access your insurance dashboard.</p>

               
                <form class="space-y-6 mb-5">
                    <!-- Floating Username -->
                    <div class="relative">
                        <input type="text" id="username" name="username"
                            class="peer w-full border border-gray-300 rounded-md px-4 pt-5 pb-2 text-sm placeholder-transparent focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Username or Email" />
                        <label for="username"
                            class="absolute left-4 top-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-gray-500">
                            Username or Email
                        </label>
                    </div>

                    <!-- Floating Password with Eye Icon -->
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="peer w-full border border-gray-300 rounded-md px-4 pt-5 pb-2 text-sm placeholder-transparent focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Password" />

                        <label for="password"
                            class="absolute left-4 top-1 text-gray-500 text-sm transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-gray-500">
                            Password
                        </label>

                        <!-- Eye Icon Button -->
                        <button type="button" id="togglePassword"
                            class="absolute right-3 top-4 text-gray-500 hover:text-black focus:outline-none">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>


                    <!-- Actions -->
                    <div class="text-right text-sm text-gray-600 hover:underline cursor-pointer">
                        Forgot your password?
                    </div>

                    <button class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-black transition">Sign
                        In</button>
                </form>
                <p class="text-center text-sm text-gray-500 mb-4">or use your email password</p>
                <!-- Social Login -->
                <div class="flex justify-center gap-4 my-6">
                    <button class="border p-2 rounded-full"><img class="w-5"
                            src="https://www.svgrepo.com/show/475656/google-color.svg" alt=""></button>
                    <button class="border p-2 rounded-full"><img class="w-5"
                            src="https://www.svgrepo.com/show/475693/facebook-color.svg" alt=""></button>
                    <button class="border p-2 rounded-full"><img class="w-5"
                            src="https://www.svgrepo.com/show/512317/github-142.svg" alt=""></button>
                    <button class="border p-2 rounded-full"><img class="w-5"
                            src="https://www.svgrepo.com/show/448234/linkedin.svg" alt=""></button>
                </div>

                
            </div>

            <!-- Right Panel -->
            <div
                class="hidden md:flex w-1/2 bg-gradient-to-tr from-black to-red-700 items-center justify-center text-white p-8 rounded-l-[100px]">
                <div class="text-center space-y-4">
                    <h2 class="text-3xl font-bold">Welcome Back!</h2>
                    <p class="text-sm">Access your policies, claims, and insurance details securely.</p>
                    <button
                        class="border border-white px-6 py-2 rounded-full hover:bg-white hover:text-red-700 transition">SIGN
                        UP</button>
                </div>
            </div>
        </div>

    </section>