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

            @if (!Auth::guest())
                @foreach ($userProfile as $userProf)
                    @if (Auth::user()->id == $userProf->id)
                        <a href="{{ route('profileshow', $userProf->id) }}">Profilis</a>
                    @endif
                @endforeach
            @else
                <a class="title" href="{{ url('login') }}">Prisijungti</a>
            @endif

            <a href="{{ url('testsList') }}">Testų sąrašas</a>
            <a href="{{ url('myTestsList') }}">Mano testų sąrašas</a>
            <a href="{{ route('statsstuff') }}">Statistika</a>

            @if (!Auth::guest())
                <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Atsijungti
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endif
            <!-- Šito prieš prisijungiant nereiktų rodyt <a href="{{ url('currency') }}">Pirkti valiutą/Premium</a>-->
        </div>

    </body>
