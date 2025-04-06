<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produits - AdminPanel</title>
            <!-- TailwindCSS -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        
            <!-- FontAwesome for icons -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        
            <!-- jQuery (required for FullCalendar) -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
            <!-- Moment.js (required for FullCalendar) -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        
            <!-- FullCalendar CSS -->
            <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet">
        
            <!-- FullCalendar JS -->
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
        
            <!-- AlpineJS (optional, for interactive features) -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js" defer></script>
        
            <script>
                // This ensures jQuery and FullCalendar are properly loaded before using them
                $(document).ready(function() {
                    console.log('FullCalendar and jQuery are loaded');
                });
            </script>
        
        
            


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
                <a href="/admin/dashboard" class="block py-2.5 px-4 rounded transition duration-200  text-white hover:bg-purple-500">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="/admin/reservations" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-purple-700">
                    <i class="fas fa-calendar-alt mr-2"></i>Réservations
                </a>
                <a href="/admin/products" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-purple-700 bg-purple-700 ">
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
                    <div class="ml-4 text-lg text-gray-700 font-medium">Produits</div>
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
                <!-- Chart for Products per Category -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Produits par Catégorie</h2>
                    <div class="h-80">
                        <canvas id="produitsChart"></canvas>
                    </div>
                </div>

                <!-- Add Product Form -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Ajouter un Produit</h2>
                    <form action="{{ route('admin.products.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="product_code" class="block text-sm font-medium text-gray-700">Code du Produit (PR_CODE)</label>
                                <input type="text" id="product_code" name="product_code" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Prix (€)</label>
                                <input type="number" id="price" name="price" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                                <select id="category" name="category" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Nombre de Personnes</label>
                                <input type="number" id="capacity" name="capacity" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            </div>

                            <button type="submit" class="mt-4 w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">Ajouter Produit</button>
                        </div>
                    </form>
                </div>

                <!-- Product List Table -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Liste des Produits</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Nom</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Prix (€)</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Catégorie</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Capacité</th>
                                    <th class="px-4 py-2 text-left text-gray-600 text-sm font-medium">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-2 py-2 text-sm">{{ $product->PR_CODE }}</td>
                                    <td class="px-2 py-2 text-sm">{{ number_format($product->PR_PRIX, 2, ',', ' ') }} €</td>
                                    <td class="px-2 py-2 text-sm">{{ $product->category_name }}</td>
                                    <td class="px-2 py-2 text-sm">{{ $product->PR_PERSONNE }}</td>
                                    <td class="px-4 py-3">
                                        <!-- Display Reservations Button -->
                                        <button class="text-blue-500 hover:text-blue-700" onclick="toggleReservations({{ $product->id }})">
                                            <i class="fas fa-calendar-alt"></i> Voir Réservations
                                        </button>
                                    
                                        <form action="{{ route('deleteproductadmin') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <button class="text-sm text-red-500">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                    
                                    <!-- Display Reservation Details in Calendar -->
                                    <tr id="reservations-row-{{ $product->id }}" class="bg-gray-100 hidden">
                                        <td colspan="6" class="p-4">
                                            <div id="product-reservations-{{ $product->id }}">
                                                <!-- Calendar Container -->
                                                <div id="calendar-{{ $product->id }}" class="w-90 h-150 mx-auto"></div>
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
        

        function showReservations(productId) {
    const row = document.getElementById('reservations-row-' + productId);
    const reservationsDiv = document.getElementById('product-reservations-' + productId);

    if (row.style.display === "table-row") {
        row.style.display = "none";
    } else {
        row.style.display = "table-row";
        fetchReservations(productId, reservationsDiv);
    }
}

function fetchReservations(productId, reservationsDiv) {
    fetch(`/admin/products/${productId}/reservations`)
        .then(response => response.json())
        .then(data => {
            reservationsDiv.innerHTML = '';
            if (data.length > 0) {
                let listHtml = '<ul>';
                data.forEach(reservation => {
                    listHtml += `<li>Du ${reservation.Date_D} au ${reservation.Date_F}</li>`;
                });
                listHtml += '</ul>';
                reservationsDiv.innerHTML = listHtml;
            } else {
                reservationsDiv.innerHTML = '<p>Aucune réservation trouvée pour ce produit.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching reservations:', error);
            reservationsDiv.innerHTML = '<p>Erreur lors de la récupération des réservations.</p>';
        });
}




//////////////////////////
function toggleReservations(productId) {
    const row = document.getElementById('reservations-row-' + productId);
    const calendarDiv = document.getElementById('calendar-' + productId);

    // If the row is visible, hide it
    if (row.style.display === "table-row") {
        row.style.display = "none";
    } else {
        // Otherwise, show the row and initialize the calendar
        row.style.display = "table-row";
        
        // Initialize FullCalendar only when needed
        if (!calendarDiv.classList.contains('initialized')) {
            initializeCalendar(productId);
            calendarDiv.classList.add('initialized');
        }
    }
}

function initializeCalendar(productId) {
    const reservations = @json($reservations);  // Pass the reservations data from PHP to JS

    // Filter the reservations for this product
    const productReservations = reservations[productId] || [];

    // Create an array of events for FullCalendar
    const events = productReservations.map(reservation => {
        // Format the dates in the correct format (YYYY-MM-DD)
        const startDate = formatDate(reservation.Date_D);
        const endDate = formatDate(reservation.Date_F);

        return {
            title: 'Réservation',
            start: startDate,  // Reservation start date
            end: endDate,      // Reservation end date
            allDay: true
        };
    });

    // Initialize FullCalendar
    $('#calendar-' + productId).fullCalendar({
        events: events,
        header: {
            left: 'prev,next today',      // Navigation buttons
            center: 'title',             // Display title (month/year)
        },
        eventRender: function(event, element) {
            element.css({
                'background-color': '#4F46E5', // Event color
                'color': '#fff',                // Event text color
                'border': 'none',               // Remove border
                'border-radius': '5px'          // Rounded corners for events
            });
        },
        views: {
            month: { buttonText: 'Month' },
        },
        events: events,  // Provide events to FullCalendar
        eventClick: function(event) {
            alert("You clicked on " + event.title + " from " + event.start.format('YYYY-MM-DD') + " to " + event.end.format('YYYY-MM-DD'));
        }
    });
}

// Function to format date to YYYY-MM-DD (ISO format)
function formatDate(dateString) {
    if (!dateString) return null;
    const date = new Date(dateString);
    return date.toISOString().split('T')[0];  // Returns 'YYYY-MM-DD'
}

/////////////////////////////
        document.addEventListener('DOMContentLoaded', function() {
    // Chart for Products by Category
    const produitsCtx = document.getElementById('produitsChart').getContext('2d');
    new Chart(produitsCtx, {
        type: 'doughnut',
        data: {
            labels: [
                @foreach ($productCategories as $category)
                    '{{ $category->nom }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach ($productCategories as $category)
                        {{ $category->total }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
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
