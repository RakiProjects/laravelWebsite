<footer class="py-5 bg-dark">
      <div class="container text-center ">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-6">
           <h4 class="m-0 text-white ">Meni:</h4>
           <ul class=" list-unstyled font-italic">
           @foreach($menu as $link)
            <li>
              <a href="{{route($link->route_name)}}">{{$link->name}}</a>
            </li>
           @endforeach
           <li class="nav-item">
                    <a class="nav-link" href="#">Dokumentacija</a>
                </li>
           </ul>
          </div>
          <div class="col-md-4 col-sm-4 col-6">
           <h4 class="m-0 text-white">Modeli:</h4>
           <ul class=" list-unstyled font-italic">
           <li><a href="{{route('product', 'Verona')}}">Verona</a></li>
           <li><a href="{{route('product', 'Mika')}}">Mika</a></li>
           <li><a href="{{route('product', 'Pismo')}}">Pismo</a></li>
           <li><a href="{{route('product', 'Classic')}}">Classic</a></li>
           <li><a href="{{route('product', 'Iris')}}">Iris</a></li>
           </ul>
   
          </div>
          <div class="col-md-4 col-sm-4">
           <h4 class="m-0 text-white">Pratite nas:</h4>
            <a href="https://www.instagram.com/torbe_i_kerefeke_missy_bo/"><img src= "{{asset('images/instagram.png')}}"  alt="instagram 'Daisy'" class="mx-auto mt-2" style="max-width:45px; max-height:45px;" /></a>
            <a href="https://www.facebook.com/torbeikerefeke/"><img src="{{asset('images/facebook.ico')}}"  alt="facebook 'Daisy'" class="mx-auto mt-2" style="max-width:45px; max-height:45px;" /></a>
            
          </div>
        </div>
       
      </div>
      <!-- /.container -->
</footer>
 <!-- Bootstrap core JavaScript -->
 <script src="{{asset('vendor/bootstrap/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <script src="{{asset('js/lightbox-plus-jquery.min.js')}}"></script>
        @yield('scripts')
    </body>
</html>