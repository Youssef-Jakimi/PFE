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