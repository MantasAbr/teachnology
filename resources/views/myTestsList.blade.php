@extends('header')
@section('content')
<h1>
    Mano testų sąrašas
</h1>

<div >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                <th>id</th>
                <th>Pavadinimas</th>
                <th>Info</th>
                <th>Kategorija</th>
                <th>Reitingas</th>
                <th>Kartų spręsta</th>
                <th>color</th>
                <th>Kartų įvertinta</th>
                <th>Show post</th>
                <th>Post editor</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    @if(Auth::user()->username == $post->username)
                        <tr>
                            <td>{{ $post->idTest }}</td>
                            <td>{{ $post->testName }}</td>
                            <td>{{ $post->info }}</td>
                            <td>{{ $post->Category_idCategory }}</td>
                            <td>{{ $post->ratingSum }}</td>
                            <td>{{ $post->completedCount }}</td>
                            <td>{{ $post->ratingCount }}</td>
                            <td>{{ $post->User_idUser }}</td>
                            <td>
                                <a href="{{ route('postshow', $post->idTest) }}" class="btn btn-primary">Show post</a>
                            </td>
                            <td>

                                <a> {!! Form::open(['action' => ['App\Http\Controllers\PostController@destroy',$post->idTest],
                                'method'=>'POST']) !!}
                                    @csrf
                                    {{Form::hidden('_method','DELETE')}}

                                    {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                    {!! Form::close() !!}
                                </a>

                            <td>
                                <a href="{{ route('postedit', $post->idTest) }}" class="btn btn-warning">Edit</a>
                            </td>
                            @endif

                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div>
    <h4>(Testo šalinimas)</h4>
    <ul>
        <li><a href="{{ url('testCreate') }}">Sukurti naują testą</a></li>
        <li><a href="{{ url('testEdit') }}">Redaguoti pasirinktą testą</a></li>
        <li><a href="{{ url('testStatistics') }}">Pasirinkto testo statistika</a></li>
        <li><a href="{{ url('testInfo') }}">Testo informacijos peržiūra(testo pradėjimui)</a></li>
    </ul>
    <td><a href="{{ url('/') }}">Atgal</a></td>
</div>
@endsection
