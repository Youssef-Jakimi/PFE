<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="YR HOTELS">
        </div>
        <h1>YR HOTELS</h1>
    </header>
<div class="login-container">
    <div class="auth-box bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">S'inscrire</h1>
        <form class="auth-form" action="{{ route('Auth') }}" method="post">
            @csrf
            <div class="form-group mb-4">
                <input type="text" name="nom" placeholder="Nom" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="form-group mb-4">
                <input type="email" name="email" placeholder="Email" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="form-group mb-4">
                <input type="text" name="CIN" placeholder="CIN" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="form-group mb-4">
                <input type="text" name="telephone" placeholder="Téléphone" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="form-group mb-4">
                <input type="password" id="password" name="password" placeholder="Mot de passe" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="form-group mb-6">
                <input type="password" id="Rpassword" name="Rpassword" placeholder="Confirmer le mot de passe" class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                <span id="password_err" class="error-message text-red-500 text-sm mt-1 hidden">Les mots de passe ne correspondent pas.</span>
            </div>
            <button type="submit" id="submitB" class="btn-auth w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition duration-300" disabled>S'enregistrer</button>
        </form>
        <div class="auth-links mt-6 text-center">
            <a href="{{ route('index.connect') }}" class="text-orange-500 hover:text-orange-600 transition duration-300">Déjà inscrit ? Se connecter</a>
        </div>
    </div>
    </div>
</body>
</html>
