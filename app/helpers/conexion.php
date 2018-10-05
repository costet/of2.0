<?php
class Conexion
{
	private static $link = null;

	public static function getLink()
	{
		if( is_null(self::$link) )
		{
			//self::$link =odbc_connect("Driver={IBM INFORMIX ODBC DRIVER};Server=localhost;Database=nomina_mor;", 'a713ap00', 'a713ap00');
			//self::$link =odbc_connect("Driver={SQL Server Native Client 11.0};Server=localhost;Database=Recibos;", 'sa', 'samorelos');
			self::$link =odbc_connect("Driver={SQL Server Native Client 11.0};Server=localhost;Database=asignacion_plazas;", 'sa', 'samorelos');
			// self::$link = odbc_connect('oficinaVirtual','sa','samorelos' );
		}
		
		return self::$link;
	}

	public static function query($query)
	{
		return odbc_exec(self::getLink() , $query );
	}

	public static function fetchArray($result)
	{
		return odbc_fetch_array($result);
	}
}
?>