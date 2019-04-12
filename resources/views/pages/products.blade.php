@extends('layouts/template')

@section('title')
Proizvodi
@endsection

@section('description')
  Postoje pet vrste modela tašni koje možete naručiti: Verona, Nika, Pismo, Classic i Iris.
  Svaki model jer drugačijih dimenzija i može biti izrađen u preko dvadeset različitih boja 
@endsection

@section('content')
<div id="models" >
@if(count($products))
    <div class="container">  
    @if(session()->has('message'))
  <div class="alertEmail">
        <div class="container">
          <div class="row">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span></button>
              {{session()->get('message')}}
            </div>
          </div>
        </div>
  </div>
@endif
      <!-- Page Heading -->
      <h2 class="my-4">Proizvodi </h2>

      <div class="row">
     
      @foreach($products as $product)
        @component('components.products.product', ["product" =>$product])
        @endcomponent
      @endforeach
       
      </div>
    </div>
    @else
        <h2>Greška pri učitavanju, pokušajte kasnije.</h2>
        @endif
      <!-- /.row -->
     </div> 
     @endsection