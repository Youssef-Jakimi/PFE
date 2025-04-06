<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="YR HOTELS - Vivez une expérience de luxe inoubliable dans nos hôtels 5 étoiles présents dans le monde entier">
        <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Laravel CSRF token -->
        <title>YR HOTELS - Luxe & Élégance</title>
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/facture.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    </head>
<body>
    <header class="desktop-nav">
        <div class="top-bar">
            <div class="languages">
                <a class="active">FR</a>
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
                        <a href="/chambre">Suite Présidentielle</a>
                        <a href="/chambre">Suite Royale</a>
                        <a href="/chambre">Chambre Deluxe</a>
                        <a href="/chambre">Chambre Standard</a>
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

    <!-- Mobile Sidebar Toggle -->
    <button id="sidebarToggle" class="sidebar-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Mobile Sidebar -->
    <nav id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo.png') }}" alt="YR HOTELS">
            <button id="closeBtn" class="close-btn"><i class="fas fa-times"></i></button>
        </div>
        <div class="nav-links">
            <a href="#" class="active">Accueil</a>
            <div class="services-dropdown">
                <a href="/chambre" id="roomsLink">Chambres & Suites</a>
                <div id="roomsSubMenu" class="sub-menu">
                    <a href="{{ route('chambre') }}">Toutes nos chambres</a>
                    <a href="/chambre">Suite Présidentielle</a>
                    <a href="/chambre">Suite Royale</a>
                    <a href="/chambre">Chambre Deluxe</a>
                </div>
            </div>
            <div class="services-dropdown">
                <a href="/tabl" id="diningLink">Gastronomie</a>
                <div id="diningSubMenu" class="sub-menu">
                    <a href="{{ route('tabl') }}">Restaurants</a>
                    <a href="/tabl">Lounge & Bar</a>
                    <a href="/tabl">Service en chambre</a>
                </div>
            </div>
            <div class="services-dropdown">
                <a href="/spa" id="spaLink">Spa & Bien-être</a>
                <div id="spaSubMenu" class="sub-menu">
                    <a href="{{ route('spa') }}">Spa</a>
                    <a href="/spa">Massages</a>
                    <a href="/spa">Piscine & Jacuzzi</a>
                </div>
            </div>
            <a href="{{ route('index.connect') }}" class="btn-login">Se connecter</a>

            <a href="{{ route('contact') }}">Contact</a>
            @if (Auth::check())
                <a href="{{ route('disconnect') }}" class="btn-login">Logout</a>
                <a href="{{ route('panier') }}" class="cart-icon"><i class="fas fa-shopping-cart"></i></a>
                <a href="{{ route('index.connect') }}" class="btn-book">Réserver</a>
            @endif
        </div>
        <div class="sidebar-footer">
            <div class="social-icons">
                <a href="/"><i class="fab fa-facebook-f"></i></a>
                <a href="/"><i class="fab fa-instagram"></i></a>
                <a href="/"><i class="fab fa-twitter"></i></a>
            </div>
            <p><i class="fas fa-phone"></i> +212 614 87 95 17</p>
        </div>
    </nav>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="facture-container">
        <div class="invoice-header">
            <div class="company-info">

                <h4 style="color: var(--primary-color); margin-top: 10px;">YR-HOTELS</h4>
                <p>contact@yr-hotels.com</p>
            </div>
            <div class="invoice-info">
                <h5 style="color: var(--secondary-color);">Facture #INV-{{ date('Ymd') }}</h5>
                <p>Date: {{ date('d/m/Y') }}</p>
                <p>Status: <span style="color: var(--primary-color); font-weight: 600;">Payée</span></p>
            </div>
        </div>

        <h1>Facture de Réservation</h1>

        <div class="table-responsive">
            <table class="facture-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Réservation</th>
                        <th>Produit</th>
                        <th>Prix Total</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        @if($detail->categorie == 'Chambre')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><input type="text" value="{{ $detail->reservation_id }}" readonly></td>
                                <td><input type="text" value="{{ $detail->categorie }}" readonly></td>
                                <td><input type="text" value="{{ number_format($detail->Prix_Total, 2, ',', ' ') }} MAD" readonly></td>
                                <td><input type="text" value="{{ date('d/m/Y', strtotime($detail->Date_D)) }}" readonly></td>
                                <td><input type="text" value="{{ date('d/m/Y', strtotime($detail->Date_F)) }}" readonly></td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><input type="text" value="{{ $detail->reservation_id }}" readonly></td>
                                <td><input type="text" value="{{ $detail->categorie }}" readonly></td>
                                <td><input type="text" value="{{ number_format($detail->Prix_Total, 2, ',', ' ') }} MAD" readonly></td>
                                <td><input type="text" value="{{ date('d/m/Y', strtotime($detail->Date_D)) }}" readonly></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="text-align: right; margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
            <p style="font-size: 1.1rem;"><strong>Montant Total:</strong>
                <span style="color: var(--primary-color); font-weight: 600; font-size: 1.2rem;">
                    {{ number_format($details->sum('Prix_Total'), 2, ',', ' ') }} MAD
                </span>
            </p>
        </div>

        <button class="btn-print" onclick="window.print()">
            <i class="fas fa-print"></i> Imprimer la Facture
        </button>

        <div class="footer">
            <p>Merci pour votre confiance! Pour toute question concernant cette facture, veuillez nous contacter.</p>
            <p>&copy; {{ date('Y') }} YR-HOTELS - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>
