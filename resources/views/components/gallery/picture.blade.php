
@foreach($gallery as $pic)
<div class="col-lg-3 col-md-4 col-6">
    <a href="{{$pic->src}}" class="d-block mb-4 h-100" data-lightbox='images/gallery'  data-title="{{$pic->alt}}">
        <img class="img-fluid img-thumbnail" src="{{asset('/')}}{{$pic->src}}" alt="{{$pic->alt}}">
    </a>
</div>
@endforeach


