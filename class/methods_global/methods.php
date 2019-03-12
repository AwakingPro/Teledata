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
			if (session_status() != PHP_SESSION_ACTIVE){
				ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);
				ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
				session_start();
			}
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
			
			if($operacion == 'insert')
				$operacion = 'Insertar';
			if($operacion == 'delete')
				$operacion = 'Borrar';
			if($operacion == 'update')
				$operacion = 'Actualizar';

			$mysqli = $this->conexion();
			if ($mysqli) {
				if (isset($_SESSION['idUsuario']) && $log) {
					$resultado = $mysqli->query('INSERT INTO log_query (IdUsuario, Fecha, Query, TipoOperacion) VALUES ("'.$_SESSION['idUsuario'].'", "'.date("Y-m-d H:i:s").'", "'.$query.'", "'.$operacion.'")');
				}
				if (!isset($_SESSION['idUsuario']) && $log) {
					// el IdUsuario 118 sera usado cuando se hagan insert desde la api de bsale para sincronizar
					$idUsuario = 118;
					$resultado = $mysqli->query('INSERT INTO log_query(IdUsuario, Fecha, Query, TipoOperacion) VALUES ("'.$idUsuario.'", "'.date("Y-m-d H:i:s").'", "'.$query.'", "'.$operacion.'")');
				}
				$mysqli->close();
			}else{
				return 'No hay conexion';
			}
		}

		public function insert($query, $log = true){
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
		public function update2($query){
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
		function listViewContactos2($post,$id = '',$tipo = '') {
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
					$tabla .= "<table class='table table-striped table-hover tabeData' id='TableContactos2'><thead><tr>";
					
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
							<i style="visibility: hidden;" class="fa fa-trash-o delete-'.$table[0].'"  attr="'.$rows[$i][0].'" aria-hidden="true" title="Eliminar"></i>
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
							// if($tipo == 1){
							// 	$rows[$i][4] = \DateTime::createFromFormat('Y-m-d', $rows[$i][4])->format('d-m-Y');
							// }
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
			$result = exec("mysqldump -u ".$this->user." --password=".$this->password." teledata > /var/www/html/Teledata/backups/`date +%Y%m%d%H%M`.sql");
			echo $result;
		}
		 // metodo para obtener el total de clientes, documentos, etc de bsale
		 function contador($tipo, $urlbsale){
            $query = "SELECT token_produccion as access_token FROM variables_globales";
            $variables_globales = self::select($query);
            $access_token = $variables_globales[0]['access_token'];
			//Total Clientes
			$url = $urlbsale;
            // Inicia cURL
            $session = curl_init($url);
            // Indica a cURL que retorne data
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

            // Configura cabeceras
            $headers = array(
                'access_token: ' . $access_token,
                'Accept: application/json',
                'Content-Type: application/json'
            );
            curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

            // Ejecuta cURL
            $response = curl_exec($session);
            // Cierra la sesión cURL
            curl_close($session);
            $response = json_decode($response, true);
            if($tipo == 3){
                return $response;
            }else{
                return $response['count'];
            }
            
		}
		public function obtenerPDF($urlPDF){
			
			// Inicia cURL
            $session = curl_init($urlPDF);

            // Indica a cURL que retorne data
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			
            // Ejecuta cURL
            $response = curl_exec($session);
            
            // Cierra la sesión cURL
            curl_close($session);
            return $response;
		}
		
		public function EditClientApiBsale($datos, $url){
			$metodo = $datos['metodo'];
			$datosEnvio = array(
				"id"			=> $datos['id'],
				"state"			=> $datos['state']
			);
			$query = "SELECT token_produccion as access_token FROM variables_globales";
            $variables_globales = self::select($query);
            $access_token = $variables_globales[0]['access_token'];
            // Inicia cURL
            $session = curl_init($url);

            // Indica a cURL que retorne data
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

            // Configura cabeceras
            $headers = array(
                'access_token: ' . $access_token,
                'Accept: application/json',
                'Content-Type: application/json'
            );
            curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($session, CURLOPT_CUSTOMREQUEST, $metodo);
			$datosEnvioEncode = json_encode($datosEnvio);
			
			curl_setopt($session, CURLOPT_POSTFIELDS, $datosEnvioEncode);

            // Ejecuta cURL
            $response = curl_exec($session);
            
            // Cierra la sesión cURL
            curl_close($session);
            return $response = json_decode($response, true);
		}
		// metodo para conectar con la api de bsale y traer los datos para usarlos
        function conectarAPI($url){
			$query = "SELECT token_produccion as access_token FROM variables_globales";
            $variables_globales = self::select($query);
            $access_token = $variables_globales[0]['access_token'];
            // Inicia cURL
            $session = curl_init($url);

            // Indica a cURL que retorne data
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

            // Configura cabeceras
            $headers = array(
                'access_token: ' . $access_token,
                'Accept: application/json',
                'Content-Type: application/json'
            );
            curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

            // Ejecuta cURL
            $response = curl_exec($session);
            
            // Cierra la sesión cURL
            curl_close($session);
            return $response = json_decode($response, true);
        }
		// metodo para buscar dentro de una variable string
		function encontrar($Value, $findme){
			//limpio puntos de rut si es necesario
			$Value= str_replace('.', '', $Value);
			//busco $findme dentro de $Value
			$encontrado = strpos($Value, $findme);
			if($encontrado == true){
				$Value = explode($findme, $Value);
				$data = array('Value' => $Value,
						  'verificacion' => true
						);
			}else{
				$data = array('Value' => $Value,
						  'verificacion' => false
						);
			}
			return $data;
		}

		// metodo para buscar dentro de un array 
		function encontrarEnArray($Value, $findme){
			if (!in_array($findme, $Value)) {
				$findme = false;
			}
			return $findme;
		}
		// metodo para enviar correos
		function enviarCorreos($TipoCorreo, $Data){
			$MensajeCorreo = '';
			$Asunto = $Data['asunto'];
			$correos = $Data['correos'];
			if($TipoCorreo == 1){
				//esta validacion es porque el rut puede ser sin "-"
				if( isset($Data['RutExplode']['verificacion']) && $Data['RutExplode']['verificacion']){
					$RUTDV = $Data['RutExplode']['Value'][0].'-'.$Data['RutExplode']['Value'][1];
					$RUT = $Data['RutExplode']['Value'][0];
				}else{
					$RUTDV = $Data['RutExplode']['Value'];
					$RUT = $RUTDV;
				}
				$MensajeCorreo = "ESTIMADO(A)S, <br>
				El Cliente: <b>".$Data['ClienteNombre']."</b> RUT: <b>".$RUTDV."</b> se Ingreso con éxito a la base de datos del ERP desde Bsale.<br><br>
				<b>Queda en su responsabilidad si es necesario crear el servicio asociado al cliente y verificar que los datos del cliente
				sean los correctos.</b><br>
				<b>Es necesario que creen el servicio correspondiente si aplica para el funcionamiento de las facturas mensuales automáticas.</b><br>
				<b>Verificar que los datos del cliente sean los correctos.</b><br><br>
				URL Privada para crear servicios: http://172.30.222.76/servicios/?Rut=".$RUT."
				<br> URL Pública para crear servicio: http://131.0.108.31/servicios/?Rut=".$RUT."
				</b><br><br>
				Saludos.";
			}
			if($TipoCorreo == 2){
				$MensajeCorreo = $Data['MensajeCorreo'];
			}

			$Html =
			"<html>
				<head>
					<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
					<style>
					body{font-family:Open Sans;font-size:14px;}
					table{font-size:13px;border-collapse:collapse;}
					th{padding:8px;text-align:left;color:#595e62;border-bottom: 2px solid rgba(0,0,0,0.14);font-size:14px;}
					td{padding:8px;border-bottom: 1px solid rgba(0,0,0,0.05);}
					</style>
				</head>
				<body>
				".$MensajeCorreo."
				</body>
			</html>";
			$Email = new Email();
			//enviar correos con estilos pro
			if($TipoCorreo == 3){
				$Html = $Data['HTML'];
			}
			$ToReturn = $Email->SendMail($Html, $Asunto, $correos);
            return $ToReturn;
		}
		
		// metodo para platilla de correo
		function plantillaCorreo($dataClient){
			$Html = "<!DOCTYPE html>
			<!--[if IE 8]> <html lang='en' class='ie8'> <![endif]-->
			<!--[if !IE]><!-->
			<html lang='en'>
			<!--<![endif]-->
			<head>
				<meta charset='utf-8' />
				<title>Error | Tipo Factura</title>
				<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' name='viewport' />
				<meta content='' name='description' />
				<meta content='' name='author' />
				
				<style type='text/css'>
					/******************************************************
					* INK RESPONSIVE EMAIL TEMPLATE: http://zurb.com/ink/ *
					******************************************************/
					
					/* Client-specific Styles & Reset */
					
					a img,hr{border:none}.img-logo,table.container table.row{display:block}.img-logo,a{text-decoration:none}#outlook a{padding:0}body{width:100%!important;min-width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}.ExternalClass{width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:100%}#backgroundTable{margin:0;padding:0;width:100%!important;line-height:100%!important}img.center,table.column,table.columns{margin:0 auto}.img-logo{outline:0;-ms-interpolation-mode:bicubic;width:auto;max-width:100%;float:left;clear:both}center{width:100%;min-width:580px}table{border-spacing:0;border-collapse:collapse}td{word-break:break-word;-webkit-hyphens:auto;-moz-hyphens:auto;hyphens:auto;border-collapse:collapse!important}table,td,tr{padding:0;vertical-align:top;text-align:left}hr{color:#d9d9d9;background-color:#d9d9d9;height:1px}table.body{height:100%;width:100%}table.container{width:580px;margin:0 auto;text-align:inherit}h1.center,h2.center,h3.center,h4.center,h5.center,h6.center,span.center,table.center,td.center{text-align:center}table.row{padding:0;width:100%;position:relative}td.wrapper{padding:10px 20px 0 0;position:relative}table.column td,table.columns td{padding:0 0 10px}table.column td.sub-column,table.column td.sub-columns,table.columns td.sub-column,table.columns td.sub-columns{padding-right:10px}td.sub-column,td.sub-columns{min-width:0}table.container td.last,table.row td.last{padding-right:0}table.one{width:30px}table.two{width:80px}table.three{width:130px}table.four{width:180px}table.five{width:230px}table.six{width:280px}table.seven{width:330px}table.eight{width:380px}table.nine{width:430px}table.ten{width:480px}table.eleven{width:530px}table.twelve{width:580px}table.one center{min-width:30px}table.two center{min-width:80px}table.three center{min-width:130px}table.four center{min-width:180px}table.five center{min-width:230px}table.six center{min-width:280px}table.seven center{min-width:330px}table.eight center{min-width:380px}table.nine center{min-width:430px}table.ten center{min-width:480px}table.eleven center{min-width:530px}table.twelve center{min-width:580px}table.one .panel center{min-width:10px}table.two .panel center{min-width:60px}table.three .panel center{min-width:110px}table.four .panel center{min-width:160px}table.five .panel center{min-width:210px}table.six .panel center{min-width:260px}table.seven .panel center{min-width:310px}table.eight .panel center{min-width:360px}table.nine .panel center{min-width:410px}table.ten .panel center{min-width:460px}table.eleven .panel center{min-width:510px}table.twelve .panel center{min-width:560px}.body .column td.one,.body .columns td.one{width:8.333333%}.body .column td.two,.body .columns td.two{width:16.666666%}.body .column td.three,.body .columns td.three{width:25%}.body .column td.four,.body .columns td.four{width:33.333333%}.body .column td.five,.body .columns td.five{width:41.666666%}.body .column td.six,.body .columns td.six{width:50%}.body .column td.seven,.body .columns td.seven{width:58.333333%}.body .column td.eight,.body .columns td.eight{width:66.666666%}.body .column td.nine,.body .columns td.nine{width:75%}.body .column td.ten,.body .columns td.ten{width:83.333333%}.body .column td.eleven,.body .columns td.eleven{width:91.666666%}.body .column td.twelve,.body .columns td.twelve{width:100%}td.offset-by-one{padding-left:50px}td.offset-by-two{padding-left:100px}td.offset-by-three{padding-left:150px}td.offset-by-four{padding-left:200px}td.offset-by-five{padding-left:250px}td.offset-by-six{padding-left:300px}td.offset-by-seven{padding-left:350px}td.offset-by-eight{padding-left:400px}td.offset-by-nine{padding-left:450px}td.offset-by-ten{padding-left:500px}td.offset-by-eleven{padding-left:550px}td.expander{visibility:hidden;width:0;padding:0!important}table.column .text-pad,table.columns .text-pad{padding-left:10px;padding-right:10px}table.column .left-text-pad,table.column .text-pad-left,table.columns .left-text-pad,table.columns .text-pad-left{padding-left:10px}table.column .right-text-pad,table.column .text-pad-right,table.columns .right-text-pad,table.columns .text-pad-right{padding-right:10px}.block-grid{width:100%;max-width:580px}.block-grid td{display:inline-block;padding:10px}.two-up td{width:270px}.three-up td{width:173px}.four-up td{width:125px}.five-up td{width:96px}.six-up td{width:76px}.seven-up td{width:62px}.eight-up td{width:52px}span.center{display:block;width:100%}img.center{float:none}.hide-for-desktop,.show-for-small{display:none}body,h1,h2,h3,h4,h5,h6,p,table.body,td{color:#222;font-family:Helvetica,Arial,sans-serif;font-weight:400;padding:0;margin:0;text-align:left;line-height:1.3}a,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{color:#2ba6cb}h1,h2,h3,h4,h5,h6{word-break:normal}h1{font-size:40px}h2{font-size:36px}h3{font-size:32px}h4{font-size:28px}h5{font-size:24px}h6{font-size:20px}body,p,table.body,td{font-size:14px;line-height:19px}p.lead,p.lede,p.leed{font-size:18px;line-height:21px}p{margin-bottom:10px}small{font-size:10px}a:active,a:hover{color:#2795b6!important}a:visited,h1 a:active,h1 a:visited,h2 a:active,h2 a:visited,h3 a:active,h3 a:visited,h4 a:active,h4 a:visited,h5 a:active,h5 a:visited,h6 a:active,h6 a:visited{color:#2ba6cb!important}.panel{background:#f2f2f2;border:1px solid #d9d9d9;padding:10px!important}.sub-grid table{width:100%}.sub-grid td.sub-columns{padding-bottom:0}table.button,table.large-button,table.medium-button,table.small-button,table.tiny-button{width:100%;overflow:hidden}table.button td,table.large-button td,table.medium-button td,table.small-button td,table.tiny-button td{display:block;width:auto!important;text-align:center;background:#2ba6cb;border:1px solid #2284a1;color:#fff;padding:8px 0}table.button:active td,table.button:hover td,table.button:visited td,table.large-button:hover td,table.medium-button:hover td,table.small-button:hover td,table.tiny-button:hover td{background:#2795b6!important}table.tiny-button td{padding:5px 0 4px}table.small-button td{padding:8px 0 7px}table.medium-button td{padding:12px 0 10px}table.large-button td{padding:21px 0 18px}table.button td a,table.large-button td a,table.medium-button td a,table.small-button td a,table.tiny-button td a{font-weight:700;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#fff;font-size:16px}table.button td a:visited,table.button:active td a,table.button:hover td a,table.button:visited td a,table.large-button td a:visited,table.large-button:active td a,table.large-button:hover td a,table.medium-button td a:visited,table.medium-button:active td a,table.medium-button:hover td a,table.small-button td a:visited,table.small-button:active td a,table.small-button:hover td a,table.tiny-button td a:visited,table.tiny-button:active td a,table.tiny-button:hover td a{color:#fff!important}table.tiny-button td a{font-size:12px;font-weight:400}table.small-button td a{font-size:16px}table.medium-button td a{font-size:20px}table.large-button td a{font-size:24px}table.secondary td{background:#e9e9e9;border-color:#d0d0d0;color:#555}table.secondary td a{color:#555}table.secondary:hover td{background:#d0d0d0!important;color:#555}table.secondary td a:visited,table.secondary:active td a,table.secondary:hover td a{color:#555!important}table.success td{background:#5da423;border-color:#457a1a}table.success:hover td{background:#457a1a!important}table.alert td{background:#c60f13;border-color:#970b0e}table.alert:hover td{background:#970b0e!important}table.radius td{-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}table.round td{-webkit-border-radius:500px;-moz-border-radius:500px;border-radius:500px}body.outlook p{display:inline!important}@media only screen and (max-width:600px){table[class=body] img{width:auto!important;height:auto!important}table[class=body] center{min-width:0!important}table[class=body] .container{width:95%!important}table[class=body] .row{width:100%!important;display:block!important}table[class=body] .wrapper{display:block!important;padding-right:0!important}table[class=body] .column,table[class=body] .columns{table-layout:fixed!important;float:none!important;width:100%!important;padding-right:0!important;padding-left:0!important;display:block!important}table[class=body] .wrapper.first .column,table[class=body] .wrapper.first .columns{display:table!important}table[class=body] table.column td,table[class=body] table.columns td{width:100%!important}table[class=body] .column td.one,table[class=body] .columns td.one{width:8.333333%!important}table[class=body] .column td.two,table[class=body] .columns td.two{width:16.666666%!important}table[class=body] .column td.three,table[class=body] .columns td.three{width:25%!important}table[class=body] .column td.four,table[class=body] .columns td.four{width:33.333333%!important}table[class=body] .column td.five,table[class=body] .columns td.five{width:41.666666%!important}table[class=body] .column td.six,table[class=body] .columns td.six{width:50%!important}table[class=body] .column td.seven,table[class=body] .columns td.seven{width:58.333333%!important}table[class=body] .column td.eight,table[class=body] .columns td.eight{width:66.666666%!important}table[class=body] .column td.nine,table[class=body] .columns td.nine{width:75%!important}table[class=body] .column td.ten,table[class=body] .columns td.ten{width:83.333333%!important}table[class=body] .column td.eleven,table[class=body] .columns td.eleven{width:91.666666%!important}table[class=body] .column td.twelve,table[class=body] .columns td.twelve{width:100%!important}table[class=body] td.offset-by-eight,table[class=body] td.offset-by-eleven,table[class=body] td.offset-by-five,table[class=body] td.offset-by-four,table[class=body] td.offset-by-nine,table[class=body] td.offset-by-one,table[class=body] td.offset-by-seven,table[class=body] td.offset-by-six,table[class=body] td.offset-by-ten,table[class=body] td.offset-by-three,table[class=body] td.offset-by-two{padding-left:0!important}table[class=body] table.columns td.expander{width:1px!important}table[class=body] .right-text-pad,table[class=body] .text-pad-right{padding-left:10px!important}table[class=body] .left-text-pad,table[class=body] .text-pad-left{padding-right:10px!important}table[class=body] .hide-for-small,table[class=body] .show-for-desktop{display:none!important}table[class=body] .hide-for-desktop,table[class=body] .show-for-small{display:inherit!important}}
				</style>
				<style type='text/css'>
					/********************************
					* CUSTOM STYLING - SYSTEM EMAIL *
					********************************/
					body{background:#d9e0e7}a:focus,a:hover{text-decoration:underline}body,p,table.body,td{font-size:12px}h1,h2,h3,h4{margin:5px 0 10px}h5,h6{margin:5px 0}h1{font-size:36px}h2{font-size:30px}h3{font-size:24px}h4{font-size:18px}h5{font-size:14px}h6{font-size:12px}h1.last,h2.last,h3.last,h4.last,h5.last,h6.last,p.last{margin-bottom:0}td.last{padding-bottom:0!important}td.wrapper{padding:15px 15px 0}table.column td,table.columns td{padding:0 0 15px}.footer,.header{background:#fff}.content.dark-theme{background:#2d353c}.content.dark-theme .panel{background:#1b2024;border:none}.content.dark-theme .blanco,.content.dark-theme .highlight,.content.dark-theme h1,.content.dark-theme h2,.content.dark-theme h3,.content.dark-theme h4,.content.dark-theme h5,.content.dark-theme h6{color:#fff!important}.content.dark-theme a,a{color:#00acac}.content.dark-theme p,.content.dark-theme td{color:#a8acb1!important}.divider{height:1px;width:100%;background:#000;margin-top:5px}.text-right{text-align:right}.valign-middle{vertical-align:middle}.m-t-0{margin-top:0!important}.m-t-5{margin-top:5px!important}.m-t-10{margin-top:10px!important}.m-t-15{margin-top:15px!important}.m-b-0{margin-bottom:0!important}.m-b-5{margin-bottom:5px!important}.m-b-10{margin-bottom:10px!important}.m-b-15{margin-bottom:15px!important}.p-t-0{padding-top:0!important}.p-t-5{padding-top:5px!important}.p-t-10{padding-top:10px!important}.p-t-15{padding-top:15px!important}.btn a,.button a{color:#fff!important;font-weight:400!important;text-decoration:none!important}table.btn td,table.button td{vertical-align:middle!important;padding:6px 18px!important;background:#00acac!important;border-color:#00acac!important}table.btn:active td,table.btn:hover td,table.btn:visited td,table.button:active td,table.button:hover td,table.button:visited td{background:#008a8a!important;border-color:#008a8a!important}table.btn.orange td,table.button.orange td{background:#f59c1a!important;border-color:#f59c1a!important}table.btn.orange:active td,table.btn.orange:hover td,table.btn.orange:visited td,table.button.orange:active td,table.button.orange:hover td,table.button.orange:visited td{background:#c47d15!important;border-color:#c47d15!important}table.btn.blue td,table.button.blue td{background:#348fe2!important;border-color:#348fe2!important}table.btn.blue:active td,table.btn.blue:hover td,table.btn.blue:visited td,table.button.blue:active td,table.button.blue:hover td,table.button.blue:visited td{background:#2a72b5!important;border-color:#2a72b5!important}table.btn.red td,table.button.red td{background:#ff5b57!important;border-color:#ff5b57!important}table.btn.red:active td,table.btn.red:hover td,table.btn.red:visited td,table.button.red:active td,table.button.red:hover td,table.button.red:visited td{background:#cc4946!important;border-color:#cc4946!important}table.btn.white td a,table.button.white td a{color:#333!important}table.btn.white td,table.button.white td{background:#fff!important;border-color:#fff!important}table.btn.white:active td,table.btn.white:hover td,table.btn.white:visited td,table.button.white:active td,table.button.white:hover td,table.button.white:visited td{background:#e2e7eb!important;border-color:#e2e7eb!important}table.btn.grey td,table.button.grey td{background:#348fe2!important;border-color:#348fe2!important}table.btn.grey:active td,table.btn.grey:hover td,table.btn.grey:visited td,table.button.grey:active td,table.button.grey:hover td,table.button.grey:visited td{background:#929ba1!important;border-color:#929ba1!important}@media only screen and (max-width:600px){.body .container.content{width:100%!important}table[class=body] .wrapper{padding-right:15px!important}.text-right{text-align:left!important}}
				</style>
			</head>
			<body>
			<!-- begin page body -->
			<table class='body'>
				<tr>
					<td class='center' align='center' valign='top'>
						<center>
							<!-- begin page header -->
							<table class='row header'>
								<tr>
									<td class='center' align='center'>
										<center>
											<!-- begin container -->
											<table class='container'>
												<tr>
													<td class='wrapper'>
														<!-- begin six columns -->
														<table class='six columns'>
															<tr>
																<td>
																	<a target='_blank' href='http://teledata.cl/'><img class='img-logo' style='width:90px;' src='http://teledata.cl/images_web/logo-teledata-200.png' /></a>
																</td>
																<td class='expander'></td>
															</tr>
														</table>
														<!-- end six columns -->
													</td>
													<td class='wrapper'>
														<!-- begin six columns -->
														<table class='six columns'>
															<tr>
																<td class='text-right valign-middle'>
																	<span class='template-label'>Sincronización con Bsale en la BD del ERP</span>
																</td>
																<td class='expander'></td>
															</tr>
														</table>
														<!-- end six columns -->
													</td>
												</tr>
											</table>
											<!-- end container -->
										</center>
									</td>
								</tr>
							</table>
							<!-- end page header -->
							
							<!-- begin page container -->
							<table class='container content dark-theme'>
								<tr>
									<td>
										<!-- begin row -->
										<table class='row'>
											<tr>
												<!-- begin wrapper -->
												<td class='wrapper'>
													<table class='twelve columns'>
														<tr>
															<td class='last'>
																<h4>". $dataClient['Subtitulo']. "</h4>
																
																<p class='m-b-5'>". $dataClient['MensajeCorreo']. "</p>
															</td>
														</tr>
														<!-- <tr>
															<td class='panel'>
																<a href='javascript:;'>https://www.wrapbootstrap.com/registration/activate/?code=28a782891</a>
															</td>
														</tr>
														<tr>
															<td>
																<p class='m-t-15 last'>If clicking the URL above does not work, copy and paste the URL into a browser window.</p>
															</td>
														</tr> -->
													</table>
												</td>
												<!-- end wrapper -->
											</tr>
										</table>
										<!-- end row -->
										<!-- begin divider -->
										<table class='divider'></table>
										<!-- end divider -->
										<!-- begin row -->
										<table class='row'>
											<tr>
												<!-- begin wrapper -->
												<td class='wrapper'>
													<!-- begin twelve columns -->
													<table class='twelve columns'>
														<tr>
															<td>"
																.$dataClient['Subtitulo2']
																.$dataClient['Parrafo'][0]
																.$dataClient['Parrafo'][1]
																.$dataClient['Parrafo'][2]
																.$dataClient['Parrafo'][3]
																.$dataClient['Parrafo'][4]
															."</td>
														</tr>
													</table>
													<!-- end twelve columns -->
													<p>
														<i class='blanco'>Esto es un correo electrónico generado por el sistema y no se requiere respuesta.</i>
													</p>
												</td>
												<!-- end wrapper -->
											</tr>
										</table>
										<!-- end row -->
									</td>
								</tr>
							</table>
							<!-- end page container -->
							
							<!-- begin page footer -->
							<table class='row footer'>
								<tr>
									<td class='center' align='center'>
										<center>
											<!-- begin container -->
											<table class='container'>
												<tr>
													<td class='wrapper'>
														<table class='six columns'>
															<tr>
																<td>
																	&copy; Teledata". date('Y')
																."</td>
																<td class='expander'></td>
															</tr>
														</table>
													</td>
													<td class='wrapper'>
														<table class='six columns'>
															<tr>
																<td class='wrapper text-right valign-middle'>
																	<a href='http://teledata.cl/#gtco-nosotros' target='_blank'>Nosotros</a>
																	&nbsp; 
																	<a href='http://teledata.cl/#gtco-features' target='_blank'>Servicios</a>
																	&nbsp; 
																	<a href='http://teledata.cl/#gtco-subscribe' target='_blank'>Factibilidad</a>
																</td>
																<td class='expander'></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<!-- end container -->
										</center>
									</td>
								</tr>
							</table>
							<!-- end page footer -->
						</center>
					</td>
				</tr>
			</table>
			<!-- end page body -->
			</body>
			</html>";
			return $Html;
		}

		public function cellColor($cells,$color){
			global $objPHPExcel;
		
			$objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					 'rgb' => $color
				)
			));
		}
	}
 ?>