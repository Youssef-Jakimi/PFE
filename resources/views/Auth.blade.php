<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

        <div class="in-up">
            <div class="login">
                <h1 style="color: white"><pre>   S'inscrire :  </pre></h1>
                <form class="main-form" action={{ route('Auth') }} method="post">
                            @csrf<br>
                            <input type="text" name="nom" placeholder="Nom" class="in-up-form" required><br><br>
                            <input type="email" name="email" placeholder="Email" class="in-up-form" required><br><br>
                            <input type="text" name="CIN" placeholder="CIN" class="in-up-form" required><br><br>
                            <input type="text" name="telephone" placeholder="Telephone" class="in-up-form" required><br><br>
                            <input type="password" id="password" name="password" placeholder="Mot de passe" class="in-up-form" required><br><br>
                            <input type="password" id="Rpassword" name="Rpassword" placeholder="Re-enter Mot de passe" class="in-up-form" required> <br>
                            <span id="password_err" style="color: red; display:none">Mots de passe ne sont pas identique </span>
                            <button  type="submit" id="submitB" disabled  class="loginB">S'enregitrer</button>

        
                 </form>
            </div>
        </div>
</body>
</html>