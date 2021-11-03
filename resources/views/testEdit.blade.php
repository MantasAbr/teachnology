<h1>
    Pasirinkto testo redagavimas
</h1>


<div class="col-md-8 offset-2">
    {!! Form::open(['action' => ['App\Http\Controllers\PostController@update',$post->idTest], 'method'=>'POST']) !!}
    @csrf
    {{Form::hidden('_method','PATCH')}}

    <div class="form-group">
        {{Form::label('testName', 'Testo pavadinimas')}}
        {{Form::text('testName', $post->testName, ['class' => 'form-control', 'placeholder' => 'Testo pavadinimas'])}}
    </div>
    <div class="form-group">
        {{Form::label('info', 'Testo informacija')}}
        {{Form::text('info', $post->info, ['class' => 'form-control', 'placeholder' => 'Testo informacija'])}}
    </div>
    <div class="form-group">
        {{Form::label('Category_idCategory', 'Testo lygis')}}
        {{Form::text('Category_idCategory', $post->Category_idCategory, ['class' => 'form-control', 'placeholder' => 'Testo lygis'])}}
    </div>


    {{ Form::submit('Redaguoti', ['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}
    <br><a href="{{ route('posts') }}" class="btn btn-primary">Grįžti atgal</a><br>
</div>
