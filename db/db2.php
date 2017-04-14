<?php  
define ('DB_HOST', '192.168.1.122');
define ('DB_USER', 'root');
define ('DB_PASS', 's9q7l5.,777');
define ('DB_NOMBRE', 'foco');
define ('DB_CHARSET', 'utf8');
     
/**
* 
*/
class Conexion 
{
	protected $conexion_db;
	public function conexion() 
	{
		$this->conexion_db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NOMBRE);

		if($this->conexion_db->connect_error)
		{
			echo "Error en conexion" . $this->conexion_db->connect_error;
		}
		return;

		$this->conexion_db->set_charset(DB_CHARSET);
	}
}



?>

