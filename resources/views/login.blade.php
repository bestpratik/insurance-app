<x-front>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded-md bg-green-100 text-green-800 border border-green-200 relative">
            <strong class="font-semibold"></strong> {{ session('success') }}
            <button type="button" onclick="this.parentElement.remove();"
                class="absolute top-2 right-3 text-green-800 hover:text-green-600">
                &times;
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 px-4 py-3 rounded-md bg-red-100 text-red-800 border border-red-200 relative">
            <strong class="font-semibold"></strong> {{ session('error') }}
            <button type="button" onclick="this.parentElement.remove();"
                class="absolute top-2 right-3 text-red-800 hover:text-red-600">
                &times;
            </button>
        </div>
    @endif

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
    <!-- Hero Section with Gradient Overlay -->

    <section class="min-h-[600px] flex items-center justify-center bg-gray-100">

        <div class="bg-white rounded-2xl shadow-lg flex w-full max-w-4xl overflow-hidden">
            <!-- Sign In Form -->
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-bold text-center text-black mb-2">Sign In to Your Account</h2>
                <p class="mb-4 text-center text-base">Use your email and password to access your insurance dashboard.
                </p>


                <form class="space-y-6 mb-5" action="{{route('user.login.submit')}}" method="post"> 
                    @csrf
                    <div class="relative">
                        <input type="text" id="username" name="email" value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-md px-4 pt-4 pb-3 text-md placeholder-transparent focus:outline-none focus:ring-1 focus:ring-red-600 bg-white"
                            placeholder="Username or Email" />
                        <label for="username" class="absolute left-4 -top-2.5 text-gray-500 text-md transition-all bg-white px-3">
                            Username or Email
                        </label>
                        @if($errors->has('email'))
                            <span style="color: red">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="relative">
                        <input type="password" id="password" name="password" value="{{ old('password') }}"
                            class="w-full border border-gray-300 rounded-md px-4 pt-4 pb-3 text-md placeholder-transparent focus:outline-none focus:ring-1 focus:ring-red-600"
                            placeholder="Password" />
                        <label for="password"
                            class="absolute left-4 -top-2.5 text-gray-500 text-md transition-all bg-white px-3">
                            Password
                        </label>
                        @if($errors->has('password'))
                            <span style="color: red">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <!-- Actions -->
                    <a href=""></a>
                    <div class="text-right text-sm text-gray-600 hover:underline cursor-pointer">
                        Forgot your password?
                    </div>


                    <button type="submit"
                        class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-black transition">Sign
                        In</button>
                </form>
                <p class="text-center text-sm text-gray-500 mb-4">or use your email password</p>
                <!-- Social Login -->
                <!-- <div class="flex justify-center gap-4 my-6">
                    <a href="{{ route('auth.google') }}" class="border p-2 rounded-full"><img class="w-5"
                            src="https://www.svgrepo.com/show/475656/google-color.svg" alt=""></a>
                    {{--<button class="border p-2 rounded-full"><img class="w-5"
                            src="https://www.svgrepo.com/show/475656/google-color.svg" alt=""></button>--}}
                    <button class="border p-2 rounded-full"><img class="w-5"
                            src="https://www.svgrepo.com/show/475693/facebook-color.svg" alt=""></button>
                    <button class="border p-2 rounded-full"><img class="w-5"
                            src="https://www.svgrepo.com/show/512317/github-142.svg" alt=""></button>
                    <button class="border p-2 rounded-full"><img class="w-5"
                            src="https://www.svgrepo.com/show/448234/linkedin.svg" alt=""></button>
                </div> -->


            </div>

            <!-- Right Panel -->
            <div
                class="hidden md:flex w-1/2 bg-gradient-to-tr from-black to-red-700 items-center justify-center text-white p-8 rounded-l-[100px]">
                <div class="text-center space-y-4">
                    <h2 class="text-3xl font-bold">Welcome Back!</h2>
                    <p class="text-sm">Access your policies, claims, and insurance details securely.</p>
                    <a href="{{route('user.register')}}">
                        <button
                            class="border border-white px-6 py-2 rounded-full hover:bg-white hover:text-red-700 transition">SIGN
                            UP</button>
                    </a>
                </div>
            </div>
        </div>

    </section>

</x-front>