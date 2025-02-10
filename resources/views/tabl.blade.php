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

        .table {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .table:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .table img {
            max-width: 200px;
            border-radius: 8px;
            margin-right: 20px;
        }

        .table-info {
            flex: 1;
        }

        .table-info h2 {
            margin: 0 0 10px;
            color: #2c3e50;
        }

        .table-info p {
            margin: 0 0 10px;
            color: #666;
        }

        .table-info .capacity {
            font-size: 1.2em;
            font-weight: bold;
            color: #2c3e50;
        }

        .table-info .amenities {
            display: flex;
            margin-top: 10px;
        }

        .table-info .amenities i {
            margin-right: 15px;
            color: #666;
            font-size: 1.2em;
        }

        .table-info .btn {
            background-color: #e67e22;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
        }

        .table-info .btn:hover {
            background-color: #d35400;
        }

        @media (max-width: 768px) {
            .table {
                flex-direction: column;
                align-items: flex-start;
            }
            .table img {
                margin-bottom: 20px;
                width: 100%;
            }
            .table-info {
                flex: none;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Réservez votre Table</h1>

        <div class="table">
            <img src="{{ asset('images/t1.jpg') }}" alt="Table 1">
            <div class="table-info">
                <h2>Table Romantique</h2>
                <p>Une table cosy pour deux personnes avec vue sur la mer, idéale pour une soirée romantique.</p>
                <p class="capacity">Capacité : 2 personnes</p>
                <div class="amenities">
                    <i class="fas fa-wifi"></i>
                    <i class="fas fa-parking"></i>
                    <i class="fas fa-seedling"></i>
                </div>
                <button class="btn">Réserver</button>
            </div>
        </div>

        <div class="table">
            <img src="{{ asset('images/t2.jpg') }}" alt="Table 2">
            <div class="table-info">
                <h2>Table Familiale</h2>
                <p>Parfait pour les repas en famille avec une ambiance conviviale et un grand espace.</p>
                <p class="capacity">Capacité : 6 personnes</p>
                <div class="amenities">
                    <i class="fas fa-wifi"></i>
                    <i class="fas fa-parking"></i>
                    <i class="fas fa-seedling"></i>
                </div>
                <button class="btn">Réserver</button>
            </div>
        </div>

        <div class="table">
            <img src="{{ asset('images/t3.jpg') }}" alt="Table 3">
            <div class="table-info">
                <h2>Table VIP</h2>
                <p>Une expérience gastronomique exclusive avec un service premium et une intimité totale.</p>
                <p class="capacity">Capacité : 4 personnes</p>
                <div class="amenities">
                    <i class="fas fa-wifi"></i>
                    <i class="fas fa-parking"></i>
                    <i class="fas fa-seedling"></i>
                </div>
                <button class="btn">Réserver</button>
            </div>
        </div>
    </div>
</body>
</html>
