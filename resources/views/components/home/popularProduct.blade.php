

<div class="col-lg-4  col-md-4 col-sm-12 portfolio-item">
  <div class="card h-100">
    <a href="{{route('product', $product->model_name)}}"><img class="card-img-top img-fluid" src="{{asset($product->src)}}" alt="{{$product->alt}}"></a>
    <div class="card-body">
      <h4 class="card-title">
      <a href="{{route('product', $product->model_name)}}">{{$product->model_name}}</a> model
      </h4>
      <p class="card-text">{{$product->description}}</p>
    </div>
  </div>
</div>