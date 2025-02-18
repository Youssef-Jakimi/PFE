<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Table</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f5;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
            color: #2c3e50;
        }

        .table {
            display: flex;
            flex-direction: column;
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .table:hover {
            transform: translateY(-8px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .table img {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            height: 250px;
        }

        .table-info {
            padding: 15px 0;
        }

        .table-info h2 {
            font-size: 1.6em;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .table-info p {
            font-size: 1em;
            color: #555;
        }

        .table-info .capacity {
            font-size: 1.1em;
            font-weight: bold;
            color: #2c3e50;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #e67e22;
            color: white;
            font-size: 1em;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover ,  .menu-btn:hover {
            background-color: #d35400;
        }

        .menu-btn {
            display: block;
            width: 200px;
            margin: 30px auto;
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            background-color: #e67e22;
            color: white;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        @media (min-width: 768px) {
            .table {
                flex-direction: row;
                align-items: center;
            }

            .table img {
                width: 250px;
                height: auto;
                margin-right: 20px;
            }

            .table-info {
                flex: 1;
            }
        }
    </style>
</head>
<body>
 
    <div class="container">
        <h1>Réservez votre Table</h1>
        <div class="table">
            <img src="{{ asset('images/t1.jpg') }}" alt="Table rendez-vous">
            <div class="table-info">
                <h2>Table rendez-vous</h2>
                <p>Table cosy pour deux avec vue sur la mer.</p>
                <p class="capacity">Capacité : 2 personnes</p>
                <button href="#" id="reserver" class="btn">Réserver</button>
                
                {{-- make the form popup when the button is clicked --}}

                <form action="{{ route('tablePanier') }}" method="post" >@csrf
                    <input type="number" name="produit" value="4" hidden>
                    <input type="date" class="date" name="date" required>
                    <button type="submit" class="btn"  >Confirmer</button>
                </form>
                
            </div>
        </div>

        <div class="table">
            <img src="{{ asset('images/t2.jpg') }}" alt="Table Familiale">
            <div class="table-info">
                <h2>Table Familiale</h2>
                <p>Parfait pour les repas en famille.</p>
                <p class="capacity">Capacité : 4-8 personnes</p>
                <a href="#" class="btn">Réserver</a>
                {{-- make the form popup when the button is clicked --}}

                <form action="{{ route('tablePanier') }}" method="post" >@csrf
                    <input type="number" name="produit" value="4" hidden>
                    <input type="date" class="date" name="date" required>
                    <button type="submit" class="btn"  >Confirmer</button>
                </form>
            </div>
        </div>

        <div class="table">
            <img src="{{ asset('images/t3.jpg') }}" alt="Table VIP">
            <div class="table-info">
                <h2>Table VIP</h2>
                <p>Privée avec service premium.</p>
                <p class="capacity">Capacité : 4 personnes</p>
                <a href="#" class="btn">Réserver</a>
                {{-- make the form popup when the button is clicked --}}

                <form action="{{ route('tablePanier') }}" method="post" >@csrf
                    <input type="number" name="produit" value="4" hidden>
                    <input type="date" class="date" name="date" required>
                    <button type="submit" class="btn"  >Confirmer</button>
                </form>
            </div>
        </div>

        <a href="{{ route('menu') }}" class="menu-btn">Voir le Menu</a>
    </div>
    
</body>
</html>
