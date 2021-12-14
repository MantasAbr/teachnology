@extends('header') 
@section('content')
<link href = "/css/styles.css" rel="stylesheet">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Registracija</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                            <div class="col-md-6">
                                <div class="name" id="name-first">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Vardas') }}</label><br>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Naudotojo vardas">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="name">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Pavardė') }}</label>
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus placeholder="Naudotojo pavardė">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('El. paštas') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Naudotojo el. paštas">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Slaptažodis') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Naudotojo slaptažodis">

                                
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Pakartokite slaptažodį') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Pakartotas naudotojo slaptažodis">
                            </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: #C41818;">Slaptažodis yra per trumpas arba nesutampa</strong>
                                    </span>
                                    <br><br>
                                @enderror

                                <button type="submit" class="btn btn-primary darkGreen">
                                   Registruotis
                                </button>

                            <div class="right">
                                @guest
                                    @if (Route::has('login'))
                                    Jau turite paskyrą?
                                        <a class="a-button" href="{{ url('login') }}">Prisijunkite</a>
                                    @endif
                                @endguest
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
