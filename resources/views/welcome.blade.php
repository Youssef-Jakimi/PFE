<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="YR HOTELS - Vivez une expérience de luxe inoubliable dans nos hôtels 5 étoiles présents dans le monde entier">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Laravel CSRF token -->
    <title>YR HOTELS - Luxe & Élégance</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Header -->
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
                <a href="#" class="active">Accueil</a>
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
                <a href="#" id="roomsLink">Chambres & Suites</a>
                <div id="roomsSubMenu" class="sub-menu">
                    <a href="{{ route('chambre') }}">Toutes nos chambres</a>
                    <a href="#">Suite Présidentielle</a>
                    <a href="#">Suite Royale</a>
                    <a href="#">Chambre Deluxe</a>
                </div>
            </div>
            <div class="services-dropdown">
                <a href="#" id="diningLink">Gastronomie</a>
                <div id="diningSubMenu" class="sub-menu">
                    <a href="{{ route('tabl') }}">Restaurants</a>
                    <a href="#">Lounge & Bar</a>
                    <a href="#">Service en chambre</a>
                </div>
            </div>
            <div class="services-dropdown">
                <a href="#" id="spaLink">Spa & Bien-être</a>
                <div id="spaSubMenu" class="sub-menu">
                    <a href="{{ route('spa') }}">Spa</a>
                    <a href="#">Massages</a>
                    <a href="#">Piscine & Jacuzzi</a>
                </div>
            </div>
            <a href="#">Destinations</a>
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
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
            <p><i class="fas fa-phone"></i> +212 614 87 95 17</p>
        </div>
    </nav>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Main Content -->
    <main class="main-content">
        <section class="hero">
            <div class="hero-slider">
                <div class="slide active">
                    <div class="overlay"></div>
                    <div class="hero-content"><br><br><br><br><br><br>
                        <h1>Luxe, Calme et Volupté</h1>
                        <p>Vivez une expérience inoubliable dans nos hôtels 5 étoiles</p>
                        <div class="hero-buttons">
                            <a href="{{ route('chambre') }}" class="btn btn-primary">Réserver</a>
                            <a href="{{ route('chambre') }}" class="btn btn-secondary">Découvrir nos services</a>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="overlay"></div>
                    <div class="hero-content"><br><br><br><br><br><br>
                        <h1>Une Gastronomie d'Exception</h1>
                        <p>Découvrez nos restaurants étoilés et leurs chefs renommés</p>
                        <div class="hero-buttons">
                            <a href="{{ route('tabl') }}" class="btn btn-primary">Nos restaurants</a>
                            <a href="{{ route('tabl') }}" class="btn btn-secondary">Réserver une table</a>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="overlay"></div>
                    <div class="hero-content">
                        <h1>Détente et Bien-être</h1><br><br><br><br><br><br>
                        <p>Nos spas vous offrent un moment de relaxation ultime</p>
                        <div class="hero-buttons">
                            <a href="{{ route('spa') }}" class="btn btn-primary">Découvrir le spa</a>
                            <a href="{{ route('spa') }}" class="btn btn-secondary">Réserver un soin</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-controls">
                <button class="prev-slide"><i class="fas fa-chevron-left"></i></button>
                <div class="slide-indicators">
                    <span class="indicator active"></span>
                    <span class="indicator"></span>
                    <span class="indicator"></span>
                </div>
                <button class="next-slide"><i class="fas fa-chevron-right"></i></button>
            </div>
        </section>

        <section class="booking-bar">
            <form class="booking-form" method="POST" action="{{ route('recherche') }}"> @csrf
                <div class="form-group">
                    <label for="destination">Destination</label>
                    <select id="destination">
                        <option value="">Choisir une destination</option>
                        <option value="Fes">Fes</option>
                        <option value="Marrakech">Marrakech</option>
                        <option value="Tanger">Tanger</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="checkin">Arrivée</label>
                    <input type="date" name="dateD" id="checkin" required>
                </div>
                <div class="form-group">
                    <label for="checkout">Départ</label>
                    <input type="date" name="dateF" id="checkout" required>
                </div>
                <div class="form-group">
                    <label for="guests">Voyageurs</label>
                    <div class="guests-select">
                        <select name="adulte" id="guests" required>
                            <option value="1">1 adulte</option>
                            <option value="2" selected>2 adultes</option>
                            <option value="3">3 adultes</option>
                            <option value="4">4 adultes</option>
                        </select>
                        <select name="enfant" id="children" >
                            <option value="0" selected>0 enfant</option>
                            <option value="1">1 enfant</option>
                            <option value="2">2 enfants</option>
                            <option value="3">3 enfants</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn-search">Vérifier la disponibilité</button>
            </form>
        </section>

        <section class="about">
            <div class="about-content">
                <div class="about-text">
                    <h2>L'expérience YR-HOTELS</h2>
                    <p class="subtitle">Un nouveau standard d'excellence</p>
                    <p>Depuis plus de 25 ans, YR-HOTELS redéfinit le luxe hôtelier à travers le monde. Notre collection d'hôtels 5 étoiles incarne l'élégance et le raffinement dans chaque détail, avec un service personnalisé qui anticipe vos moindres désirs.</p>
                    <p>Présents dans les destinations les plus prestigieuses, nos établissements allient une architecture exceptionnelle, un design intérieur signé par les plus grands noms, et une gastronomie étoilée qui vous feront vivre une expérience sensorielle unique.</p>
                    <a href="#" class="btn btn-outline">Notre histoire</a>
                </div>
                <div class="about-image">
                    <img src="{{ asset('images/int.jpeg') }}" alt="Intérieur luxueux de YR HOTELS">
                </div>
            </div>
        </section>

        <section id="services" class="services">
            <h2>Des Services d'Exception</h2>
            <p class="subtitle">Pour un séjour inoubliable</p>
            <div class="service-cards">
                <div class="card">
                    <div class="card-content">
                        <i class="fas fa-bed"></i>
                        <h3>Chambres & Suites</h3>
                        <p>Des espaces élégants et spacieux, conçus pour offrir un confort absolu et une tranquillité parfaite.</p>
                        <ul class="card-features">
                            <li><i class="fas fa-check"></i> Literie premium</li>
                            <li><i class="fas fa-check"></i> Vue panoramique</li>
                            <li><i class="fas fa-check"></i> Produits d'accueil luxueux</li>
                        </ul>
                        <a href="{{ route('chambre') }}" class="btn-card">Découvrir</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <i class="fas fa-utensils"></i>
                        <h3>Gastronomie</h3>
                        <p>Une expérience culinaire exceptionnelle orchestrée par nos chefs étoilés, mettant en valeur les produits locaux.</p>
                        <ul class="card-features">
                            <li><i class="fas fa-check"></i> Restaurants étoilés</li>
                            <li><i class="fas fa-check"></i> Cave à vins prestigieuse</li>
                            <li><i class="fas fa-check"></i> Service en chambre 24/7</li>
                        </ul>
                        <a href="{{ route('tabl') }}" class="btn-card">Découvrir</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <i class="fas fa-spa"></i>
                        <h3>Spa & Bien-être</h3>
                        <p>Un havre de paix où se ressourcer, avec des soins signature exclusifs et des installations haut de gamme.</p>
                        <ul class="card-features">
                            <li><i class="fas fa-check"></i> Massages personnalisés</li>
                            <li><i class="fas fa-check"></i> Piscine à débordement</li>
                            <li><i class="fas fa-check"></i> Sauna et hammam</li>
                        </ul>
                        <a href="{{ route('spa') }}" class="btn-card">Découvrir</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="destinations">
            <h2>Nos Destinations</h2>
            <p class="subtitle">Des adresses prestigieuses dans le monde entier</p>
            <div class="destination-gallery">
                <div class="destination-card">
                    <img src="{{ asset('images/Fes.jpeg') }}" alt="YR HOTELS Fes">
                    <div class="destination-overlay">
                        <h3>Fes</h3>
                        <p>Maroc</p>
                        <a href="#" class="btn-explore">Explorer</a>
                    </div>
                </div>
                <div class="destination-card">
                    <img src="{{ asset('images/Kech.jpeg') }}" alt="YR HOTELS Marrakech">
                    <div class="destination-overlay">
                        <h3>Marrakech</h3>
                        <p>Maroc</p>
                        <a href="#" class="btn-explore">Explorer</a>
                    </div>
                </div>
                <div class="destination-card">
                    <img src="{{ asset('images/Tanger.jpeg') }}" alt="YR HOTELS Tanger">
                    <div class="destination-overlay">
                        <h3>Tanger</h3>
                        <p>Maroc</p>
                        <a href="#" class="btn-explore">Explorer</a>
                    </div>
                </div>
            </div>
            <a href="#" class="btn-all-destinations">Toutes nos destinations</a>
        </section>

        <section class="testimonials">
            <h2>Ce que disent nos clients</h2>
            <div class="testimonial-slider">
                <div class="testimonial active">
                    <div class="quote">"Une expérience exceptionnelle. Le service était impeccable et la suite avec vue sur l'océan absolument magnifique."</div>
                    <div class="client">
                        <div class="client-info">
                            <h4>Sophia Benjelloun</h4>
                            <p>Fes, Maroc</p>
                        </div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="quote">"Le restaurant étoilé vaut à lui seul le détour. Une cuisine raffinée qui sublime les produits locaux avec créativité."</div>
                    <div class="client">
                        <div class="client-info">
                            <h4>Zakaria Hilali</h4>
                            <p>Rabat, Maroc</p>
                        </div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="quote">"Le spa est un véritable havre de paix. J'ai particulièrement apprécié le massage signature qui m'a procuré une détente absolue."</div>
                    <div class="client">
                        <div class="client-info">
                            <h4>Imen Bensouda</h4>
                            <p>Tanger, Maroc</p>
                        </div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-controls">
                <button class="prev-testimonial"><i class="fas fa-chevron-left"></i></button>
                <div class="testimonial-indicators">
                    <span class="indicator active"></span>
                    <span class="indicator"></span>
                    <span class="indicator"></span>
                </div>
                <button class="next-testimonial"><i class="fas fa-chevron-right"></i></button>
            </div>
        </section>

        <section class="newsletter">
            <div class="newsletter-content">
                <h2>Restez informé</h2>
                <p>Inscrivez-vous à notre newsletter pour recevoir nos offres exclusives et les dernières actualités de YR HOTELS.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Votre adresse email" required>
                    <button type="submit" class="btn-subscribe">S'inscrire</button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <img src="{{ asset('images/logo.png') }}" alt="YR HOTELS" class="footer-logo">
                <p>YR HOTELS incarne l'élégance et le luxe dans chacun de ses établissements à travers le monde, offrant une expérience unique alliant confort exceptionnel et service personnalisé.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Liens rapides</h3>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="{{ route('chambre') }}">Chambres & Suites</a></li>
                    <li><a href="{{ route('tabl') }}">Restaurants</a></li>
                    <li><a href="{{ route('spa') }}">Spa</a></li>
                    <li><a href="#">Destinations</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Nos services Inclus</h3>
                <ul>
                    <li><a href="#">Concierge privé</a></li>
                    <li><a href="#">Service en chambre 24/7</a></li>
                    <li><a href="#">Centre d'affaires</a></li>
                    <li><a href="#">Voiturier</a></li>
                    <li><a href="#">Transfert aéroport</a></li>
                    <li><a href="#">Évènements & Réceptions</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact</h3>
                <address>
                    <p><i class="fas fa-map-marker-alt"></i> 95 Av.Zerktouni,Fes Maroc</p>
                    <p><i class="fas fa-phone"></i> +212 614-879517</p>
                    <p><i class="fas fa-envelope"></i> contact@yr-hotels.com</p>
                </address>
                <a href="{{ route('contact') }}" class="btn-contact">Nous contacter</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 YR HOTELS. Tous droits réservés.</p>
            <div class="footer-links">
                <a href="#">Mentions légales</a>
                <a href="#">Politique de confidentialité</a>
                <a href="#">Conditions générales</a>
                <a href="#">Plan du site</a>
            </div>
        </div>
    </footer>

    <!-- Chat Bubble -->
    <div class="chat-bubble" id="chatBubble">
        <i class="fas fa-comments"></i>
    </div>

    <!-- Chat Modal -->
    <div class="chat-modal" id="chatModal">
        <div class="chat-modal-content">
            <div class="chat-modal-header">
                <h3>Chat avec RY-BOT</h3>
                <button id="closeChatBtn" class="close-chat-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="chat-container" id="chat-container">
                <div class="message assistant">
                    <strong>RY-BOT:</strong>
                    <p>Bonjour ! Je suis RY-BOT, votre compagnon pour explorer YR HOTELS. Comment puis-je vous aider aujourd’hui ?</p>
                </div>
            </div>
            <form id="chat-form" class="chat-form">
                <input type="text" id="user-input" placeholder="Posez votre question..." required>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const closeBtn = document.getElementById('closeBtn');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            closeBtn.addEventListener('click', function() {
                sidebar.classList.remove('active');
                document.body.style.overflow = 'auto';
            });

            const dropdownLinks = document.querySelectorAll('.services-dropdown > a');
            dropdownLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submenuId = this.id.replace('Link', 'SubMenu');
                    const submenu = document.getElementById(submenuId);
                    submenu.classList.toggle('active');
                });
            });

            // Hero Slider
            let currentSlide = 0;
            const slides = document.querySelectorAll('.hero-slider .slide');
            const indicators = document.querySelectorAll('.slide-indicators .indicator');
            const totalSlides = slides.length;

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                indicators.forEach(indicator => indicator.classList.remove('active'));
                slides[index].classList.add('active');
                indicators[index].classList.add('active');
                currentSlide = index;
            }

            document.querySelector('.prev-slide').addEventListener('click', function() {
                showSlide((currentSlide - 1 + totalSlides) % totalSlides);
            });

            document.querySelector('.next-slide').addEventListener('click', function() {
                showSlide((currentSlide + 1) % totalSlides);
            });

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', function() {
                    showSlide(index);
                });
            });

            setInterval(function() {
                showSlide((currentSlide + 1) % totalSlides);
            }, 5000);

            // Testimonial Slider
            let currentTestimonial = 0;
            const testimonials = document.querySelectorAll('.testimonial');
            const testimonialIndicators = document.querySelectorAll('.testimonial-indicators .indicator');
            const totalTestimonials = testimonials.length;

            function showTestimonial(index) {
                testimonials.forEach(testimonial => testimonial.classList.remove('active'));
                testimonialIndicators.forEach(indicator => indicator.classList.remove('active'));
                testimonials[index].classList.add('active');
                testimonialIndicators[index].classList.add('active');
                currentTestimonial = index;
            }

            document.querySelector('.prev-testimonial').addEventListener('click', function() {
                showTestimonial((currentTestimonial - 1 + totalTestimonials) % totalTestimonials);
            });

            document.querySelector('.next-testimonial').addEventListener('click', function() {
                showTestimonial((currentTestimonial + 1) % totalTestimonials);
            });

            testimonialIndicators.forEach((indicator, index) => {
                indicator.addEventListener('click', function() {
                    showTestimonial(index);
                });
            });

            // Chat Functionality
            const chatBubble = document.getElementById('chatBubble');
            const chatModal = document.getElementById('chatModal');
            const closeChatBtn = document.getElementById('closeChatBtn');
            const chatContainer = document.getElementById('chat-container');
            const chatForm = document.getElementById('chat-form');
            const userInput = document.getElementById('user-input');

            let chatHistory = JSON.parse(sessionStorage.getItem('chatHistory')) || [
                { role: 'assistant', content: 'Bonjour ! Je suis RY-BOT, votre compagnon pour explorer YR HOTELS. Comment puis-je vous aider aujourd’hui ?' }
            ];

            function renderChat() {
                chatContainer.innerHTML = '';
                chatHistory.forEach((message) => {
                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('message', message.role);
                    messageDiv.innerHTML = `<strong>${message.role === 'user' ? 'Vous' : 'RY-BOT'}:</strong><p>${message.content}</p>`;
                    chatContainer.appendChild(messageDiv);
                });
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }

            chatBubble.addEventListener('click', function() {
                chatModal.classList.add('active');
                renderChat();
            });

            closeChatBtn.addEventListener('click', function() {
                chatModal.classList.remove('active');
            });

            async function sendMessageToBackend(userMessage) {
                try {
                    const response = await fetch("{{ route('gpt.response') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ query: userMessage })
                    });

                    if (!response.ok) {
                        throw new Error('Échec de la requête à l’API');
                    }

                    return await response.json();
                } catch (error) {
                    console.error('Erreur:', error);
                    return { response: "Désolé, je n’ai pas pu traiter votre demande. Veuillez réessayer." };
                }
            }

            chatForm.addEventListener('submit', async function(event) {
                event.preventDefault();

                const userMessage = userInput.value.trim();
                if (!userMessage) return;

                chatHistory.push({ role: 'user', content: userMessage });
                sessionStorage.setItem('chatHistory', JSON.stringify(chatHistory));
                renderChat();

                userInput.value = '';

                const typingDiv = document.createElement('div');
                typingDiv.classList.add('message', 'assistant', 'typing');
                chatContainer.appendChild(typingDiv);
                chatContainer.scrollTop = chatContainer.scrollHeight;

                const data = await sendMessageToBackend(userMessage);

                typingDiv.remove();

                chatHistory.push({ role: 'assistant', content: data.response });
                sessionStorage.setItem('chatHistory', JSON.stringify(chatHistory));
                renderChat();
            });

            renderChat();
        });
    </script>
</body>
</html>
