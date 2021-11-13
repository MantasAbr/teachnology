<h1>
    Pasirinkto testo informacija
</h1>
<div>
    <h4>(Testo komentarų peržiūra, rašymas, redagavimas)</h4>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>
                            <p>Testo pavadinimas - <b>{{ $post->testName }}</b></p>
                        </h3>
                        <p>Testo informacija - <b>{{ $post->info }}</b></p>
                        @if($post->Category_idCategory == 1)
                        <p>Testo lygis - <b>Elementary school</b></p>
                        @endif
                        @if($post->Category_idCategory == 2)
                            <p>Testo lygis - <b>Middle school</b></p>
                        @endif
                        @if($post->ratingSum == null)
                            <p>Testo įvertinimas - <b>Testo dar niekas nesprendė</b></p>
                        @endif
                        @if($post->ratingSum != null)
                        <p>Testo įvertinimas - <b>{{ $avarage  }}</b></p>
                        @endif
                        @if($post->completedCount == null)
                        <p>Išspręsta kartų - <b>Testo dar niekas nesprendė</b></p>
                        @endif
                        @if($post->completedCount != null)
                            <p>Išspręsta kartų - <b>{{ $post->completedCount }}</b></p>
                        @endif

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<td>
    @if(Auth::user()->username == $post->username)
    <a> {!! Form::open(['action' => ['App\Http\Controllers\PostController@destroy',$post->idTest],
                                'method'=>'POST']) !!}
        @csrf
        {{Form::hidden('_method','DELETE')}}

        {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
        {!! Form::close() !!}
    </a>

<td>
    <ul><a href="{{ route('postedit', $post->idTest) }}" class="btn btn-warning">Edit</a></ul>
    @endif
    <td><a href="{{ url('testsList') }}">Atgal į testų sąrašą</a></td>
    <ul>
        <li><a href="{{ url('test') }}">Pradėti testą</a></li>
    </ul>
</div>
