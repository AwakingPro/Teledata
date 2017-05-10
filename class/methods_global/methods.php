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
			$mysqli = $this->conexion();
			if ($mysqli) {
				$resultado = $mysqli->query($query);
				if ($resultado) {
					$return = $mysqli->insert_id;
					$mysqli->close();
				}else{
					$return = false;
					$mysqli->close();
				}
				return $return;
			}else{
				return 'No hay conexion';
			}
		}

		public function select($query) {
			$mysqli = $this->conexion();
			if ($mysqli) {
				$rows = array();
				if ($resultado = $mysqli->query($query)) {
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
			$tabla = "<table class='table table-striped tabeData'><thead><tr>";
			foreach ($data[0] as $clave => $valor) {
				$tabla.="<th>".$clave."</th>";
			}
			$tabla.="</tr></thead><tbody>";
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

