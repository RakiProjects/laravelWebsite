@extends("admin.layouts.templateAdmin1")

@section('title')
Ažuriranje slike
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
            <h3 class="mb-5">Ažuriranje slike</h3>
            <form action='{{route("galerija.update", ["id"=> $picture->id])}}' method="POST" enctype="multipart/form-data" class="mt-3">
                {{csrf_field()}}
                @method('PUT')
                <input type="hidden" value="{{$picture->src}}" name="oldSrc"/>
                <div class="control-group form-group">
                    <div class="controls">
                    <label>Model:</label>
                        <select name="model"  class="mb-3">
                        <option value="{{$picture->model}}" selected>{{$picture->model}}</option>
                        @foreach($models as $model)
                            <option value="{{$model->name}}">{{$model->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="picture"  class="mb-3">Slika: </label>
                        <input type="file"  class="mb-3" name="picture" id="picture"/>   
                     </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                    <input type="text" class="form-control" id="alt" name="alt" value="{{$picture->alt}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Ažuriraj</button>
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