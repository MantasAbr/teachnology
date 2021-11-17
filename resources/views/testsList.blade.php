@extends('header')
@section('content')
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
<body>
    <div class="pageCointaner">
        <div class="testListSplashContainer">
            <h4 class="testListSplashText">Testų sąrašas</h4>
            
            <!-- Atsiprašau už šitą nesamonę. Bandžiau įvairiai, bet negrįžo atgal kitaip -->
            <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{ url('/') }}"><button style="cursor: pointer;">Atgal</button></a>
        </div>
        
        <table class="testListTable">
            <thead>
            <th>Testo pavadinimas</th>
            <th>Kategorija</th>
            <th>Veiksmai</th>
            </thead>
            <tbody>
            @foreach($otherposts as $post)
                @if(Auth::user()->username == $post->username)
                    <tr>
                        <td>{{ $post->testName }}</td>
                        @if($post->Category_idCategory == 1)
                            <td>Elementary school</td>
                        @endif
                        @if($post->Category_idCategory == 2)
                            <td>Middle school</td>
                        @endif
                        <td>
                            <a href="{{ route('postshow', $post->idTest) }}">
                                <button class="testListButton">Pasirinkti</button>
                            </a>
                        </td>
                        </td>
                        @endif

                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table> 

    </div>
    <div style="margin-top: 80px;"></div>
    @endsection
</body>
</html>