@extends('layouts/template')

@section('title')
  Početna
@endsection

@section('description')
  Tašne "Daisy" pojavile su se sasvim slučajno, iz potrebe za igrom i stvaranjem.
  Radovi dizajnerice povezani sa porodičnom zanatskom tradicijom.
  Svakoj ručno izrađenoj torbi posvećuje se podjednako ljudavi i pažnje.
  Modeli prate svetske trendove i svojim vlasnicama daju ono sto svakoj dami treba.
@endsection

@section('content')
@if(session('message'))
     <div class="alert alert-info mt-4" role="alert">
   {{session('message')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button> 
</div>
@endif
@include('components.home.slider')
<section id="mainProducts">
    <div class="container mt-4">
      <!-- Portfolio Section -->
      <h2>Najpopularniji proizvodi</h2>
      <div class="row mt-4 mb-4">
        @foreach($popularProducts as $product) 
          @component('components.home.popularProduct', ["product" => $product])
          @endcomponent      
        @endforeach
    </div>
  </div>
</section>
@include('components.home.about')


@endsection