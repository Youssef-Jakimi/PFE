<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
             class="bg-gradient-to-b from-purple-800 to-purple-600 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out z-10">

            <div class="flex items-center space-x-4 px-4">
                <div class="font-extrabold text-2xl">AdminPanel</div>
            </div>

            <nav class="mt-10">
                <a href="/admin/dashboard" class="block py-2.5 px-4 rounded transition duration-200 bg-purple-700 text-white hover:bg-purple-500">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="/admin/reservations" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-purple-700">
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

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-md flex justify-between items-center py-4 px-6">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none md:hidden">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="ml-4 text-lg text-gray-700 font-medium">Dashboard</div>
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
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                            <i class="fas fa-calendar-alt text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Réservations</div>
                            <div class="text-2xl font-bold">{{ $reservations }}</div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-green-100 text-green-500">
                            <i class="fas fa-box text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Produits</div>
                            <div class="text-2xl font-bold">{{ $produits }}</div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Utilisateurs</div>
                            <div class="text-2xl font-bold">{{ $utilisateurs }}</div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-file-invoice-dollar text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Factures</div>
                            <div class="text-2xl font-bold">{{ number_format($factures, 2, ',', ' ') }} €</div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Réservations Mensuelles</h2>
                        <div class="h-80">
                            <canvas id="reservationsChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Produits par Catégorie</h2>
                        <div class="h-80">
                            <canvas id="produitsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Reservations Table -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Dernières Réservations</h2>
                        <a href="#" class="text-blue-500 hover:text-blue-700 text-sm">Voir tout</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">ID</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Client</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Date</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($dernieresReservations as $reservation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">#{{ $reservation->id }}</td>
                                    <td class="px-4 py-3">{{ $reservation->nom }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($reservation->Date)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex space-x-2">
                                            <a href="/admin/reservations" class="text-blue-500 hover:text-blue-700"><i class="fas fa-eye"></i></a>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Réservations Mensuelles Chart
        const reservationsCtx = document.getElementById('reservationsChart').getContext('2d');
        const reservationsChart = new Chart(reservationsCtx, {
            type: 'line',
            data: {
                labels: [
                    @foreach ($reservationsMensuelles as $data)
                        '{{ \Carbon\Carbon::create()->month($data->mois)->format("F") }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Réservations',
                    data: [
                        @foreach ($reservationsMensuelles as $data)
                            {{ $data->total }},
                        @endforeach
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
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Produits par Catégorie Chart
        const produitsCtx = document.getElementById('produitsChart').getContext('2d');
        const produitsChart = new Chart(produitsCtx, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach ($produitsParCategorie as $categorie)
                        '{{ $categorie->nom }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach ($produitsParCategorie as $categorie)
                            {{ $categorie->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(79, 70, 229, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(56, 189, 248, 0.8)',
                        'rgba(217, 70, 239, 0.8)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '65%'
            }
        });
    });
    </script>
</body>
</html>
