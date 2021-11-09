@extends('header')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<div class="container-center">
    <div class="row justify-content-center">
    <h1 style="text-align: center;">
    Naujo testo kūrimas
</h1>
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">Sukurti testą</div> -->
                <div class="card-body">
                    <form method="POST" action="{{route('poststore')}}"  id="dynamic_form" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="label">Testo pavadinimas: </label><br>
                            <input placeholder="Testo pavadinimas" type="text" name="testName" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label class="label">Testo lygis </label><br>
                            <!-- <input placeholder="Testo lygis"  type="text" name="category" class="form-control" required/> -->
                            <select name="category" placeholder="Testo lygis">
                                @foreach($category as $cat)
                                    <option value="{{$cat->idCategory}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="label">Informacija: </label><br>
                            <textarea placeholder="Testo informacija" name="info" class="form-control" required></textarea>
                        </div>

<!-------------- -------------------------------------------------->

                                <!---<form method="post" id="dynamic_form">--->
                                    <span id="result"></span>
                                    <table class="table table-bordered table-striped" id="user_table">
                                        <thead>
                                        <tr>
                                            <th width="35%">Klausimas</th>
                                            <th width="35%">Svoris</th>
                                            <th width="30%">Veiksmas</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                        <input type="submit"  name="save" id="save" class="btn btn-success" value ="Save" />

                    </form>

                        <script>
                            $(document).ready(function(){

                                var count = 1;

                                dynamic_field(count);

                                function dynamic_field(number)
                                {
                                    html = '<tr>';
                                    html += "Klausimas";
                                    html += '<td><input type="text" name="question[]" class="form-control" />Atsakymas</td>';
                                    html += '<td><input type="text" name="weight[]" class="form-control" />Tesingumas</td>';

                                    html += '<tr><td><input type="text" placeholder="Atsakymas" name="answer[]" class="form-control" /></td>';
                                    html += '<td><input type="checkbox" placeholder="Ar teisingas" name="is_Correct[]" class="form-control" /></td>';
                                    html += '<tr><td><input type="text" placeholder="Atsakymas" name="answer[]" class="form-control" /></td>';
                                    html += '<td><input type="checkbox" placeholder="Ar teisingas" name="is_Correct[]" class="form-control" /></td>';
                                    html += '<tr><td><input type="text" placeholder="Atsakymas" name="answer[]" class="form-control" /></td>';
                                    html += '<td><input type="checkbox" placeholder="Ar teisingas" name="is_Correct[]" class="form-control" /></td>';
                                    html += '<tr><td><input type="text" placeholder="Atsakymas" name="answer[]" class="form-control" />Klausimas</td>';
                                    html += '<td><input type="checkbox" placeholder="Ar teisingas" name="is_Correct[]" class="form-control" />Svoris</td>';
                                    if(number > 1)
                                    {
                                       // html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                                        $('tbody').append(html);
                                    }
                                    else
                                    {
                                        html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                                        $('tbody').html(html);
                                    }
                                }

                                $(document).on('click', '#add', function(){
                                    count++;
                                    dynamic_field(count);
                                });

                                $(document).on('click', '.remove', function(){
                                    count--;
                                    $(this).closest("tr").remove();
                                });

                                $('#dynamic_form').on('submit', function(event){
                                    $.ajax({
                                        url:'{{ route("poststore") }}',
                                        method:'post',
                                        data:$(this).serialize(),
                                        dataType:'json',
                                        success:function(data)
                                        {
                                            if(data.error)
                                            {
                                                var error_html = '';
                                                for(var count = 0; count < data.error.length; count++)
                                                {
                                                    error_html += '<p>'+data.error[count]+'</p>';
                                                }
                                                $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                                            }
                                            else
                                            {
                                                dynamic_field(1);
                                                $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                                            }
                                        }
                                    })
                                });

                            });
                        </script>
                        <!-------------- -------------------------------------------------->

                        <div class="form-group">
                           <!---
                            <input type="submit"  name="save" id="save" class="btn btn-success" > --->
                            <a href="{{ route('posts') }}" class="btn btn-primary">Grįžti</a>
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
