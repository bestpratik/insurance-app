<div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Policies Sold -->
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                            <!-- Document Duplicate Icon -->
                            <x-heroicon-o-document-duplicate class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-lg font-bold">{{ $this->policySold() }}</div>
                            <div class="text-sm text-gray-500">Policies Sold</div>
                        </div>
                    </div>
                </div>

                <!-- Premium Collected -->
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-100 text-green-600 p-3 rounded-full">
                            <!-- Banknotes Icon -->
                            <x-heroicon-o-banknotes class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-lg font-bold">£{{$this->paidPurchaseAmount}}</div>
                            <div class="text-sm text-gray-500">Premium Collected</div>
                        </div>
                    </div>
                </div>

                <!-- Pending Claims -->
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                            <!-- Exclamation Circle Icon -->
                            <x-heroicon-o-exclamation-circle class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-lg font-bold">{{$this->unPaidPurchase}}</div>
                            <div class="text-sm text-gray-500">Pending Claims</div>
                        </div>
                    </div>
                </div>

                <!-- Total Clients -->
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                            <!-- Users Icon -->
                            <x-heroicon-o-users class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-lg font-bold">{{$this->totalClient}}</div>
                            <div class="text-sm text-gray-500">Total Clients</div>
                        </div>
                    </div>
                </div>
            </div>
</div>
