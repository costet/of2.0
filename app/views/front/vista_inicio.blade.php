@extends('tema.master')

@section('master_metas')
	 <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Obras - IEBEM</title>
@stop
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
        width: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

    </style>

@section('master_contenido')
	<div class="container">
		<div align="center">
			<h3>Obra Educativa<br>Lista para Inaguración<br> <small>Fecha de Actualización a: {{ date("Y-m-d") }}</small> </h3>
		</div>
		<form id="formulario">
			<div class="col-sm-3 col-md-3">
				<div class="form-group">
				    <label for="exampleInputEmail1">Municipio</label>
				    {{-- onchange="cambiar(this.value)" --}}
				    <select class="form-control" name="municipio" >
				    	<option value="0" selected="">Seleccion un opción</option>
				    	@foreach($muni as $mun)
							<option value="{{ $mun->municipio }}">{{ $mun->municipio }}</option>
				    	@endforeach
				    </select>
			  	</div>
			</div>
			<div class="col-sm-3 col-md-3">
				<div class="form-group">
				    <label for="exampleInputEmail1">Nivel Educativo</label>
				    <img src="{{ URL::asset('img/loading.gif') }}" id='imgNivel' class="img-responsive" width="40px" style="display: none;">
				    <div id="divnivel">
				    	<select class="form-control" name="nivel">
					    	<option value="0"  selected="">Seleccion un opción</option>
					    	@foreach($nivel as $niv)
								<option value="{{ $niv->nivel_educativo }}">{{ $niv->nivel_educativo }}</option>
					    	@endforeach
					    </select>
				    </div>
			  	</div>
			</div>
			<div class="col-sm-3 col-md-3">				
				<div class="form-group">
				    <label for="exampleInputEmail1">Financiamiento</label>
				    <img src="{{ URL::asset('img/loading.gif') }}" id='imgTipo' class="img-responsive" width="40px" style="display: none;">
				    <div id="divtipo">
				    	<select class="form-control" id="tipo" name="tipo">
					    	<option value="0"  selected="">Seleccion un opción</option>
					    	<option value="1"  >Gobierno del Estado</option>
					    	<option value="2"  >Congreso</option>
					    </select>
				    </div>
				    
			  	</div>
			</div>
			
			<div class="col-sm-3 col-md-3">
				<div class="form-group">
				    <label for="exampleInputEmail1">Verificar</label><br>
				    <button type="button" class="btn btn-danger" onclick="consultar()">Verificar</button>
			  	</div>
			</div>
		</form>
	</div>
	<div class="container">
		<div id="map" ></div>
		<div class="table-responsive">
			<div id="tabla"></div>
		</div>
			
	</div>
	
@stop

@section("master_plugins")
	@parent
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
	{{HTML::script("//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js", array("type" => "text/javascript"))}}
	
	<script async defer
	        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnW3a-zFngljwBLHqjlWv-H1C2IAeevLE&callback=initMap"> //credencial de la API
        
    </script>
	<script type="text/javascript">
		var map;
      	var infoWindow;

        function initMap() {
          	 map = new google.maps.Map(document.getElementById('map'), {
	            center: new google.maps.LatLng(22.8621500,-102.6106100), //cambiar esta linea para centrar el mapa
	            zoom: 5
	        });
	        infoWindow = new google.maps.InfoWindow;
	         $.get( "{{ URL::asset("mostrar_todo") }}", function( dataa ) {
	         	var trs='';
			  	map = new google.maps.Map(document.getElementById('map'), {
	            center: new google.maps.LatLng(18.7475,-99.070278), //cambiar esta linea para centrar el mapa
	            zoom: 10
		        });
		        infoWindow = new google.maps.InfoWindow;
            	dataa.datos.forEach(function(element) {
        			// console.log(element.ct+element.lat+element.lon);
        			var ct = element.ct;
				    var nombre = element.nombre;
				    var nivel = element.nivel_educativo;
	              	var mu = element.municipio;
	              	var localidad = element.localidad;
	              	var obra =element.obra;

	              	var lat= parseFloat(element.lat);
	              	var lon= parseFloat(element.lon);
	              	// console.log(lat+'****'+lon);
	              	var point = new google.maps.LatLng(
	                  	parseFloat(lat),
	                  	parseFloat(lon),
	                );	              
	              	var iconBase;
	              	var finan;
	                if(element.valida==1){
	                	// iconBase = "{{ URL::asset('img/1.png') }}";
	                	iconBase = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
	                	finan='Gobierno del Estado';

	                }else{
	                	// iconBase = "{{ URL::asset('img/2.png') }}";
	                	iconBase = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
	                	finan='Congreso';
	                }
	              	
	              	var marker = new google.maps.Marker({
	                	map: map,
	                	position: point,
	                	icon : iconBase,
	                	
	              	});
	              	marker.addListener('click', function() {
	                	infoWindow.setContent("<strong>"+ct+"</strong><br>NOMBRE CT: "+nombre+"<br>NIVEL EDUCATIVO: "+ nivel+"<br>MUNICIPIO: "+mu+"<br>"+"LOCALIDAD: "+localidad + "<br>AÑO DEL EJERCICIO: " + element.ejercicio+ "<br>OBRA: "+element.obra+"<br>INVERSIÓN: "+ element.inversion+"<br>PROGRAMA: "+element.programa);
	                	infoWindow.open(map, marker);
	              	});
            		trs=trs+'<tr>'+													
                                '<td><button class="btn btn-danger btn-xs" onclick="mostrarPunto('+lat+','+lon+',\u0027'+element.ct+'\u0027,\u0027'+nombre+'\u0027,\u0027'+nivel+'\u0027,\u0027'+mu+'\u0027,\u0027'+localidad+'\u0027,\u0027'+element.ejercicio+'\u0027,\u0027'+element.obra+'\u0027,\u0027'+element.inversion+'\u0027,\u0027'+element.programa+'\u0027,'+element.valida+')">Ver en mapa</button></td>'+
                                "<td>"+element.ct+"</td>"+
                                "<td>"+element.nombre+"</td>"+
                                "<td>"+element.municipio+"</td>"+
                                "<td>"+element.localidad+"</td>"+
                                "<td>"+finan+"</td>"+
							"</tr>";   

				    
				});
				document.getElementById("tabla").innerHTML =" ";
				$("#tabla").append("<br><br><h4>Escuelas</h4>"+
									"<table id='tab' class='display table-condensed tabla table-bordered' class='table table-hover'>"+
									"<thead>"+
										"<tr>"+
											"<th></th>"+
											"<th>CT</th>"+
											"<th>NOMBRE</th>"+
											"<th>MUNICIPIO</th>"+
											"<th>LOCALIDAD</th>"+
											"<th>FINANCIAMIENTO</th>"+
										"</tr>"+
									"</thead>"+
									"<tbody>"+
										trs+
									"</tbody>"+
									"</table>");
				$('#tab').DataTable({
					
					        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
					        "responsive": true,
					        "order": [[ 1, "asc" ]]
					        
				});						
                      			
			},"json");	      
        }

        function cambiar(municipio){
        	// console.log(municipio);
        	document.getElementById("divtipo").innerHTML =" ";
        	document.getElementById("divnivel").innerHTML =" ";
      		$("#imgTipo").show();
      		$("#imgNivel").show();
      		$.get("{{URL::to('mustrar_nivel')}}", {muni: municipio}, function(data) {
				$("#imgTipo").hide();
				$("#imgNivel").hide();
				$("#divtipo").append("<select name='tipo' class='form-control'><option value='0'  selected>Seleccione una opción</option>"+data.tipo+"</select>");
				$("#divnivel").append("<select name='nivel' class='form-control'><option value='0'  selected>Seleccione una opción</option>"+data.nivel+"</select>");
			},"json");
        }
        function consultar(){
      		var formData = new FormData(document.getElementById("formulario"));
      		
      		$.ajax({
                 type: 'post',   
                 cache: false,
                 url:'{{ URL::asset("mostrar") }}' ,    
                 data: formData,
                 contentType:false,
                 processData: false,
                 dataType: "json",
                 success: 
                    function(dataa) 
                    {
                    	 var trs='';       		
                    	map = new google.maps.Map(document.getElementById('map'), {
			            center: new google.maps.LatLng(dataa.lat,dataa.lon), //cambiar esta linea para centrar el mapa
			            zoom: 10
				        });
				        infoWindow = new google.maps.InfoWindow;
		            	dataa.datos.forEach(function(element) {
		        			// console.log(element.ct+element.lat+element.lon);
		        			var ct = element.ct;
						    var nombre = element.nombre;
						    var nivel = element.nivel_educativo;
			              	var mu = element.municipio;
			              	var localidad = element.localidad;
			              	var obra =element.obra;

			              	var lat= parseFloat(element.lat);
			              	var lon= parseFloat(element.lon);
			              	// console.log(lat+'****'+lon);
			              	var point = new google.maps.LatLng(
			                  	parseFloat(lat),
			                  	parseFloat(lon),
			                );	              
			              	var iconBase;
			                if(element.valida==1){
			                	// iconBase = "{{ URL::asset('img/1.png') }}";
			                	iconBase = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
			                	finan='Gobierno del Estado';

			                }else{
			                	// iconBase = "{{ URL::asset('img/2.png') }}";
			                	iconBase = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
			                	finan='Congreso';
			                }
			              	
			              	var marker = new google.maps.Marker({
			                	map: map,
			                	position: point,
			                	icon : iconBase,
			                	
			              	});
			              	marker.addListener('click', function() {
			                	infoWindow.setContent("<strong>"+ct+"</strong><br>NOMBRE CT: "+nombre+"<br>NIVEL EDUCATIVO: "+ nivel+"<br>MUNICIPIO: "+mu+"<br>"+"LOCALIDAD: "+localidad + "<br>AÑO DEL EJERCICIO: " + element.ejercicio+ "<br>OBRA: "+element.obra+"<br>INVERSIÓN: "+ new Intl.NumberFormat('es-MX').format(element.inversion) +"<br>PROGRAMA: "+element.programa);
			                	infoWindow.open(map, marker);
			              	});      
			              	
			              	trs=trs+'<tr>'+													
	                                    '<td><button class="btn btn-danger btn-xs" onclick="mostrarPunto('+lat+','+lon+',\u0027'+element.ct+'\u0027,\u0027'+nombre+'\u0027,\u0027'+nivel+'\u0027,\u0027'+mu+'\u0027,\u0027'+localidad+'\u0027,\u0027'+element.ejercicio+'\u0027,\u0027'+element.obra+'\u0027,\u0027'+element.inversion+'\u0027,\u0027'+element.programa+'\u0027,'+element.valida+')">Ver en mapa</button></td>'+
	                                    "<td>"+element.ct+"</td>"+
	                                    "<td>"+element.nombre+"</td>"+
	                                    "<td>"+element.municipio+"</td>"+
	                                    "<td>"+element.localidad+"</td>"+
	                                    "<td>"+finan+"</td>"+
									"</tr>";   
		            		
						    
						});
						document.getElementById("tabla").innerHTML =" ";
						$("#tabla").append("<br><br><h4>Escuelas</h4>"+
											"<table id='tab' class='display table-condensed tabla table-bordered' class='table table-hover'>"+
											"<thead>"+
												"<tr>"+
													"<th></th>"+
													"<th>CT</th>"+
													"<th>NOMBRE</th>"+
													"<th>MUNICIPIO</th>"+
													"<th>LOCALIDAD</th>"+
													"<th>FINANCIAMIENTO</th>"+
												"</tr>"+
											"</thead>"+
											"<tbody>"+
												trs+
											"</tbody>"+
											"</table>");
						$('#tab').DataTable({
							"language": {
							          "url": "{{URL::asset('js/lenguajeDataTable/es_es.json')}}"
							        },
							        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
							        "responsive": true,
							        "order": [[ 1, "asc" ]]
							        
						});						
                      	
                    }
             });
      				
			      
			            
			            // Array.prototype.forEach.call(markers, function(markerElem) {
			              	
        }

        

      	function downloadUrl(url, callback) {
        	var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        	request.onreadystatechange = function() {
	          	if (request.readyState == 4) {
	            	request.onreadystatechange = doNothing;
	            	callback(request, request.status);
	          	}
        	};
        	request.open('GET', url, true);
        	request.send(null);
      	}

      	

    function mostrarPunto(lat,lng,ct,nombre,nivel,mu,localidad,ejercicio,obra,inversion,programa,valida){
       		console.log(map);
	       	var popup = new google.maps.InfoWindow({
		        content: 'Wohoooo, salió el InfoWindow, pero ¿por qué sale exactamente en el punto del marcador?', 
		        position: new google.maps.LatLng(parseFloat(lat),parseFloat(lng))
		    });
		    var iconBase;
		    if(valida==1){
            	// iconBase = "{{ URL::asset('img/1.png') }}";
            	iconBase = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";

            }else{
            	// iconBase = "{{ URL::asset('img/2.png') }}";
            	iconBase = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
            }
			              	
 			var marker = new google.maps.Marker({
						                	map: map,
						                	position: new google.maps.LatLng(parseFloat(lat),parseFloat(lng)),
						                	icon: iconBase
						              	});
 			infoWindow.setContent("<strong>"+ct+"</strong><br>NOMBRE CT: "+nombre+"<br>NIVEL EDUCATIVO: "+ nivel+"<br>MUNICIPIO: "+mu+"<br>"+"LOCALIDAD: "+localidad + "<br>AÑO DEL EJERCICIO: " + ejercicio+ "<br>OBRA: "+obra+"<br>INVERSIÓN: "+ new Intl.NumberFormat('es-MX').format(inversion) +"<br>PROGRAMA: "+programa);
        	infoWindow.open(map, marker);
        	$("html, body").animate({scrollTop:"0px"});
		       		
		}    
    
    function scrollToTop(scrollDuration) {
	    var scrollStep = -window.scrollY / (scrollDuration / 15),
	        scrollInterval = setInterval(function(){
	        if ( window.scrollY != 0 ) {
	            window.scrollBy( 0, scrollStep );
	        }
	        else clearInterval(scrollInterval); 
	    },15);
    }
             
	</script>

	
	
@stop
