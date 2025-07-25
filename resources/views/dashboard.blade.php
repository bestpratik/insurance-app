<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Welcome to Moneywise PLC</h2>

           <!-- Dashboard Stats Cards -->
            <livewire:dashboard-card-component /> 


            <!-- Welcome Box -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-10">
                <div class="flex flex-col  justify-start w-full p-6 bg-white rounded-lg border">
                    <h2 class="text-xl font-bold text-start">Sales Overview</h2>
                    <canvas id="insurancebarChart"></canvas>

                </div>

                <div class="flex flex-col w-full p-6 bg-white rounded-lg border">
                    <h2 class="text-xl font-bold text-start">Revenue Distribution</h2> 
                    <canvas id="revenuePieChart"></canvas>
                </div>
            </div>

           
            <livewire:dashboard-component /> 

        </div>
    </div>

  
    <!-- Required chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> 

    <script>
        var ctx = document.getElementById('insurancebarChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    label: 'Total Sale',
                    data: @json($data['data']['total_sale']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },{
                    label: 'Pending Amount',
                    data: @json($data['data']['pending_amount']),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Paid Amount',
                    data: @json($data['data']['paid_amount']),
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    borderColor: 'rgba(255, 205, 86, 1)',
                    borderWidth: 1
                }
            ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        //max: 400,
                        stepSize: 50
                    }
                }
            }
        });

        var pieCtx = document.getElementById('revenuePieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Total Sales', 'Pending Amount', 'Paid Amount'],
                datasets: [{
                    data: [
                        @json(array_sum($data['data']['total_sale'])),
                        @json(array_sum($data['data']['pending_amount'])),
                        @json(array_sum($data['data']['paid_amount']))
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 205, 86, 0.7)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += '£' + context.raw.toLocaleString();
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script>
        Livewire.on('swal:success', data => {
            Swal.fire({
                title: 'Payment information updated successfully!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>