<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Spa & Tarifs</title>
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

.section-container {
    display: flex;
    flex-direction: row;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin: 40px 0;
}

.card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.card img {
    width: 100%;
    border-radius: 8px;
}

.card h3 {
    margin: 10px 0;
    color: #2c3e50;
    font-size: 1.4em;
}

.card p {
    color: #666;
    font-size: 1em;
}


.catalogue-container {
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
    .section-container {
        flex-direction: column;
        align-items: center;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Réservez votre Expérience Spa</h1>


        <h2>Nos Services</h2>
        <div class="section-container">
            <div class="card">
                <img src="" alt="Massage Relaxant">
                <h3>Massage Relaxant</h3>
                <p>Un massage doux pour apaiser votre corps et votre esprit.</p>
            </div>
            <div class="card">
                <img src="" alt="Soins du Visage">
                <h3>Soins du Visage</h3>
                <p>Un soin revitalisant pour une peau éclatante et hydratée.</p>
            </div>
            <div class="card">
                <img src="" alt="Hammam & Sauna">
                <h3>Hammam & Sauna</h3>
                <p>Profitez de la chaleur pour une relaxation totale.</p>
            </div>
        </div>


        <h2>Nos Packs</h2>
        <div class="section-container">
            <div class="card">
                <img src="" alt="Pack Détente">
                <h3>Pack Détente</h3>
                <p>Massage relaxant + Hammam + Thé aux herbes.</p>
            </div>
            <div class="card">
                <img src="" alt="Pack Luxe">
                <h3>Pack Luxe</h3>
                <p>Massage aux pierres chaudes + Soins du visage + sauna.</p>
            </div>
            <div class="card">
                <img src="" alt="Pack Duo">
                <h3>Pack Duo</h3>
                <p>Expérience bien-être amis ou famille avec soins personnalisés.</p>
            </div>
        </div>


        <h2>CATALOGUE</h2>
        <div class="catalogue-container">
            <table>
                <tr>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Prix</th>
                </tr>
                <tr>
                    <td>Massage Relaxant</td>
                    <td>Massage corporel  avec huiles essentielles.</td>
                    <td>150 DH</td>
                </tr>
                <tr>
                    <td>Soins du Visage</td>
                    <td>vaporisation intense et nettoyage en profondeur.</td>
                    <td>99 DH</td>
                </tr>
                <tr>
                    <td>Hammam & Sauna</td>
                    <td>Séance inoubliable pour une relaxation optimale.</td>
                    <td>300 DH</td>
                </tr>
                <tr>
                    <td>Pack Détente</td>
                    <td>Massage relaxant + Hammam + Thé aux herbes.</td>
                    <td>449 DH</td>
                </tr>
                <tr>
                    <td>Pack Luxe</td>
                    <td>Massage aux pierres chaudes + Soins du visage + sauna.</td>
                    <td>799 DH</td>
                </tr>
                <tr>
                    <td>Pack Duo</td>
                    <td>Expérience bien-être amis ou famille avec soins personnalisés.</td>
                    <td>1199 DH</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
