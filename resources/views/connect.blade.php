<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Se connecter</h1>
            <form class="login-form" action="{{ route('ajouter.login') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" name="CIN" placeholder="CIN" class="form-input" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Mot de passe" class="form-input" required>
                </div>
                <button type="submit" class="btn-login">Se connecter</button>
            </form>
            <div class="login-links">
                <a href="{{ route('Auth') }}">Créer un compte</a>
            </div>
        </div>
    </div>
</body>
</html>
