<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/authlog.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>
    <!-- Mobile Sidebar -->
    <!-- Mobile Header Bar -->
    <header class="mobile-header">
        <div class="mobile-header-container">
            <button id="sidebarToggle" class="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="YR HOTELS">
            </div>
            
        </div>
    
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo.png') }}" alt="YR HOTELS">
                <button id="closeBtn" class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="nav-links">
                <a href="/" class="active">Accueil</a>
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
                        <a href="{{ route('index.connect') }}" class="btn-book">Réserver</a>
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
    </header>

<div class="login-container">
    <div class="auth-box bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">S'inscrire</h1>
        <form class="auth-form" action="{{ route('Auth') }}" method="post">
            @csrf
            <div class="form-group mb-4">
                <input type="text" name="nom" placeholder="Nom" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="form-group mb-4">
                <input type="email" name="email" placeholder="Email" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="form-group mb-4">
                <input type="text" name="CIN" placeholder="Identifiant / CIN" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="form-group mb-4">
                <input type="text" name="telephone" placeholder="Téléphone" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="form-group mb-4">
                <input type="password" id="password" name="password" placeholder="Mot de passe" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="form-group mb-6">
                <input type="password" id="Rpassword" name="Rpassword" placeholder="Confirmer le mot de passe" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                <span id="password_err" class="error-message text-red-500 text-sm mt-1 hidden">Les mots de passe ne correspondent pas.</span>
            </div>
            <button type="submit" id="submitB" class="btn-auth w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition duration-300" disabled>S'enregistrer</button>
        </form>
        <div class="auth-links mt-6 text-center">
            <a href="{{ route('index.connect') }}" class="text-orange-500 hover:text-orange-600 transition duration-300">Déjà inscrit ? Se connecter</a>
        </div>
    </div>
    </div>
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
</body>
</html>
