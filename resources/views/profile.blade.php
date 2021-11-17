@extends('header')
@section('content')

<div class="container-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            @csrf
                            <label class="label">Naudotojo vardas </label><br>
                            <td>{{ $usersProfile->name}}</td><br>  
                            <br>
                            <label class="label">El. paštas </label><br>
                            <td>{{ $usersProfile->email}}</td><br>
                            <br>
                            <label class="label">Slaptažodis </label><br>
                            <td>{{ $usersProfile->password}}</td><br>
                            <br>
                            <label class="label">Pakartoti slaptažodį </label><br>
                            <td>{{ $usersProfile->password}}</td><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        
<div>
    <h4>(Redaguoti)</h4>
    <ul>
        <li><a href="{{ url('followingList') }}">Sekamų naudotojų sąrašas</a></li>
    </ul>  
    <td><a href="{{ url('/') }}">Atgal</a></td>
</div>
@endsection