

<h1>
    Testo feedbackas
</h1>
<div>
        @foreach($questions as $quest)

            <div>
                <p>Klausimas - <b>
                {{ $quest->question }}
            </div>
        @endforeach
            <table class="table table-striped">
            <thead>
            <th>Atsakymai</th>
            <th>Teisingi atsakymai</th>
            </thead>
                <tbody>
        <form method="POST" action="{{ route('testdov2', ['idTest' => $id, 'kelintas'=>$kelintas]) }}"  id="dynamic_form" enctype="multipart/form-data">
            @csrf
            @foreach($answers as $quest)
                <tr>

                    <td>   {{ $quest->answer }}</td>
        @foreach($goodid as $ansID)
            @if($ansID == $quest->idAnswers)
                    <td>   +</td>

                        @endif
                        @endforeach
                </tr>

                </tbody>
            @endforeach
                @if($bad == 1)
                    <tr>
                    <td> Jūs negavote taškų</td>
                    </tr>
                @else
                    <tr>
                    <td>Jūs gavote <?php echo substr($questionsWeight, 1, -1);?> tašk.</td>
                    </tr>
                @endif
                <td>
                    <input type="hidden" name="score" value = {{$score}} />
                    <input type="hidden" name="correct" value = {{$correct}} />
                    @if($howmuch > $kelintas + 1)
                <input type="submit"  name="save" id="save" class="btn btn-success" value ="Sekantis" />
                    @else
                        <input type="submit"  name="save" id="save" class="btn btn-success" value ="Baigti testą" />
                        @endif
                </td>
        </form>
        </table>

</div>

