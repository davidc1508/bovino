<?php
?>
<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bovinos - Dashboard</title>
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/css/bootstrap-table.css">
    <link type="text/css" rel="stylesheet" href="/css/select2.min.css">    
    <link type="text/css" rel="stylesheet" href="/css/AdminLTE.min.css">
    <link type="text/css" rel="stylesheet" href="/css/skins/skin-green.min.css">
    <link type="text/css" rel="stylesheet" href="/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="/css/site.css">
    @yield('css')
    <script src="/js/jquery-2.2.0.min.js"></script>
    <script type="text/javascript">
            var baseUrl = {!! json_encode(url('/')) !!};
            var token = '{{ csrf_token() }}';
            $nomeGlobal = '';
            $brincoGlobal = '';
            $idGlobal = '';
        </script>
</head>
<body class="skin-green sidebar-mini">
<div class="wrapper">
    @include('Partials/navbar')
    @include('Partials/aside')  
  <div class="content-wrapper">
    @yield('content')
    @yield('modal')
  </div>
</div>
  <script src='/js/bootstrap.min.js'></script>
  <script src='/js/bootstrap-table.js'></script>
  <script src='/js/select2.min.js'></script>
  <script src='/js/jquery.validate.min.js'></script>
  <script src='/js/moment.min.js'></script>
  <script src='/js/fastclick.min.js'></script>
  <script src='/js/app.min.js'></script>
  <script src='/js/Chart.min.js'></script>
  <script src='/js/arcnet.simple.mask.min.js'></script>
  <script src='/js/jquery.maskedinput.min.js'></script>
  <script src='/js/site.js'></script>
  @yield('script')
</body>
</html>
 