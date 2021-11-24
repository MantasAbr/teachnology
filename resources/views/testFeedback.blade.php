<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TeachNology</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">

</head>
<body>

<div class="questionPageContainer">
    @foreach($questions as $quest)

    <div class="questionPageContainerHeader">
        <p><span class="questionNumber">{{ $kelintas + 1}} klausimo grįžtamasis ryšys</span></p>
        <p style="margin-top: auto; margin-bottom: auto; padding-top: 2px;">
        <b style="color: #064420;">Vertė:
        <span style="color: orange;"><?php echo substr($questionsWeight, 1, -1);?> tašk.</span></b></p>
    </div>

    <div class="hairline"></div>

    <p class="questionText">{{ $quest->question }}</p>

    @endforeach

    <table class="answerListTable">
        <thead>
            <th>Atsakymai</th>
            <th>Teisingi atsakymai</th>
        </thead>
        <tbody>
        <form  method="POST" action="{{ route('testdov2', ['idTest' => $id, 'kelintas'=>$kelintas]) }}"  id="dynamic_form" enctype="multipart/form-data">
            @csrf
            @foreach($answers as $quest)
                    <tr>
                        <td>   {{ $quest->answer }}</td>
                        @foreach($goodid as $ansID)
                        @if($ansID == $quest->idAnswers)
                            <td><span style="color: #064420;"class="material-icons">done</span></td>
                        @endif


                @endforeach
                </tr>
            @endforeach
            </tbody>
    </table>
    <div class="answerFooter">
        @if($bad == 1)
            <p style="color: red;">Jūs negavote taškų</p>
        @else
            <p>Jūs gavote <?php echo substr($questionsWeight, 1, -1);?> tašk.</p>
        @endif
            <input type="hidden" name="score" value = {{$score}} />
            <input type="hidden" name="correct" value = {{$correct}} />
            @if($howmuch > $kelintas + 1)
                <input class="checkAnswerButton" type="submit"  name="save" id="save" class="btn btn-success" value ="Sekantis" />
            @else
                <input class="checkAnswerButton" type="submit"  name="save" id="save" class="btn btn-success" value ="Baigti testą" />
            @endif
        </form>
    </div>
    <div style="padding: 20px 0px;"></div>
    </div>
</body>
</html>
