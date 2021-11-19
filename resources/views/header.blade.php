<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TeachNology</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="/css/styles.css" rel="stylesheet">

    </head>
    <body>
    <div class="header">
        <img src="img/logo2.png">

        @if (!Auth::guest())
            <a class="logOut" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out fa-2x"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @else
            <a class="logOut" href="{{ url('login') }}">
                <i class="fa fa-sign-in fa-2x" ></i>
            </a>
        @endif

        <nav>
        <ul>
            <li class="list"><a  href="/testsList">Testai</a></li>
            <li class="list"><a href="/statistics">Statistika</a></li>
            <li class="list"><a href="/myTestsList">Mano testai</a></li>

            {{-- <li class="list"><a href="/profile">Profilis</a></li> --}}
            <a class="premium" href="/premium">Nusipirkti Premium</a>

            @if (!Auth::guest())

                        <a style="float: right; margin-right: 20px;">{{Auth::user()->email}}</a>
            @endif
        </ul>
        </nav>
    </div>
        <div id="modal" class="modal">
            <div class="modal-container">
                <div class="modal-box">
                    <div class="modal-header-box">
                        <button class="exit">X</button>
                        <h3 class="splash"><i style="color: orange;">Premium</i> funkcionalumo pirkimas</h3>
                    </div>
                    <div class="hairline"></div>

                    <p style="margin-left: 20px; font-size:larger;">Įsigijus svetainės <i style="color: orange;">Premium</i> prenumeratą, gausite prieigą prie šių naujų funkcijų:</p>
                    <ul>
                        <li>Galimybė peržiūrėti savo testų statistiką!</li>
                        <li>...!</li>
                        <li>...!</li>
                    </ul>

                    <div class="payment-select-container">
                        <a href="buying_premium"><img src="/img/payment/swed.png" class="payment-method"></img></a>
                        <div style="padding-left:20px"></div>
                        <a href="buying_premium"><img src="/img/payment/dnb.png" class="payment-method"></img></a>
                    </div>
                    <div style="padding-top:15px"></div>
                    <div class="payment-select-container">
                        <a href="buying_premium"><img src="/img/payment/seb.png" class="payment-method"></img></a>
                        <div style="padding-left:20px"></div>
                        <a href="buying_premium"><img src="/img/payment/thc.png" class="payment-method"></img></a> <!-- Čia mūsų tas crypto tipo, po to normalia fotke reiks uzdet-->
                    </div>

                </div>     
            </div>
        </div>

        <script type=text/javascript>
            $("button").click(function(){
                $("#modal").toggleClass('modal');
            });
        </script>

        <div class="inner">
                @yield('content')
        </div>

    </body>
</html>
