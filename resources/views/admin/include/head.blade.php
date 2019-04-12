<!DOCTYPE html>
<html lang="en">
<script>
  let baseUrl= "{{url('/')}}";
  let csrf = "{{csrf_token()}}";
</script>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>"Daisy" Admin - @yield('title')</title>

  <link rel="icon" href="{{asset('images/daisyLogo.png')}}">

  <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <link href="{{asset('admin/css/all.min.css')}}" rel="stylesheet" type="text/css"> -->


  <!-- Page level plugin CSS-->
  <link href="{{asset('admin/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('admin/css/sb-admin.css')}}" rel="stylesheet">

</head>

<body id="page-top">