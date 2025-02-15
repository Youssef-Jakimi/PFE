<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Table & Menu</title>
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
    max-width: 1500px;
    margin: 0 auto;
    padding: 20px;
}


.plats-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin: 40px 0;
}

.plat {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 250px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.plat:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.plat img {
    width: 100%;
    border-radius: 8px;
}

.plat h3 {
    margin: 10px 0;
    color: #2c3e50;
    font-size: 1.5em;
}

.plat p {
    color: #666;
    font-size: 1em;
}


.menu-container {
    margin: 40px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #2c3e50;
    color: white;
    font-size: 1.2em;
}

tr:hover {
    background-color: #f9f9f9;
}


        @media (max-width: 768px) {
            .plats-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 align=center>YR-HOTELS Menu</h1>

        <h2>nos coups de coeur:</h2>
        <div class="plats-container">
            <div class="plat">
                <img src="{{ asset('images/p1.jpg') }}" alt="Plat 1">
                <h3>Filet de Saumon</h3>
                <p>Un délicieux saumon grillé accompagné de légumes frais.</p>
            </div>
            <div class="plat">
                <img src="{{ asset('images/p2.jpg') }}" alt="Plat 2">
                <h3>Pâtes Carbonara</h3>
                <p>Pâtes crémeuses au parmesan et aux lardons.</p>
            </div>
            <div class="plat">
                <img src="{{ asset('images/p3.jpg') }}" alt="Plat 3">
                <h3>Steak de Bœuf</h3>
                <p>Steak grillé à la perfection avec sauce au poivre.</p>
            </div>
        </div>


        <h2>Notre Menu</h2>
        <div class="menu-container">
            <table>
                <tr>
                    <th>Plat</th>
                    <th>Description</th>
                    <th>Prix</th>
                </tr>
                <tr>
                    <td>Filet de Saumon</td>
                    <td>Servi avec légumes grillés et sauce citronnée.</td>
                    <td>260 DH</td>
                </tr>
                <tr>
                    <td>Pâtes Carbonara</td>
                    <td>Pâtes fraîches avec sauce à la crème, parmesan et lardons.</td>
                    <td>79 DH</td>
                </tr>
                <tr>
                    <td>Steak de Boeuf</td>
                    <td>Accompagné de frites maison et sauce au poivre.</td>
                    <td>175 DH</td>
                </tr>
                <tr>
                    <td>Pizza Bismark</td>
                    <td>Poulet,champignions, mozzarella et basilic frais.</td>
                    <td>85 DH</td>
                </tr>
                <tr>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
