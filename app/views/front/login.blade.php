@extends('tema.master')

@section('master_metas')
	<title>Inicio</title>
@stop

@section('master_contenido')
	<div class="container">
		<div align="center">
			<h3>Para entrar al m&oacute;dulo de administración</h3><br>
			<div class="col-md-4 col-md-offset-4" >
				<form action="{{ URL::asset('iniciosesion')}}" method="post" >
			  <div class="form-group">
			    <label for="exampleInputEmail1">Usuario</label>
			    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Usuario" name="usuario">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Contraseña</label>
			    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="pass">
			  </div>
			  
			  <button type="submit" class="btn btn-default">Entrar</button>
			</form>
			</div>
			
		</div><br><br><br><br><br><br><br><br><br><br><br><br>
		@if(Session::get('mensaje'))
			<div class='alert alert-danger aviso'><strong>Atención!</strong>
				<p>{{Session::get('mensaje')}}</p>
			</div>
		@endif
		
		{{-- <a class="btn btn-danger" href="{{ URL::asset('/inicioGoogle') }}" role="button">Inicio con Google</a> --}}
	</div>
@stop

