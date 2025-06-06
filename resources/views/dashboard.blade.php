<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Welcome to Moneywise PLC</h2>

            <livewire:dashboard-component /> 

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