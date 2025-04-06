<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="YR HOTELS - Vivez une expérience de luxe inoubliable dans nos hôtels 5 étoiles présents dans le monde entier">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Laravel CSRF token -->
    <title>YR HOTELS - Luxe & Élégance</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Include Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>
<body>
    <!-- Header -->
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
                    <div class="flex items-center space-x-4">
                        <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div x-data="{ isOpen: false }" class="relative">
                            
                            <button @click="isOpen = !isOpen" class="flex items-center space-x-2 text-gray-700 focus:outline-none">
                                <span>Utilisateur, {{ Auth::user()->nom }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
    
                            <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"> Profil</a>
                                <a href="{{ route('panier') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"> <i class="fas fa-shopping-cart"></i>Panier</a>
                                <a href="{{ route('disconnect') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Déconnexion</a>
                                
                                
                                </div>

                        </div>
                    </div>
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
            <a href="{{ route('contact') }}">Contact</a>
            @if (Auth::check())
                    @if (Auth::user()->ADMIN == TRUE)
                    <a href="{{ route('disconnect') }}" class="btn-login">Logout</a>
                    <a href="{{ route('admin.dashboard') }}" class="btn-book">Admin</a>
                    @else
                    <div class="flex items-center space-x-4">
                        <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div x-data="{ isOpen: false }" class="relative">
                            
                            <button @click="isOpen = !isOpen" class="flex items-center space-x-2 text-gray-700 focus:outline-none">
                                <span>Utilisateur, {{ Auth::user()->nom }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
    
                            <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"> Profil</a>
                                <a href="{{ route('panier') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"> <i class="fas fa-shopping-cart"></i>Panier</a>
                                <a href="{{ route('disconnect') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Déconnexion</a>
                                
                                
                                </div>

                        </div>
                    </div>
                    <a href="{{ route('index.connect') }}" class="btn-book">Réserver</a>
                    @endif
                @else
                    <a href="{{ route('index.connect') }}" class="btn-login">Se connecter</a>
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

    <main class="py-12 px-6 md:px-20 bg-gray-50">
        <section class="bg-white p-8 rounded shadow-lg mb-12">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Détails du Profil</h2>
            <div class="grid gap-4 text-lg">
                <p><strong>Nom:</strong> {{ $user->nom }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Identifiant:</strong> {{ $user->CIN ?? 'Non renseigné' }}</p>
                <p><strong>Téléphone:</strong> {{ $user->telephone ?? 'Non renseigné' }}</p>
                <p><strong>Membre Depuis:</strong> {{ $user->created_at ?? 'Non renseigné' }}</p>
            </div>
        </section>

        <section class="bg-white p-8 rounded shadow-lg">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Historique des Réservations</h2>
            @if ($reservations->isEmpty())
                <p class="text-gray-600">Aucune réservation trouvée.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100 text-left text-sm font-medium text-gray-700">
                                <th class="px-4 py-3">Produit</th>
                                <th class="px-4 py-3">Personnes</th>
                                <th class="px-4 py-3">Prix Unitaire</th>
                                <th class="px-4 py-3">Prix Total</th>
                                <th class="px-4 py-3">DE</th>
                                <th class="px-4 py-3">A</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="px-4 py-3">{{ $reservation->PR_CODE }}</td>
                                    <td class="px-4 py-3">{{ $reservation->PR_PERSONNE }} personnes</td>
                                    <td class="px-4 py-3">{{ $reservation->PR_PRIX }} MAD</td>
                                    <td class="px-4 py-3">{{ $reservation->Prix_Total }} MAD</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($reservation->Date_D)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($reservation->Date_F)->format('d/m/Y') }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
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
