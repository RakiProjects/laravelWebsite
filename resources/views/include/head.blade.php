<!DOCTYPE html>
<html lang="en">
<script>
  let baseUrl= "{{url('/')}}";
  let csrf = "{{csrf_token()}}";
</script>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content='@yield("description")'>
    <meta name="keywords" content="">
    <meta name="author" content="Radakovicć Nemanja">
    
    <title>Tašne "Daisy" | @yield('title')</title>

    <link rel="icon" href="{{asset('images/daisyLogo.png')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <!-- Bootstrap core CSS -->
    <link href="{{asset('/')}}vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
     <!-- LightBox -->
     <link href="{{asset('css/lightbox.min.css')}}" rel="stylesheet">
     <!-- Custom styles-->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">

  </head>
  <body>