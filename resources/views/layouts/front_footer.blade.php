<footer class="bg-gray-900 text-white pt-14 pb-16 md:pb-6">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-10 text-sm">
        @php
            $contact = contactHelper();
            //dd($contact);
        @endphp
        <!-- Logo and About -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <a href="#">
                    <img src="{{ asset('logo-white.png') }}" alt="">
                </a>
            </div>
            <p class="text-gray-400 mb-4 text-md">Take advantage of our extensive knowledge, commitment to superior
                customer
                service, and dedication to excellence.</p>
            <div class="flex space-x-3">
                <a href="{{$contact->link1}}" class="hover:text-red-500"><svg xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24" class="size-4">
                        <path
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.988h-2.54v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33V21.878C18.343 21.128 22 16.991 22 12z" />
                    </svg>
                </a>
                <!-- <a href="{{$contact->link2}}" class="hover:text-red-500"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24" class="size-4">
                        <path
                            d="M22.46 6c-.77.35-1.6.58-2.46.69a4.29 4.29 0 0 0 1.88-2.37 8.59 8.59 0 0 1-2.72 1.04 4.27 4.27 0 0 0-7.36 3.89A12.13 12.13 0 0 1 3.15 4.6a4.27 4.27 0 0 0 1.32 5.7 4.23 4.23 0 0 1-1.93-.53v.05a4.27 4.27 0 0 0 3.43 4.18 4.3 4.3 0 0 1-1.92.07 4.27 4.27 0 0 0 3.98 2.96A8.57 8.57 0 0 1 2 19.54 12.09 12.09 0 0 0 8.29 21c7.55 0 11.68-6.26 11.68-11.68 0-.18-.01-.36-.02-.54A8.34 8.34 0 0 0 22.46 6z" />
                    </svg>
                </a> -->
                <a href="{{$contact->link3}}" class="hover:text-red-500"><svg xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" class="size-4" viewBox="0 0 24 24">
                        <path
                            d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8h4V24h-4V8zm7.5 0h3.8v2.1h.05c.53-.9 1.83-2.1 3.77-2.1 4.03 0 4.78 2.65 4.78 6.09V24h-4v-8.5c0-2.02-.03-4.63-2.82-4.63-2.82 0-3.25 2.2-3.25 4.47V24h-4V8z" />
                    </svg>
                </a>
                <a href="{{$contact->link4}}" class="hover:text-red-500"><svg xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" class="size-4" viewBox="0 0 24 24">
                        <path
                            d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.5.5.2.9.5 1.3.9.4.4.7.8.9 1.3.2.4.4 1 .5 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.5 2.2-.2.5-.5.9-.9 1.3-.4.4-.8.7-1.3.9-.4.2-1 .4-2.2.5-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.5-.5-.2-.9-.5-1.3-.9-.4-.4-.7-.8-.9-1.3-.2-.4-.4-1-.5-2.2-.1-1.3-.1-1.7-.1-4.9s0-3.6.1-4.9c.1-1.2.3-1.8.5-2.2.2-.5.5-.9.9-1.3.4-.4.8-.7 1.3-.9.4-.2 1-.4 2.2-.5C8.4 2.2 8.8 2.2 12 2.2m0-2.2C8.7 0 8.3 0 7 .1 5.6.1 4.5.3 3.7.6 2.9 1 2.2 1.6 1.6 2.2.9 2.9.3 3.6 0 4.5.3 5.6.1 6.7.1 8.1.1 9.4 0 9.8 0 12c0 2.2.1 2.6.1 3.9 0 1.4.2 2.5.5 3.3.3.9.9 1.6 1.6 2.2.6.6 1.3 1.2 2.2 1.6.8.3 1.9.5 3.3.5 1.3 0 1.7.1 3.9.1 2.2 0 2.6-.1 3.9-.1 1.4 0 2.5-.2 3.3-.5.9-.3 1.6-.9 2.2-1.6.6-.6 1.2-1.3 1.6-2.2.3-.8.5-1.9.5-3.3 0-1.3.1-1.7.1-3.9 0-2.2-.1-2.6-.1-3.9 0-1.4-.2-2.5-.5-3.3-.3-.9-.9-1.6-1.6-2.2-.6-.6-1.3-1.2-2.2-1.6-.8-.3-1.9-.5-3.3-.5C15.7 0 15.3 0 12 0zM12 5.8a6.2 6.2 0 1 0 0 12.4 6.2 6.2 0 0 0 0-12.4zm0 10.2a4 4 0 1 1 0-8.1 4 4 0 0 1 0 8.1zm6.4-11.7a1.4 1.4 0 1 0 0 2.9 1.4 1.4 0 0 0 0-2.9z" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Address -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
            <ul class="space-y-2 text-gray-400 text-lg">
                <li class="flex items-center gap-2 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m6.115 5.19.319 1.913A6 6 0 0 0 8.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 0 0 2.288-4.042 1.087 1.087 0 0 0-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 0 1-.98-.314l-.295-.295a1.125 1.125 0 0 1 0-1.591l.13-.132a1.125 1.125 0 0 1 1.3-.21l.603.302a.809.809 0 0 0 1.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 0 0 1.528-1.732l.146-.292M6.115 5.19A9 9 0 1 0 17.18 4.64M6.115 5.19A8.965 8.965 0 0 1 12 3c1.929 0 3.716.607 5.18 1.64" />
                    </svg>
                    {!! $contact->address !!}
                </li>
                <li class="flex items-center gap-2 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    <a href="tel:{{$contact->phone}}" class="text-white hover:underline">
                        {{$contact->phone}}
                    </a>  
                </li>
                <li class="flex items-center gap-2 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <a href="mailto:{{$contact->email}}" class="text-white hover:underline">
                        {{$contact->email}}
                    </a>
                    
                </li>
            </ul>
        </div>

        <!-- Quick Links -->

        <div>
            <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
            <ul class="space-y-2 text-gray-400 text-lg">
                <li><a href="{{ route('about.us') }}"
                        class="{{ request()->routeIs('about.us') ? 'text-red-600' : '' }}"> About Us</a></li>
                <li><a href="{{ route('contact.us') }}"
                        class="{{ request()->routeIs('contact.us') ? 'text-red-600' : '' }}">Contact Us</a></li>
                <li><a href="{{ route('service') }}"
                        class="{{ request()->routeIs('service') ? 'text-red-600' : '' }}">Our Services</a></li>
                <li><a href="{{route('terms.conditions')}}" class="hover:text-red-500">Terms & Condition</a></li>
            </ul>
        </div>

        <!-- Newsletter -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
            <p class="text-red-600 mb-4">Join our newsletter for updates and news.</p>
            <form id="newsletterForm" class="flex">
                @csrf
                <input type="email" id="email_id" name="email_id" placeholder="Your Email ID"
                    class="w-full px-2 py-4 rounded-l bg-gray-800 text-red-500 focus:outline-none">
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 rounded-r">SignUp</button>
            </form>
            <div id="message" class="mt-2 text-sm"></div>
        </div>
    </div>
    <div class="mt-4 text-center text-white text-lg"> authorised and regulated by the financial conduct authority
    </div>
    <!-- Bottom Footer -->
    <div class="mt-4 border-t border-gray-700 pt-6 text-center text-gray-500 text-lg"> © <span
            class="text-red-600">moneywise plc</span>, All Rights Reserved.
    </div>
</footer>

<div class="fixed-bottom-insurance md:hidden">
    <a href="{{ route('service') }}" class="text-white hover:underline w-full block">
        Buy Insurance Now
    </a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Ensure input is clear on page load
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('email_id').value = '';
    });

    document.getElementById('newsletterForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const emailInput = document.getElementById('email_id');
        const email_id = emailInput.value.trim();
        const messageDiv = document.getElementById('message');

        // Clear previous messages
        messageDiv.textContent = '';
        messageDiv.classList.remove('text-green-500', 'text-red-500');

        if (!email_id) {
            messageDiv.textContent = 'Please enter your email.';
            messageDiv.classList.add('text-red-500');
            return;
        }

        fetch('{{ route('newsletter.subscribe') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                email_id: email_id
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageDiv.textContent = data.message;
                    messageDiv.classList.add('text-green-500');
                    document.getElementById('newsletterForm').reset();
                } else {
                    messageDiv.textContent = data.message;
                    messageDiv.classList.add('text-red-500');
                }
            })
            .catch(error => {
                console.error(error);
                messageDiv.textContent = 'Something went wrong. Please try again.';
                messageDiv.classList.add('text-red-500');
            });
    });
</script>