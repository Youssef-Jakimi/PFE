<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Chambres</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
      body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1, h2 {
    text-align: center;
    color: #2c3e50;
}

/* SECTION CHAMBRES */
.chambre {
    background: white;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.chambre:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.chambre img {
    max-width: 200px;
    border-radius: 8px;
    margin-right: 450px;
}

.chambre-info {
    flex: 1;
    margin-left: 20px;
}

.chambre-info h2 {
    margin: 0 0 10px;
    color: #2c3e50;
}

.chambre-info p {
    margin: 0 0 10px;
    color: #666;
}

.chambre-info .price {
    font-size: 1.5em;
    font-weight: bold;
    color: #e67e22;
}

.chambre-info .amenities {
    display: flex;
    margin-top: 10px;
}

.chambre-info .amenities i {
    margin-right: 15px;
    color: #666;
    font-size: 1.2em;
}

.chambre-info .btn {
    background-color: #e67e22;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    margin-top: 20px;
}

.chambre-info .btn:hover {
    background-color: #d35400;
}

/* Responsiveness */
@media (max-width: 768px) {
    .chambre {
        flex-direction: column;
        align-items: center;
    }
    .chambre img {
        margin-bottom: 20px;
        width: 100%;
    }
    .chambre-info {
        flex: none;
        width: 100%;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Réservation de Chambres</h1>

        <!-- Chambre 1 -->
        <div class="chambre">
            <img src="{{ asset('images/ch1.jpg') }}" alt="Chambre 1">
            <div class="chambre-info">
                <h2>Chambre Standard</h2>
                <p>Une chambre confortable avec lit double, salle de bain privée et vue sur le jardin.</p>
                <p class="price">699 DH / nuit</p>
                <div class="amenities">
                    <i class="fas fa-wifi"></i>
                    <i class="fas fa-parking"></i>
                    <i class="fa-solid fa-shower"></i>




                </div>
                <button class="btn">Réserver</button>
                {{-- make the form popup when the button is clicked --}}

                <form action="{{ route('chambrePanier') }}" method="post" >@csrf
                    <input type="number" name="produit" value="1" hidden>
                    <input type="date" class="date" name="dateD" required>
                    <input type="date" class="date" name="dateF" required >

                    <button type="submit" class="btn"  >Confirmer</button>
                </form>
            </div>
        </div>

        <!-- Chambre 2 -->
        <div class="chambre">
            <img src="{{ asset('images/ch2.jpg') }}" alt="Chambre 2">
            <div class="chambre-info">
                <h2>Chambre Deluxe</h2>
                <p>Une chambre spacieuse avec lit king-size, salle de bain luxueuse et vue sur la mer.</p>
                <p class="price">1499 DH/ nuit</p>
                <div class="amenities">
                    <i class="fas fa-wifi"></i>
                    <i class="fa-solid fa-tv"></i>
                    <i class="fas fa-paw"></i>
                    <i class="fas fa-utensils"></i>

                </div>
                <button class="btn">Réserver</button>
                {{-- make the form popup when the button is clicked --}}

                <form action="{{ route('chambrePanier') }}" method="post" >@csrf
                    <input type="number" name="produit" value="3" hidden>
                    <input type="date" class="date" name="dateD" required>
                    <input type="date" class="date" name="dateF" required>

                    <button type="submit" class="btn"  >Confirmer</button>
                </form>
            </div>
        </div>

        <!-- Chambre 3 -->
        <div class="chambre">
            <img src="{{ asset('images/ch3.jpg') }}" alt="Chambre 3">
            <div class="chambre-info">
                <h2>Suite Présidentielle</h2>
                <p>Une suite luxueuse offrant une vue panoramique sur la ville, un jacuzzi privé, un accès exclusif à notre plage privée, ainsi que divers services VIP pour une expérience inoubliable.</p>
                <p class="price">2699 DH / nuit</p>
                <div class="amenities">
                    <i class="fas fa-coffee"></i>
                    <i class="fas fa-concierge-bell"></i>
                    <i class="fas fa-umbrella-beach"></i>
                    <i class="fa-solid fa-spa"></i>
                </div>
                <button class="btn">Réserver</button>
                {{-- make the form popup when the button is clicked --}}

                <form action="{{ route('chambrePanier') }}" method="post" >@csrf
                    <input type="number" name="produit" value="1" hidden>
                    <input type="date" class="date" name="dateD" required> 
                    <input type="date" class="date" name="dateF" required>

                    <button type="submit" class="btn"  >Confirmer</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
