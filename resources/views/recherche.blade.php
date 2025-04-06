<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="YR HOTELS - Vivez une expérience de luxe inoubliable dans nos hôtels 5 étoiles présents dans le monde entier">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>YR HOTELS - Luxe & Élégance</title>
    <link rel="stylesheet" href="{{ asset('css/recherche.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Include Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Custom Styles */
        .filter-price input[type="range"] {
            width: 100%;
            margin-top: 0.5rem;
            accent-color: #b8860b; /* Theme-friendly color */
        }

        .results-container {
            display: flex;
            justify-content: space-between;
            gap: 2rem;
            margin-top: 2rem;
            padding-bottom: 2rem;
        }

        .result-cards {
            flex: 1;
        }

        .card {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .card-image {
            flex: 0 0 150px;
            height: 150px;
            overflow: hidden;
            margin-right: 20px;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            flex: 1;
        }

        .card-content h3 {
            margin-bottom: 10px;
        }

        .btn-card {
            background-color: #b8860b;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
            margin-left: auto;
        }

        .btn-card:hover {
            background-color: #d4af37;
        }

    </style>
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
    <br><br><br>
    <section class="booking-bar">
        <form class="booking-form" method="POST" action="{{ route('recherche') }}"> 
            @csrf
            
            <!-- Removed Destination Field -->
            
            <div class="form-group">
                <label for="dates">Arrivée et Départ</label>
                <input type="hidden" name="dateD" id="checkin" required>
                <input type="hidden" name="dateF" id="checkout" required>
                <input type="hidden" id="stayDurationInput" name="stayDuration" required>
                <input type="text" name="dates" id="dates" placeholder="Choisir vos dates" required>
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
                    <select name="enfant" id="children">
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
    
    


    <main class="main-content">
        <section class="booking-results">
            <div class="results-container">
                
                <!-- Filter Sidebar -->
                <div class="filter-sidebar">
                    <h3>Filtres</h3>
                    <div class="filter-category">
                        <h4>Catégorie</h4>
                        <select id="categoryFilter">
                            <option value="">Toutes les catégories</option>
                            <option value="1">Chambres</option>
                            <option value="2">Restaurants</option>
                            <option value="3">Spa</option>
                        </select>
                    </div>
                    <div class="filter-price">
                        <h4>Prix</h4>
                        <input class="filter-price-range" type="range" min="0" max="5000" value="5000" id="priceFilter" step="100">
                        <p id="priceRange">Prix jusqu'à 5000 MAD</p>
                    </div>
                    <div class="filter-person">
                        <h4>Capacité</h4>
                        <select id="personFilter">
                            <option value="">Toutes les capacités</option>
                            <option value="1">1 Personne</option>
                            <option value="2">2 Personnes</option>
                            <option value="3">3 Personnes</option>
                            <option value="4">4 Personnes</option>
                            <option value="5">+5 Personnes</option>
                        </select>
                    </div>
                </div>

                <!-- Results Section -->
                <div class="result-cards">
                    

                    <!-- Dynamic Product Cards -->
                    <div id="productResults"></div>
                </div>
            </div>
        </section>
    </main>

    
    <form id="reservationForm" action="{{ route('chambrePanier') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="product_ID" id="product_ID">
        <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">
        <input type="hidden" name="dateD" value="{{ request('dateD') }}">
        <input type="hidden" name="dateF" value="{{ request('dateF') }}">
        <input type="hidden" name="stayDuration" value="{{ request('stayDuration') }}">

    </form>


    <script>
            const products = @json($availableProducts);


        function renderProducts(filteredProducts) {
            const productResults = document.getElementById('productResults');
            productResults.innerHTML = '';
            filteredProducts.forEach(product => {
                const productCard = document.createElement('div');
                productCard.classList.add('card');

                let imageSrc;
                switch(product.PR_CATEGORIE) {
                    case 1:
                        imageSrc = '{{ asset("images/ch1.jpg") }}';
                        productCard.innerHTML = `
                            <div class="card-image">
                                <img src="${imageSrc}" alt="Category Image">
                            </div>
                            <div class="card-content">
                                <h3> ${product.PR_CODE}</h3>
                                <p>Type : Chambre Hotel </p>
                                <p>Capacité : ${product.PR_PERSONNE} personnes</p>
                                
                                


                            </div>
                            <button class="btn-card" onclick="confirmReservation('${product.PR_CODE}')">${product.PR_PRIX } MAD/nuit <br><br> Réserver</button>

                        `;
                        break;
                    case 2:
                        imageSrc = '{{ asset("images/t1.jpg") }}';
                        productCard.innerHTML = `
                            <div class="card-image">
                                <img src="${imageSrc}" alt="Category Image">
                            </div>
                            <div class="card-content">
                                <h3> ${product.PR_CODE}</h3>
                                <p>Type : Table Restaurant </p>
                                <p>Capacité : ${product.PR_PERSONNE} personnes</p>
                                
                                


                            </div>
                            <button class="btn-card" onclick="confirmReservation('${product.PR_CODE}')">${product.PR_PRIX } MAD/nuit <br><br> Réserver</button>

                        `;
                        break;
                    case 3:
                        imageSrc = '{{ asset("images/sp2.jpg") }}';
                        productCard.innerHTML = `
                            <div class="card-image">
                                <img src="${imageSrc}" alt="Category Image">
                            </div>
                            <div class="card-content">
                                <h3> ${product.PR_CODE}</h3>
                                <p>Type : Séance SPA </p>
                                <p>Capacité : ${product.PR_PERSONNE} personnes</p>
                                
                                


                            </div>
                            <button class="btn-card" onclick="confirmReservation('${product.PR_CODE}')">${product.PR_PRIX } MAD/nuit <br><br> Réserver</button>

                        `;
                        break;
                    default:
                }

                
                productResults.appendChild(productCard);
            });
        }

        function applyFilters() {
            const categoryFilter = document.getElementById('categoryFilter').value;
            const priceFilter = document.getElementById('priceFilter').value;
            const personFilter = document.getElementById('personFilter').value;

            const filteredProducts = products.filter(product => {
                return (
                    (categoryFilter === '' || product.PR_CATEGORIE == categoryFilter) &&
                    product.PR_PRIX <= priceFilter &&
                    (personFilter === '' || product.PR_PERSONNE == personFilter)
                );
            });

            renderProducts(filteredProducts);
        }

        document.getElementById('priceFilter').addEventListener('input', function() {
            document.getElementById('priceRange').textContent = `Prix jusqu'à ${this.value} MAD`;
            applyFilters();
        });

        document.getElementById('categoryFilter').addEventListener('change', applyFilters);
        document.getElementById('personFilter').addEventListener('change', applyFilters);

        renderProducts(products);
//***************************************
    
    

        function confirmReservation(prCode) {
            if (!@json(Auth::check())) {
                alert('Veuillez vous connecter pour effectuer une réservation.');
                window.location.href = '{{ route('index.connect') }}';
                return;
            }

            if (confirm(`Êtes-vous sûr de vouloir réserver le produit ${prCode} du {{ request('dateD') }} au {{ request('dateF') }}?`)) {
                // Fill in the form and submit it
                document.getElementById('product_ID').value = prCode;
                document.getElementById('reservationForm').submit();
            }
        }
//************************************************
    

document.addEventListener("DOMContentLoaded", function() {
    flatpickr("#dates", {
        mode: "range", // Enables date range mode
        dateFormat: "d-m-Y", // Use the DD-MM-YYYY format
        minDate: "today", // Disable past dates
        locale: {
            firstDayOfWeek: 1, // Set Monday as the first day of the week
        },
        onChange: function(selectedDates, dateStr, instance) {
            if (selectedDates.length > 1) {
                const checkinDate = selectedDates[0];
                const checkoutDate = selectedDates[1];

                // Format the dates in DD-MM-YYYY format
                const formattedCheckinDate = checkinDate.toLocaleDateString('en-GB'); // 'en-GB' returns DD/MM/YYYY
                const formattedCheckoutDate = checkoutDate.toLocaleDateString('en-GB');

                // Set the check-in and check-out values in the hidden fields
                document.getElementById('checkin').value = formattedCheckinDate.split('/').reverse().join('-'); // Convert to DD-MM-YYYY
                document.getElementById('checkout').value = formattedCheckoutDate.split('/').reverse().join('-'); // Convert to DD-MM-YYYY

                // Calculate the difference in days
                const checkinDateObject = new Date(checkinDate);
                const checkoutDateObject = new Date(checkoutDate);

                // Get the difference in milliseconds, then convert to days
                const diffTime = checkoutDateObject - checkinDateObject;
                const diffDays = diffTime / (1000 * 60 * 60 * 24); // Convert milliseconds to days

                // Display the number of days
                console.log('Number of days between the selected dates:', diffDays);

                // Optional: You can display the number of days in the UI or send it in a hidden field
                // Example: Add the number of days to a hidden input field
                if(diffDays==0){
                document.getElementById('stayDurationInput').value = 1;
                }else{
                document.getElementById('stayDurationInput').value = diffDays;

                }
                // Update the display text for the date range
                document.getElementById('dates').value = `${formattedCheckinDate} - ${formattedCheckoutDate}`;
            }
        }
    });
});




//********************************************

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
