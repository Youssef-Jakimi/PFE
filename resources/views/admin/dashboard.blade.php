<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - YR HOTELS</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <h1>Dashboard Admin</h1>

        <div class="statistics">
            <p>Nombre total de réservations : {{ $reservationsCount }}</p>
            <p>Nombre total d'utilisateurs : {{ $usersCount }}</p>
        </div>

        <div class="charts">
            <!-- Graphique des réservations par mois -->
            <canvas id="reservationsChart"></canvas>
        </div>
    </div>

    <script>
        // Données du graphique des réservations par mois
        var reservationsByMonth = @json($reservationsByMonth);

        // Données pour l'affichage du graphique
        var months = reservationsByMonth.map(item => item.month);
        var counts = reservationsByMonth.map(item => item.count);

        // Création du graphique
        var ctx = document.getElementById('reservationsChart').getContext('2d');
        var reservationsChart = new Chart(ctx, {
            type: 'line', // Type de graphique (vous pouvez changer ce type)
            data: {
                labels: months, // Mois
                datasets: [{
                    label: 'Réservations',
                    data: counts, // Compte des réservations
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw + ' réservations';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Mois'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Nombre de réservations'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
