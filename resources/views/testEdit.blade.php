@extends('layouts.app')

@section('content')

<h1>
    Pasirinkto testo redagavimas
</h1>


<div class="col-md-8 offset-2">
    {!! Form::open(['action' => ['App\Http\Controllers\PostController@update',$post->idTest], 'method'=>'POST']) !!}
    @csrf
    {{Form::hidden('_method', 'PATCH')}}

    <div class="form-group">
        {{Form::label('testName', 'Testo pavadinimas')}}
        {{Form::text('testName', $post->testName, ['class' => 'form-control', 'placeholder' => 'Testo pavadinimas'])}}
    </div>
    <div class="form-group">
        {{Form::label('info', 'Testo informacija')}}
        {{Form::text('info', $post->info, ['class' => 'form-control', 'placeholder' => 'Testo informacija'])}}
    </div>

    <div class="form-group">
    {{ Form::submit('Redaguoti', ['class'=>'btn btn-primary'])}}
    </div>
    <a href="{{ route('posts') }}" class="btn btn-primary">Grįžti atgal</a><br>
    {!! Form::close() !!}<br>
</div>
@endsection
