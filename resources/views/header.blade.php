<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TeachNology</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/styles.css" rel="stylesheet" type="text/css">
    </head>
    <body> 
        <div class="header">
        <img src="img/logo2.png">
        <a class="logOut" href="/logOut"><i class="fa fa-sign-out fa-2x"></i></a>  
        <nav>   
        <ul>
            <li class="list"><a  href="/testsList">Testai</a></li>
            <li class="list"><a href="/statistics">Statistika</a></li>
            <li class="list"><a href="/myTestsList">Mano testai</a></li>
            <li class="list"><a href="/profile">Profilis</a></li>
            <a class="premium" href="/premium">Nusipirkti Premium</a>             
        </ul>
        </nav>
</div>
<div class="inner">
        @yield('content')
</div>
    </body>
    </html>