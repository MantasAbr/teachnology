<h1>
    Testo spendimo baigimo puslapis
</h1>
<div>
    <h4>(Testo įvertinimas)</h4>
    <h4>(Komentaro palikimas??)</h4>
@foreach($questions as $quest)

    <div>
        {{ $quest->question }}
    </div>
    @endforeach
    @foreach($answers as $quest)

        <div>
            {{ $quest->answer }}
        </div>
    @endforeach
    <td><a href="{{ route('testdo', $id) }}">Sekantis</a></td>
    <div></div>
    <td><a href="{{ url('testsList') }}">Baigti testą</a></td>
</div>
