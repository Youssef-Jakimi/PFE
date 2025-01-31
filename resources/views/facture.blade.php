<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture de Réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="facture-container">
        <h1>Facture de Votre Réservation</h1>
        <table class="facture-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Id Réservation</th>
                    <th>Id Produit</th>
                    <th>Prix Total</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><input type="text" value="{{ $detail->reservation_id }}" readonly></td>
                        <td><input type="text" value="{{ $detail->produit_id }}" readonly></td>
                        <td><input type="text" value="{{ $detail->Prix_Total }}" readonly></td>
                        <td><input type="text" value="{{ $detail->Date_D }}" readonly></td>
                        <td><input type="text" value="{{ $detail->Date_F }}" readonly></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn-print" onclick="window.print()">Imprimer la Facture</button>
    </div>
</body>
</html>
