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
<div style="width: 40%; margin: auto; text-align: right;">
    <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{ url('/') }}"><button style="cursor: pointer;">Atgal</button></a>
</div>
<div style="text-align: center;" class="container-center profile">
    
        <div class="row justify-content-center">
                    <div class="card-body">

                        <div class="valiuta">
                            <button style="float: left;" href="#valiuta" class="valiuta" onclick="modal()">Įsigyti valiutą</button> 
                        </div>
                        <div style="width: 100%;" class="form-group">
                            @csrf      
                            <h3 style="text-align: left; margin-top: 0px;">TeachNology valiutos kiekis: <strong>{{ $usersProfile->currency }}</strong></h3>    
                        @if($usersProfile->google_id == null)
                            <form method="POST" action="{{ route('UpdateProfile') }}">
                                @csrf
                                    <div class="col-md-6">
                                        <div class="name" id="name-first">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Naudotojo vardas') }}</label><br>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usersProfile->name}}" required autocomplete="name" autofocus placeholder="Naudotojo vardas" disabled>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <br>
        
                                    <div class="col-md-6">
                                        <div class="name">
                                        <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Naudotojo pavardė') }}</label>
                                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value=" {{ $usersProfile->surname}}" required autocomplete="surname" autofocus placeholder="Naudotojo pavardė" disabled>
        
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <br>

                                    <div class="col-md-6">
                                        <div class="email name">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('El. paštas') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value=" {{ $usersProfile->email}}" required autocomplete="surname" autofocus placeholder="El. paštas" disabled>
        
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                    <button id="Save" type="submit" class="btn btn-primary darkGreen hidden">
                                        Saugoti
                                    </button>
                                </div>
                            </form>

                            <button id="Edit" onclick="EditProfile()" class="darkGreen">
                                Redaguoti
                            </button>
                            <br>
                            <a class="a-button" href="/password/{{Auth::user()->id}}">Keisti slaptažodį</a>

                            @else
                                <div style="text-align: left;">
                                    <p>Naudotojo vardas: <strong>{{ $usersProfile->name }}</strong></p>
                                    <p>Naudotojo pavardė: <strong>{{ $usersProfile->surname }}</strong></p>
                                    <p>El. paštas: <strong>{{ $usersProfile->email }}</strong></p>
                                </div>
                            @endif
                        </div>
                      

                            
                    </div>
        </div>
</div>
        
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
    
</div>
<div id="valiuta" class="modal">
<form method="post" action="{{route('addCur', $usersProfile->id)}}" >
     @csrf 
    <div class="modal-container">
        <div class="modal-box">
            <div class="modal-header-box">
                <button class="exit" onClick="modal()">X</button>
                <h3 class="splash">Valiutos pirkimas</h3>
            </div>
            <div class="hairline"></div>
                <div class="crypto">
                    <a>Pasirinkite norimą sumą ir valiutą kurią norite konvertuoti į mūsų valiutą</a>
                    
                    <input type="number" min="0" name="kiekis"  value="" Required></td>
                    
                </div>
               
                    <dl id="crypto" class="dropdown">
                     <h3> Iš <span class="tab"></span> Į </h3>   
                    <dt><a href="#"><span>Crypto valiuta</span></a></dt>
                        <dd>
                            <ul>
                                <li><a href="#"><img class="cryptoimg" src="/img/crypto/bitcoin.png" alt="" />Bitcoin<span class="value">BC</span></a></li>
                                <li><a href="#"><img class="cryptoimg" src="/img/crypto/eth.png" alt="" />Ethereum<span class="value">ET</span></a></li>
                                <li><a href="#"><img class="cryptoimg" src="/img/crypto/cardano.png" alt="" />Cardano<span class="value">CD</span></a></li>
                                <li><a href="#"><img class="cryptoimg" src="/img/crypto/solana.png" alt="" />Solana<span class="value">SOL</span></a></li>
                            </ul> 
                        </dd>
                       <img class="thc" src="/img/crypto/thc.png"/> 
                      <br><br>
                      
                      <button class="btn btn-primary" style="margin-left:120px; border: solid 1px;">Konvertuoti</button>
                    </dl>         
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<script type=text/javascript>
          function modal(){
                $('#valiuta').toggleClass('modal');
            }

            

            $(".dropdown img.flag").addClass("flagvisibility");
        $(".dropdown dt a").click(function() {
            $(".dropdown dd ul").toggle();
        });
                    
        $(".dropdown dd ul li a").click(function() {
            var text = $(this).html();
            $(".dropdown dt a span").html(text);
            $(".dropdown dd ul").hide();
            $("#result").html("Selected value is: " + getSelectedValue("sample"));
        });
                    
        function getSelectedValue(id) {
            return $("#" + id).find("dt a span.value").html();
        }
    
        $(document).bind('click', function(e) {
            var $clicked = $(e.target);
            if (! $clicked.parents().hasClass("dropdown"))
                $(".dropdown dd ul").hide();
        });
    
        $(".dropdown img.flag").toggleClass("flagvisibility");
        function EditProfile() {
            document.getElementById('name').disabled = false;
            document.getElementById('surname').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('Edit').style.display = "none";
            document.getElementById('Save').style.display = "initial";
        }
        </script>
@endsection
</body>
</html>