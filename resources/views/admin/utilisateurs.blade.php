<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs - Admin Panel</title>
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
                <a href="/admin/reservations" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-purple-700">
                    <i class="fas fa-calendar-alt mr-2"></i>Réservations
                </a>
                <a href="/admin/products" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-purple-700">
                    <i class="fas fa-box mr-2"></i>Produits
                </a>
                <a href="/admin/utilisateurs" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-purple-700 bg-purple-700">
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
                    <div class="ml-4 text-lg text-gray-700 font-medium">Utilisateurs</div>
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
                <!-- Chart for Users Registered -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Utilisateurs Enregistrés</h2>
                    <div class="h-80">
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>

                <!-- User Registration Form -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Ajouter un Utilisateur</h2>
                    <form action="{{ route('admin.utilisateur.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" id="nom" name="nom" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label for="CIN" class="block text-sm font-medium text-gray-700">Identifiant (CIN)</label>
                                <input type="text" id="CIN" name="CIN" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                                <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label for="telephone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                                <input type="tel" id="telephone" name="telephone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="admin" class="block text-sm font-medium text-gray-700">Admin</label>
                                <input type="checkbox" id="admin" name="admin" class="mt-1">
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-500">Ajouter</button>
                        </div>
                    </form>
                </div>

                <!-- User List -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Liste des Utilisateurs</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left text-sm font-medium">ID</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium">Nom</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium">CIN</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium">Email</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium">Téléphone</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium">Role</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($utilisateurs as $utilisateur)
                                    <tr>
                                        <td class="px-4 py-3">{{ $utilisateur->id }}</td>
                                        <td class="px-4 py-3">{{ $utilisateur->nom }}</td>
                                        <td class="px-4 py-3">{{ $utilisateur->CIN }}</td>
                                        <td class="px-4 py-3">{{ $utilisateur->email }}</td>
                                        <td class="px-4 py-3">{{ $utilisateur->telephone }}</td>
                                        <td class="px-4 py-3">{{ $utilisateur->ADMIN ? 'Admin' : 'Utilisateur' }}</td>
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
            // Users Registered Chart
            const usersCtx = document.getElementById('usersChart').getContext('2d');
            new Chart(usersCtx, {
                type: 'line',
                data: {
                    labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    datasets: [{
                        label: 'Utilisateurs Enregistrés',
                        data: [
                            @foreach ($usersByMonth as $month => $count)
                                {{ $count }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(79, 70, 229, 0.2)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
</body>
</html>
