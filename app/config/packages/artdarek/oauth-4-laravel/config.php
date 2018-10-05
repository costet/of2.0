<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array(),
        ),		
        'Google' => array(
		    'client_id'     => '1034333385662-mlt7ke5i19tp2fpjemcerupo02b1scks.apps.googleusercontent.com',
		    'client_secret' => '5yfnEaJGzJuGadPyHSDZMhSV',
		    'scope'         => array('userinfo_email', 'userinfo_profile'),
		),  
	)

);