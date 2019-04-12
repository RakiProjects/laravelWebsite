@extends('layouts/template')

@section('title')
Galerija
@endsection

@section('description')
"Daisy" galerija je mesto gde možete pogledati najnovije i najoriginalnije tašne koje smo radili. Mnoge slike
predstavljaju dokaz zahvalnosti kupaca za proizvod.

@endsection

@section('content')
<!-- Page Content -->
<div id="gallery">
    <div class="container">
        <h2 class="my-4 text-center text-lg-left">Galerija</h2>
        <div class="row " id='showGallery'>     
                <h1>Loading...</h1>            
        </div> 
    </div>
    <!-- /.container -->
</div>
@endsection

@section('scripts')
<script>
     $(document).ready(function(){     
        $.ajax({
            type:"GET",
            url: baseUrl + "/ajax/galerija",
            success:function(data){
                $('#showGallery').html(data);
            }
        });
     });
</script>
@endsection