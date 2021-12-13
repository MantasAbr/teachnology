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

<div class="pageContainer">
    <div class="selectedTestSplashContainer">
        <h4 class="selectedTestSplashText">Pasirinkto testo informacija</h4>


        <div style="display: flex; flex-direction: row;">
        @if(Auth::user()->id == $post->User_idUser)
            <a style="height: 40px; margin-top:auto; margin-bottom: auto;">
                {!! Form::open(['action' => ['App\Http\Controllers\PostController@destroy',$post->idTest],
                                        'method'=>'POST']) !!}
                @csrf
                {{Form::hidden('_method','DELETE')}}

                {{Form::submit('Ištrinti', ['class'=>'deleteButton'])}}
                {!! Form::close() !!}
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{ route('postedit', $post->idTest) }}"><button style="cursor: pointer;">Redaguoti</button></a>
            @endif
            </a>

            <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{ url('testsList') }}"><button style="cursor: pointer;">Atgal</button></a>
        </div>
    </div>

    <div class="testInfoContainer">
        <p class="name"><b>{{ $post->testName }}</b></p>
        <div class="hairline"></div>

        @if($post->Category_idCategory == 1)
            <p>Lygis - <b>1-4 klasės</b></p>
            @elseif ($post->Category_idCategory == 2)
                <p>Lygis - 5-8 klasės<b></b></p>
                @elseif ($post->Category_idCategory == 3)
                    <p>Lygis - 9-10 klasės<b></b></p>
                    @elseif ($post->Category_idCategory == 4)
                        <p>Lygis - 11-12 klasės<b></b></p>
                        @elseif ($post->Category_idCategory == 5)
                            <p>Lygis - aukštasis<b></b></p>
        @endif

        <div style="text-align: left;">
            @if(Auth::User()->premiumEnds > Carbon\Carbon::now())
            @if($post->ratingSum == null)
                <p style="margin-bottom: 0px;">Įvertinimas - <b><span style="color: red;">Testo dar niekas nesprendė. Būk pirmas!<span></b></p>
            @endif

            @if($post->ratingSum != null)

            <div>
                <p style="float: left; margin-bottom: 0px;">Įvertinimas - <b><?php/* echo round($avarage, 2) */?></b></p>
                <div class="Stars" style="--rating: {{ round($avarage, 2)}};" aria-label="Rating is 2.3 out of 5">
                </div>
            </div>

            @endif
            @if($post->ratingSum == null)
                <p style="float: left; width: 100%;">Kiek kartų įvertinta - <b><span style="color: red;">Testo dar niekas nesprendė. Būk pirmas!<span></b></p>
            @else
                <p style="float: left; width: 100%;">Kiek kartų įvertinta  - <b>{{ $post->ratingCount }}</b></p>
            @endif
            @if($post->completedCount == null)
            <p>Išspręsta kartų - <b><span style="color: red;">Testo dar niekas nesprendė. Būk pirmas!<span></b></p>
            @endif
            @if($post->completedCount != null)
                <p>Išspręsta kartų - <b>{{ $post->completedCount }}</b></p>
            @endif
            @else
                <p> <b><span style="color: red;" >Nori matyti statistiką? Įsigyk premium funkcionalumą<span></b></p>
     @endif
        </div>
        <p>Testo kūrėjas  - <b>{{ $name }}</b> <b>{{$surname }}</b></p>
        <div class="hairline"></div>
        <p class="infoHeader">Aprašymas</p>
            <p class="info"><b>{{ $post->info }}</b><p>
        @if($post->Category_idCategory == 1)
        @endif

        <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{ route('testdo', ['idTest' => $post->idTest, 'kelintas'=>$kelintas = 0]) }}"><button class="testProceedButton">Pradėti testą</button></a>




        <form  method="post" action="{{ route('addComment', ['idTest' =>  $post->idTest, 'idUser' => Auth::user()->id] ) }}">
        @csrf
		<h1>Rašyti komentarą</h1>
        <label>Komentaras:  </label><br>
        <textarea type="text" class="textarea" name="komentaras" placeholder="Įrašykite komentarą" Required></textarea>
        <br>
        <button class="btn btn-primary" style="margin-top: 20px">Siųsti</button>
        </form>

        <table>

        <tr>
            <td>Komentarai</td>


        </tr>
        @foreach($comments as $comment)
        <tr>
        <form method="POST" action="{{ route('updateComment',  ['idTest' => $post->idTest, 'idComment' => $comment->idComment]) }}">
            @csrf
            <td>
                <div style="text-align: center;">

                    @if (Auth::user()->id == $comment->User_idUser || Auth::user()->role == 1)
                        <span class="delete-comm"><a href="{{ route('deleteComment',  [ 'idTest' => $post->idTest, 'idComment' => $comment->idComment]) }}"><i class="fas fa-trash-alt"></i></a></span>
                        @if (Auth::user()->id == $comment->User_idUser)
                        <span class="edit-comm"><a id="Edit{{$comment['idComment']}}" onclick="EditComment({{$comment['idComment']}})"><i class="fas fa-pen"></i></a></span>

                        {{-- <span class="save-comm"><a ><i class="fas fa-save"></i></a></span> --}}
                        @endif
                    @endif
                    @if (Auth::user()->id != $comment->User_idUser)
                        <span class="delete-comm"><a style="color: #E4EFE7;">.</a></span>
                        <span class="delete-comm"><a style="color: #E4EFE7;">.</a></span>
                    @endif

                    <textarea class="textarea" id="{{$comment['idComment']}}" name="comment" autofocus placeholder="Komentaras" disabled>{{$comment['comment']}}</textarea>
                    @if (Auth::user()->id == $comment->User_idUser)

                    <button id="Save{{$comment['idComment']}}" type="submit" class="btn btn-primary darkGreen" style="display: none; margin-top: 5px; margin-bottom: 0;"> Saugoti </button>
                    @endif

                </div>
            </td>
            {{-- @if (Auth::user()->id == $comment->User_idUser)
            <td><button id="Save{{$comment['idComment']}}" type="submit" class="btn btn-primary darkGreen" style="display: none;"> Saugoti </button> </td>
            @endif --}}
        </form>
        </tr>
        @endforeach
    </table>
    </div>

</div>
</body>
<script>
    function EditComment($id){
        document.getElementById($id).disabled = false;
        document.getElementById('Edit'+$id).style.display= "none";
        document.getElementById('Save'+$id).style.display = "initial";
    }
</script>
</html>
