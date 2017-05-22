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

		public function delete($query){
			$mysqli = $this->conexion();
			if ($mysqli) {
				$resultado = $mysqli->query($query);
				if ($resultado) {
					$return = true;
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
			$mysqli = $this->conexion();
			if ($mysqli) {
				if ($resultado = $mysqli->query($post)) {
					while ($field = mysqli_fetch_field($resultado)) {
						$fields[] = $field->name;
						$table[] = $field->table;
					}
					$tabla = "<table class='table table-striped tabeData'><thead><tr>";
					for ($i=0; $i < count($fields) ; $i++) {
						$tabla.="<th>".$fields[$i]."</th>";
					}
					$tabla.="<th></th></tr></thead><tbody>";
					while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
						$rows[] = $fila;
					}
					if (isset($rows)) {
						for ($i=0; $i < count($rows) ; $i++) {
							$tabla.= '<tr>';
							foreach ($rows[$i] as $clave => $valor) {
								$tabla.="<td>".$valor."</td>";
							}
							$tabla.='<td class="optionTable">
								<i class="fa fa-trash-o deleteRow"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>
								<i class="fa fa-pencil-square-o" attr="'.$rows[$i][0].'"  aria-hidden="true" title="Editar"></i>
								</td>';
							$tabla.= '</tr>';
						}
					}
					$tabla.="</tbody></table>";
					return $tabla;

				}else{
					return 'Problemas en el query de consulta';
				}
			}else{
				return 'No hay conexion';
			}
		}
	}

 ?>
