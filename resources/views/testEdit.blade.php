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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    </head>
    <body style="margin-top: 0px;">

        <div class="pageContainer edit-test">
            <div class="selectedTestSplashContainer">
                <h1>
                    Testo redagavimas
                </h1>
                <div style="display: flex; flex-direction: row;">


                    <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{ route('postshow', $post->idTest) }}" class="btn btn-primary"><button style="cursor: pointer;">Atgal</button></a><br>
                    {!! Form::close() !!}<br>


                </div>
            </div>

           
            <div class="testInfoContainer testInfoContainer-edit">
                {!! Form::open(['action' => ['App\Http\Controllers\PostController@update',$post->idTest], 'method'=>'POST']) !!}
                @csrf
                {{Form::hidden('_method', 'PATCH')}}

              

                <div class="edit">
                    {{Form::label('testName', 'Testo pavadinimas')}}
                    <br>
                    {{Form::text('testName', $post->testName, ['class' => 'form-control', 'placeholder' => 'Testo pavadinimas'])}}
                </div>
                    

                <div class="edit">
                    {{Form::label('info', 'Testo informacija')}}
                    <br>
                    {{Form::text('info', $post->info, ['class' => 'form-control', 'placeholder' => 'Testo informacija'])}}
                </div>

                <div class="form-group" style="width: 30%; margin: auto;">
                    {{ Form::submit('Saugoti', ['class'=>'a-button'])}}
                </div>
            </div>
        </div>
    </body>
</html>