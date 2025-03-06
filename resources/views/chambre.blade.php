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
            @foreach($chambres as $chambre)
            <div class="chambre">
                <div class="chambre-image">
                    <img src="{{ asset('images/ch' . $loop->iteration . '.jpg') }}" alt="Vue de la Chambre">
                    <div class="price-tag">{{ $chambre->PR_PRIX }} MAD/nuit</div>
                </div>
                <div class="chambre-content">
                    <h2>Chambre {{ $chambre->PR_CODE }}</h2>
                    <p class="chambre-description">
                        Une chambre confortable pouvant accueillir {{ $chambre->PR_PERSONNE }} personne(s).
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
                    <button class="btn" onclick="openBooking({{ $chambre->id }}, '{{ $chambre->PR_CODE }}', {{ $chambre->PR_PRIX }})">
                        Réserver maintenant
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="modal" id="bookingModal">
        <div class="modal-content">
            <h2 id="modalTitle" style="margin-bottom: 1.5rem;">Réservation</h2>
            <form id="bookingForm" action="{{ route('chambrePanier') }}" method="POST">
                @csrf
                <input type="hidden" name="produit_id" id="chambreId">
                <input type="hidden" name="Prix_Total" id="prixTotal">
                <input type="hidden" name="code_chambre" id="codeChambre">
                <input type="hidden" name="duree" id="dureeInput">

                <div class="form-group">
                    <label for="dateD">Date d'arrivée</label>
                    <input type="date" class="form-control" id="dateD" name="Date_D" required>
                </div>

                <div class="form-group">
                    <label for="dateF">Date de départ</label>
                    <input type="date" class="form-control" id="dateF" name="Date_F" required>
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
                    <button type="submit" class="btn" id="submitButton">Confirmer</button>
                    <button type="button" class="btn btn-secondary" onclick="closeBooking()">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Variable globale pour stocker l'ID de la chambre
        let chambreIdGlobal = null;
        let currentPrice = 0;
        let chambreName = '';

        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('dateD').min = today;
            document.getElementById('dateF').min = today;

            document.getElementById('dateD').addEventListener('change', updateDates);
            document.getElementById('dateF').addEventListener('change', updateDates);

            // Ajouter un gestionnaire d'événements pour le formulaire
            document.getElementById('bookingForm').addEventListener('submit', function(event) {
                // Vérifier que l'ID de la chambre est défini
                if (!chambreIdGlobal) {
                    event.preventDefault();
                    alert('Erreur: ID de chambre non défini. Veuillez réessayer.');
                    return false;
                }

                // S'assurer que le produit_id est correctement défini
                document.getElementById('chambreId').value = chambreIdGlobal;

                // S'assurer que le prix total est défini
                const totalPrice = document.getElementById('totalPrice').textContent;
                if (totalPrice === "-") {
                    event.preventDefault();
                    alert('Veuillez sélectionner des dates valides.');
                    return false;
                }

                const prixNumerique = parseFloat(totalPrice.replace(' MAD', ''));
                document.getElementById('prixTotal').value = prixNumerique;

                // S'assurer que la durée est définie
                const dureeTexte = document.getElementById('stayDuration').textContent;
                if (dureeTexte === "-" || dureeTexte.includes("doit être après")) {
                    event.preventDefault();
                    alert('Veuillez sélectionner des dates valides.');
                    return false;
                }

                const dureeNumerique = parseInt(dureeTexte.replace(' jour(s)', ''));
                document.getElementById('dureeInput').value = dureeNumerique;

                // Débogage - afficher les valeurs
                console.log("Soumission du formulaire:");
                console.log("produit_id:", document.getElementById('chambreId').value);
                console.log("Prix_Total:", document.getElementById('prixTotal').value);
                console.log("Date_D:", document.getElementById('dateD').value);
                console.log("Date_F:", document.getElementById('dateF').value);
            });
        });

        function openBooking(id, name, price) {
            // Stocker l'ID de chambre dans la variable globale
            chambreIdGlobal = id;
            currentPrice = price;
            chambreName = name;

            // Assurer que l'ID est un nombre
            if (typeof id !== 'number') {
                id = parseInt(id, 10);
                if (isNaN(id)) {
                    console.error("ID de chambre invalide:", id);
                    alert("Erreur: ID de chambre invalide");
                    return;
                }
            }

            // Définir explicitement les valeurs
            document.getElementById('chambreId').value = id;
            document.getElementById('codeChambre').value = name;
            document.getElementById('modalTitle').textContent = `Réserver Chambre ${name}`;

            // Ouvrir le modal
            document.getElementById('bookingModal').classList.add('active');

            // Réinitialiser le formulaire
            document.getElementById('bookingForm').reset();

            // Réinitialiser les champs cachés après reset
            document.getElementById('chambreId').value = id;
            document.getElementById('codeChambre').value = name;

            // Mettre à jour l'affichage
            updateDates();

            // Vérification dans la console
            console.log("openBooking appelé avec:", id, name, price);
            console.log("chambreId actuel:", document.getElementById('chambreId').value);
        }

        function closeBooking() {
            document.getElementById('bookingModal').classList.remove('active');
        }

        function updateDates() {
            const dateD = document.getElementById('dateD').value;
            const dateF = document.getElementById('dateF').value;

            if (dateD && dateF) {
                const startDate = new Date(dateD);
                const endDate = new Date(dateF);

                if (endDate >= startDate) {
                    const diffTime = Math.abs(endDate - startDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    document.getElementById('stayDuration').textContent = `${diffDays} jour(s)`;
                    document.getElementById('totalPrice').textContent = `${diffDays * currentPrice} MAD`;
                    document.getElementById('prixTotal').value = diffDays * currentPrice;
                    document.getElementById('dureeInput').value = diffDays;
                } else {
                    document.getElementById('stayDuration').textContent = "La date de départ doit être après la date d'arrivée";
                    document.getElementById('totalPrice').textContent = "-";
                }
            } else {
                document.getElementById('stayDuration').textContent = "-";
                document.getElementById('totalPrice').textContent = "-";
            }
        }
    </script>
</body>
</html>
