@extends('header')
@section('content')
<h1>
    Bendra naudotojų ir testų statistika
</h1>
<th>Top 5 geriausiai įvertinti testai</th>
<table>
    <thead>
    <th>Testo pavadinimas</th>
    <th>Įvertinimas</th>
    </thead>
    <tbody>
    @foreach($results as $result)
<tr>
    <td>{{$result->testName}}</td>
    @if($result->ratingSum > 0)
    <td><?php echo round($result->ratingSum / $result->ratingCount, 2) ?> </td>
    @else
    <td>0</td>
        @endif
</tr>
    @endforeach
    </tbody>
</table>

<th>Top 5 daugiausiai kartų spręsti testai</th>
<table>
    <thead>
    <th>Testo pavadinimas</th>
    <th>Kiek kartų spręsta</th>
    </thead>
    <tbody>
    @foreach($complet as $comple)
    <tr>
        <td>{{$comple->testName}}</td>
        <td>{{$comple->completedCount}}</td>
    </tr>
    @endforeach
    </tbody>
</table>

<th>Top 5 aktyviausi vartotojai</th>
<table>
    <thead>
    <th>Vartotojo vardas</th>
    <th>Kiek testų išsprendes</th>
    </thead>
    <tbody>
    @foreach($userTest as $usert)
        <tr>
            <td>{{$usert->name}}</td>
            <td>{{$usert->testCount}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<th>Top 5 protingiausi vartotojai</th>
<table>
    <thead>
    <th>Vartotojo vardas</th>
    <th>Testų pažymio vidurkis</th>
    </thead>
    <tbody>
    @foreach($userSmart as $users)
        <tr>
            <td>{{$users->name}}</td>
            @if($users->testCount > 0)
                <td><?php echo round($users->testMarkSum / $users->testCount, 2) ?> </td>
            @else
                <td>0</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
<div>
    <td><a href="{{ url('/') }}">Atgal</a></td>
</div>
@endsection
