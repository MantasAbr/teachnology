@extends('header')
@section('content')

<div style="width: 40%; margin: auto; text-align: right;">
    <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{ url('/') }}"><button style="cursor: pointer;">Atgal</button></a>
</div>
<div style="text-align: center;" class="container-center">
    
        <div class="row justify-content-center">
                    <div class="card-body">
                        <div style="width: 100%;" class="form-group">
                            @csrf
                            <label class="label">Naudotojo vardas </label><br>
                            <td>{{ $usersProfile->name}}</td><br>  
                            <br>
                            <label class="label">El. paštas </label><br>
                            <td>{{ $usersProfile->email}}</td><br>
                            <br>
                            <button>Redaguoti</button>
                            <br><br>
                            <button href="#valiuta" class="valiuta">Įsigyti valiutą</button> 
                            {{-- <label class="label">Slaptažodis </label><br>
                            <td>{{ $usersProfile->password}}</td><br>
                            <br>
                            <label class="label">Pakartoti slaptažodį </label><br>
                            <td>{{ $usersProfile->password}}</td><br> --}}
                        </div>
                      @if(Auth::user()->role == 1)
                        @if($usersProfile->is_blocked == 1)
                            <a href="{{ route('status', ['id' => $usersProfile->id, 'status_code'=>0]) }}" class="btn">
                        <button>Blokuoti</button>
                            </a>
                            @else
                            <a href="{{ route('status', ['id' => $usersProfile->id, 'status_code'=>1]) }}" class="btn">
                        <button>Atblokuoti</button>
                            </a>
                        
                            @endif
                            @endif

                            
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
                <button class="exit">X</button>
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
          $(".valiuta button").click(function(){
                $("#valiuta").toggleClass('modal');
            });

            

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
        </script>
@endsection
