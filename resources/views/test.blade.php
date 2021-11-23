<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TeachNology</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/styles.css" rel="stylesheet">

</head>
<body>

<div>
    @if($howmuch > $kelintas)
    @foreach($questions as $quest)

    <div class="questionPageContainer">
        <div class="questionPageContainerHeader">
            <p><span class="questionNumber">{{ $kelintas + 1}} Klausimas </span></p>
            <p style="margin-top: auto; margin-bottom: auto; padding-top: 2px;">
            <b style="color: #064420;">Vertė: 
            <span style="color: orange;"><?php echo substr($questionsWeight, 1, -1);?> tašk.</span></b></p>
        </div>

        <div class="hairline"></div>

        <p class="questionText">{{ $quest->question }}</p>

    @endforeach
        <form class="form" method="POST" action="{{ route('testansw', ['idTest' => $id, 'kelintas'=>$kelintas]) }}"  id="dynamic_form" enctype="multipart/form-data">
            @csrf
            <table>
                @foreach($answers as $quest)
                <tbody class="questionContainer">
                    <tr class="questionRow">
                        <td>{{ $quest->answer }}</td>
                        <td><input type="checkbox" class="checkbox" name="is_Correct[{{$quest->idAnswers}}]" value="1" /></td>
                    </tr>
                    <input type="hidden" name="score" value = {{$score}} />
                    <input type="hidden" name="correct" value = {{$correct}} />
                </tbody>
                @endforeach
            </table>
            <input type="submit" name="save" id="save" class="checkAnswerButton" value ="Patikrinti" />
        </form>

        
        <script type=text/javascript>
            var checkboxes = $("input[type='checkbox']"),
                submitButt = $("input[type='submit']");
            submitButt.attr("disabled", !checkboxes.is(":checked"));
            checkboxes.click(function() {
                submitButt.attr("disabled", !checkboxes.is(":checked"));
            });
        </script>
    </div>

    @else
        <h1>
            Testo spendimo baigimo puslapis
        </h1>
    <div> <h4>(Testo įvertinimas)</h4></div>
        <div>  Jūsų pažymys: <?php echo $mark ?></div>

        <li class="list"><a class="premium"><button class="premium">Įvertinti testą</button></a></li>
        <div id="modal" class="modal">
            <div class="modal-container">
                <div class="modal-box">
                    <div class="modal-header-box">
                        <button class="exit">X</button>
                        <h3 class="splash"><i style="color: orange;">Testo įvertinimas</i></h3>
                    </div>
                    <div class="hairline"></div>
                    <form action="{{ route('testdn',['id' => $id, 'mark'=>$mark])}}"  id="dynamic_form" enctype="multipart/form-data">
                        @csrf
                    <select name="stars" placeholder="Testo lygis">
                        @for($i = 1; $i < 6; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                        <input type="submit" name="save" id="save" class="submit" value ="Įvertinti" />

                </div>
            </div>
        </div>

        <script type=text/javascript>
            $("button").click(function(){
                $("#modal").toggleClass('modal');
            });
        </script>
    <td><a href="{{ route('testdn',['id' => $id, 'mark'=>$mark]) }}">Išeiti</a></td>
</div>
@endif
</body>
</html>



