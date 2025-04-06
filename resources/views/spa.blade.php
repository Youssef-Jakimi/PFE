<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Spa & Tarifs</title>
    <link rel="stylesheet" href="{{ asset('css/spa.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
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

    <div class="scontainer">
        <h1>Réservez votre Expérience Spa</h1>
        <h2>Nos Services</h2>

        <div class="section-scontainer">
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
                <a href="/" class="btn">Réserver</a>
            </div>
            @endforeach
        </div>

        <h2>Nos Packs</h2>
        <div class="section-scontainer">
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
                <a href="/" class="btn">Réserver</a>
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
    </div>
</body>
</html>
