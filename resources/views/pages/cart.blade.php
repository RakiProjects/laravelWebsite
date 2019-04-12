@extends('layouts/template')

@section('title')
Korpa
@endsection

@section('content')
<div class="container">
    @if(session('message'))
    <div class="alert alert-info mt-4" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!-- DataTables Example -->
    @if(!$cartItems->isEmpty())
    <div class="card mb-3">
        <div class="card-header">
            Korpa
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Slika</th>
                            <th>Model</th>
                            <th>Boja</th>
                            <th>Dimenzije</th>
                            <th>Cena</th>
                            <th>Obriši</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td><img class="img-fluid img-thumbnail" src="{{asset('/')}}{{$item->src}}"
                                    style="width:9vw; height:7vw; object-fit: cover;"></td>
                            <td class="align-middle">{{$item->model_name}}</td>
                            <td class="align-middle">{{$item->color}}</td>
                            <td class="align-middle">{{$item->dimensions}}</td>
                            <td class="align-middle">{{$item->price}} RSD</td>
                            <td class="align-middle">
                                <form action='{{route("cartDeleteItem", ["id" => $item->id])}}' method="POST">
                                    {{csrf_field()}}
                                    @method('DELETE')
                                    <button type="submit" style="font-size:24px"><span>&times;</span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer"><button type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#porudzbina"> Poruči</button></div>
    </div>
    @else
    <div style="margin-bottom:600px; margin-top:50px;">
        <h3>Korpa vam je prazna.</h3>
    </div>
    @endif
    <div>
        <a class="btn btn-info mb-5" href="{{route('ordersView')}}">Prethodne porudžbine</a>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="porudzbina">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Porudzbina</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('order')}}" method="POST">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <ul>
                            <li>Username : <strong>{{session()->get('user')->username}}</strong></li>
                            <li>Email: <strong>{{session()->get('user')->email}}</strong></li>
                            <li>Adresa: <input type="text" name="address" class="form-control" /></li>
                            <li>Telefon: <input type="text" name="phone" class="form-control" /></li>
                            <ol>
                                @foreach($cartItems as $item)
                                <li>
                                    <strong>{{$item->model_name}}, {{$item->color}}, {{$item->dimensions}},
                                        {{$item->price}} RSD</strong>
                                </li>
                                @endforeach
                            </ol>
                            <li>Cena svih torbi:
                                @foreach($cartItems as $item)
                                <input type="hidden" value="{{$priceSum += $item->price}}" />
                                @if($loop->last)
                              
                                <strong>{{$priceSum}} </strong><small> RSD</small>
                                @endif
                                @endforeach
                            </li>
                            <li><strong>Cena transporta: 250.00 </strong><small>RSD</small> </li>
                            <li class="text-uppercase">  
                                <input type="hidden" name="priceSum" value="{{$priceSum +250}}" />
                                <strong>Ukupna cena: {{$priceSum + 250}} </strong><small>RSD</small>
                            </li>
                            <li>Plaćanje pouzećem</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">PORUČI</button>
                    </div>
                </form>
                <!-- container -->
            </div>
        </div>
    </div>
</div>
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
@endsection