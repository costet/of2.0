<?php
	header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
	header("Content-Type: text/html; charset=utf8;");
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		@section("master_metas")
			<title>Plantilla maestra</title>
		@show

		@section("master_links")
			{{HTML::style("css/bootstrap.min.css", array("type" => "text/css"))}}
			{{HTML::style("css/jquery-ui.css", array("type" => "text/css"))}}
			{{HTML::style("css/sweetalert.css", array("type" => "text/css"))}}
			{{HTML::style("css/fileinput.css", array("type" => "text/css"))}}
			{{HTML::style("css/css.css", array("type" => "text/css"))}}
			{{HTML::style("dist/css/lightbox.css", array("type" => "text/css"))}}
			{{HTML::style("css/font-awesome.min.css", array("type" => "text/css"))}}
		@show
		<style type="text/css">
			body{
				background-color: #f2f2f2;

			}
		</style>

		
	</head>
	<body>
		@section("master_encabezado")
			<div class="container">
				<!-- <div class="col-sm-6"><img src='{{URL::asset("img/logo (1).png")}}' class="img-responsive"></div> -->
				{{-- <div class="col-sm-6 hidden-xs"><div align="right"><br><img src="{{URL::asset("img/logo_visionmorelos.png")}}" class="img-responsive"></div></div> --}}
			</div><br>
			

		@show
		
		@section("master_contenido")
		@show
		@section("master_pie_pagina")
			<br><br>
			<div class="">
				{{-- <div class=""><img src="{{URL::asset("img/pleca.png")}}" width="100%"><br> --}}
					<div align="center">
				        <!-- Dirección de Personal y Relaciones Laborales<br> 
				        Subdirección de Informática<br>
				        Departamento de Ingenieria de Sistemas -->
					</div>
				</div>
			</div>
		@show

		@section("master_plugins")
			{{HTML::script("js/jquery.js", array("type" => "text/javascript"))}}
			{{HTML::script("js/jquery.min.js", array("type" => "text/javascript"))}}
			{{HTML::script("js/bootstrap.min.js", array("type" => "text/javascript"))}}
			{{HTML::script("js/sweetalert.min.js", array("type" => "text/javascript"))}}
			{{HTML::script("js/jquery-ui.js", array("type" => "text/javascript"))}}
			{{HTML::script("js/fileinput.min.js", array("type" => "text/javascript"))}}
			{{HTML::script("js/bootstrap-filestyle.min.js", array("type" => "text/javascript"))}}
			{{HTML::script("dist/js/lightbox.js", array("type" => "text/javascript"))}}
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-104450668-1', 'auto');

			  ga('send', 'pageview');

			</script>
		@show
	</body>
</html>