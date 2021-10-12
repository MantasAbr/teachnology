<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TeachNology</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
            <link href = "/css/main.css" rel="stylesheet">


    </head>
    <body class="antialiased">
            <div>
                <h1 class="splash">TEACHNOLOGY</h1>
                    <a class="title" href="{{ url('logIn') }}">Prisijungti</a>
                    <a class="title" href="{{ url('profile') }}">Profilis</a>
                    <a class="title" href="{{ url('testsList') }}">Testų sąrašas</a>
                    <a class="title" href="{{ url('myTestsList') }}">Mano testų sąrašas</a>
                    <a class="title" href="{{ url('statistics') }}">Statistika</a>
                    <a class="title" href="{{ url('currency') }}">Pirkti valiutą/Premium</a>
            </div>
            
            <!--<div class="circle">
                <div class="tick"></div>
                <div class="tick"></div>
                <div class="tick"></div>
                <div class="tick"></div>
                <div class="tick"></div>
            </div> -->
    </body>
</html>
