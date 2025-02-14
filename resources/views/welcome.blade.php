<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YR HOTELS - Accueil</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="YR HOTELS">
        </div>
        <h2>YR HOTELS</h2>
        <nav>
            <div class="slidein section">
                <a href="#"><span data-hover="Accueil">Accueil</span></a>
                <a href="auth"><span data-hover="Se connecter">Se connecter</span></a>
                <a href="#services"><span data-hover="Services">Services</span></a>
                <a href="{{ route('contact') }}"><span data-hover="Contact">Contact</span></a>
            </div>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2>Vivez une expérience inoubliable</h2>
            <p>Réservez votre séjour dans un hôtel 5 étoiles avec un service exceptionnel.</p>
            <a href="auth" class="btn">Réserver maintenant</a>
        </div>
    </section>

    <section class="about">
        <h2>À propos de nous</h2>
        <p>YR-HOTELS est une série d'hôtels dans différents pays qui offre des services luxueux, des chambres spacieuses, ainsi que des services de restauration et de spa.</p>
    </section>

    <section id="services" class="services">
        <h2>Nos Services</h2>
        <div class="service-cards">
            <div class="card">
                <i class="fas fa-spa"></i>
                <h3>Spa & Bien-être</h3>
                <p>Profitez de nos services de spa pour une relaxation totale.</p>
                <a href="{{ route('spa') }}" style="color: #e67e22" class="en-savoir-plus">En savoir plus >></a>
            </div>
            <div class="card">
                <i class="fas fa-utensils"></i>
                <h3>Restauration</h3>
                <p>Dégustez des plats exotiques préparés par notre selections de chefs étoilés.</p>
                <a href="{{ route('tabl') }}" style="color: #e67e22" class="en-savoir-plus">En savoir plus >></a>
            </div>
            <div class="card">
                    <i class="fas fa-concierge-bell"></i>
                    <h3>Service Chambre</h3>
                    <p>Un service de chambre 24/7 pour votre confort et joie.</p>
                    <a href="{{ route('chambre') }}" style="color: #e67e22" class="en-savoir-plus">En savoir plus >></a>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 YR HOTELS. Tous droits réservés.</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>
</body>
</html>
