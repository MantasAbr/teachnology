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
        <p>Lygis - <b>Elementary school</b></p>
        @if($post->Category_idCategory == 2)
            <p>Lygis - <b>Middle school</b></p>
        @endif
        @if($post->ratingSum == null)
            <p>Įvertinimas - <b><span style="color: red;">Testo dar niekas nesprendė. Būk pirmas!<span></b></p>
        @endif
        @if($post->ratingSum != null)
        <p>Įvertinimas - <b>{{ $avarage  }}</b></p>
        @endif
        @if($post->completedCount == null)
        <p>Išspręsta kartų - <b><span style="color: red;">Testo dar niekas nesprendė. Būk pirmas!<span></b></p>
        @endif
        @if($post->completedCount != null)
            <p>Išspręsta kartų - <b>{{ $post->completedCount }}</b></p>
        @endif
        <div class="hairline"></div>
        <p class="infoHeader">Informacija</p>
            <p class="info"><b>{{ $post->info }}</b><p>
        @if($post->Category_idCategory == 1)
        @endif

        <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{ route('testdo', ['idTest' => $post->idTest, 'kelintas'=>$kelintas = 0]) }}"><button class="testProceedButton">Pradėti testą</button></a>
        

        
  
        <form  method="post" action="{{ route('addComment', ['idTest' =>  $post->idTest, 'idUser' => Auth::user()->id] ) }}">
        @csrf 
		<h1>Rašyti komentarą</h1><br>
        <label>Komentaras:  </label>
        <textarea type="text" name="komentaras"  Required></textarea>	
        <br>
        <button class="btn btn-primary" style="margin-left:120px; border: solid 1px;">Siųsti</button>
        </form> 
       
        <table>
    
        <tr>
            <td>Komentaras</td>
         
            
        </tr>
        @foreach($comments as $comment)
        <tr>
        <form method="POST" action="{{ route('updateComment',  ['idTest' => $post->idTest, 'idComment' => $comment->idComment]) }}">
            @csrf
            <td>
                <textarea id="{{$comment['idComment']}}" name="comment" autofocus placeholder="Komentaras" disabled>{{$comment['comment']}}</textarea>
            </td>
            @if (Auth::user()->id == $comment->User_idUser)
            <td><button id="Save{{$comment['idComment']}}" type="submit" class="btn btn-primary darkGreen" style="display: none;"> Saugoti </button> </td>
            @endif
        </form>   

            @if (Auth::user()->id == $comment->User_idUser)
            <td> <button id="Edit{{$comment['idComment']}}" onclick="EditComment({{$comment['idComment']}})"> Redaguoti </button> </td>
            <td>
             <a href="{{ route('deleteComment',  [ 'idTest' => $post->idTest, 'idComment' => $comment->idComment]) }}"><button style="cursor: pointer;">Ištrinti</button></a>
            </td>
            @endif
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
