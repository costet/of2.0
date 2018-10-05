<?php

class SeguridadController extends BaseController {

	

	public function iniciarSession()	
	{
		$user=Input::get('usuario');
		$pass=Input::get('pass');
		if($user=='administrador' && $pass='Subinfor09*'){
			Session::flush();
            Session::put("usuario", $user);
            Session::put("login", true);
            Session::save();
            return Redirect::to("/");
		}else{
			return Redirect::to("/login")->with(array("mensaje"=> "Usted no se encuentra registrado para tener acceso"));
		}
	 //    $code = Input::get( 'code' );
	 //    $OAuth = new OAuth();
		// //$OAuth::setHttpClient('CurlClient');
	 //    $googleService = OAuth::consumer( 'Google' );
	 //    if ( !empty( $code ) ) {

	 //        $token = $googleService->requestAccessToken( $code );
	 //        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
	 //       	$correo=explode("@",$result['email']);
	 //       	if($correo[1] == 'iebem.edu.mx'){ //iebem.edu.mx  gmail.com
	 //       		$verificar= DB::table('usuarios_intranet')->select('*')->where('correo','=',$result['email'])->get();
	 //       		if(count($verificar) > 0){
	 //       			Session::flush();
	 //                Session::put("usuario", $result['name']);
	 //                Session::put("correo", $result['email']);
	 //                Session::put("login", true);
	 //                Session::put("ct", $correo[0]);
	 //                Session::put("persona", $verificar[0]->persona);
	 //                Session::save();
	 //                // if($verificar[0]->persona == 0){
	 //                	return Redirect::to("/");
	 //                // }elseif ($verificar[0]->persona==1) {
	 //                // 	return Redirect::to("/admin");
	 //                // }elseif ($verificar[0]->persona==2) {
	 //                // 	return Redirect::to("/pagos");
	 //                // }
	                
	 //       		}else{
		//        		return Redirect::to("/login")->with(array("mensaje"=> "Usted no se encuentra registrado para tener acceso"));
		//        	}
	       		
	 //       	}else{
	 //       		return Redirect::to("/login")->with(array("mensaje"=> "Usted no se encuentra registrado para tener acceso"));
	 //       	}

	 //    }
	 //    else {
	 //        $url = $googleService->getAuthorizationUri();
	 //        return Redirect::to( (string)$url );
	 //    }
		// return View::make('hello');
	}
	public function salir(){
		Session::flush();
		Session::save();
		return Redirect::to("/login");
	}

}
