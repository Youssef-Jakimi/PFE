<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestion des Réservations</title>
</head>
<body>
    <div class="container mt-4">
        <h2>Réservations</h2>
        <!-- Input pour le Client -->
        <label for="client">Client :</label>
        <input type="text" id="client" placeholder="Nom du client" class="form-control mb-3">

        <!-- Section pour Chambre -->
        <button class="btn btn-primary mb-3" id="ChambreButton">Réserver Chambre</button>
        <div id="ChambreDiv" style="display: none;">
            <form action="{{ route('FaireReservation') }}" method="post" class="mb-3">
                @csrf
                <input type="hidden" name="type" value="Chambre">
                Produit :
                <select name="produit"  class="form-control mb-2">
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}">{{ $produit->PR_CODE }}</option>
                    @endforeach
                </select>
                Id Réservation :
                <input type="text" name="id_reserv" class="form-control mb-2" placeholder="Id de réservation">
                Prix Total :
                <input type="text" name="prix" class="form-control mb-2" placeholder="Prix total">
                Date Début :
                <input type="date" name="DD" class="form-control mb-2">
                Date Fin :
                <input type="date" name="DF" class="form-control mb-2">
                <button type="submit" class="btn btn-success">Ajouter</button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Id Réservation</th>
                        <th>Id Produit</th>
                        <th>Produit</th>
                        <th>Prix Total</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chambres as $chambre)
                        <tr>
                            <td>{{ $chambre->id }}</td>
                            <td>{{ $chambre->produit_id }}</td>
                            <td>{{ $chambre->nom }}</td>
                            <td>{{ $chambre->Prix_Total }}</td>
                            <td>{{ $chambre->Date_D }}</td>
                            <td>{{ $chambre->Date_F }}</td>
                            <td>
                                <a href="/updatedetail" class="btn btn-info btn-sm">Modifier</a>
                                <a href="/deletedetail" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Section pour Table -->
       <button class="btn btn-primary mb-3" id="TableButton">Réserver Table</button>
        <div id="TableDiv" style="display: none;">
            <form action="{{ route('FaireReservation') }}" method="post" class="mb-3">
                @csrf
                <input type="hidden" name="type" value="Table">
                Produit :
                <select name="produit" class="form-control mb-2">
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}">{{ $produit->PR_CODE }}</option>
                    @endforeach
                </select>
                Id Réservation :
                <input type="text" name="id_reserv" class="form-control mb-2" placeholder="Id de réservation">
                Prix Total :
                <input type="text" name="prix" class="form-control mb-2" placeholder="Prix total">
                Date Début :
                <input type="date" name="DD" class="form-control mb-2">
                Date Fin :
                <input type="date" name="DF" class="form-control mb-2">
                <button type="submit" class="btn btn-success">Ajouter</button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Id Réservation</th>
                        <th>Id Produit</th>
                        <th>Produit</th>
                        <th>Prix Total</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table)
                        <tr>
                            <td>{{ $table->id }}</td>
                            <td>{{ $table->produit_id }}</td>
                            <td>{{ $table->nom }}</td>
                            <td>{{ $table->Prix_Total }}</td>
                            <td>{{ $table->Date_D }}</td>
                            <td>{{ $table->Date_F }}</td>
                            <td>
                                <a href="/updatedetail" class="btn btn-info btn-sm">Modifier</a>
                                <a href="/deletedetail" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Section pour Spa -->
        <button class="btn btn-primary mb-3" id="SpaButton">Réserver Spa</button>
        <div id="SpaDiv" style="display: none;">
            <form action="{{ route('FaireReservation') }}" method="post" class="mb-3">
                @csrf
                <input type="hidden" name="type" value="Spa">
                Produit :
                <select name="produit" class="form-control mb-2">
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}">{{ $produit->PR_CODE }}</option>
                    @endforeach
                </select>
                Id Réservation :
                <input type="text" name="id_reserv" class="form-control mb-2" placeholder="Id de réservation">
                Prix Total :
                <input type="text" name="prix" class="form-control mb-2" placeholder="Prix total">
                Date Début :
                <input type="date" name="DD" class="form-control mb-2">
                Date Fin :
                <input type="date" name="DF" class="form-control mb-2">
                <button type="submit" class="btn btn-success">Ajouter</button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Id Réservation</th>
                        <th>Id Produit</th>
                        <th>Prix Total</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   {{--  @foreach($details->where('type', 'Spa') as $detail)
                        <tr>
                            <td>{{ $detail->id }}</td>
                            <td>{{ $detail->produit_id }}</td>
                            <td>{{ $detail->Prix_Total }}</td>
                            <td>{{ $detail->Date_D }}</td>
                            <td>{{ $detail->Date_F }}</td>
                            <td>
                                <a href="/updatedetail/{{ $detail->id }}" class="btn btn-info btn-sm">Modifier</a>
                                <a href="/deletedetail/{{ $detail->id }}" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gérer l'affichage des sections dynamiquement
        document.getElementById('ChambreButton').addEventListener('click', function () {
            toggleDiv('ChambreDiv');
        });
        document.getElementById('TableButton').addEventListener('click', function () {
            toggleDiv('TableDiv');
        });
        document.getElementById('SpaButton').addEventListener('click', function () {
            toggleDiv('SpaDiv');
        });

        function toggleDiv(divId) {
            var div = document.getElementById(divId);
            div.style.display = (div.style.display === 'none') ? 'block' : 'none';
        }
    </script>
</body>
</html>
 
 