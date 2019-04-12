<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">Tašne <span class="h3 font-italic font-weight-bold"
                id="logoText">"Daisy"</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @if(session()->has('user') and session()->get('user')->name=="admin")
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('admin/korisnici')}}">Admin panel</a>
                </li>
                @endif
                @isset($menu)               
                @foreach($menu as $link)
                <li class="nav-item">
                    <a class="nav-link" href="{{route($link->route_name)}}">{{$link->name}}</a>
                </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link" href="#">Dokumentacija</a>
                </li>
                @endisset
                @if(!session()->has('user'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('loginRegisterView')}}">Prijavite se</a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{route('cartView')}}" style="color:orange"><i class="fa fa-shopping-cart fa-2x"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">Odjavite se</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>