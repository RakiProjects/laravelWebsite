@extends("admin.layouts.templateAdmin1")

@section('title')
Ažuriranje proizvoda
@endsection
@section('content')
<div class="container text-center">
    @if(session('message'))
    <div class="alert alert-info mt-4" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-5 mt-5 offset-md-3">
            <h3>Ažuriranje proizvoda</h3>
            <form action='{{route("proizvodi.update", ["id"=> $product->id])}}' method="POST" class="mt-3">
                {{csrf_field()}}
                @method('PUT')
                <input type="hidden" name="sizeId" value="{{($product->size_id)}}"/>             
                <div class="control-group form-group ">
                    <div class="controls">
                        <label>Naziv:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                      <label>Opis:</label>
                        <textarea rows="3" cols="100" class="form-control" id="description" name="description"
                            maxlength="999" style="resize:none">{{$product->description}}</textarea>
                    </div>
                </div>
                <div class="control-group form-group ">
                    <div class="controls">
                    <label>Velicina:</label>
                        <input type="text" class="form-control" id="size" name="size" placeholder="Veličina"
                            value="{{$product->dimensions}}">
                    </div>
                </div>
                <div class="control-group form-group ">
                    <div class="controls">
                    <label>Cena:</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Cena"
                            value="{{$product->price}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Ažuriraj</button>
            </form>         
</div>
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
    </div>

    <!-- /.row -->
  
<div class='container'>
    <div class="row">
        <div class="col-lg-7 mt-5">
            <h3>Promena slike</h3>
            <form action='{{route("updatePicture")}}' method="POST" enctype="multipart/form-data"
                class="mt-3">
                {{csrf_field()}}
                @method('PUT')
                <input type="hidden" value="{{$product->src}}" name="oldSrc"/>
                <input type="hidden" value="{{$product->picture_id}}" name="pictureId"/>
                <img class="img-fluid img-thumbnail" src="{{asset('/')}}{{$product->src}}"
                    style="width:12vw; height:5vw; object-fit: cover;">
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="picture">Slika: </label>
                        <input type="file" name="picture" id="picture" />
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                    <label>Opis slike:</label>
                        <input type="text" class="form-control" id="alt" name="alt" placeholder="Opis slike"
                            value="{{$product->alt}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Promeni sliku</button>
            </form>
        </div>
    </div>
    <!-- /.row -->
</div>
</div>
@endsection