@php
    $contact = contactHelper();
@endphp

<section class="bg-red-700 text-white text-sm px-6 py-3 flex justify-between items-center">
    <div class="flex items-center space-x-6">
        <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
            </svg>

            <span class="hidden md:block">
                <a href="tel:{{ $contact->phone }}" class="text-white hover:underline">
                    {{ $contact->phone }}
                </a></span>
        </div>
        <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>

            <span class="hidden md:block">
                <a href="mailto:{{ $contact->email }}" class="text-white hover:underline">
                    {{ $contact->email }}
                </a></span>
        </div>
        <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m6.115 5.19.319 1.913A6 6 0 0 0 8.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 0 0 2.288-4.042 1.087 1.087 0 0 0-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 0 1-.98-.314l-.295-.295a1.125 1.125 0 0 1 0-1.591l.13-.132a1.125 1.125 0 0 1 1.3-.21l.603.302a.809.809 0 0 0 1.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 0 0 1.528-1.732l.146-.292M6.115 5.19A9 9 0 1 0 17.18 4.64M6.115 5.19A8.965 8.965 0 0 1 12 3c1.929 0 3.716.607 5.18 1.64" />
            </svg>

            <span class="hidden md:block">{!! $contact->address !!}</span>
        </div>
    </div>
    <div class="flex space-x-5 items-center">
        <a href="{{ $contact->link1 }}" class="hover:text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="size-4">
                <path
                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.988h-2.54v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33V21.878C18.343 21.128 22 16.991 22 12z" />
            </svg>
        </a>
        <a href="{{ $contact->link2 }}" class="hover:text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="size-4">
                <path
                    d="M18.9 2H22l-7.7 8.8L22.8 22h-6.4l-5-6.8L5.9 22H2l8.2-9.4L2.4 2h6.4l4.6 6.2L18.9 2zM17.6 20h1.8L7.1 4H5.3l12.3 16z" />
            </svg>
        </a>
        <a href="{{ $contact->link3 }}" class="hover:text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-4" viewBox="0 0 24 24">
                <path
                    d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8h4V24h-4V8zm7.5 0h3.8v2.1h.05c.53-.9 1.83-2.1 3.77-2.1 4.03 0 4.78 2.65 4.78 6.09V24h-4v-8.5c0-2.02-.03-4.63-2.82-4.63-2.82 0-3.25 2.2-3.25 4.47V24h-4V8z" />
            </svg>
        </a>
        <a href="{{ $contact->link4 }}" class="hover:text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-4" viewBox="0 0 24 24">
                <path
                    d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.5.5.2.9.5 1.3.9.4.4.7.8.9 1.3.2.4.4 1 .5 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.5 2.2-.2.5-.5.9-.9 1.3-.4.4-.8.7-1.3.9-.4.2-1 .4-2.2.5-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.5-.5-.2-.9-.5-1.3-.9-.4-.4-.7-.8-.9-1.3-.2-.4-.4-1-.5-2.2-.1-1.3-.1-1.7-.1-4.9s0-3.6.1-4.9c.1-1.2.3-1.8.5-2.2.2-.5.5-.9.9-1.3.4-.4.8-.7 1.3-.9.4-.2 1-.4 2.2-.5C8.4 2.2 8.8 2.2 12 2.2m0-2.2C8.7 0 8.3 0 7 .1 5.6.1 4.5.3 3.7.6 2.9 1 2.2 1.6 1.6 2.2.9 2.9.3 3.6 0 4.5.3 5.6.1 6.7.1 8.1.1 9.4 0 9.8 0 12c0 2.2.1 2.6.1 3.9 0 1.4.2 2.5.5 3.3.3.9.9 1.6 1.6 2.2.6.6 1.3 1.2 2.2 1.6.8.3 1.9.5 3.3.5 1.3 0 1.7.1 3.9.1 2.2 0 2.6-.1 3.9-.1 1.4 0 2.5-.2 3.3-.5.9-.3 1.6-.9 2.2-1.6.6-.6 1.2-1.3 1.6-2.2.3-.8.5-1.9.5-3.3 0-1.3.1-1.7.1-3.9 0-2.2-.1-2.6-.1-3.9 0-1.4-.2-2.5-.5-3.3-.3-.9-.9-1.6-1.6-2.2-.6-.6-1.3-1.2-2.2-1.6-.8-.3-1.9-.5-3.3-.5C15.7 0 15.3 0 12 0zM12 5.8a6.2 6.2 0 1 0 0 12.4 6.2 6.2 0 0 0 0-12.4zm0 10.2a4 4 0 1 1 0-8.1 4 4 0 0 1 0 8.1zm6.4-11.7a1.4 1.4 0 1 0 0 2.9 1.4 1.4 0 0 0 0-2.9z" />
            </svg>
        </a>
        <a href="{{ url('/quote') }}" class="inline-block 2xl:hidden bg-white text-red-700 px-4 py-2 rounded-md font-semibold hover:bg-gray-100">
            Get a Quote
        </a>
    </div>
</section>
