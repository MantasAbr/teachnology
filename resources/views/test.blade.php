<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TeachNology</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/styles.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">  

</head>
<body>

<div>
    @if($howmuch > $kelintas)
    @foreach($questions as $quest)

    <div class="questionPageContainer">
        <div class="questionPageContainerHeader">
            <p><span class="questionNumber">{{ $kelintas + 1}} klausimas </span></p>
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
                        <td><label class="checkbox-container"><input type="checkbox" name="is_Correct[{{$quest->idAnswers}}]"  value="1"><span class="checkmark"></span></label></td>

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
    <div class="questionPageContainer">
        <p class="endingHeaderText">Testo sprendimo baigimo puslapis</p>
        <div class="hairline"></div>

        <div class="gradeInfo">
            <span style="color: #064420;">Jūsų pažymys:</span>
            
            @if ($mark < 4)
                <span style="color: red;"><?php echo round($mark, 2)?><span style="color: #064420;">. Nepasisekė... Bandykite dar kartą.</span></span>
                <br>
                <img style="margin-top: 10px; width: 300px;" src="/img/feedback/frog.gif"/> 
                @endif
            @if ($mark >= 4 && $mark < 8)
                <span style="color: orange;"><?php echo round($mark, 2)?></span>
                <br>
                <img style="margin-top: 10px" src="/img/feedback/8.gif" /> 
            @endif
            @if ($mark >= 8 && $mark != 10)
                <span style="color: #064420;"><?php echo round($mark, 2)?></span>
                <br>
                <img style="margin-top: 10px; width: 300px;" src="/img/feedback/bravo-clap.gif" /> 
            @endif
            @if ($mark == 10)
                <span style="color: #064420;"><?php echo round($mark, 2)?>. <span style="color: orange;">Šaunu!</span></span>
                <br>
                <img style="margin-top: 10px; width: 300px;" src="/img/feedback/clapping-applause.gif"/> 

            @endif
            
        </div>

        <div class="testCompletionButtonContainer">
            <a class="premium"><button class="premium" id="open">Įvertinti testą</button></a>
            <a class="premium" href="{{ route('testdn',['id' => $id, 'mark'=>$mark]) }}"><button class="premium">Išeiti</button></a>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-container">
            <div class="modal-box-rating" style="margin-top: -100px;">
                <div class="modal-header-box">
                    <a class="premium" href="{{ route('testdn',['id' => $id, 'mark'=>$mark]) }}"><button class="exit">X</button></a>
                    <h3 class="splash">Testo įvertinimas</h3>
                </div>
                <div class="hairline"></div>
                <form action="{{ route('testdn',['id' => $id, 'mark'=>$mark])}}"  id="dynamic_form" enctype="multipart/form-data">
                    <div class="modalOptions starss">
                        @csrf
                        <select name="stars" placeholder="Testo lygis" style="width: 300px;">
                            <option value="1">&#9733;</option>
                            <option value="2">&#9733;&#9733;</option>
                            <option value="3">&#9733;&#9733;&#9733;</option>
                            <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                            <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                        </select>
                        <div style="padding-top: 50px;"></div>
                        <input type="submit" name="save" id="save" class="submit" value ="Įvertinti" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type=text/javascript>
        $("#open").click(function(){
            $("#modal").toggleClass('modal');
        });
    </script>
</div>
@endif
</body>
</html>