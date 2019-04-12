@extends("admin.layouts.templateAdmin1")

@section('title')
galerija
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
                Tabela za galeriju
                <form action="{{route('galerija.create')}}" method="GET" class="mt-3">
                    <input type="submit" class="btn btn-success" value="Dodaj sliku za galeriju" />
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Slika</th>
                                <th>Model</th>
                                <th>src</th>
                                <th>alt</th>
                                <th>Ažuriraj</th>
                                <th>Obriši</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Slika</th>
                                <th>Model</th>
                                <th>src</th>
                                <th>alt</th>
                                <th>Ažuriraj</th>
                                <th>Obriši</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($gallery as $picture)
                            <tr >
                                <td><img class="img-fluid img-thumbnail" src="{{asset('/')}}{{$picture->src}}" style="width:9vw; height:7vw; object-fit: cover;"></td>
                                <td class="align-middle">{{$picture->model}}</td>
                                <td class="align-middle">{{$picture->src}}</td>
                                <td class="align-middle">{{$picture->alt}}</td>
                                <td class="align-middle">
                                    <form action='{{route("galerija.edit", ["id"=> $picture->id])}}' method="GET">
                                        {{csrf_field()}}
                                        <button type="submit"><span> <i class="fa fa-edit"
                                                    style="font-size:24px"></i></span></button>
                                    </form>
                                </td>
                                <td class="align-middle">
                                    <form action='{{route("galerija.destroy", ["id" => $picture->id])}}' method="POST">
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
            <div class="card-footer small text-muted">Tabela za galeriju</div>
        </div>

    </div>
    <!-- /.container-fluid -->

    @endsection