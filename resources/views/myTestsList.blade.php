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
                <th>Testo pavadinimas</th>
                <th>Kategorija</th>
                <th>Show post</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    @if(Auth::user()->username == $post->username)
                        <tr>
                            <td>{{ $post->testName }}</td>
                            @if($post->Category_idCategory == 1)
                                <td>Elementary school</td>
                            @endif
                            @if($post->Category_idCategory == 2)
                            <td>Middle school</td>
                            @endif
                            <td>
                                <a href="{{ route('postshow', $post->idTest) }}" class="btn btn-primary">Show post</a>
                            </td>
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
        <li><a href="{{route('testcreate')}}">Sukurti naują testą</a></li>
        <li><a href="{{ url('testStatistics') }}">Pasirinkto testo statistika</a></li>
    </ul>
    <td><a href="{{ url('/') }}">Atgal</a></td>
</div>
@endsection
