<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TeachNology</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
            <link href = "/css/styles.css" rel="stylesheet">


    </head>

    <body class="antialiased">
        <img src="/img/logo_side_text.png"/>

        <div class="button_container">
            <!-- Čia logo galės per vidurį būt <img><img>-->
            <a class="title" href="{{ url('login') }}">Prisijungti</a>
            <a href="{{ url('profile') }}">Profilis</a>
            <a href="{{ route('otherpostss') }}">Testų sąrašas</a>
            <a href="{{ url('myTestsList') }}">Mano testų sąrašas</a>
            <a href="{{ url('statistics') }}">Statistika</a>
            <!-- Šito prieš prisijungiant nereiktų rodyt <a href="{{ url('currency') }}">Pirkti valiutą/Premium</a>-->
        </div>

        <!-- Nekenčiu front-end'o kai jis nesigauna
        <div class="container">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div> -->
    </body>

