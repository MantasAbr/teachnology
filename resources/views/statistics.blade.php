@extends('header')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TeachNology</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Styles -->
        <link href = "/css/styles.css" rel="stylesheet">
    </head>
<body>

<div class="pageCointaner statisticsTable">
    <div class="testListSplashContainer">
        <h4 class="testListSplashText">Bendra naudotojų ir testų statistika</h4>
        <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{ url('/') }}"><button style="cursor: pointer;">Atgal</button></a>
    </div>

    <div class="grid-container">
        <div class="grid-item">
            <h3>Top 5 geriausiai įvertinti testai</h3>
            <table class="testListTable">
                <thead>
                <th>Testo pavadinimas</th>
                <th>Įvertinimas</th>
                </thead>
                <tbody>
                    <span style="display: none;">{{$iteration = 1}}</span>
                    @foreach($results as $result)                    
                        <tr>
                            <td style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
                                @if ($iteration == 1)
                                    <span class="material-icons" style="color: gold;">emoji_events</span> {{$result->testName}}                            
                                @elseif ($iteration == 2)
                                    <span class="material-icons" style="color: silver;">emoji_events</span> {{$result->testName}}                               
                                @elseif ($iteration == 3)
                                    <span class="material-icons" style="color: darkgoldenrod;">emoji_events</span> {{$result->testName}}
                                @else
                                    {{$result->testName}}
                                @endif
                            </td>
                            @if($result->ratingSum > 0)
                                <td><?php echo round($result->ratingSum / $result->ratingCount, 2) ?> </td>
                            @else
                                <td>0</td> 
                            @endif
                        </tr>
                        <span style="display: none;">{{$iteration = $iteration + 1}}</span>
                        @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="grid-item">
            <h3>Top 5 daugiausiai kartų spręsti testai</h3>
            <table class="testListTable">
                <thead>
                    <th>Testo pavadinimas</th>
                    <th>Sprendimų skaičius</th>
                </thead>
                <tbody>
                    <span style="display: none;">{{$iteration = 1}}</span>
                    @foreach($complet as $comple)
                        <tr>
                            <td style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
                                @if ($iteration == 1)
                                    <span class="material-icons" style="color: gold;">emoji_events</span> {{$comple->testName}}                            
                                @elseif ($iteration == 2)
                                    <span class="material-icons" style="color: silver;">emoji_events</span> {{$comple->testName}}                               
                                @elseif ($iteration == 3)
                                    <span class="material-icons" style="color: darkgoldenrod;">emoji_events</span> {{$comple->testName}}
                                @else
                                    {{$comple->testName}}
                                @endif
                            </td>
                            <td>{{$comple->completedCount}}</td>
                        </tr>
                        <span style="display: none;">{{$iteration = $iteration + 1}}</span>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="grid-item">
            <h3>Top 5 aktyviausi naudotojai</h3>
            <table class="testListTable">
                <thead>
                    <th>Naudotojo vardas</th>
                    <th>Išspręstų testų skaičius</th>
                </thead>
                <tbody>
                    <span style="display: none;">{{$iteration = 1}}</span>
                    @foreach($userTest as $usert)
                        <tr>
                            <td style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
                                @if ($iteration == 1)
                                    <span class="material-icons" style="color: gold;">emoji_events</span> {{$usert->name}}                         
                                @elseif ($iteration == 2)
                                    <span class="material-icons" style="color: silver;">emoji_events</span> {{$usert->name}}                             
                                @elseif ($iteration == 3)
                                    <span class="material-icons" style="color: darkgoldenrod;">emoji_events</span> {{$usert->name}}
                                @else
                                    {{$usert->name}}
                                @endif
                            </td>
                            <td>{{$usert->testCount}}</td>
                        </tr>
                        <span style="display: none;">{{$iteration = $iteration + 1}}</span>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="grid-item">
            <h3>Top 5 protingiausi naudotojai</h3>
        <table class="testListTable">
            <thead>
                <th>Naudotojo vardas</th>
                <th>Testų pažymio vidurkis</th>
            </thead>
            <tbody>
                <span style="display: none;">{{$iteration = 1}}</span>
                @foreach($userSmart as $users)
                <tr>
                    <td style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
                        @if ($iteration == 1)
                            <span class="material-icons" style="color: gold;">emoji_events</span> {{$users->name}}                    
                        @elseif ($iteration == 2)
                            <span class="material-icons" style="color: silver;">emoji_events</span> {{$users->name}}                            
                        @elseif ($iteration == 3)
                            <span class="material-icons" style="color: darkgoldenrod;">emoji_events</span> {{$users->name}}
                        @else
                        {{$users->name}}
                        @endif
                    </td>
                    @if($users->testCount > 0)
                        <td><?php echo round($users->testMarkSum / $users->testCount, 2) ?> </td>
                    @else
                        <td>0</td>
                    @endif
                </tr>
                <span style="display: none;">{{$iteration = $iteration + 1}}</span>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
</body>

@endsection
</html>