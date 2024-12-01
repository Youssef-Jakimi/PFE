<form action="{{ route('reservation.store') }}" method="POST" class="reservation-form" data-target="{{ $type }}Div">
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">
    Produit:
    <select name="produit" class="form-select">
        @foreach($produits as $produit)
            <option value="{{ $produit->id }}">{{ $produit->PR_CODE }}</option>
        @endforeach
    </select>
    <div class="mt-2">
        Id Réservation: <input type="text" name="id_reserv" class="form-control">
        Prix Total: <input type="text" name="prix" class="form-control">
        Date Début: <input type="date" name="DD" class="form-control">
        Date Fin: <input type="date" name="DF" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
</form>
