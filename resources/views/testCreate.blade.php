@extends('header')
@section('content')
<div class="container-center">
    <div class="row justify-content-center">
    <h1 style="text-align: center;">
    Naujo testo kūrimas
</h1>
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">Sukurti testą</div> -->
                <div class="card-body">
                    <form method="post" action="{{route('poststore')}}" enctype="multipart/form-data">
                        <div class="form-group">
                            @csrf
                            <label class="label">Testo pavadinimas: </label><br>
                            <input placeholder="Testo pavadinimas" type="text" name="testName" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label class="label">Testo lygis </label><br>
                            <!-- <input placeholder="Testo lygis"  type="text" name="category" class="form-control" required/> -->
                            <select name="category" placeholder="Testo lygis">
                                @foreach($category as $cat)
                                    <option value="{{$cat->name}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Informacija: </label><br>
                            <textarea placeholder="Testo informacija" name="info" class="form-control" required></textarea>
                        </div>
                       

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" />
                            <a href="{{ route('posts') }}" class="btn btn-primary">Grįžti</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
