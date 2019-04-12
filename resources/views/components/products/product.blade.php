<div class="col-lg-6 col-md-6 portfolio-item mb-4">
  <div class="card h-100">
    <a href="{{route('product', $product->name)}}"><img class="card-img-top" src="{{asset('/')}}{{$product->src}}" alt="{{$product->alt}}"></a>
    <div class="card-body">             
        <h4 class="card-title">
        <small>model &nbsp</small><a href="{{route('product', $product->name)}}">{{$product->name}}</a>
        </h4>
        <p class="card-text">{{$product->description}}</p> 
        <a class="btn btn-primary" href="{{route('product', $product->name)}}">Saznaj više o modelu</a>
        <!-- <p class="card-text">{{$product->description}}</p> -->
    </div>
   </div>
</div>
      