@extends('layouts/template')

@section('title')
Autentifikacija
@endsection

@section('content')
@if(session('message'))
     <div class="alert alert-info  mt-4" role="alert">
   {{session('message')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button> 
</div>
@endif
    <div class="container" style="margin-top:100px; margin-bottom:200px;">
    <!-- LOGIN -->
        <div class="row">
            <div class="col-md-5">
             <div class="card text-left">
                <div class="card-header">Logovanje</div>
                <div class="card-body bg-dark ">
                <form action="{{route('doLogin')}}" method="POST" onSubmit='return checkLogin()'>
                    @csrf
                    <div class="form-group">                
                        <input type="text" clas="form-control" name="username1" id="username1" placeholder="Korisničko ime"/>
                    </div>
                    <div class="form-group">
                        <input type="password" clas="form-control" name="password1" id="password1" placeholder="Lozinka"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="login" value='login'>Uloguj se</button>
                    </div>
                </form>
                </div>
             </div>
            </div>
    <!-- REGISTRACIJA -->
            <div class="col-md-5 offset-md-2">
                <div class="card text-left">
                    <div class="card-header">Registracija</div>
                    <div class="card-body bg-dark ">
                    <form action="{{route('doRegister')}}" method="POST" onSubmit='return checkRegister()'>
                        @csrf
                        <div class="form-group">                
                            <input type="text" clas="form-control" name="username" id="username" placeholder="Korisničko ime"/>
                        </div>
                        <div class="form-group">                
                            <input type="email" clas="form-control" name="email" id="email" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <input type="password" clas="form-control" name="password" id="password" placeholder="Lozinka" />
                        </div>
                        <div class="form-group">
                            <input type="password" clas="form-control" name="password_confirmation" id="passwordConfirm" placeholder="Potvrdi lozinku" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="register" value="register">Registruj se</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
                <!-- ERRORS ISPIS -->
                @if ($errors->any())
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
@endsection

@section('scripts')
    <script src="{{asset('js/loginRegisterValidation.js')}}"></script>
@endsection