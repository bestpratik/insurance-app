<nav id="_dm-customWizardSteps" class="flex justify-center space-x-1 md:space-x-2 mt-3 mb-3 border-b ">
                    <!-- Active tab -->
                    <a href="{{ route('insurances.edit', $insurance->id) }}"
                        class=" flex items-center text-center px-4 py-2 font-medium transition-all duration-300 {{ request()->routeIs('insurances.edit') ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-600' }}">
                        <x-heroicon-o-identification class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">General Details</span>
                    </a>

                    <!-- Inactive tabs -->
                    <a href="{{ route('insurance.pricing', $insurance->id) }}"
                        class=" flex items-center text-center px-4 py-2 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300 {{ request()->routeIs('insurance.pricing') ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-600' }}">
                        <x-heroicon-o-currency-dollar class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Pricing</span>
                    </a>
                    <a href="{{ route('insurance.static.document', $insurance->id) }}"
                        class=" flex items-center text-center px-4 py-2 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300 {{ request()->routeIs('insurance.static.document') ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-600' }}">
                        <x-heroicon-o-document class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Static Documents</span>
                    </a>
                    <a href="{{ route('insurance.dynamic.document', $insurance->id) }}"
                        class=" flex items-center text-center px-4 py-2 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300 {{ request()->routeIs('insurance.dynamic.document') ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-600' }}">
                        <x-heroicon-o-document-text class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Dynamic Documents</span>
                    </a>
                    <a href="{{ route('insurance.email.template', $insurance->id) }}"
                        class="flex items-center text-center px-4 py-2  hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300 {{ request()->routeIs('insurance.email.template') ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-600' }}">
                        <x-heroicon-o-envelope class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Email Template</span>
                    </a>
                    <a href="{{ route('insurance.summary', $insurance->id) }}"
                        class="flex items-center text-center px-4 py-2 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition-all duration-300 {{ request()->routeIs('insurance.summary') ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-600' }}">
                        <x-heroicon-o-chart-bar class="h-6 w-6 me-2" />
                        <span class="text-sm hidden md:inline">Summary</span>
                    </a>
                </nav>