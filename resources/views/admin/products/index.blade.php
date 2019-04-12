@extends("admin.layouts.templateAdmin1")

@section('title')
proizvodi
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
                Tabela za proizvode
                <form action="{{url('admin/proizvodi/create')}}" method="GET" class="mt-3">
                    <input type="submit" class="btn btn-success" value="Dodaj proizvod" />
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Slika</th>
                                <th>Model</th>
                                <th>Opis</th>
                                <th>Veličina</th>
                                <th>Cena</th>
                                <th>Src</th>
                                <th>Alt</th>
                                <th>Ažuriraj</th>
                                <th>Obriši</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Slika</th>
                                <th>Model</th>
                                <th>Opis</th>
                                <th>Veličina</th>
                                <th>Cena</th>
                                <th>Src</th>
                                <th>Alt</th>
                                <th>Ažuriraj</th>
                                <th>Obriši</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($products as $product)
                            <tr >
                                <td><img class="img-fluid img-thumbnail" src="{{asset('/')}}{{$product->src}}" style="width:12vw; height:5vw; object-fit: cover;"></td>
                                <td class="align-middle">{{$product->name}}</td>
                                <td class="align-middle">{{$product->description}}</td>
                                <td class="align-middle">{{$product->dimensions}}</td>
                                <td class="align-middle">{{$product->price}} RSD</td>
                                <td class="align-middle">{{$product->src}}</td>
                                <td class="align-middle">{{$product->alt}}</td>
                                <td class="align-middle">
                                    <form action='{{route("proizvodi.edit", ["id"=> $product->id])}}' method="GET">
                                        {{csrf_field()}}
                                        <button type="submit"><span> <i class="fa fa-edit"
                                                    style="font-size:24px"></i></span></button>
                                    </form>
                                </td>
                                <td class="align-middle">
                                    <form action='{{route("proizvodi.destroy", ["id" => $product->id])}}' method="POST">
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
            <div class="card-footer small text-muted">Tabela za proizvode</div>
        </div>

    </div>
    <!-- /.container-fluid -->

    @endsection