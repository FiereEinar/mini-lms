<x-app-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            Dashboard
        </h1>
    </div>

    <div class="max-w-7xl space-y-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Total Books -->
            <div class="bg-white shadow rounded-lg p-5 flex flex-col justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Books</p>
                    <p class="mt-2 text-2xl font-bold text-gray-800">{{ $totalBooks }}</p>
                </div>
            </div>

            <!-- Available Books -->
            <div class="bg-white shadow rounded-lg p-5 flex flex-col justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Available Books</p>
                    <p class="mt-2 text-2xl font-bold text-gray-800">{{ $availableBooks }}</p>
                </div>
            </div>

            <!-- Active Borrows -->
            <div class="bg-white shadow rounded-lg p-5 flex flex-col justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Active Borrows</p>
                    <p class="mt-2 text-2xl font-bold text-gray-800">{{ $activeBorrows }}</p>
                </div>
            </div>

            <!-- Overdue Borrows -->
            <div class="bg-white shadow rounded-lg p-5 flex flex-col justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Overdue Borrows</p>
                    <p class="mt-2 text-2xl font-bold text-red-600">{{ $overdueBorrows }}</p>
                </div>
            </div>

        </div>

        <!-- Total Fines -->
        <div class="bg-white shadow rounded-lg p-5">
            <p class="text-sm font-medium text-gray-500">Total Fines Collected</p>
            <p class="mt-2 text-2xl font-bold text-gray-800">₱{{ number_format($totalFines, 2) }}</p>
        </div>

    </div>

    <div class="bg-white shadow rounded-lg p-6 mt-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Borrows Trend (Last 7 Days)</h2>

        <canvas id="borrowsChart" class="w-full h-64"></canvas>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('borrowsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dates->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))),
                datasets: [{
                    label: 'Borrows',
                    data: @json($borrowsTrendFull),
                    backgroundColor: 'rgba(99, 102, 241, 0.2)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(99, 102, 241, 1)',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>