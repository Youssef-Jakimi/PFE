<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <a href="/Table" ><button> Afficher Les Reservations </button></a>          

        <div >
            <h1 style="color: white"><pre>   Se connecter :  </pre></h1>
            <form class="mb-3" action={{ route('FaireReservation') }} method="post">
                        @csrf<br>
                        Id Produit<input type="text" class="form-control" name="produit" placeholder="id du Produit "> </input><br>
                        Id Reservation<input type="text" class="form-control" name="id_reserv" placeholder="id du reservation "> </input><br>
                        Prix Totale<input type="text"class="form-control" name="prix" placeholder="prix total "></input><br>
                        Date Debut<input type="date"class="form-control" name="DD" placeholder="Date Debut "> </input><br>
                        Date Fin<input type="date"class="form-control" name="DF" placeholder="date fin "> </input><br>
                        <button type="submit" class="btn btn-primary">Ajouter</button>

     
            </form>

             

        </div>

</body>
</html>