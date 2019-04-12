@extends('layouts/template')

@section('title')
{{$product->name}} model
@endsection


@section('description')
@if($product->name =="Verona")
Najpopularniji model za dnevne i večernje šetnje. Odaberite veličinu koja Vam odgovara: mini 15x9, srednja 20x9, velika
25x9, i boju koja vam najviše priliči.
@elseif($product->name =="Nika")
Elegentna pliš Nika, za večernje izlaske i svečanosti, 20x9 (cm) dimenzija sa preko 20 različitih boja.
@elseif($product->name =="Pismo")
Pismo torbica odlično ide uz sve vaše kombinacije za svečane prilike. Dimenzija 25x7 (cm) uz mogućnost izbora od 20
različitih boja.
@elseif($product->name =="Classic")
Za ljubitelje klasike, torbica sa ručkom. Dimenzije 20x9 (cm), dostupa preko 20 različitih boja.
@elseif($product->name =="Iris")
Sa elegantnom kopčom i dimenzijama 30x9 (cm), Iris model je najbolja opcija za sve ljubitelje većih torbi.
@endif
@endsection

@section('content')
<!-- Page Content -->

<div class="container">
    <div id="product">

    <div id="message_box" class="alertEmail" hidden>
        <div class="container">
          <div class="row">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span></button>
              <span id="message"></span>
            </div>
          </div>
        </div>
  </div>
        <!-- Portfolio Item Heading -->
        <h1 class="my-4">{{$product->name}}
            <small>model</small>
        </h1>

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8 ">
                <img class="img-fluid " src="{{asset('/')}}{{($product->src)}}" alt="{{$product->alt}}">
            </div>

            <div class="col-md-4">
                <h3 class="my-3">Cena <span class="font-italic font-weight-bold price"
                        id="priceSpan">{{$product->price}}</span><small> RSD</small></h3>
                <br /><br />
                <form>
                <!-- action="{{route('cartAddProduct')}}" method="POST" -->
                    {{csrf_field()}}
                    <input type="hidden" id="productName" name="productName" value="{{$product->name}}"/>
                    <input type="hidden" id="productPrice" name="productPrice" value="{{$product->price}}"/>
                    <input type="hidden" id="productDimensions" name="productDimensions" value="{{$product->dimensions}}"/>
                    <input type="hidden" id="pictureSrc" name="pictureSrc" value="{{$product->src}}"/>
                    <div class="form-group row">
                        <label class="h5 col-3">Veličina: &nbsp;</label>
                        <div class="col-9">
                            <span class="h4">{{$product->dimensions}} (cm)</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="h5 col-3">Boja: &nbsp;</label>
                        <div class="col-9">
                            <select id="productColor" name="productColor">
                                @foreach ($colors as $color)
                                <option value="{{$color->name}}">{{$color->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if(!session()->has('user'))
                    <div class="offset-sm-2 col-sm-10">
                        <h5><a class="nav-link text-info" href="{{route('loginRegisterView')}}" role="button">Ulogujte se da bi narucili</a></h5>
                    </div>
                    @else
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="button" name="cartAddButton" id="cartIcon" onClick="addToCart();">Dodaj u korpu<i class="fa fa-shopping-cart fa-2x"></i></button>
                        </div>
                    </div>
                    @endif
                </form>
                <div class="alert alert-info" id="instagramInfoText">
                    Ukoliko vam je lakše, sve porudžbine se mogu izvršiti preko <a
                        href="https://www.instagram.com/torbe_i_kerefeke_missy_bo/" class="alert-link">instagram</a>
                    DM-a.
                </div>
            </div>
        </div>
    </div>
    <div id="restModels">
        <!-- row -->
        <!-- Related Projects Row -->
        <h3 class="my-4">Drugi modeli</h3>
        <div class="row">
            @foreach($products as $otherProduct)
            @if($otherProduct->name == $product->name)
            @continue
            @else
            <div class="col-md-3 col-6 mb-4">
                <a href="{{route('product', $otherProduct->name)}}">
                    <img class="img-fluid" src="{{asset('/')}}{{($otherProduct->src)}}" alt="{{$otherProduct->alt}}">
                </a>
            </div>
            @endif
            @endforeach
        </div>
        <!-- /.row -->
    </div>
</div>
<!-- /.container -->
@endsection

@section('scripts')
    <script>
        function addToCart() {
            $("#message_box").attr("hidden", true);
            $("#message").html("");
            
            $.ajax({
                type: "POST",
                data: {
                    _token: csrf,
                    "productName": $("#productName").val(),
                    "productPrice": $("#productPrice").val(),
                    "productColor": $("#productColor").val(),
                    "productDimensions": $("#productDimensions").val(),
                    "pictureSrc": $("#pictureSrc").val()
                },
                url: baseUrl + "/korpa",
                success: function (data) {
                    $("#message_box").attr("hidden", false);
                    $("#message").html(data.message)
                }
            });
        }
    </script>
@endsection