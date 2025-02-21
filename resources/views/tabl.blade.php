<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Table</title>
    <link rel="stylesheet" href="{{ asset('css/tabl.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Réservation de Table</h1>

        <!-- Table 1 -->
        <div class="table">
            <img src="{{ asset('images/t1.jpg') }}" alt="Table rendez-vous">
            <div class="table-info">
                <h2>Table rendez-vous</h2>
                <p>Table cosy pour deux avec vue sur la mer.</p>
                <p class="capacity">Capacité : 2 personnes</p>
                <button class="btn" onclick="openForm(1)">Réserver</button>
            </div>
        </div>

        <!-- Table 2 -->
        <div class="table">
            <img src="{{ asset('images/t2.jpg') }}" alt="Table Familiale">
            <div class="table-info">
                <h2>Table Familiale</h2>
                <p>Parfait pour les repas en famille.</p>
                <p class="capacity">Capacité : 4-8 personnes</p>
                <button class="btn" onclick="openForm(2)">Réserver</button>
            </div>
        </div>

        <!-- Table 3 -->
        <div class="table">
            <img src="{{ asset('images/t3.jpg') }}" alt="Table VIP">
            <div class="table-info">
                <h2>Table VIP</h2>
                <p>Privée avec service premium.</p>
                <p class="capacity">Capacité : 4 personnes</p>
                <button class="btn" onclick="openForm(3)">Réserver</button>
            </div>
        </div>

        <a href="{{ route('menu') }}" class="menu-btn">Voir le Menu</a>
    </div>

    <!-- Formulaire de réservation -->
    <div class="overlay" id="overlay"></div>
    <div class="form-popup" id="reservationForm">
        <form action="{{ route('tablePanier') }}" method="post">
            @csrf
            <input type="number" name="produit" id="produit" hidden>
            <input type="number" name="tableProduit" value="4" hidden>
            <input type="date" class="date" name="date" id="date" required>
            <button type="submit" class="btn">Confirmer</button>
            <button type="button" class="btn" onclick="closeForm()">Annuler</button>
        </form>
    </div>

    <script>
        function openForm(tableId) {
            document.getElementById('produit').value = tableId;
            document.getElementById('reservationForm').classList.add('active');
            document.getElementById('overlay').classList.add('active');
        }

        function closeForm() {
            document.getElementById('reservationForm').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        }

        document.getElementById('date').addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (selectedDate < today) {
                alert('Veuillez sélectionner une date valide (non passée).');
                this.value = '';
            }
        });
    </script>
</body>
</html>
