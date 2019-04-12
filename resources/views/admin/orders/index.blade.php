@extends("admin.layouts.templateAdmin1")

@section('title')
porudžbine
@endsection

@section("content")
<div id="content-wrapper">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-info mt-4" role="alert">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Tabela za porudžbine
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Korisnikom ID</th>
                                <th>Adressa</th>
                                <th>Telefon</th>
                                <th>Cena</th>
                                <th>Datum porudžbine</th>
                                <th>Datum slanja</th>
                                <th>Pošalji</th>
                                <th>Detaljine informacije</th>
                                <th>Obriši</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Korisnikom ID</th>
                                <th>Adressa</th>
                                <th>Telefon</th>
                                <th>Cena</th>
                                <th>Datum porudžbine</th>
                                <th>Datum slanja</th>
                                <th>Pošalji</th>
                                <th>Detaljine informacije</th>
                                <th>Obriši</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($orders as $order)
                            <tr >
                                <td class="align-middle">{{$order->user_id}}</td>
                                <td class="align-middle">{{$order->address}}</td>
                                <td class="align-middle">{{$order->phone}}</td>
                                <td class="align-middle">{{$order->full_price}} RSD</td>
                                <td class="align-middle">{{$order->time_of_order}}</td>                               
                                <td class="align-middle">{{$order->sent_at}}</td>

                                <td class="align-middle">
                                    <form action='{{route("porudzbine.update", ["id"=> $order->id])}}' method="POST">
                                        {{csrf_field()}}
                                        @method('PUT')
                                        <button type="submit" {{empty($order->sent_at) ? "" : "disabled"}}><span> <i class="fa fa-paper-plane"
                                                    style="font-size:24px"></i></span></button>
                                    </form>
                                </td>
                                <td class="align-middle">
                                    <form action='{{route("porudzbine.show", ["id"=> $order->id])}}' method="GET">
                                        {{csrf_field()}}
                                        <button type="submit"><span> <i class="fa fa-info-circle"
                                                    style="font-size:24px"></i></span></button>
                                    </form>
                                </td>
                                <td class="align-middle">
                                    <form action='{{route("porudzbine.destroy", ["id" => $order->id])}}' method="POST">
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
            <div class="card-footer small text-muted">Tabela za porudžbine</div>
        </div>

    </div>
    <!-- /.container-fluid -->

    @endsection