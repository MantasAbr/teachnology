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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
    </head>
<body>
    <div class="pageCointaner">
        <div class="testListSplashContainer">
            <h4 class="testListSplashText">Testų sąrašas</h4>

            <!-- Atsiprašau už šitą nesamonę. Bandžiau įvairiai, bet negrįžo atgal kitaip -->
            <a style="height: 40px; margin-top:auto; margin-bottom: auto;">
                <button href="#rikiavimas" onclick="sortModal()" style="cursor: pointer; display:flex; flex-direction:row; align-items: center; justify-content: center;">
                    <span class="material-icons">sort</span>Rikiuoti
                </button>
            </a>
            <a style="height: 40px; margin-top:auto; margin-bottom: auto;">
                <button href="#filtravimas" onclick="filterModal()" style="cursor: pointer; display:flex; flex-direction:row; align-items: center; justify-content: center;">
                    <span class="material-icons">filter_alt</span>Filtruoti
                </button>
            </a>
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

                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>

    </div>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center" name="action" value='html'>
            <div class="bottom">
                {!! $otherposts->links() !!}
            </div>
        </div>
    <div style="margin-top: 80px;"></div>

    <div id="rikiavimas" class="modal">
        <div class="modal-container">
            <div class="modal-box" style="width: 620px; height: 360px;">
                <div class="modal-header-box">
                    <button class="exit" onclick="sortModal()">X</button>
                    <h2 class="splash">Rikiavimas</h2>
                </div>
                <div class="hairline"></div>
                <div class="sort-list">
                    <div class=list-item>
                        <p class="choice">Pagal įkėlimo datą</p>
                        <label class="checkbox-container-radio">
                            <input type="radio" name="sortOptions">
                            <span class="checkmark-radio"></span>
                        </label>
                    </div>
                    <div class=list-item>
                        <p class="choice">Pagal peržiūras</p>
                        <label class="checkbox-container-radio">
                            <input type="radio" name="sortOptions">
                            <span class="checkmark-radio"></span>
                        </label>
                    </div>
                    <div class=list-item>
                        <p class="choice">Pagal įvertinimą</p>
                        <label class="checkbox-container-radio">
                            <input type="radio" name="sortOptions">
                            <span class="checkmark-radio"></span>
                        </label>
                    </div>
                    <button onclick="sortModal()">Rikiuoti</button>                    
                </div>                                                   
            </div>
        </div>
    </div>

    <div id="filtravimas" class="modal">
        <div class="modal-container">
            <div class="modal-box" style="width: 620px; height: 360px;">
                <div class="modal-header-box">
                    <button class="exit" onclick="filterModal()">X</button>
                    <h2 class="splash">Filtravimas</h2>
                </div>
                <div class="hairline"></div>
                <div class="sort-list">
                    <div class=list-item>
                        <p class="choice">Visi testai</p>
                        <label class="checkbox-container-radio">
                            <input type="radio" name="filterOptions">
                            <span class="checkmark-radio"></span>
                        </label>

                    </div>
                    <div class=list-item>
                        <p class="choice">Nespręsti testai</p>
                        <label class="checkbox-container-radio">
                            <input type="radio" name="filterOptions">
                            <span class="checkmark-radio"></span>
                        </label>
                    </div>
                    <div class=list-item>
                        <p class="choice">Spręsti testai</p>
                        <label class="checkbox-container-radio">
                            <input type="radio" name="filterOptions">
                            <span class="checkmark-radio"></span>
                        </label>
                    </div>
                    <button onclick="filterModal()">Filtruoti</button>                    
                </div>                                                   
            </div>
        </div>
    </div>
 
    <script type=text/javascript>
        function sortModal(){
            $('#rikiavimas').toggleClass('modal');
        }
        function filterModal(){
            $('#filtravimas').toggleClass('modal');
        }
    </script>
    @endsection
</body>
</html>
