<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Chambres</title>
    <link rel="stylesheet" href="{{ asset('css/chambre.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Réservation de Chambres</h1>
            <p>Découvrez nos chambres luxueuses et profitez d'un séjour inoubliable</p>
        </header>

        <div class="rooms-grid">
            <!-- Chambre 1 -->
            <div class="chambre">
                <div class="chambre-image">
                    <img src="{{ asset('images/ch1.jpg') }}" alt="Vue de la Chambre Standard">
                    <div class="price-tag">699 DH/nuit</div>
                </div>
                <div class="chambre-content">
                    <h2>Chambre Standard</h2>
                    <p class="chambre-description">
                        Une chambre confortable avec lit double, salle de bain privée et vue sur le jardin.
                        Parfaite pour un séjour reposant en solo ou en couple.
                    </p>
                    <div class="amenities">
                        <div class="amenity">
                            <i class="fas fa-wifi"></i>
                            <span>WiFi gratuit</span>
                        </div>
                        <div class="amenity">
                            <i class="fas fa-parking"></i>
                            <span>Parking</span>
                        </div>
                        <div class="amenity">
                            <i class="fa-solid fa-shower"></i>
                            <span>Salle de bain</span>
                        </div>
                    </div>
                    <button class="btn" onclick="openBooking(1, 'Chambre Standard', 699)">
                        Réserver maintenant
                    </button>
                </div>
            </div>

            <!-- Chambre 2 -->
            <div class="chambre">
                <div class="chambre-image">
                    <img src="{{ asset('images/ch2.jpg') }}" alt="Vue de la Chambre Deluxe">
                    <div class="price-tag">1499 DH/nuit</div>
                </div>
                <div class="chambre-content">
                    <h2>Chambre Deluxe</h2>
                    <p class="chambre-description">
                        Une chambre spacieuse avec lit king-size, salle de bain luxueuse et vue imprenable sur la mer.
                        Profitez d'équipements haut de gamme pour un confort optimal.
                    </p>
                    <div class="amenities">
                        <div class="amenity">
                            <i class="fas fa-wifi"></i>
                            <span>WiFi premium</span>
                        </div>
                        <div class="amenity">
                            <i class="fa-solid fa-tv"></i>
                            <span>TV HD</span>
                        </div>
                        <div class="amenity">
                            <i class="fas fa-paw"></i>
                            <span>Pet friendly</span>
                        </div>
                        <div class="amenity">
                            <i class="fas fa-utensils"></i>
                            <span>Room service</span>
                        </div>
                    </div>
                    <button class="btn" onclick="openBooking(2, 'Chambre Deluxe', 1499)">
                        Réserver maintenant
                    </button>
                </div>
            </div>

            <!-- Suite Présidentielle -->
            <div class="chambre">
                <div class="chambre-image">
                    <img src="{{ asset('images/ch3.jpg') }}" alt="Vue de la Suite Présidentielle">
                    <div class="price-tag">2699 DH/nuit</div>
                </div>
                <div class="chambre-content">
                    <h2>Suite Présidentielle</h2>
                    <p class="chambre-description">
                        Notre suite la plus prestigieuse avec vue panoramique, jacuzzi privé et accès exclusif à la plage privée.
                        Services VIP et conciergerie 24/7 pour une expérience inoubliable.
                    </p>
                    <div class="amenities">
                        <div class="amenity">
                            <i class="fas fa-coffee"></i>
                            <span>Petit déjeuner</span>
                        </div>
                        <div class="amenity">
                            <i class="fas fa-concierge-bell"></i>
                            <span>Conciergerie</span>
                        </div>
                        <div class="amenity">
                            <i class="fas fa-umbrella-beach"></i>
                            <span>Plage privée</span>
                        </div>
                        <div class="amenity">
                            <i class="fa-solid fa-spa"></i>
                            <span>Spa privé</span>
                        </div>
                    </div>
                    <button class="btn" onclick="openBooking(3, 'Suite Présidentielle', 2699)">
                        Réserver maintenant
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de réservation -->
    <div class="modal" id="bookingModal">
        <div class="modal-content">
            <h2 id="modalTitle" style="margin-bottom: 1.5rem;">Réservation</h2>
            <form id="bookingForm" action="{{ route('chambrePanier') }}" method="post">
                @csrf
                <input type="hidden" name="produit" id="chambreId">
                <input type="hidden" id="chambrePrice">

                <div class="form-group">
                    <label for="dateD">Date d'arrivée</label>
                    <input type="date" class="form-control" id="dateD" name="dateD" required>
                </div>

                <div class="form-group">
                    <label for="dateF">Date de départ</label>
                    <input type="date" class="form-control" id="dateF" name="dateF" required>
                </div>

                <div class="form-group">
                    <label>Durée du séjour</label>
                    <p id="stayDuration">-</p>
                </div>

                <div class="form-group">
                    <label>Prix total</label>
                    <p id="totalPrice">-</p>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn">Confirmer</button>
                    <button type="button" class="btn btn-secondary" onclick="closeBooking()">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialiser la date minimum à aujourd'hui
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('dateD').min = today;
            document.getElementById('dateF').min = today;

            // Gestionnaire d'événements pour les dates
            document.getElementById('dateD').addEventListener('change', updateDates);
            document.getElementById('dateF').addEventListener('change', updateDates);
        });
        let currentPrice = 0;
        function openBooking(id, name, price) {
            currentPrice = price;
            document.getElementById('chambreId').value = id;
            document.getElementById('chambrePrice').value = price;
            document.getElementById('modalTitle').textContent = `Réserver ${name}`;
            document.getElementById('bookingModal').classList.add('active');
            document.getElementById('bookingForm').reset();
            updateDates();
        }
        function closeBooking() {
            document.getElementById('bookingModal').classList.remove('active');
        }
    </script>
</body>
</html>
