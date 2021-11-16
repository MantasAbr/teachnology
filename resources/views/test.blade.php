

<h1>
    Testo spendimo baigimo puslapis
</h1>
<div>
    <h4>(Testo įvertinimas)</h4>
    <h4>(Komentaro palikimas??)</h4>
    @if($howmuch > $kelintas)
@foreach($questions as $quest)

    <div>
        <p>Klausimas - <b>
        {{ $quest->question }}
    </div>
    @endforeach
    <div>
        <p>Atsakymo variantai</p>
    </div>
    <form method="POST" action="{{ route('testdov2', ['idTest' => $id, 'kelintas'=>$kelintas]) }}"  id="dynamic_form" enctype="multipart/form-data">
        @csrf
    @foreach($answers as $quest)

        <div>
            {{ $quest->answer }}
            <td><input type="checkbox" placeholder="Ar teisingas" name="is_Correct[]" class="form-control" /></td>
        </div>
    @endforeach
        <input type="submit"  name="save" id="save" class="btn btn-success" value ="Sekantis" />
    </form>

    @else
    <div></div>
    <td><a href="{{ url('testsList') }}">Baigti testą</a></td>
</div>
@endif
