@extends("admin.layouts.templateAdmin1")

@section('title')
porudzbina
@endsection

@section("content")

<div class="container">
<div class="row mt-5"> 
    <div class="col-sm-6">
        <ul style="list-style:none">
            <li>Korisnik: <strong>{{ $order->username}}</strong></li>
            <li>Email: <strong>{{$order->email}}</strong></li>
            <li>Adresa: <strong>{{$order->address}}</strong></li>
            <li>Telefon: <strong>{{$order->phone}}</strong></li>
            <li>Datum porudzbine: <strong>{{$order->time_of_order}}</strong></li>
            <li>Cena: <strong>{{$order->full_price}}</strong> <small>RSD</small></li>
            <li>Datum slanja: <strong>{{ $order->sent_at}}</strong></li>
        </ul>
    </div>
</div>

<div class="card mb-3">
        <div class="card-header">
            Detalji
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>R.B.</th>
                            <th>Model</th>
                            <th>Boja</th>
                            <th>Dimenzije</th>
                            <th>Cena</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orderDetail as $item)
                        <tr>                       
                            <td class="align-middle">{{$loop->iteration}}.</td>
                            <td class="align-middle">{{$item->product_name}}</td>
                            <td class="align-middle">{{$item->product_color}}</td>
                            <td class="align-middle">{{$item->product_size}}</td>
                            <td class="align-middle">{{$item->price}} RSD</td>                          
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

