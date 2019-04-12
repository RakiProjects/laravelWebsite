<header id="sliderBackground">
      <div class="container" >
      <div id="carouselIndicators" class="carousel slide" data-ride="carousel"  data-interval='4000'>
        <!-- Indicators -->
        <ul class="carousel-indicators">
          <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselIndicators" data-slide-to="1"></li>
          <li data-target="#carouselIndicators" data-slide-to="2"></li>
        </ul>  
        <!-- The slideshow -->
        <div class="carousel-inner">
          <div class="carousel-item active slider">
            <img src="{{asset('/')}}images/sliders/slider1.jpg" class="img-fluid" alt="Slider 1, Verona i pismo tašne"> 
          </div>
          <div class="carousel-item">
            <img src="{{asset('/')}}images/sliders/slider2.jpg" class="img-fluid" alt="Slider 2, Verona i pismo tašne">
          </div>
          <div class="carousel-item">
            <img src="{{asset('/')}}images/sliders/slider3.jpg" class="img-fluid" alt="Slider 3, Verona tašna">
          </div>
        </div> 
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#carouselIndicators" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#carouselIndicators" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div> 
      </div>
</header>