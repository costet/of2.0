<?php

	Route::get('/',array('uses' => 'obrasController@inicio') );	
	Route::post('/mostrar',array('uses' => 'obrasController@mostrar') );
	Route::get('/mostrar_todo',array('uses' => 'obrasController@mostrar_todo') );
	Route::get('/mustrar_nivel',array('uses' => 'obrasController@mustrar_nivel') );
    // Route::get('/ajax_tipo',array('uses' => 'obrasController@tipo') );

	
	





