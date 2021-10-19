@extends('header')
@section('content')
    <body class="antialiased">
            <div>
                <h1>Pagrindinis puslapis</h1>
                <ul>
                    <li><a href="{{ url('logIn') }}">Prisijungti</a></li>
                    <li><a href="{{ url('profile') }}">Profilis</a></li>
                    <li> <a href="{{ url('testsList') }}">Testų sąrašas</a></li>
                    <li><a href="{{ url('myTestsList') }}">Mano testų sąrašas</a></li>
                    <li><a href="{{ url('statistics') }}">Statistika</a></li>
                    <li><a href="{{ url('currency') }}">Pirkti valiutą/Premium</a></li>
                </ul>  
            </div>    
    </body>
@endsection
