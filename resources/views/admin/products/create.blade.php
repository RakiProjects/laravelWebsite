@extends("admin.layouts.templateAdmin1")

@section('title')
Dodaj proizvod
@endsection
@section('content')
<div class="container text-center">
@if(session('message'))
        <div class="alert alert-info mt-4" role="alert">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    <div class="row">
        <div class="col-lg-4 mt-5 offset-md-3">
            <h3>Dodaj proizvod</h3>
            <form action="{{url('admin/proizvodi')}}" method="POST" enctype="multipart/form-data" class="mt-3">
                {{csrf_field()}}
                <div class="control-group form-group ">
                    <div class="controls">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Naziv">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                    <textarea rows="3" cols="100" class="form-control" id="description" name="description" placeholder="description" maxlength="999" style="resize:none"></textarea>
                    </div>
                </div>          
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="picture">Slika: </label>
                        <input type="file" name="picture" id="picture"/>   
                     </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                    <input type="text" class="form-control" id="alt" name="alt" placeholder="Opis slike">
                    </div>
                </div>
                <div class="control-group form-group ">
                    <div class="controls">
                        <input type="text" class="form-control" id="size" name="size" placeholder="Veličina">
                    </div>
                </div>
                <div class="control-group form-group ">
                    <div class="controls">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Cena">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Dodaj</button>
            </form>
        </div>
    </div>
    <!-- /.row -->
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection