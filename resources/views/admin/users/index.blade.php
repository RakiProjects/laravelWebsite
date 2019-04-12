@extends("admin.layouts.templateAdmin1")

@section('title')
korisnici
@endsection

@section("content")
<div id="content-wrapper">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-info mt-4" role="alert">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Tabela za korisnike
                <form action="{{url('admin/korisnici/create')}}" method="GET" class="mt-3">
                <input type="submit" class="btn btn-success" value="Dodaj korisnika"/>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive" id ="table">
                   
                          
                      
                </div>
            </div>
            <div class="card-footer small text-muted">Tabela za korisnike</div>
        </div>

    </div>
    <!-- /.container-fluid -->

    @endsection

    @section('scripts')

    <script>

        function adminUsers(){
            let users = [];

            function getUsers(){
                $.ajax({
                    url : baseUrl + "/ajax/korisnici",
                    success : function(data){
                        users = data;
                        let html = generateTable()
                        $("#table").html(html)
                    }
                });
            }

            function removeUser(id){
                $.ajax({
                    method: "delete",
                    url : baseUrl + "/admin/korisnici/" + id,
                    data:{
                        _token : csrf
                    },
                    success : function(data){
                        let module = adminUsers()
                        module.getUsers()
                    }
                });
            }

            function generateTable(){
                let html = generateTableHeadings();
                for(let user of users){
                    html += generateTableRow(user);
                }
                html += `  </tbody>
                         </table>`;
                return html;
            }

            function generateTableHeadings(){
                return  `
                 <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Uloga</th>
                                <th>Datum kreiranja</th>
                                <th>Datum ažuriranja</th>
                                <th>Ažuriraj</th>
                                <th>Obriši</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Uloga</th>
                                <th>Datum kreiranja</th>
                                <th>Datum ažuriranja</th>
                                <th>Ažuriraj</th>
                                <th>Obriši</th>
                            </tr>
                        </tfoot>
                        <tbody>
               `
            }

            function generateTableRow(user){
                return `
                    <tr>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>${user.name}</td>
                        <td>${user.created_at}</td>
                        <td>${user.updatet_at}</td>
                        <td>
                            <button type="button" onclick="editUser(${user.id})"><span> <i class="fa fa-edit" style="font-size:24px"></i></span></button>
                        </td>
                        <td>
                                <button type="button" onclick="deleteUser(${user.id})" style="font-size:24px"><span>&times;</span></button>
                        </td>

                     </tr>
                `
            }

            return {
                getUsers,
                removeUser
            }
        }

        function deleteUser(id){
            users.removeUser(id)
        }

        function editUser(id){
            var url = '{!!url("admin/korisnici/'+id+'/edit")!!}';
            window.location.href = url;
        }

        $(document).ready(function(){
            users.getUsers();
        });

        let users = adminUsers();

    </script>

    @endsection

   