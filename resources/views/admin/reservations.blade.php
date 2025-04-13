<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>
<body class="bg-gray-100" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
             class="bg-gradient-to-b from-purple-800 to-purple-600 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out z-10">

            <div class="flex items-center space-x-4 px-4">
                <div class="font-extrabold text-2xl">YR-HOTELS</div>
            </div>

            <nav class="mt-10">
                <a href="/admin/dashboard" class="block py-2.5 px-4 rounded transition duration-200 text-white hover:bg-purple-500">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="/admin/reservations" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-purple-700 bg-purple-700">
                    <i class="fas fa-calendar-alt mr-2"></i>Réservations
                </a>
                <a href="/admin/products" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-purple-700">
                    <i class="fas fa-box mr-2"></i>Produits
                </a>
                <a href="/admin/utilisateurs" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-purple-700">
                    <i class="fas fa-users mr-2"></i>Utilisateurs
                </a>
            </nav>
        </div>

        <!-- Mobile Sidebar Toggle Button -->
        <button @click="sidebarOpen = !sidebarOpen" class="sidebar-toggle md:hidden fixed top-5 left-5 bg-purple-600 text-white p-3 rounded-md shadow-lg">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-md flex justify-between items-center py-4 px-6">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none md:hidden">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="ml-4 text-lg text-gray-700 font-medium">Réservations</div>
                </div>
                <div class="flex items-center space-x-4">
                    <div x-data="{ isOpen: false }" class="relative">
                        <button @click="isOpen = !isOpen" class="flex items-center space-x-2 text-gray-700 focus:outline-none">
                            <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <span>Administrateur, {{ Auth::user()->nom }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            <a href="{{ route('disconnect') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
                <!-- Chart for Reservations per Month -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Réservations Mensuelles</h2>
                    <div class="h-80">
                        <canvas id="reservationsPerMonthChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Période avec le Plus de Réservations</h2>
                    <div class="h-80">
                        <canvas id="reservationsByPeriodChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Liste des Réservations</h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">ID</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Client</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Produit</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Période</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Prix Total</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($reservations as $reservation)
                                <tr class="hover:bg-gray-50" id="reservation-{{ $reservation->id }}">
                                    <td class="px-4 py-3">#{{ $reservation->id }}</td>
                                    <td class="px-4 py-3">{{ $reservation->nom }}</td>
                                    <td class="px-4 py-3">{{ $reservation->PR_CODE }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($reservation->Date_D)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($reservation->Date_F)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">{{ number_format($reservation->prix_total, 2, ',', ' ') }} MAD</td>
                                    <td class="px-4 py-3">
                                        <!-- Button to toggle details -->
                                        <button onclick="toggleDetails({{ $reservation->id }})" class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-chevron-down" id="toggle-icon-{{ $reservation->id }}"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Hidden details row that shows on click -->
                                <tr id="details-row-{{ $reservation->id }}" style="display: none;">
                                    <td colspan="6" class="bg-gray-50">
                                        <div class="p-4">
                                            <h3 class="font-semibold text-gray-700 mb-2">Détails de la Réservation</h3>
                                            <div class="overflow-x-auto">
                                                <table class="w-full table-auto border-collapse">
                                                    <thead>
                                                        <tr class="bg-gray-200">
                                                            <th class="px-4 py-2 text-left text-sm font-medium">Produit</th>
                                                            <th class="px-4 py-2 text-left text-sm font-medium">Période</th>
                                                            <th class="px-4 py-2 text-left text-sm font-medium">Prix Unitaire</th>
                                                            <th class="px-4 py-2 text-left text-sm font-medium">Prix Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($reservation->products as $product)
                                                        <tr class="border-b">
                                                            <td class="px-4 py-3">{{ $product->PR_CODE }}</td>
                                                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($product->Date_D)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($product->Date_F)->format('d/m/Y') }}</td>
                                                            <td class="px-4 py-3">{{ number_format($product->PR_PRIX, 2, ',', ' ') }} MAD</td>
                                                            <td class="px-4 py-3">{{ number_format($product->total_price, 2, ',', ' ') }} MAD</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Toggle the details visibility for each reservation
        function toggleDetails(reservationId) {
            var detailsRow = document.getElementById('details-row-' + reservationId);
            var toggleIcon = document.getElementById('toggle-icon-' + reservationId);

            // Toggle visibility
            if (detailsRow.style.display === "none" || detailsRow.style.display === "") {
                detailsRow.style.display = "table-row";
                toggleIcon.classList.replace('fa-chevron-down', 'fa-chevron-up');
            } else {
                detailsRow.style.display = "none";
                toggleIcon.classList.replace('fa-chevron-up', 'fa-chevron-down');
            }
        }

        // Initialize the charts
        document.addEventListener('DOMContentLoaded', function() {
            // Réservations Mensuelles Chart
            const reservationsCtx = document.getElementById('reservationsPerMonthChart').getContext('2d');
            new Chart(reservationsCtx, {
                type: 'line',
                data: {
                    labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    datasets: [{
                        label: 'Réservations',
                        data: [
                            @for ($i = 1; $i <= 12; $i++)
                                {{ $reservationsMensuelles->where('mois', $i)->first()->total ?? 0 }},
                            @endfor
                        ],
                        backgroundColor: 'rgba(79, 70, 229, 0.2)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointBackgroundColor: 'rgba(79, 70, 229, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { drawBorder: false } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Second Chart: Period with Most Reservations
            const reservationsByPeriodCtx = document.getElementById('reservationsByPeriodChart').getContext('2d');
            new Chart(reservationsByPeriodCtx, {
                type: 'bar',
                data: {
                    labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    datasets: [{
                        label: 'Réservations',
                        data: [
                            @for ($i = 1; $i <= 12; $i++)
                                {{ $reservationsPerMonthPeriod->where('month', $i)->first()->total ?? 0 }},
                            @endfor
                        ],
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, grid: { drawBorder: false } }, x: { grid: { display: false } } }
                }
            });
        });
    </script>
</body>
</html>
