<h1>
    Naujo testo kūrimas
</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sukurti testą</div>
                <div class="card-body">
                    <form method="post" action="{{route('poststore')}}" enctype="multipart/form-data">
                        <div class="form-group">
                            @csrf
                            <label class="label">Testo pavadinimas: </label>
                            <input placeholder="Testo pavadinimas" type="text" name="testName" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="label">Informacija: </label>
                            <input placeholder="Testo informacija" type="text" name="info" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="label">Testo lygis </label>
                            <input placeholder="Testo lygis"  type="text" name="category" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" />
                            <a href="{{ route('posts') }}" class="btn btn-primary">Grįžti</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
