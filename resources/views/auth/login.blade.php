@extends('header') 
@section('content')
<link href = "/css/styles.css" rel="stylesheet">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-login">
                <div class="card-header">
                    <h1>Prisijungimas</h1>
                </div>

                <div class="card-body">


                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                            <div class="col-md-6">
                                <label for="email" class="col-md-4 col-form-label text-md-right">El. paštas</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Naudotojo el. paštas">

                            </div>


                            <div class="col-md-6">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Slaptažodis') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Naudotojo slaptažodis">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: #C41818;"><?php echo 'Neteisingai įvesti duomenys' ?></strong>
                                </span>
                                <br>
                                <br>
                            @enderror

                            @if (session('error'))
                                <a style="color: #C41818;">{{session('error') }}</a>
                                <br>
                                <br>
                           @endif        
                              

                            <div class="col-md-8 offset-md-4 buttons">
                                <button type="submit" class="btn btn-primary darkGreen">
                                    Prisijungti
                                </button><br>

                                @if (Route::has('password.request'))
                                    <a class="a-button" href="{{ route('password.request') }}">
                                        {{ __('Priminti slaptažodį') }}
                                    </a>


                                @endif<br>
                                <a class="a-button google" href="{{url('auth/google')}}"  >Prisijungti su</a>
                            </div>
                            <div class="right">
                                @guest
                                @if (Route::has('login'))
                                <span>Neturite paskyros?</span>
                                    <a class="a-button" href="{{ route('register') }}">Registruotis</a>
                                @endif
                            @endguest
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
