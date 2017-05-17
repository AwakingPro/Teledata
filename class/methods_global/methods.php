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
					while ($fila = $resultado->fetch_array(MYSQLI_BOTH)) {
						$rows[] = $fila;
					}
					$resultado->free();
					return $rows;
				}else{
					return 'Problemas en el query de consulta';
				}
			}else{
				return 'No hay conexion';
			}
		}

		function listView($post) {
			$data = $this->select($post);
			if (count($data) > 0) {
				$tabla = "<table class='table table-striped tabeData'><thead><tr>";
				foreach ($data[0] as $clave => $valor) {
					$tabla.="<th>".$clave."</th>";
				}
				$tabla.="<th></th></tr></thead><tbody>";
				for ($i=0; $i < count($data) ; $i++) {
					$tabla.= '<tr>';
					foreach ($data[$i] as $clave => $valor) {
						$tabla.="<td>".$valor."</td>";
					}
					$tabla.='<td class="optionTable">
						<i class="fa fa-trash-o" aria-hidden="true" title="Eliminar"></i>
						<i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar"></i>
						</td>';
					$tabla.= '</tr>';
				}
				$tabla.="</tbody></table>";
				return $tabla;
			}else{
				$msn = "<h2>No se encontraron datos para la tabla</h2>";
				return $msn;
			}
		}
	}

 ?>

