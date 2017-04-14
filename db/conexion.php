<?php

/** 
*
* @Clase Conexion a la Base de Datos
* @versión: 1.0     @modificado: 6 de Septiembre del 2016
* @autor: Luis Ponce
*
*/

class Conexion{

	private $dbhost = 'localhost';
	private $dbuser = 'root';
	private $dbpass = 'm9a7r5s3';
	private $dbname = 'SPOTMANAGER';

	public function conectar (){

		$mysqli = new mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname);
		
		if ($mysqli ->connect_error){
			echo "Error de Connexion ($mysqli->connect_errno)
			$mysqli->connect_error\n";
			exit;
		} 
		else{
			return $mysqli;
		}
	}	
}
?>