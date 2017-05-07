<?php
	/**
	* Métodos globales
	*/

	include_once('settings_mysql.php');

	class Method {

		private $host;
		private $user;
		private $password;
		private $nameDateBase;

		function __construct () {
			$this->host = host;
			$this->user = user;
			$this->password = password;
			$this->nameDateBase = nameDataBase;
		}

		public function conexion(){
			$mysqli = new mysqli(host, user, password, nameDataBase);
			if ($mysqli->connect_error) {
				return 'Error de Conexión (' . $mysqli->connect_errno . ') '. $mysqli->connect_error;
			}else{
				return $mysqli;
			}
		}

		public function insert($query){
			if ($this->conexion()) {
				$resultado = $this->conexion()->query($query);
				if ($resultado) {
					$return = $this->conexion()->insert_id;
					$this->conexion()->close();
				}else{
					$return = "Problemas en el query";
					$this->conexion()->close();
				}
				return $return;
			}else{
				return 'No hay conexion';
			}
		}

		public function select($query) {
			if ($this->conexion()) {
				$rows = array();
				if ($resultado = $this->conexion()->query($query)) {
					while ($fila = $resultado->fetch_assoc()) {
						$rows[] = $fila;
					}
				    	$resultado->free();
				}
		           		return $rows;
		           	}else{
		            		return 'No hay conexion';
		            	}
		}

		function listView($post) {
			$data =  $this->select($post);
			$tabla = "<table class='table table-striped DataTable'><thead><tr>";
			foreach ($data[1] as $clave => $valor) {
				$tabla.="<th>".$clave."</th>";
			}
			$tabla.="<tr></thead><tbody>";
			for ($i=0; $i < count($data) ; $i++) {
				$tabla.= '<tr>';
				foreach ($data[$i] as $clave => $valor) {
					$tabla.="<th>".$valor."</th>";
				}
				$tabla.= '</tr>';
			}
			$tabla.="</tbody></table>";
			return $tabla;
		}


	}
 ?>

