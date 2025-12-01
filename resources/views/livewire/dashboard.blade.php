<div>
    <livewire:components.header />

    <livewire:components.sidebar />

    <!-- Main Content -->
    <main id="main-content" class="pt-24 pl-64 smooth-transition min-h-screen">
        <div class="p-6">
            <!-- Dashboard Page -->
            <div id="dashboard-page" class="page active">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl 
                    shadow-sm border border-gray-100 dark:border-gray-700 
                    smooth-transition card-hover">
                        <div class="flex flex-col space-y-4">
                            <h3 class="text-gray-500 dark:text-gray-400 
                            font-semibold text-lg">Total Visitor</h3>
                            <p class="text-4xl font-bold text-blue-600 
                            dark:text-blue-400">{{ $totalVisitors }}</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl 
                    shadow-sm border border-gray-100 dark:border-gray-700 
                    smooth-transition card-hover">
                        <div class="flex flex-col space-y-4">
                            <h3 class="text-gray-500 dark:text-gray-400 
                            font-semibold text-lg">Total User</h3>
                            <p class="text-4xl font-bold text-blue-600 
                            dark:text-blue-400">{{ $totalUsers }}</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl 
                    shadow-sm border border-gray-100 dark:border-gray-700 
                    smooth-transition card-hover">
                        <div class="flex flex-col space-y-4">
                            <h3 class="text-gray-500 dark:text-gray-400 
                            font-semibold text-lg">Total Product</h3>
                            <p class="text-4xl font-bold text-blue-600 
                            dark:text-blue-400">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-8">
                    <!-- Visitor Statistics -->
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl 
                    shadow-sm border border-gray-100 dark:border-gray-700 smooth-transition">
                        <div class="flex flex-col space-y-6">
                            <h3 class="text-2xl font-bold dark:text-white">
                                All Statistics
                            </h3>
                            <div class="w-full h-80">
                                <canvas id="visitorChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other pages would follow the same pattern with proper spacing -->
        </div>
    </main>

    <script>
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 
        'September', 'October', 'November', 'December'];

        const visitorData = @json($visitors);
        const userData = @json($users);
        const productData = @json($products);

        const visitorCtx = document.getElementById('visitorChart').getContext('2d');
        new Chart(visitorCtx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Visitors',
                        data: visitorData,
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#2563eb',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    },
                    {
                        label: 'Users',
                        data: userData,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    },
                    {
                        label: 'Products',
                        data: productData,
                        borderColor: '#fbbf24',
                        backgroundColor: 'rgba(251, 191, 36, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#fbbf24',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            stepSize: 200,
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>
</div>