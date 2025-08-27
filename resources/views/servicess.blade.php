  <x-front>  
    
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>

    <!-- Script -->




    <section
        class="relative bg-[url('/service-details.jpg')] bg-cover bg-center bg-no-repeat text-white">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative z-1 py-24 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Buy Directly</h2>
                <p class="text-lg md:text-xl mb-8">Tailored financial solutions to help you grow, protect, and manage
                    your wealth.</p>

            </div>
    </section>

      <section class="bg-gray-100 py-16">
          <div class="max-w-4xl mx-auto px-8">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                  @foreach ($services as $row)
                  <div
                      class="bg-white rounded-xl shadow-md overflow-hidden relative group transition transform hover:scale-[1.005] hover:shadow-xl">


                      <div class="relative">
                          <img src="{{ asset('uploads/service/' . $row->image) }}" alt="Landlord Protection"
                              class="w-full h-68 object-cover">
                          <div class="absolute bottom-4 left-4 bg-red-100 text-red-700 px-4 py-1 rounded-lg text-sm font-bold shadow-md">
                              £ {{ $row->insurance->payable_amount }}
                          </div>
                      </div>

                      <div class="p-6">
                          @if ($row->offer)
                          <span
                              class="absolute top-4 right-4 bg-green-600 text-white px-3 py-1 rounded-md text-sm font-semibold flex items-center gap-1 shadow-md transition-all duration-300 group-hover:shadow-green-500/50">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" viewBox="0 0 640 640" style="width: 20px; display: inline-block; margin-right: 4px;"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                  <path d="M256.1 72C322.4 72 376.1 125.7 376.1 192C376.1 258.3 322.4 312 256.1 312C189.8 312 136.1 258.3 136.1 192C136.1 125.7 189.8 72 256.1 72zM226.4 368L285.8 368C292.5 368 299 368.4 305.5 369.1C304.6 374 304.1 379 304.1 384.1L304.1 476.2C304.1 501.7 314.2 526.1 332.2 544.1L364.1 576L77.8 576C61.4 576 48.1 562.7 48.1 546.3C48.1 447.8 127.9 368 226.4 368zM352.1 476.2L352.1 384.1C352.1 366.4 366.4 352.1 384.1 352.1L476.2 352.1C488.9 352.1 501.1 357.2 510.1 366.2L606.1 462.2C624.8 480.9 624.8 511.3 606.1 530.1L530 606.2C511.3 624.9 480.9 624.9 462.1 606.2L366.1 510.2C357.1 501.2 352 489 352 476.3zM456.1 432C456.1 418.7 445.4 408 432.1 408C418.8 408 408.1 418.7 408.1 432C408.1 445.3 418.8 456 432.1 456C445.4 456 456.1 445.3 456.1 432z" />
                              </svg> {{ $row->offer }}
                          </span>
                          @endif

                          <h3 class="text-lg font-bold mb-2">{{ $row->title }}</h3>
                          <p class="text-sm text-gray-600 mb-4">{{ $row->sub_title }}</p>

                          <div class="flex gap-2 justify-between">
                              <a href="{{ route('service.details', $row->page_slug) }}"
                                  class="relative rounded-md flex h-[40px] w-40 items-center justify-center overflow-hidden border border-red-600 text-red-600 transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-600 before:duration-500 before:ease-out hover:text-white hover:before:h-40 hover:before:w-56">
                                  <span class="relative z-10">Know more</span>
                              </a>

                              <a href="{{ route('policy.buyer', $row->page_slug) }}"
                                  class="relative rounded-md flex h-[40px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-40 hover:before:w-56">
                                  <span class="relative z-1">Buy Now</span>
                              </a>

                          </div>
                      </div>
                  </div>
                  @endforeach
              </div>
          </div>
      </section>

   

</x-front>
