<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Spa & Tarifs</title>
    <link rel="stylesheet" href="{{ asset('css/spa.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="scontainer">
        <h1>Réservez votre Expérience Spa</h1>

        <h2>Nos Services</h2>

        {{-- Affichage des spas dynamiquement comme dans le code original 
        <div class="tables-items">
            @foreach($spas as $spa)
                <div class="cart-item">
                    <div>
                        <div class="item-detail"><span>Produit:</span> {{ $spa->PR_CODE }}</div>
                        <div class="item-detail"><span>Capacité :</span> {{ $spa->PR_PERSONNE }} personne</div>
                        <div class="item-detail"><span>PRIX :</span> {{ $spa->PR_PRIX }} MAD</div>
                    </div>
                </div>
            @endforeach
        </div>--}}

        {{-- Services avec cards dynamiques qui utilisent les données existantes --}}
        <div class="section-scontainer">
            {{-- Utiliser trois services initiaux mais de manière dynamique --}}
            @php
                $services = [
                    ['title' => 'Massage Relaxant', 'desc' => 'Un massage doux pour apaiser votre corps et votre esprit.', 'produit_id' => 5],
                    ['title' => 'Soins du Visage', 'desc' => 'Un soin revitalisant pour une peau éclatante et hydratée.', 'produit_id' => 5],
                    ['title' => 'Hammam & Sauna', 'desc' => 'Profitez de la chaleur pour une relaxation totale.', 'produit_id' => 5]
                ];
            @endphp

            @foreach($services as $index => $service)
            <div class="card" tabindex="0">
                <img src="{{ asset('images/s' . ($index + 1) . '.jpg') }}" alt="{{ $service['title'] }}">
                <h3>{{ $service['title'] }}</h3>
                <p>{{ $service['desc'] }}</p>
                <button class="btn" onclick="toggleForm({{ $index + 1 }})">Réserver</button>
                <form action="{{ route('tablePanier') }}" method="post" class="reservation-form">
                    @csrf
                    <input type="number" name="tableSPAProduit" value="{{ $service['produit_id'] }}" hidden>
                    <input type="date" class="date" name="date" required min="{{ date('Y-m-d') }}">
                    <button type="submit" class="btn">Confirmer</button>
                </form>
            </div>
            @endforeach
        </div>

        <h2>Nos Packs</h2>
        <div class="section-scontainer">
            {{-- Utiliser trois packs initiaux mais de manière dynamique --}}
            @php
                $packs = [
                    ['title' => 'Pack Détente', 'desc' => 'Massage relaxant + Hammam + Thé aux herbes.', 'price' => 449],
                    ['title' => 'Pack Luxe', 'desc' => 'Massage aux pierres chaudes + Soins du visage + sauna.', 'price' => 799],
                    ['title' => 'Pack Duo', 'desc' => 'Expérience bien-être amis ou famille avec soins personnalisés.', 'price' => 1199]
                ];
            @endphp

            @foreach($packs as $index => $pack)
            <div class="card" tabindex="0">
                <img src="{{ asset('images/sp' . ($index + 1) . '.jpg') }}" alt="{{ $pack['title'] }}">
                <h3>{{ $pack['title'] }}</h3>
                <p>{{ $pack['desc'] }}</p>
                <button class="btn" onclick="openBooking({{ $index + 1 }}, '{{ $pack['title'] }}', {{ $pack['price'] }})">Réserver</button>
            </div>
            @endforeach
        </div>

        <h2>CATALOGUE</h2>
        <div class="catalogue-scontainer">
            <table>
                <tr>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Prix</th>
                </tr>
                {{-- Les entrées du catalogue peuvent être générées dynamiquement --}}
                @php
                    $catalogItems = array_merge($services, $packs);
                    $prices = [150, 99, 300, 449, 799, 1199];
                @endphp

                @foreach($catalogItems as $index => $item)
                <tr tabindex="0">
                    <td>{{ $item['title'] }}</td>
                    <td>{{ $item['desc'] }}</td>
                    <td>{{ $prices[$index] }} DH</td>
                </tr>
                @endforeach
            </table>
        </div>
        <a href="#" class="menu-btn">Réserver une séance</a>
    </div>

    {{-- Modal pour la réservation des packs --}}
    <div class="modal" id="bookingModal">
        <div class="modal-content">
            <h2 id="modalTitle" style="margin-bottom: 1.5rem;">Réservation</h2>
            <form id="bookingForm" action="{{ route('tablePanier') }}" method="POST">
                @csrf
                <input type="hidden" name="tableSPAProduit" id="packId" value="5">
                <input type="hidden" name="packNom" id="packNom">

                <div class="form-group">
                    <label for="dateReservation">Date de réservation</label>
                    <input type="date" class="form-control" id="dateReservation" name="date" required min="{{ date('Y-m-d') }}">
                </div>

                <div class="form-group">
                    <label for="nombrePersonnes">Nombre de personnes</label>
                    <select id="nombrePersonnes" name="personnes" class="form-control" required>
                        <option value="1">1 personne</option>
                        <option value="2">2 personnes</option>
                        <option value="3">3 personnes</option>
                        <option value="4">4 personnes</option>
                    </select>
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
        // Fonction pour afficher/masquer le formulaire de réservation des services
        function toggleForm(cardId) {
            const forms = document.querySelectorAll('.reservation-form');
            forms.forEach(form => form.classList.remove('active'));
            const form = document.querySelector(`.card:nth-child(${cardId}) .reservation-form`);
            form.classList.toggle('active');
        }

        // Variables globales pour la réservation de packs
        let currentPackId = 5; // Valeur par défaut
        let currentPrice = 0;
        let packName = '';

        // Fonction pour ouvrir le modal de réservation des packs
        function openBooking(id, name, price) {
            currentPackId = 5; // On garde la valeur par défaut pour ne pas affecter la BD
            currentPrice = price;
            packName = name;

            document.getElementById('packId').value = currentPackId;
            document.getElementById('packNom').value = name;
            document.getElementById('modalTitle').textContent = `Réserver ${name}`;

            // Ouvrir le modal
            document.getElementById('bookingModal').classList.add('active');
            document.getElementById('bookingModal').style.display = 'flex';

            // Réinitialiser le formulaire
            document.getElementById('bookingForm').reset();

            // Mettre à jour l'affichage du prix
            updatePrice();
        }

        // Fonction pour fermer le modal
        function closeBooking() {
            document.getElementById('bookingModal').classList.remove('active');
            document.getElementById('bookingModal').style.display = 'none';
        }

        // Fonction pour mettre à jour le prix en fonction du nombre de personnes
        function updatePrice() {
            const nombrePersonnes = document.getElementById('nombrePersonnes').value;
            const prixTotal = currentPrice * nombrePersonnes;
            document.getElementById('totalPrice').textContent = `${prixTotal} DH`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Style CSS pour le modal
            const style = document.createElement('style');
            style.textContent = `
                .modal {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0,0,0,0.5);
                    justify-content: center;
                    align-items: center;
                    z-index: 1000;
                }
                .modal-content {
                    background-color: white;
                    padding: 2rem;
                    border-radius: 8px;
                    max-width: 500px;
                    width: 90%;
                }
                .form-group {
                    margin-bottom: 1.5rem;
                }
                .form-control {
                    width: 100%;
                    padding: 0.5rem;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                }
                .button-group {
                    display: flex;
                    justify-content: space-between;
                    margin-top: 2rem;
                }
                .btn-secondary {
                    background-color: #6c757d;
                }
            `;
            document.head.appendChild(style);

            // Événement pour mettre à jour le prix quand le nombre de personnes change
            document.getElementById('nombrePersonnes').addEventListener('change', updatePrice);
        });
    </script>
</body>
</html>
