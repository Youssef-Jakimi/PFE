<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Table</title>
    <link rel="stylesheet" href="{{ asset('css/tabl.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>
<body>
    <header class="desktop-nav">
        <div class="top-bar">
            <div class="languages">
                <a href="#" class="active">FR</a>
                <a href="#">EN</a>
            </div>
            <div class="contact-info">
                <a href="tel:+212 614-879517"><i class="fas fa-phone"></i> +212 614 87 95 17</a>
                <a href="tel:+212 718-041286"><i class="fas fa-phone"></i> +212 718 04 12 86</a>
                <a href="mailto:contact@yr-hotels.com"><i class="fas fa-envelope"></i> contact@yr-hotels.com</a>
            </div>
        </div>
        <nav class="main-nav">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="YR HOTELS">
            </div>
            <div class="nav-links">
                <a href="/" class="active">Accueil</a>
                <div class="nav-dropdown">
                    <a href="{{ route('chambre') }}">Chambres & Suites</a>
                    <div class="dropdown-content">
                        <a href="#">Suite Présidentielle</a>
                        <a href="#">Suite Royale</a>
                        <a href="#">Chambre Deluxe</a>
                        <a href="#">Chambre Standard</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <a href="{{ route('tabl') }}">Gastronomie</a>
                    <div class="dropdown-content">
                        <a href="{{ route('menu') }}">Restaurant Étoilé</a>
                        <a href="{{ route('menu') }}">Lounge & Bar</a>
                        <a href="{{ route('menu') }}">Service en chambre</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <a href="{{ route('spa') }}">Spa & Bien-être</a>
                    <div class="dropdown-content">
                        <a href="{{ route('spa') }}">Massages</a>
                        <a href="{{ route('spa') }}">Soins du corps</a>
                        <a href="{{ route('spa') }}">Piscine & Jacuzzi</a>
                    </div>
                </div>
                <a href="#">Destinations</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
            <div class="nav-actions">
                @if (Auth::check())
                    @if (Auth::user()->ADMIN == TRUE)
                    <a href="{{ route('disconnect') }}" class="btn-login">Logout</a>
                    <a href="{{ route('admin.dashboard') }}" class="btn-book">Admin</a>
                    @else
                    <a href="{{ route('disconnect') }}" class="btn-login">Logout</a>
                    <a href="{{ route('panier') }}" class="cart-icon"><i class="fas fa-shopping-cart"></i></a>
                    <a href="{{ route('index.connect') }}" class="btn-book">Réserver</a>
                    @endif
                @else
                    <a href="{{ route('index.connect') }}" class="btn-login">Se connecter</a>
                    <a href="{{ route('panier') }}" class="cart-icon"><i class="fas fa-shopping-cart"></i></a>
                    <a href="{{ route('index.connect') }}" class="btn-book">Réserver</a>
                @endif
            </div>
        </nav>
    </header>
    <div class="container">
        <h1>Réservation de Table</h1>



        {{-- //affiche les tables dynamiquement  
        <div class="tables-items">
            @foreach($tables as $table)
                <div class="cart-item">
                    <div>
                        <div class="item-detail"><span>Produit:</span> {{ $table->PR_CODE }}</div>
                        <div class="item-detail"><span>Capacité :</span> {{ $table->PR_PERSONNE }} personne</div>
                        <div class="item-detail"><span>PRIX :</span> {{ $table->PR_PRIX }} MAD</div>
                    </div>
                    
                </div>
            @endforeach
        </div>
--}}



        <!-- Table 1 -->
        <div class="table">
            <img src="{{ asset('images/t1.jpg') }}" alt="Table rendez-vous">
            <div class="table-info">
                <h2>Table rendez-vous</h2>
                <p>Table cosy pour deux avec vue sur la mer.</p>
                <p class="capacity">Capacité : 2 personnes</p>
                <button class="btn" onclick="openForm(1)">Réserver</button>
            </div>
        </div>

        <!-- Table 2 -->
        <div class="table">
            <img src="{{ asset('images/t2.jpg') }}" alt="Table Familiale">
            <div class="table-info">
                <h2>Table Familiale</h2>
                <p>Parfait pour les repas en famille.</p>
                <p class="capacity">Capacité : 4-8 personnes</p>
                <button class="btn" onclick="openForm(2)">Réserver</button>
            </div>
        </div>

        <!-- Table 3 -->
        <div class="table">
            <img src="{{ asset('images/t3.jpg') }}" alt="Table VIP">
            <div class="table-info">
                <h2>Table VIP</h2>
                <p>Privée avec service premium.</p>
                <p class="capacity">Capacité : 4 personnes</p>
                <button class="btn" onclick="openForm(3)">Réserver</button>
            </div>
        </div>

        <a href="{{ route('menu') }}" class="menu-btn">Voir le Menu</a>
    </div>

    <!-- Formulaire de réservation -->
    <div class="overlay" id="overlay"></div>
    <div class="form-popup" id="reservationForm">
        <form action="{{ route('tablePanier') }}" method="post">
            @csrf
            <input type="number" name="produit" id="produit" hidden>
            <input type="number" name="tableSPAProduit" value="4" hidden>
            <input type="date" class="date" name="date" id="date" required>
            <button type="submit" class="btn">Confirmer</button>
            <button type="button" class="btn" onclick="closeForm()">Annuler</button>
        </form>
    </div>

    <script>
        function openForm(tableId) {
            document.getElementById('produit').value = tableId;
            document.getElementById('reservationForm').classList.add('active');
            document.getElementById('overlay').classList.add('active');
        }

        function closeForm() {
            document.getElementById('reservationForm').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        }

        document.getElementById('date').addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (selectedDate < today) {
                alert('Veuillez sélectionner une date valide (non passée).');
                this.value = '';
            }
        });
    </script>
</body>
</html>
