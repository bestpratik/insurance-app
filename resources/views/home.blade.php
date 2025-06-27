<x-front>
	   <section class="relative w-full max-h-[450px] overflow-hidden">
        <!-- Slider Container -->
        <div id="sliderWrapper" class="flex transition-transform duration-500 ease-in-out"
            style="transform: translateX(0%)">
            <!-- Slide 1 -->
            <div class="min-w-full max-h-[450px] relative">
                <img src="{{asset('banner.jpg')}}" class="w-full h-[450px] object-cover" alt="Slide 1" />
                <div class="absolute inset-0 bg-black/30 flex items-center">
                    <div class="container mx-auto px-6">
                        <div class="max-w-xl text-white">
                            <h2 class="text-4xl font-bold mb-4">Your Future, Our Priority</h2>
                            <p class="text-lg text-gray-100 mb-6">Clita erat ipsum et lorem et sit, sed stet lorem sit
                                clita duo justo magna dolore erat amet.</p>
                            <a href="#"
                                class="relative rounded-lg flex h-[50px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-56 hover:before:w-56">
                                <span class="relative z-1">More Details</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="min-w-full max-h-[450px] relative">
                <img src="{{asset('banner-2.jpg')}}" class="w-full h-[450px] object-cover" alt="Slide 2" />
                <div class="absolute inset-0 bg-black/30 flex items-center">
                    <div class="container mx-auto px-6">
                        <div class="max-w-xl text-white">
                            <h2 class="text-4xl font-bold mb-4">The Best Insurance Begins Here</h2>
                            <p class="text-lg text-gray-100 mb-6">Clita erat ipsum et lorem et sit, sed stet lorem sit
                                clita duo justo magna dolore erat amet.</p>
                            <a href="#"
                                class="relative rounded-lg flex h-[50px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-56 hover:before:w-56">
                                <span class="relative z-1">More Details</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Left Arrow -->
        <button id="prevBtn"
            class="absolute left-3 top-1/2 transform -translate-y-1/2 bg-red-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md z-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Right Arrow -->
        <button id="nextBtn"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-red-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md z-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </section>


    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:flex md:items-center md:gap-12">
            <!-- Left: Image + Badge -->
            <div class="relative md:w-1/2">
                <div
                    class="absolute -top-6 -left-6 bg-red-600 text-white text-center px-6 py-4 rounded-md shadow-md z-1 flex space-x-2 align-center">
                    <p class="text-6xl font-bold">47</p>
                    <div class="text-start">
                        <p class="text-3xl font-semibold">Years</p>
                        <p class="text-sm">Experience</p>
                    </div>
                </div>
                <img src="{{asset('about.jpg')}}" alt="about" class="rounded-md shadow-lg">
            </div>

            <!-- Right: Text Content -->
            <div class="md:w-1/2 mt-10 md:mt-0">
                <h2 class="text-3xl md:text-4xl font-bold text-black mb-4 leading-tight">
                    Insurance That Works for You — Not the Other Way Around
                </h2>
                <p class="text-gray-600 mb-4">
                    At Moneywise Investments PLC, we believe there’s more to financial and insurance services than just
                    policies and paperwork — it’s about people. Since our inception, we’ve built a reputation for good,
                    honest service, putting our clients at the heart of everything we do.
                </p>


                <p class="text-gray-500 mb-6">
                    Whether you're a business or personal customer, we take the time to understand your unique needs. We
                    don’t believe in one-size-fits-all solutions. Instead, our team carefully listens, advises, and
                    recommends only the products that truly fit your circumstances — ones you can both understand and
                    trust.
                </p>

                <!-- Call Info -->
                <!-- <div class="flex items-center space-x-3 border-t pt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        class="size-6" x="0" y="0" viewBox="0 0 438.536 438.536"
                        style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path
                                d="M414.41 24.123C398.333 8.042 378.963 0 356.315 0H82.228C59.58 0 40.21 8.042 24.126 24.123 8.045 40.207.003 59.576.003 82.225v274.084c0 22.647 8.042 42.018 24.123 58.102 16.084 16.084 35.454 24.126 58.102 24.126h274.084c22.648 0 42.018-8.042 58.095-24.126 16.084-16.084 24.126-35.454 24.126-58.102V82.225c-.001-22.649-8.043-42.021-24.123-58.102zm-55.251 308.751c-3.997 8.754-12.99 16.371-26.977 22.846-13.99 6.475-26.413 9.712-37.265 9.712-3.046 0-6.283-.235-9.708-.711-3.426-.479-6.324-.952-8.703-1.428-2.378-.476-5.523-1.331-9.421-2.57-3.905-1.234-6.715-2.189-8.422-2.854-1.718-.664-4.856-1.854-9.421-3.566-4.569-1.718-7.427-2.765-8.562-3.138-31.215-11.427-61.721-32.028-91.507-61.814-29.786-29.793-50.391-60.292-61.812-91.502-.378-1.143-1.425-3.999-3.14-8.565a952.564 952.564 0 0 0-3.571-9.419c-.662-1.713-1.615-4.521-2.853-8.42-1.237-3.903-2.091-7.041-2.568-9.423-.478-2.376-.95-5.277-1.427-8.704-.476-3.427-.713-6.667-.713-9.71 0-10.85 3.237-23.269 9.71-37.259 6.472-13.988 14.084-22.981 22.841-26.979 10.088-4.189 19.7-6.283 28.837-6.283 2.091 0 3.616.192 4.565.572.953.385 2.524 2.094 4.714 5.14 2.19 3.046 4.568 6.899 7.137 11.563 2.57 4.665 5.092 9.186 7.566 13.562a601.267 601.267 0 0 1 7.139 12.991c2.284 4.279 3.711 6.995 4.281 8.133.571.957 1.809 2.762 3.711 5.429 1.902 2.663 3.333 5.039 4.283 7.135.95 2.094 1.427 4.093 1.427 5.996 0 2.859-1.953 6.331-5.854 10.42-3.903 4.093-8.186 7.854-12.85 11.281s-8.945 7.092-12.847 10.994c-3.899 3.899-5.852 7.087-5.852 9.562 0 1.333.333 2.902 1 4.71.666 1.812 1.285 3.287 1.856 4.427.571 1.141 1.477 2.76 2.712 4.856 1.237 2.096 2.048 3.427 2.426 3.999 10.467 18.843 22.508 35.07 36.114 48.681 13.612 13.613 29.836 25.648 48.682 36.117.567.384 1.902 1.191 4.004 2.43 2.091 1.232 3.713 2.136 4.853 2.707 1.143.571 2.614 1.191 4.425 1.852 1.811.664 3.381.999 4.719.999 3.036 0 7.225-3.138 12.56-9.418a976.681 976.681 0 0 1 16.276-18.705c5.516-6.181 9.985-9.274 13.418-9.274 1.902 0 3.897.473 5.999 1.424 2.095.951 4.469 2.382 7.132 4.284 2.669 1.91 4.476 3.142 5.428 3.721l15.125 8.271c10.089 5.332 18.511 10.041 25.27 14.134s10.424 6.899 10.996 8.419c.379.951.564 2.478.564 4.572-.007 9.128-2.102 18.741-6.297 28.803z"
                                fill="#720000" opacity="1" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                    <div>
                        <p class="text-black font-bold">Call Us: +020 8552 5521</p>
                    </div>
                </div> -->
                <a href="#"
                    class="relative rounded-lg flex h-[50px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-56 hover:before:w-56">
                    <span class="relative z-1">More Details</span>
                </a>
            </div>
        </div>
    </section>
    <section class="bg-gray-100 py-16">
        <div class="max-w-4xl mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden relative ">
                    <img src="{{asset('43704.jpg')}}" alt="Landlord Protection" class="w-full h-48 object-cover">

                    <div class="p-6">
                        <div class="border-b-4 border-red-500 w-10 mb-4"></div>
                        <h3 class="text-lg font-bold mb-2">Landlord Legal Expenses & Rent Guarantee Insurance</h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Landlord Legal Expenses & Rent Guarantee Insurance
                        </p>
                        <div class="flex gap-2">
                            <a href="#"
                                class="relative rounded-md flex h-[40px] w-40 items-center justify-center overflow-hidden border border-red-600 text-red-600 transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-600 before:duration-500 before:ease-out hover:text-white hover:before:h-40 hover:before:w-56">
                                <span class="relative z-10">Know more</span>
                            </a>
                            <a href="#"
                                class="relative rounded-md flex h-[40px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-40 hover:before:w-56">
                                <span class="relative z-1">Buy Now</span>
                            </a>
                        </div>
                    </div>
                </div> <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden relative">
                    <img src="{{asset('LANDLORD.jpg')}}" alt="Residential Let Insurance" class="w-full h-48 object-cover">

                    <div class="p-6">
                        <div class="border-b-4 border-red-500 w-10 mb-4"></div>
                        <h3 class="text-lg font-bold mb-2">
                            Residential let insurance policy for malicious damages
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Residential let insurance policy for malicious damages
                        </p>
                        <div class="flex gap-2">
                            <a href="#"
                                class="relative rounded-md flex h-[40px] w-40 items-center justify-center overflow-hidden border border-red-600 text-red-600 transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-600 before:duration-500 before:ease-out hover:text-white hover:before:h-40 hover:before:w-56">
                                <span class="relative z-10">Know more</span>
                            </a>
                            <a href="#"
                                class="relative rounded-md flex h-[40px] w-40 items-center justify-center overflow-hidden bg-red-600 text-white transition-all before:absolute before:h-0 before:w-0 before:rounded-full before:bg-red-800 before:duration-500 before:ease-out hover:shadow-orange-800 hover:before:h-40 hover:before:w-56">
                                <span class="relative z-1">Buy Now</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <section class="py-16 bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-white mb-12">
                We Provide Professional <br />
                <span class="text-red-600">Insurance Services</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card Template (copy this for all) -->
                <div
                    class="bg-gray-900 rounded-lg shadow-lg p-6 hover:shadow-xl transition border border-gray-700 hover:backdrop-blur-2xl">
                    <div class="flex items-start gap-4">
                        <div class="bg-red-600 text-white p-3 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                            </svg>

                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Building and Contents Insurance</h3>
                            <p class="text-gray-300 text-sm mt-2">As a landlord we know your properties are your biggest
                                asset. This is why insuring your
                                buildings against any potential risk such as fire damage or flood damage can mean you
                                don’t risk huge loss...</p>
                            <a href="#" class="inline-block mt-4 text-red-500 hover:underline text-sm font-medium">Read
                                More</a>
                        </div>
                    </div>
                </div>

                <!-- Health Insurance -->
                <div class="bg-gray-900 rounded-lg shadow-lg p-6 hover:shadow-xl transition border border-gray-700">
                    <div class="flex items-start gap-4">
                        <div class="bg-red-600 text-white p-3 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3l8.25 4.5v4.507c0 4.632-3.219 8.87-8.25 9.993-5.031-1.123-8.25-5.36-8.25-9.993V7.5L12 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6v6H9z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Property Owners Liability Insurance</h3>
                            <p class="text-gray-300 text-sm mt-2">Avoid the cost of a potential compensation claim made
                                against you by a tenant. When you
                                add property owners liability insurance to your policy you can be confident that any
                                claim
                                made against you will not cost you significantly and will not damage your income. ..</p>
                            <a href="#" class="inline-block mt-4 text-red-500 hover:underline text-sm font-medium">Read
                                More</a>
                        </div>
                    </div>
                </div>

                <!-- Home Insurance -->
                <div class="bg-gray-900 rounded-lg shadow-lg p-6 hover:shadow-xl transition border border-gray-700">
                    <div class="flex items-start gap-4">
                        <div class="bg-red-600 text-white p-3 rounded-md">
                            <!-- Landlords Home Emergency SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" class="w-6 h-6">
                                <!-- House -->
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10.5L12 4l9 6.5V20a1 1 0 01-1 1h-5v-5H9v5H4a1 1 0 01-1-1v-9.5z" />
                                <!-- Emergency Flame -->
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.5 13.5c.75.75 1.5 2 1.5 3 0 1.5-1 3-3 3s-3-1.5-3-3c0-1 .75-2.25 1.5-3 .5-.5 1.5-1 1.5-2 0-.75-.25-1.25-.5-1.5 1.5.25 2.5 1.5 2.5 3 0 1-.75 1.5-.75 1.5z" />
                            </svg>

                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Landlords Home Emergency Insurance</h3>
                            <p class="text-gray-300 text-sm mt-2">Whether you let out one property or multiple
                                properties, the option to insure your boiler
                                and heating systems, your plumbing and drainage, and power supply can save you time and
                                money.
                            </p>
                            <a href="#" class="inline-block mt-4 text-red-500 hover:underline text-sm font-medium">Read
                                More</a>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Insurance -->
                <div class="bg-gray-900 rounded-lg shadow-lg p-6 hover:shadow-xl transition border border-gray-700">
                    <div class="flex items-start gap-4">
                        <div class="bg-red-600 text-white p-3 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 9.75L12 3l9 6.75v8.25A2.25 2.25 0 0 1 18.75 21H5.25A2.25 2.25 0 0 1 3 18V9.75z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9" />
                            </svg>

                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Landlords Legal Expenses Insurance</h3>
                            <p class="text-gray-300 text-sm mt-2">In the event of having to evict a tenant and going
                                through the lengthy process of eviction, ensure
                                you are covered for legal expenses and loss of rent. If your tenants are in breach of
                                their
                                contract you can be covered for any damage caused to the property, any loss of rent and
                                legal
                                advice that you may require. Don’t run the risk of significant and expensive fees and
                                costs.
                            </p>
                            <a href="#" class="inline-block mt-4 text-red-500 hover:underline text-sm font-medium">Read
                                More</a>
                        </div>
                    </div>
                </div>

                <!-- Business Insurance -->
                <div class="bg-gray-900 rounded-lg shadow-lg p-6 hover:shadow-xl transition border border-gray-700">
                    <div class="flex items-start gap-4">
                        <div class="bg-red-600 text-white p-3 rounded-md">
                            <!-- Briefcase Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="size-6">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                            </svg>

                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Business Insurance</h3>
                            <p class="text-gray-300 text-sm mt-2">Secure your enterprise against liabilities and risks.
                            </p>
                            <a href="#" class="inline-block mt-4 text-red-500 hover:underline text-sm font-medium">Read
                                More</a>
                        </div>
                    </div>
                </div>

                <!-- Property Insurance -->
                <div class="bg-gray-900 rounded-lg shadow-lg p-6 hover:shadow-xl transition border border-gray-700">
                    <div class="flex items-start gap-4">
                        <div class="bg-red-600 text-white p-3 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                            </svg>

                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Property Insurance</h3>
                            <p class="text-gray-300 text-sm mt-2">Coverage for your commercial and personal properties.
                            </p>
                            <a href="#" class="inline-block mt-4 text-red-500 hover:underline text-sm font-medium">Read
                                More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="clients my-12">

        <!-- Swiper Container -->
        <div class="swiper mySwiper w-full max-w-7xl mx-auto">
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div
                    class=" swiper-slide border rounded-md  hover:scale-103 transition-transform duration-300 flex items-center justify-center">
                    <img src="{{asset('03.jpg')}}" class=" px-8 py-3" alt="">
                </div>
                <div
                    class=" swiper-slide border rounded-md  hover:scale-103 transition-transform duration-300 flex items-center justify-center">
                    <img src="{{asset('08.png')}}" class=" px-8 py-3" alt="">
                </div>
                <div
                    class=" swiper-slide border rounded-md  hover:scale-103 transition-transform duration-300 flex items-center justify-center">
                    <img src="{{asset('07.jpg')}}" class=" px-8 py-3" alt="">
                </div>
                <div
                    class=" swiper-slide border rounded-md  hover:scale-103 transition-transform duration-300 flex items-center justify-center">
                    <img src="{{asset('06.png')}}" class=" px-8 py-3" alt="">
                </div>
                <div
                    class=" swiper-slide border rounded-md  hover:scale-103 transition-transform duration-300 flex items-center justify-center">
                    <img src="{{asset('05.png')}}" class=" px-8 py-3" alt="">
                </div>
                <div
                    class=" swiper-slide border rounded-md  hover:scale-103 transition-transform duration-300 flex items-center justify-center">
                    <img src="{{asset('04.png')}}" class=" px-8 py-3" alt="">
                </div>
            </div>

            <!-- Optional Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>
</x-front>