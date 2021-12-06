@extends('header')
@section('content')
<!DOCTYPE html>

<div style="width: 50%; margin: auto; text-align: right;">
    <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{ url('/') }}"><button style="cursor: pointer;">Atgal</button></a>
</div>
<div style="text-align: center;" class="container-center-admin">
    <table class="testListTable">
    
        <tr>
            <td>Id</td>
            <td>Vardas</td>
            <td>Pavardė</td>
            <td>Email</td>
            <td></td>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user['id']}}</td>
            <td>{{$user['name']}}</td>
            <td>{{$user['surname']}}</td>
            <td>{{$user['email']}}</td>
            <td>
             {{-- <a href="{{ route('showUser',  ['userid' => $user->id,]) }}"><button style="cursor: pointer;">Daugiau</button></a> --}}

             @if(Auth::user()->role == 1)
                @if($user->is_blocked == 1)
                    <a href="{{ route('status', ['id' => $user->id, 'status_code'=>0]) }}" class="btn">
                        <button style="color: red;"><strong>Blokuoti</strong></button>
                    </a>
                @else
                    <a href="{{ route('status', ['id' => $user->id, 'status_code'=>1]) }}" class="btn">
                        <button>Atblokuoti</button>
                    </a>
                
                @endif
            @endif

            </td>
        </tr>
        @endforeach
    </table>
    
                      
                            

</div>
@endsection
</body>
</html>