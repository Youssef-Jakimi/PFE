<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture de Réservation</title>
    <link rel="stylesheet" href="{{ asset('css/facture.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <div class="facture-container">
        <div class="invoice-header">
            <div class="company-info">

                <h4 style="color: var(--primary-color); margin-top: 10px;">YR-HOTELS</h4>
                <p>contact@yr-hotels.com</p>
            </div>
            <div class="invoice-info">
                <h5 style="color: var(--secondary-color);">Facture #INV-{{ date('Ymd') }}</h5>
                <p>Date: {{ date('d/m/Y') }}</p>
                <p>Status: <span style="color: var(--primary-color); font-weight: 600;">Payée</span></p>
            </div>
        </div>

        <h1>Facture de Réservation</h1>

        <div class="table-responsive">
            <table class="facture-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Réservation</th>
                        <th>Produit</th>
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
                            <td><input type="text" value="{{ $detail->categorie }}" readonly></td>
                            <td><input type="text" value="{{ number_format($detail->Prix_Total, 2, ',', ' ') }} MAD" readonly></td>
                            <td><input type="text" value="{{ date('d/m/Y', strtotime($detail->Date_D)) }}" readonly></td>
                            <td><input type="text" value="{{ date('d/m/Y', strtotime($detail->Date_F)) }}" readonly></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="text-align: right; margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
            <p style="font-size: 1.1rem;"><strong>Montant Total:</strong>
                <span style="color: var(--primary-color); font-weight: 600; font-size: 1.2rem;">
                    {{ number_format($details->sum('Prix_Total'), 2, ',', ' ') }} MAD
                </span>
            </p>
        </div>

        <button class="btn-print" onclick="window.print()">
            <i class="fas fa-print"></i> Imprimer la Facture
        </button>

        <div class="footer">
            <p>Merci pour votre confiance! Pour toute question concernant cette facture, veuillez nous contacter.</p>
            <p>&copy; {{ date('Y') }} YR-HOTELS - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>
