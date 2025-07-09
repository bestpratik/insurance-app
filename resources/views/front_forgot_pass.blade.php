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

    <section class="min-h-[600px] flex items-center justify-center bg-gray-100">

        <div class="bg-white rounded-2xl shadow-lg flex w-full max-w-4xl overflow-hidden">
            <!-- Sign In Form -->
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-bold text-center text-black mb-2">Forgot Your Password?</h2>
                <p class="mb-4 text-center text-base">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

               
                <form class="space-y-6 mb-5" action="{{route('validate.pass')}}" method="post"> 
                    @csrf
                    <!-- Floating email --> 
                    <div class="relative">
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                            class="peer w-full border border-gray-300 rounded-md px-4 pt-5 pb-2 text-sm placeholder-transparent focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Enter Your Email Id" />
                        <label for="email"
                            class="left-4 top-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-gray-500">
                            Enter Your Email Id
                        </label>
                         @if($errors->has('email'))
						    <span style="color: red">{{ $errors->first('email') }}</span>
						@endif
                    </div>

                 
                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-black transition">Submit</button>
                </form>
                
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