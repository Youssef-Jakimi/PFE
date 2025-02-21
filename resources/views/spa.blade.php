<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Spa & Tarifs</title>
    <link rel="stylesheet" href="{{ asset('css/spa.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="scontainer">
        <h1>Réservez votre Expérience Spa</h1>

        <h2>Nos Services</h2>
        <div class="section-scontainer">
            <div class="card" tabindex="0">
                <img src="{{ asset('images/s1.jpg') }}" alt="Massage Relaxant">
                <h3>Massage Relaxant</h3>
                <p>Un massage doux pour apaiser votre corps et votre esprit.</p>
                <button class="btn" onclick="toggleForm(1)">Réserver</button>
                <form action="{{ route('tablePanier') }}" method="post" class="reservation-form">
                    @csrf
                    <input type="number" name="produit" value="5" hidden>
                    <input type="date" class="date" name="date" required>
                    <button type="submit" class="btn">Confirmer</button>
                </form>
            </div>
            <div class="card" tabindex="0">
                <img src="{{ asset('images/s2.jpg') }}" alt="Soins du Visage">
                <h3>Soins du Visage</h3>
                <p>Un soin revitalisant pour une peau éclatante et hydratée.</p>
                <button class="btn" onclick="toggleForm(2)">Réserver</button>
                <form action="{{ route('tablePanier') }}" method="post" class="reservation-form">
                    @csrf
                    <input type="number" name="produit" value="5" hidden>
                    <input type="date" class="date" name="date" required>
                    <button type="submit" class="btn">Confirmer</button>
                </form>
            </div>
            <div class="card" tabindex="0">
                <img src="{{ asset('images/s3.jpg') }}" alt="Hammam & Sauna">
                <h3>Hammam & Sauna</h3>
                <p>Profitez de la chaleur pour une relaxation totale.</p>
                <button class="btn" onclick="toggleForm(3)">Réserver</button>
                <form action="{{ route('tablePanier') }}" method="post" class="reservation-form">
                    @csrf
                    <input type="number" name="produit" value="5" hidden>
                    <input type="date" class="date" name="date" required>
                    <button type="submit" class="btn">Confirmer</button>
                </form>
            </div>
        </div>

        <h2>Nos Packs</h2>
        <div class="section-scontainer">
            <div class="card" tabindex="0">
                <img src="{{ asset('images/sp1.jpg') }}" alt="Pack Détente">
                <h3>Pack Détente</h3>
                <p>Massage relaxant + Hammam + Thé aux herbes.</p>
            </div>
            <div class="card" tabindex="0">
                <img src="{{ asset('images/sp2.jpg') }}" alt="Pack Luxe">
                <h3>Pack Luxe</h3>
                <p>Massage aux pierres chaudes + Soins du visage + sauna.</p>
            </div>
            <div class="card" tabindex="0">
                <img src="{{ asset('images/sp3.jpg') }}" alt="Pack Duo">
                <h3>Pack Duo</h3>
                <p>Expérience bien-être amis ou famille avec soins personnalisés.</p>
            </div>
        </div>

        <h2>CATALOGUE</h2>
        <div class="catalogue-scontainer">
            <table>
                <tr>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Prix</th>
                </tr>
                <tr tabindex="0">
                    <td>Massage Relaxant</td>
                    <td>Massage corporel avec huiles essentielles.</td>
                    <td>150 DH</td>
                </tr>
                <tr tabindex="0">
                    <td>Soins du Visage</td>
                    <td>Vaporisation intense et nettoyage en profondeur.</td>
                    <td>99 DH</td>
                </tr>
                <tr tabindex="0">
                    <td>Hammam & Sauna</td>
                    <td>Séance inoubliable pour une relaxation optimale.</td>
                    <td>300 DH</td>
                </tr>
                <tr tabindex="0">
                    <td>Pack Détente</td>
                    <td>Massage relaxant + Hammam + Thé aux herbes.</td>
                    <td>449 DH</td>
                </tr>
                <tr tabindex="0">
                    <td>Pack Luxe</td>
                    <td>Massage aux pierres chaudes + Soins du visage + sauna.</td>
                    <td>799 DH</td>
                </tr>
                <tr tabindex="0">
                    <td>Pack Duo</td>
                    <td>Expérience bien-être amis ou famille avec soins personnalisés.</td>
                    <td>1199 DH</td>
                </tr>
            </table>
        </div>
        <a href="#" class="menu-btn">Réserver une séance</a>
    </div>

    <script>
        // Fonction pour afficher/masquer le formulaire de réservation
        function toggleForm(cardId) {
            const forms = document.querySelectorAll('.reservation-form');
            forms.forEach(form => form.classList.remove('active'));
            const form = document.querySelector(`.card:nth-child(${cardId}) .reservation-form`);
            form.classList.toggle('active');
        }
    </script>
</body>
</html>
