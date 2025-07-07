<x-app-layout>
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible max-w-4xl mx-auto">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
    @endif
    <div
        class="bg-white border rounded-lg col-span-2 mt-4 p-8 flex flex-wrap align-center justify-between max-w-4xl mx-auto">
        <h2 class="font-semibold text-xl text-gray-800 m-0">
            Edit Contact Information
        </h2>
        <form class="bg-white w-full space-y-4" method="post" action="{{ route('update.contact', $contact->id) }}">
            @csrf
            @method('PUT')

            <!-- Address -->
            <div>
                <label class="block">
                    <span class="text-gray-700">Address</span>
                    <input name="address" type="text" class="w-full mt-1 p-2 border rounded"
                        value="{{ old('address', $contact->address) }}" placeholder="Enter Address">
                </label>
            </div>

            <!-- Phone -->
            <div>
                <label class="block">
                    <span class="text-gray-700">Phone Number</span>
                    <input name="phone" type="text" class="w-full mt-1 p-2 border rounded"
                        value="{{ old('phone', $contact->phone) }}" placeholder="Enter Phone Number">
                </label>
            </div>

            <!-- Email -->
            <div>
                <label class="block">
                    <span class="text-gray-700">Email</span>
                    <input name="email" type="email" class="w-full mt-1 p-2 border rounded"
                        value="{{ old('email', $contact->email) }}" placeholder="Enter Email">
                </label>
            </div>

            <!-- Extra Links -->
            @for ($i = 1; $i <= 4; $i++)
                <div>
                    <label class="block">
                        <span class="text-gray-700">Extra Link {{ $i }}</span>
                        <input name="link{{ $i }}" type="url" class="w-full mt-1 p-2 border rounded"
                            placeholder="https://example.com" value="{{ old('link' . $i, $contact->{'link' . $i}) }}">
                    </label>
                </div>
            @endfor

            <button type="submit" class="w-full mt-4 p-2 bg-blue-600 text-white rounded">Update Contact</button>
        </form>
    </div>
</x-app-layout>
