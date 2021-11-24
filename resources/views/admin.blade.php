@extends('header')
@section('content')

<div style="width: 40%; margin: auto; text-align: right;">
    <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{ url('/') }}"><button style="cursor: pointer;">Atgal</button></a>
</div>
<div style="text-align: center;" class="container-center">
    <table>
    
        <tr>
            <td>Id</td>
            <td>Vardas</td>
            <td>Email</td>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user['id']}}</td>
            <td>{{$user['name']}}</td>
            <td>{{$user['email']}}</td>
            <td>
             <a href="{{ route('showUser',  ['userid' => $user->id,]) }}"><button style="cursor: pointer;">Daugiau</button></a>
            </td>
        </tr>
        @endforeach
    </table>
    
                      
                            

</div>
@endsection