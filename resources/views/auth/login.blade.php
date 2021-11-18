@extends('header') 
@section('content')
<link href = "/css/styles.css" rel="stylesheet">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-login">
                <div class="card-header">
                    <h3>Prisijungimas</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                            <div class="col-md-6">
                                <label for="email" class="col-md-4 col-form-label text-md-right">El. paštas</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Naudotojo el. paštas">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Slaptažodis') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Naudotojo el. paštas">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                                    
                              

                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Prisijungti
                                </button><br>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Pamiršote slaptažodį?') }}
                                    </a>
                                @endif<br>
                                <a class="a-button google" href="{{url('auth/google')}}"  >Prisijungti su</a>
                            </div>
                            <div class="right">
                                @guest
                                @if (Route::has('login'))
                                Neturite paskyros?
                                    <a href="{{ route('register') }}">Registruotis</a>
                                @endif
                            @endguest
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
