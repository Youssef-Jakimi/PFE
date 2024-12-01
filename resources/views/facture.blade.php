<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1> La facture de Votre reservation : </h1>
    <table class="table">
        <th>
            <td>Id Reservation</td>
            <td>Id Produit </td>
            <td>Prix Total</td>
            <td>Date Debut</td>
            <td>Date fin</td>
        </th>
        <tbody>
            
              
            @foreach ($details as $detail)
                <tr>
                <td></td>
                <td><input type="text" value="{{ $detail->reservation_id}}"readonly style="border: none"></td>
                <td><input type="text" value="{{ $detail->produit_id}}" readonly style="border: none"></td>
                <td><input type="text" value="{{ $detail->Prix_Total}}" readonly style="border: none"></td>
                <td><input type="text" value="{{ $detail->Date_D}}" readonly style="border: none"></td>
                <td><input type="text" value="{{ $detail->Date_F}}" readonly style="border: none"></td>
            
              @endforeach
        </tbody>
        </table>
</body>
</html>