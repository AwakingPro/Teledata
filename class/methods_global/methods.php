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
		public function log($query){
			$mysqli = $this->conexion();
			if ($mysqli) {
				if (!isset($_SESSION['idUsuario']) || empty($_SESSION['idUsuario'])) {
					$resultado = $mysqli->query('INSERT INTO log_query (IdUsuario, Fecha, Query) VALUES (0, "'.date("Y-m-d H:i:s").'", "'.$query.'")');
				}else{
					$resultado = $mysqli->query('INSERT INTO log_query (IdUsuario, Fecha, Query) VALUES ("'.$_SESSION['idUsuario'].'", "'.date("Y-m-d H:i:s").'", "'.$query.'")');
				}
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

		public function insert($query){
			$mysqli = $this->conexion();
			if ($mysqli) {
				$resultado = $mysqli->query($query);
				$this->log($query);
				if ($resultado) {
					$return = $mysqli->insert_id;
					$mysqli->close();
				}else{
					$return = false;
					// $return = mysqli_error($mysqli);
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
				$this->log($query);
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
		public function update($query){
			$mysqli = $this->conexion();
			if ($mysqli) {
				$resultado = $mysqli->query($query);
				$this->log($query);
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
			$mysqli->set_charset("utf8");
			if ($mysqli) {
				$rows = array();
				if ($resultado = $mysqli->query($query)) {
					$this->log($query);
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
					$tabla = "<table class='table table-striped table-hover tabeData'><thead><tr>";
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
								<i class="fa fa-trash-o delete-'.$table[0].'"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>
								<i class="fa fa-pencil-square-o update-'.$table[0].'" attr="'.$rows[$i][0].'"  aria-hidden="true" title="Editar"></i>
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
		function listViewTicktes($post) {
			$mysqli = $this->conexion();
			if ($mysqli) {
				if ($resultado = $mysqli->query($post)) {
					while ($field = mysqli_fetch_field($resultado)) {
						$fields[] = $field->name;
						$table[] = $field->table;
					}
					$tabla = "<table class='table table-striped table-hover tabeData'><thead><tr>";
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
								<i class="fa fa-trash-o delete-'.$table[0].'"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>
								<i class="fa fa-pencil-square-o update-'.$table[0].'" attr="'.$rows[$i][0].'"  aria-hidden="true" title="Editar"></i>
								<i class="fa fa-commenting comentarios" attr="'.$rows[$i][0].'"  data-toggle="modal" data-target="#comentarios" aria-hidden="true" title="Editar"></i>
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
		function listViewTiketsSoporte($post) {
			$mysqli = $this->conexion();
			if ($mysqli) {
				if ($resultado = $mysqli->query($post)) {
					while ($field = mysqli_fetch_field($resultado)) {
						$fields[] = $field->name;
						$table[] = $field->table;
					}
					$tabla = "<table class='table table-striped table-hover tabeData'><thead><tr>";
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
								<i class="fa fa-calendar-times-o finalizar-'.$table[0].'" attr="'.$rows[$i][0].'"  aria-hidden="true" title="Finalizar Ticket"></i>
								<i class="fa fa-commenting comentarios" attr="'.$rows[$i][0].'"  data-toggle="modal" data-target="#comentarios" aria-hidden="true" title="Hacer un Comentario"></i>
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
		function listViewServicios($post) {
			$mysqli = $this->conexion();
			if ($mysqli) {
				if ($resultado = $mysqli->query($post)) {
					while ($field = mysqli_fetch_field($resultado)) {
						$fields[] = $field->name;
						$table[] = $field->table;
					}
					$tabla = "<table class='table table-striped table-hover tabeData'><thead><tr>";
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
								<i class="fa fa-list listDatosTecnicos" attr="'.$rows[$i][0].'"  data-toggle="modal" data-target="#verServicios" aria-hidden="true" title="Ver"></i>
								<i class="fa fa-plus agregarDatosTecnicos" attr="'.$rows[$i][0].'"  data-toggle="modal" data-target="#agregarDatosTecnicos" aria-hidden="true" title="Agregar"></i>
								<i class="fa fa-times eliminarServicio" attr="'.$rows[$i][0].'" aria-hidden="true" title="eliminar"></i>
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
		function listViewFacturasClientes($post) {
			$mysqli = $this->conexion();
			if ($mysqli) {
				if ($resultado = $mysqli->query($post)) {
					while ($field = mysqli_fetch_field($resultado)) {
						$fields[] = $field->name;
						$table[] = $field->table;
					}
					$tabla = "<table class='table table-striped table-hover tabeData'>
								<thead>
									<tr>
										<th>
											<input type='checkbox' name='' value='' checked>
										</th>";
					for ($i=0; $i < count($fields) ; $i++) {
						$tabla.="<th>".$fields[$i]."</th>";
					}
					$tabla.="</thead>
								<tbody>";
					while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
						$rows[] = $fila;
					}
					if (isset($rows)) {
						for ($i=0; $i < count($rows) ; $i++) {
							$tabla.= '<tr><td class="select-checkbox"><input type="checkbox" name="" value="" style="margin-left: 9px;" checked></td>';
							foreach ($rows[$i] as $clave => $valor) {
								$tabla.="<td>".$valor."</td>";
							}
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
		function listViewUsuarios($post) {
			$mysqli = $this->conexion();
			if ($mysqli) {
				if ($resultado = $mysqli->query($post)) {
					while ($field = mysqli_fetch_field($resultado)) {
						$fields[] = $field->name;
						$table[] = $field->table;
					}
					$tabla = "<table class='table table-striped table-hover tabeData'><thead><tr><th></th>";
					for ($i=0; $i < count($fields) ; $i++) {
						$tabla.="<th>".$fields[$i]."</th>";
					}
					$tabla.="<th></th></tr></thead><tbody>";
					while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
						$rows[] = $fila;
					}
					if (isset($rows)) {
						for ($i=0; $i < count($rows) ; $i++) {
							if (file_exists('../../ajax/perfil/img-profile/'.$rows[$i][0].'.jpg')) {
								$tabla.= '<tr><td><img class="img-circle" height="50" src="../ajax/perfil/img-profile/'.$rows[$i][0].'.jpg" alt="img-profile"></td>';
							} else {
								$tabla.= '<tr><td><img class="img-circle" height="50" src="../img/av1.png" alt="img-profile"></td>';
							}
							foreach ($rows[$i] as $clave => $valor) {
								$tabla.="<td style='line-height: 50px;'>".$valor."</td>";
							}
							$tabla.='<td class="optionTable" >
								<i style="line-height: 50px;" class="fa fa-trash-o delete-'.$table[0].'"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>
								<i style="line-height: 50px;" class="fa fa-pencil-square-o update-'.$table[0].'" attr="'.$rows[$i][0].'"  aria-hidden="true" title="Editar"></i>
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