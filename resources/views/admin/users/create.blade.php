@extends("admin.layouts.templateAdmin1")

@section('title')
Dodaj korisnika
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
            <h3>Dodaj korisnika</h3>
            <form action="{{url('admin/korisnici')}}" method="POST" class="mt-3">
                {{csrf_field()}}
                <div class="control-group form-group ">
                    <div class="controls">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Korisničko ime">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <input type="password" class="form-control" id="password" name="password" placeholder="lozinka">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <input type="password" class="form-control" id="passwordConfirm" name="password_confirmation" placeholder="Potvrdi lozinku">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                    <label for="role">Uloga: </label>
                        <select name='role'>
                            <option value='1'>Admin</option>
                            <option value='2'>User</option>
                        </select>
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