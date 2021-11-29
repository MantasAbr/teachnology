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
        <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="/profile/{{Auth::user()->id}}"><button style="cursor: pointer;">Atgal</button></a>
    </div>
    <div style="text-align: center;" class="container-center profile password">
        <div class="row justify-content-center">
            <div class="card-body">
                <div style="width: 100%;" class="passwordUpdate">
                    @csrf      
                    <h3>Slaptažodžio keitimas</h3>    
                    <form method="POST" action="{{ route('UpdatePassword') }}">
                        @csrf
                            <div class="col-md-6">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Slaptažodis') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Naujas slaptažodis">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Pakartokite slaptažodį') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Pakartotas naujas slaptažodis">
                            </div>
                        @if($status != null)
                            <h3 style="color: red; margin-bottom: 0px;">  {{ $status }}</h3>
                        @endif
                        </div>
                            <button id="Save" type="submit" class="btn btn-primary darkGreen">
                                Saugoti
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
    </div>
</body>
</html>