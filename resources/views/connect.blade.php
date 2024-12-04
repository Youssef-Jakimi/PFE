<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
        <div class="in-up">
            <div class="login">
                <h1 style="color: white"><pre>   Se connecter :  </pre></h1>
                <form class="main-form" action={{ route('ajouter.login') }} method="post">
                            @csrf<br>
                        <input type="text" name="CIN" placeholder="CIN" class="in-up-form" required><br><br>
                        <input type="password" name="password" placeholder="Password" class="in-up-form" required> <br>
                        <input  type="submit" value="Connecter" class="loginB">
                        
         
                 </form>
        </div>
        
        
    </div>
</body>
</html>