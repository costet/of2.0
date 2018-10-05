<?php
class obrasController extends BaseController {
	function inicio(){
		
		$muni=DB::select('select distinct municipio from obras') ;
		$nivel=DB::select('select distinct nivel_educativo from obras') ;
		return View::make("front.vista_inicio",compact("muni","nivel"));
		
	}
	function mostrar_todo()
	{
		$datos= DB::select("select  * from obras");	
		return json_encode(array('datos'=>$datos ));
	}
	function mustrar_nivel(){
		$tipos='';
		$municipios='';
		$muni = Input::get("muni");
		$munici= DB::select("select distinct nivel_educativo from obras where municipio like '".$muni."' ");
		$tipo= DB::select("select distinct valida from obras where municipio like '".$muni."' ");
		foreach ($munici as $mun) {
			$municipios= $municipios."<option value='".$mun->nivel_educativo."'>".$mun->nivel_educativo."</option>";
		}
		foreach ($tipo as $tip) {
			 
			if($tip->valida==1){
				$tipos= $tipos."<option value='".$tip->valida."' >Gobierno del Estado</option>";
			}else{
				$tipos= $tipos."<option value='".$tip->valida."' >Congreso</option>";
			}
			
		}

		// dd($tipos);

		return json_encode(array('nivel'=>$municipios,'tipo'=>$tipos ));
	}
	function mostrar(){			
		$muni=Input::get("municipio");
		$nivel=Input::get("nivel");
		$tipo=Input::get("tipo");
		$sql='';
		$sql2='';
		$sql3='';
		if ($nivel != '0' ) {
			$sql="and nivel_educativo like '".$nivel."'";
		}
		if ($tipo != '0') {
			$sql2= "and valida=".$tipo;
		}
		if ($muni == '0') {
			$sql3="municipio like '%%' ";
		}else{
			$sql3="municipio like '%".$muni."%' ";
		}

		if($tipo== '0' && $muni=='0' && $nivel=='0'){
			$datos= DB::select("SELECT * FROM obras ");
		}else{
			$datos= DB::select("SELECT * FROM obras where ".$sql3." ".$sql." ".$sql2);
		}
			
		
		$cordenada= DB::select("select * from coordenadas_muni where municipio like '".$muni."' ");	
		if (count($cordenada)>0) {
			$lat=$cordenada[0]->lat;
			$lng=$cordenada[0]->lng;
		}else{
			$lat=18.7475;
			$lng=-99.070278;
		}
		return json_encode(array('datos'=>$datos,'lat'=>$lat,"lon"=>$lng ));
		
		
	}  
	
	
}
