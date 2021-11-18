

<h1>
    Testo spendimo baigimo puslapis
</h1>
<div>
    <h4>(Komentaro palikimas??)</h4>
    @if($howmuch > $kelintas)
@foreach($questions as $quest)

    <div>
        <p>Klausimas - <b>
        {{ $quest->question }}
    </div>
            <div>
                <p>Klausimo vertė - <b>
                {{ $questionsWeight }}
            </div>
    @endforeach
    <div>
        <p>Atsakymo variantai</p>
    </div>
    <form method="POST" action="{{ route('testansw', ['idTest' => $id, 'kelintas'=>$kelintas]) }}"  id="dynamic_form" enctype="multipart/form-data">
        @csrf
    @foreach($answers as $quest)

        <div>
            {{ $quest->answer }}
            <td><input type="checkbox" name="is_Correct[{{$quest->idAnswers}}]" class="form-control" value="1" /></td>
            <input type="hidden" name="score" value = {{$score}} />
            <input type="hidden" name="correct" value = {{$correct}} />
        </div>
    @endforeach
        <input type="submit"  name="save" id="save" class="btn btn-success" value ="Patikrinti" />
    </form>

    @else
    <div> <h4>(Testo įvertinimas)</h4></div>
        <div>  Jūsų pažymys: <?php echo $mark ?></div>
    <td><a href="{{ url('testsList') }}">Baigti testą</a></td>
</div>
@endif


