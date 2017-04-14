<?php
class Conexion{

	private $dbhost = 'localhost';
	private $dbuser = 'root';
	private $dbpass = 'M9a7r5s3A';
	private $dbname = 'foco';

	public function conectar(){

		$mysqli = new mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname);
		
		if ($mysqli ->connect_error){
			echo "Error de Connexion ($mysqli->connect_errno)
			$mysqli->connect_error\n";
			exit;
		} 
		else
		{
			return $mysqli;
		}
	}	
}
?>