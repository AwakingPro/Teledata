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
				$mysqli->query("SET NAMES 'utf8'");
				return $mysqli;
			}
		}
		public function log($query,$operacion,$log = true){
			$mysqli = $this->conexion();
			if ($mysqli) {
				if (session_status() != PHP_SESSION_ACTIVE){
					session_start();
				}
				if (isset($_SESSION['idUsuario']) && $log) {
					$resultado = $mysqli->query('INSERT INTO log_query (IdUsuario, Fecha, Query, TipoOperacion) VALUES ("'.$_SESSION['idUsuario'].'", "'.date("Y-m-d H:i:s").'", "'.$query.'", "'.$operacion.'")');
				}
				$mysqli->close();
			}else{
				return 'No hay conexion';
			}
		}

		public function insert($query,$log = true){
			$mysqli = $this->conexion();
			if ($mysqli) {
				$resultado = $mysqli->query($query);
				if ($resultado) {
					$this->log($query, 'insert', $log);
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

		public function delete($query, $log = true){
			$mysqli = $this->conexion();
			if ($mysqli) {
				$resultado = $mysqli->query($query);
				if ($resultado) {
					$this->log($query, 'delete', $log);
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
				if ($resultado) {
					$this->log($query, 'update');
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
					// $this->log($query, 'select');
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
					for ($i=1; $i < count($fields) ; $i++) {
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
								if($clave != 0) {
									
									if($clave == 5) {
										$tabla.="<td class='campo-servicios'>".$valor."<i attr='".$rows[$i][1]."' data-nombre='".$rows[$i][2]."' class='verServiciosCliente fa fa-eye' title='Ver Servicios'></i></td>";
									} else {
										$tabla.="<td>".$valor."</td>";
									}
									
								}
									
							}
							if($table[0] == 'personaempresa'){
								$detalles = '<i class="fa fa-book dashboard" id="dashboard" attr="'.$rows[$i][0].'" data-dashboard="'.$rows[$i][2].'" aria-hidden="true" title="Resumen Cliente"></i>';
								$ver = '<i class="fa fa-eye update-'.$table[0].'" id="view" attr="'.$rows[$i][0].'" aria-hidden="true" title="Visualizar"></i>';
								$contactos = '<i class="fa fa-phone abre-modal-contactos" id="contactos" attr="'.$rows[$i][0].'" data-nombre="'.$rows[$i][2].'" aria-hidden="true" title="Contactos"></i>';
								$count = 0;
								$query = "SELECT * FROM servicios WHERE Rut = substring_index('".$rows[$i][1]."','-',1)";
								if ($resultado = $mysqli->query($query)) {
									while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
										$count++;
									}
								}
								$query = "SELECT * FROM facturas WHERE Rut = substring_index('".$rows[$i][1]."','-',1)";
								if ($resultado = $mysqli->query($query)) {
									while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
										$count++;
									}
								}
								if($count){
									$eliminar = '';
								}else{
									$eliminar = '<i class="fa fa-trash-o delete-'.$table[0].'"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>';
								}
							}else{
								$eliminar = '<i class="fa fa-trash-o delete-'.$table[0].'"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>';
								$ver = '';
							}
							$tabla.='<td class="optionTable">
								<i class="fa fa-pencil-square-o update-'.$table[0].'" attr="'.$rows[$i][0].'" id="update" aria-hidden="true" title="Editar"></i>
								'.$ver.'
								'.$contactos.'
								'.$detalles.'
								'.$eliminar.'
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

		function listViewContactos($post,$id = '',$tipo = '') {
			$mysqli = $this->conexion();
			if ($mysqli) {
				if ($resultado = $mysqli->query($post)) {
					while ($field = mysqli_fetch_field($resultado)) {
						$fields[] = $field->name;
						$table[] = $field->table;
					}
					$tabla = '';
					if($tipo){
						$tabla .= '<button class="btn btn-success agregarDatosTecnicos" attr="'.$id.'"  data-toggle="modal" data-target="#agregarDatosTecnicos" aria-hidden="true" title="Agregar" style="margin-bottom:20px">Agregar</button>';
					}
					$tabla .= "<table class='table table-striped table-hover tabeData' id='TableContactos'><thead><tr>";
					for ($i=1; $i < count($fields) ; $i++) {
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
								if($clave != 0)
								$tabla.="<td>".$valor."</td>";
							}
							// $update = '<i class="fa fa-edit updateDatosTecnicos" data-toggle="modal" data-target="#ModalDatosTecnicos" id="'.$rows[$i][0].'" attr="'.$id.'" aria-hidden="true" title="Editar"></i>';
							$update = '<i class="fa fa-edit update-'.$table[0].'" id="'.$rows[$i][0].'" attr="'.$id.'" aria-hidden="true" title="Editar"></i>';
							$tabla.='<td class="optionTable">
								'.$update.'
								<i class="fa fa-trash-o delete-'.$table[0].'"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>
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

		function listViewDelete($post,$id = '',$tipo = '') {
			$mysqli = $this->conexion();
			if ($mysqli) {
				if ($resultado = $mysqli->query($post)) {
					while ($field = mysqli_fetch_field($resultado)) {
						$fields[] = $field->name;
						$table[] = $field->table;
					}
					$tabla = '';
					if($tipo){
						$tabla .= '<button class="btn btn-success agregarDatosTecnicos" attr="'.$id.'"  data-toggle="modal" data-target="#agregarDatosTecnicos" aria-hidden="true" title="Agregar" style="margin-bottom:20px">Agregar</button>';
					}
					$tabla .= "<table class='table table-striped table-hover tabeData'><thead><tr>";
					for ($i=1; $i < count($fields) ; $i++) {
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
								if($clave != 0)
								$tabla.="<td>".$valor."</td>";
							}
							if($tipo){
								$update = '<i class="fa fa-edit updateDatosTecnicos" data-toggle="modal" data-target="#ModalDatosTecnicos" id="'.$rows[$i][0].'" attr="'.$id.'" aria-hidden="true" title="Editar"></i>';
							}else{
								$update = '';
							}
							$tabla.='<td class="optionTable">
								'.$update.'
								<i class="fa fa-trash-o delete-'.$table[0].'"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>
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

		function listViewSingle($post) {
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
					$tabla.="</tr></thead><tbody>";
					while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
						$rows[] = $fila;
					}
					if (isset($rows)) {
						for ($i=0; $i < count($rows) ; $i++) {
							$tabla.= '<tr>';
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

		function listViewTickets($post) {
			$mysqli = $this->conexion();
			if ($mysqli) {
				if ($resultado = $mysqli->query($post)) {
					while ($field = mysqli_fetch_field($resultado)) {
						$fields[] = $field->name;
						$table[] = $field->table;
					}
					$tabla = "<table class='table table-striped table-hover tabeData'><thead><tr>";
					for ($i=1; $i < count($fields) ; $i++) {
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
								if($clave != 0)
									$tabla.="<td>".$valor."</td>";
							}
							$tabla.='<td class="optionTable">
								<i class="fa fa-pencil-square-o update-'.$table[0].'" attr="'.$rows[$i][0].'"  aria-hidden="true" title="Editar"></i>
								<i class="fa fa-commenting comentarios" attr="'.$rows[$i][0].'"  data-toggle="modal" data-target="#comentarios" aria-hidden="true" title="Editar"></i>
								<i class="fa fa-trash-o delete-'.$table[0].'"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>
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
		function listViewTicketsSoporte($post) {
			$mysqli = $this->conexion();
			if ($mysqli) {
				if ($resultado = $mysqli->query($post)) {
					while ($field = mysqli_fetch_field($resultado)) {
						$fields[] = $field->name;
						$table[] = $field->table;
					}
					$tabla = "<table class='table table-striped table-hover tabeData'><thead><tr>";
					for ($i=1; $i < count($fields) ; $i++) {
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
								if($clave != 0)
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
					for ($i=1; $i < count($fields) ; $i++) {
						$tabla.="<th>".$fields[$i]."</th>";
					}
					$tabla.="<th>Acciones</th></tr></thead><tbody>";
					while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
						$rows[] = $fila;
					}
					if (isset($rows)) {
						for ($i=0; $i < count($rows) ; $i++) {
							$id = $rows[$i][0];
							$tabla.= '<tr>';
							foreach ($rows[$i] as $clave => $valor) {
								if($clave != 0){
									$tabla.="<td>".$valor."</td>";
								}
								// if($clave == 3){
								// 	$explode = explode('.',$valor);
								// 	if(isset($explode[1])){
								// 		if($explode[1] == '00'){
								// 			$valor = intval($valor);
								// 		}
								// 	}
								// 	$tabla.="<td>".$valor."</td>";
								// }
							}
							$query = "SELECT * FROM facturas_detalle WHERE IdServicio = '".$id."'";
							$count = 0;
							if ($resultado = $mysqli->query($query)) {
								while ($fila = $resultado->fetch_array(MYSQLI_NUM)) {
									$count++;
								}
							}
							if(!$count){
								$eliminar = '<i class="fa fa-times eliminarServicio" attr="'.$id.'" aria-hidden="true" title="eliminar"></i>';
							}else{
								$eliminar = '';
							}
							$tabla.='<td class="optionTable">
								<i class="fa fa-power-off estatusServicio" attr="'.$id.'"  data-toggle="modal" data-target="#modalEstatus" aria-hidden="true" title="Activar/Desactivar"></i>
								<i class="fa fa-plus listDatosTecnicos" attr="'.$id.'"  data-toggle="modal" data-target="#verServicios" aria-hidden="true" title="Ver"></i>
								<i class="fa fa-pencil-square-o mostrarDatosTecnicos" attr="'.$id.'"  data-toggle="modal" data-target="#modalEditar" aria-hidden="true" title="Ver"></i>
								'.$eliminar.'
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
								<i style="line-height: 50px;" class="fa fa-pencil-square-o update-'.$table[0].'" attr="'.$rows[$i][0].'"  aria-hidden="true" title="Editar"></i>
								<i style="line-height: 50px;" class="fa fa-trash-o delete-'.$table[0].'"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>
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
		function obtenerDv($_rol) {
			/* Bonus: remuevo los ceros del comienzo. */
			while($_rol[0] == "0") {
				$_rol = substr($_rol, 1);
			}
			$factor = 2;
			$suma = 0;
			for($i = strlen($_rol) - 1; $i >= 0; $i--) {
				$suma += $factor * $_rol[$i];
				$factor = $factor % 7 == 0 ? 2 : $factor + 1;
			}
			$dv = 11 - $suma % 11;
			/* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
			$dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
			return $dv;
		}
		function respaldarDB(){
			$result = exec("sudo mysqldump -u root -p teledata --password=".password." --user=".user." > /var/www/html/Teledata/backups/`date +%Y%m%d%H%M`.sql");
			echo $result;
		}
	}
 ?>