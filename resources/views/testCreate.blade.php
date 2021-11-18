@extends('header')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
<div class="container-center container-center-test">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 style="text-align: center;">
                    Naujo testo kūrimas
                </h3>
                <!-- <div class="card-header">Sukurti testą</div> -->
                <div class="card-body">
                    <form method="POST" action="{{route('poststore')}}"  id="dynamic_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group test-name">
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
                                        {{-- <thead>
                                        <tr>
                                            <th>Klausimas</th>
                                            <th>Svoris</th>
                                            <th></th>
                                        </tr>
                                        </thead> --}}
                                        <tbody>

                                        </tbody>
                                    </table>

                        <input type="submit"  name="save" id="save" class="submit" value ="Kurti testą" />

                    </form>

                        <script>
                            $(document).ready(function(){

                                var count = 1;

                                dynamic_field(count);

                                function dynamic_field(number)
                                {
                                    html = '<tr>';
                                    
                                    html += '<td>Klausimas<input type="text" class="questionInput" name="question[]" placeholder="Klausimas"/></td>';
                                    html += '<td>Svoris<input type="number" step=0.01 min=0.1 placeholder="Svoris" name="weight[]" class="form-control" style="margin-bottom: 5px;" /></td>';
                                    html += '<td></td>';
                                    html += '<tr><td>1 atsakymo variantas<input type="text" placeholder="Atsakymas" name="answer[]" class="answer" /></td>';
                                    html += '<td><input type="checkbox" placeholder="Ar teisingas" name="is_Correct[]" class="form-control" /></td>';
                                    html += '<td></td>';
                                    html += '<tr><td>2 atsakymo variantas<input type="text" placeholder="Atsakymas" name="answer1[]"  class="answer" /></td>';
                                    html += '<td><input type="checkbox" placeholder="Ar teisingas" name="is_Correct1[]" class="form-control" /></td>';
                                    html += '<td></td>';
                                    html += '<tr><td>3 atsakymo variantas<input type="text" placeholder="Atsakymas" name="answer2[]"  class="answer" /></td>';
                                    html += '<td><input type="checkbox" placeholder="Ar teisingas" name="is_Correct2[]" class="form-control" /></td>';
                                    html += '<tr><td>4 atsakymo variantas<input type="text" placeholder="Atsakymas" name="answer3[]"  class="answer answer-last" /></td>';
                                    html += '<td><input type="checkbox" placeholder="Ar teisingas" name="is_Correct3[]" class="form-control" /></td>';
                                    html += '<td></td>';
                                   
                                    if(number > 1)
                                    {
                                        //html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                                        $('tbody').append(html);
                                    }
                                    else
                                    {
                                        html += '<td><button type="button" name="add" id="add" class="addQuestion"><i class="fas fa-plus"></i></button></td></tr>';
                                        $('tbody').append(html);
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

                                $('#dynamic_form').on('submit', function(){
                                    var this_master = $(this);

                                    this_master.find('input[type="checkbox"]').each( function () {
                                        var checkbox_this = $(this);


                                        if( checkbox_this.is(":checked") == true ) {
                                            checkbox_this.attr('value','1');
                                        } else {
                                            checkbox_this.prop('checked',true);
                                            //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA
                                            checkbox_this.attr('value','0');
                                        }
                                    })

                                });

                            });
                        </script>
                        <!-------------- -------------------------------------------------->

                        <div class="form-group-back">
                           <!---
                            <input type="submit"  name="save" id="save" class="btn btn-success" > --->
                            <a href="{{ route('posts') }}" class="back">Grįžti</a>
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
