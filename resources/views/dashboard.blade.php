<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Welcome to Moneywise PLC</h2>

            <!-- Dashboard Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Policies Sold -->
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                            <!-- Document Duplicate Icon -->
                            <x-heroicon-o-document-duplicate class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-lg font-bold">1,240</div>
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
                            <div class="text-lg font-bold">₦4.7M</div>
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
                            <div class="text-lg font-bold">38</div>
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
                            <div class="text-lg font-bold">890</div>
                            <div class="text-sm text-gray-500">Total Clients</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Welcome Box -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-10">
                <div class="flex flex-col  justify-start w-full p-6 bg-white rounded-lg border">
                    <div class="flex items-end justify-between w-full">
                        <!-- Left Side -->
                        <div>
                            <h2 class="text-xl font-bold">Purchased Insurances</h2>
                            <!-- <span class="text-sm font-semibold text-gray-500">2025</span> -->
                        </div>

                        <!-- Right Side (Legend) -->
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <span class="block w-4 h-4 bg-indigo-400"></span>
                                <span class="ml-1 text-xs font-medium">Temple</span>
                            </div>
                            <div class="flex items-center">
                                <span class="block w-4 h-4 bg-indigo-300"></span>
                                <span class="ml-1 text-xs font-medium">RSA</span>
                            </div>
                            <div class="flex items-center">
                                <span class="block w-4 h-4 bg-indigo-200"></span>
                                <span class="ml-1 text-xs font-medium">Others</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-end flex-grow w-full mt-2 space-x-2 sm:space-x-3">
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$37,500</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-6 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-16 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Jan</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$45,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-6 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-20 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Feb</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$47,500</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-20 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Mar</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$50,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-6 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-24 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Apr</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$47,500</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-20 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">May</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$55,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-24 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Jun</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$60,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-16 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-20 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Jul</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$57,500</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-24 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Aug</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$67,500</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-10 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-32 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Sep</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$65,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow bg-indigo-400 h-28"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Oct</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$70,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-40 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Nov</span>
                        </div>
                        <div class="relative flex flex-col items-center flex-grow pb-5 group">
                            <span class="absolute top-0 hidden -mt-6 text-xs font-bold group-hover:block">$75,000</span>
                            <div class="flex items-end w-full">
                                <div class="relative flex justify-center flex-grow h-12 bg-indigo-200"></div>
                                <div class="relative flex justify-center flex-grow h-8 bg-indigo-300"></div>
                                <div class="relative flex justify-center flex-grow h-40 bg-indigo-400"></div>
                            </div>
                            <span class="absolute bottom-0 text-xs font-bold">Dec</span>
                        </div>
                    </div>

                </div>

                <div class="flex flex-col w-full p-6 bg-white rounded-lg border">
                    <h2 class="text-xl font-bold text-start">Revenue </h2>
                    <!-- <span class="text-sm font-semibold text-gray-500">2025</span> -->
                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>

            <div class="overflow-x-auto mt-10" >
  <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
    <thead class="bg-gray-100 text-xs font-semibold text-gray-700 uppercase">
      <tr>
        <th class="px-4 py-2">Sl No</th>
        <th class="px-4 py-2">Policy No</th>
        <th class="px-4 py-2">Insurance</th>
        <th class="px-4 py-2">Property Address</th>
        <th class="px-4 py-2">Landlord/Agency</th>
        <th class="px-4 py-2">Landlord/Agency Address</th>
        <th class="px-4 py-2">Start Date</th>
        <th class="px-4 py-2">End Date</th>
        <th class="px-4 py-2">Days Left</th>
        <th class="px-4 py-2">Action</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
      <tr class="hover:bg-gray-50">
        <td class="px-4 py-2">4605</td>
        <td class="px-4 py-2 text-blue-600 font-medium">LERG-8107574569</td>
        <td class="px-4 py-2">Rent Guarantee Protection</td>
        <td class="px-4 py-2">59 Acacia Road Mitcham London CR4 1SF</td>
        <td class="px-4 py-2">
          Cromwood Housing LTD<br>
          <span class="text-gray-500 text-xs">rents@cromwood.co.uk</span>
        </td>
        <td class="px-4 py-2">16E Urban Hive, Theydon Road E5 9BQ</td>
        <td class="px-4 py-2">31st May 2024</td>
        <td class="px-4 py-2">31st May 2025</td>
        <td class="px-4 py-2">0 days</td>
        <td class="px-4 py-2 space-x-2">
          <span class="text-red-500 font-semibold">Renewed</span>
          <button class="bg-gray-800 text-white text-xs px-3 py-1 rounded hover:bg-gray-700">View</button>
        </td>
      </tr>
      <!-- Repeat <tr> for other rows -->
      <!-- Example Renew Policy row -->
      <tr class="hover:bg-gray-50">
        <td class="px-4 py-2">4635</td>
        <td class="px-4 py-2 text-blue-600 font-medium">RSA-6353387690</td>
        <td class="px-4 py-2">Landlord Protection Insurance<br><span class="text-xs text-gray-600">(Rent Guarantee & Legal Assistance)</span></td>
        <td class="px-4 py-2">Flat 3 Canadian Court 15 Canadian Avenue Catford London SE6 3AU</td>
        <td class="px-4 py-2">
          ADS Homes Property & Mortgage Solutions Ltd<br>
          <span class="text-gray-500 text-xs">alvin@adshomes.co.uk</span>
        </td>
        <td class="px-4 py-2">20 Wenlock Road London N1 7GU</td>
        <td class="px-4 py-2">31st May 2024</td>
        <td class="px-4 py-2">31st May 2025</td>
        <td class="px-4 py-2">0 days</td>
        <td class="px-4 py-2 space-x-2">
          <button class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded">Renew Policy</button>
          <button class="bg-gray-800 text-white text-xs px-3 py-1 rounded hover:bg-gray-700">View</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

        </div>
    </div>
    <!-- Required chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
const xValues = ["Pending", "Paid", "Success", "Failed"];
const yValues = [30, 80, 120, 10]; // Example: number of accounts by status
const barColors = [
  "#f6c23e", // Pending - yellow
  "#1cc88a", // Paid - green
  "#36b9cc", // Success - blue
  "#e74a3b"  // Failed - red
];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  }
});
</script>
</x-app-layout>