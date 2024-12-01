<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
        <div >
            <h1 style="color: white"><pre>   Se connecter :  </pre></h1>
            <form class="mb-3" action={{ route('update') }} method="post">
                        @csrf<br>
                    <input type="text" name ="id" hidden value="{{$detail->id}}">
                    <input type="text" name="produit" placeholder="id du Produit " value="{{$detail->produit_id}}"> Id Produit</input>
                    <input type="text" name="id_reserv" placeholder="id du reservation " value="{{$detail->reservation_id}}">Id Reservation </input>
                    <input type="text" name="prix" placeholder="prix total "value="{{$detail->Prix_Total}}">Prix Totale </input>
                    <input type="date" name="DD" placeholder="Date Debut "value="{{$detail->Date_D}}">Date Debut </input>
                    <input type="date" name="DF" placeholder="date fin "value="{{$detail->Date_F}}">Date Fin </input>
                    <button type="submit" class="btn btn-primary">Modifier</button>

     
            </form>

             

        </div>

</body>
</html>