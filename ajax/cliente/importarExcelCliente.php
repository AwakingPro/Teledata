<?php 
	require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
	require_once('../../class/methods_global/methods.php');
	session_start();
	$idUsuario = $_SESSION['idUsuario'];

	$objPHPExcel = PHPExcel_IOFactory::load("excel.xlsx");
	$run = new Method;
	$query = "DELETE FROM personaempresa";
	$delete = $run->delete($query);
	$query = "DELETE FROM servicios";
	$delete = $run->delete($query);

	foreach ($objPHPExcel->getWorksheetIterator() as $index => $worksheet) {

		// $worksheetTitle     = $worksheet->getTitle();
		$highestRow         = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		// $nrColumns = ord($highestColumn) - 64;
		// echo "<br>The worksheet ".$worksheetTitle." has ";
		// echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
		// echo ' and ' . $highestRow . ' row.';
		// echo '<br>Data: <table border="1"><tr>';

		if($index == 1){
			for ($row = 2; $row <= $highestRow; ++ $row) {
				// echo '<tr>';
				for ($col = 0; $col < $highestColumnIndex; ++ $col) {
					$cell = $worksheet->getCellByColumnAndRow($col, $row);
					$val = $cell->getValue();
					if($col == 0){
						$CodigoCliente = $val;
						if($CodigoCliente){
							$RutDv = explode("-", $val);
							$Rut = $RutDv[0];
							if(isset($RutDv[1])){
								$Dv = $RutDv[1];
							}else{
								$Dv = 0;
							}
						}else{
							continue;
						}
					}else if($col == 2){
						$Codigo = $val;
					}else if($col == 3){
						if($val == "Ip Pública"){
							$IdServicio = 4;
						}else{
							$IdServicio = 1;
						}
					}else if($col == 4){
						$Valor = $val;
					}else if($col == 5){
						$Descripcion = $val;
					}
					// $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
					// echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
				}

				$query = " INSERT INTO servicios (Rut, Grupo, TipoFactura, Valor, Descuento, IdServicio, Codigo, Descripcion, IdUsuarioSession, Alias, Estatus, FechaInstalacion, InstaladoPor, Comentario, UsuarioPppoe, Direccion, Latitud, Longitud, Referencia, Contacto, Fono, PosibleEstacion, Equipamiento, SenalTeorica, IdUsuarioAsignado, SenalFinal, EstacionFinal, EstatusFacturacion, CostoInstalacion, CostoInstalacionDescuento, FacturarSinInstalacion, FechaComprometidaInstalacion, FechaFacturacion, FechaUltimoCobro) VALUES ('".$Rut."', '1', 'BSMI', '".$Valor."', '0', '".$IdServicio."', '".$Codigo."', '".$Descripcion."', '".$idUsuario."', '".$Codigo."', '0', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '0', '', '', '0', '', '0', '0', '1970-01-01', NOW(), NOW())";
				$id = $run->insert($query);
				if(!$id){
					echo 'Error 1';
				}
			}
		}else if($index == 2){
			for ($row = 2; $row <= $highestRow; ++ $row) {
				// echo '<tr>';
				for ($col = 0; $col < $highestColumnIndex; ++ $col) {
					$cell = $worksheet->getCellByColumnAndRow($col, $row);
					$val = $cell->getValue();
					if($col == 0){
						$CodigoCliente = $val;
						if($CodigoCliente){
							$RutDv = explode("-", $val);
							$Rut = $RutDv[0];
							if(isset($RutDv[1])){
								$Dv = $RutDv[1];
							}else{
								$Dv = 0;
							}
						}else{
							continue;
						}
					}else if($col == 1){
						$Nombre = $val;
					}else if($col == 3){
						$Giro = $val;
					}else if($col == 6){
						$Provincia = $val;
					}else if($col == 7){
						$Comuna = $val;
					}else if($col == 8){
						$Direccion = $val;
					}else if($col == 9){
						$Correo = $val;
					}else if($col == 10){
						$Telefono = $val;
					}else if($col == 12){
						$Contacto = $val;
					}
					// $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
					// echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
				}

				$query = "INSERT INTO personaempresa
					(rut, dv, nombre, giro, comuna, provincia, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, IdUsuarioSession, CodigoCliente)
					VALUES
					('".$Rut."', '".$Dv."', '".$Nombre."', '".$Giro."', '".$Comuna."', '".$Provincia."', '".$Direccion."', '".$Correo."', '".$Contacto."', '', '".$Telefono."', '', '2', '".$idUsuario."','".$CodigoCliente."')";
				$id = $run->insert($query);

				if(!$id){
					// $array = array('Rut' => $Rut, 'Dv' => $Dv, 'Nombre' => $Nombre, 'Giro' => $Giro, 'Comuna' => $Comuna, 'Provincia' => $Provincia, 'Direccion' => $Direccion, 'Correo' => $Correo, 'Contacto' => $Contacto, 'Telefono' => $Telefono, 'TipoCliente' => 'Factura');
					// echo '<pre>'; print_r($array); echo '</pre><br><br>';
				}
			}
			// echo '</tr>';
		}else if($index == 3){
			for ($row = 2; $row <= $highestRow; ++ $row) {
				// echo '<tr>';
				for ($col = 0; $col < $highestColumnIndex; ++ $col) {
					$cell = $worksheet->getCellByColumnAndRow($col, $row);
					$val = $cell->getValue();
					if($col == 0){
						$CodigoCliente = $val;
						if($CodigoCliente){
							$RutDv = explode("-", $val);
							$Rut = $RutDv[0];
							if(isset($RutDv[1])){
								$Dv = $RutDv[1];
							}else{
								$Dv = 0;
							}
						}else{
							continue;
						}
					}else if($col == 2){
						$Codigo = $val;
					}else if($col == 3){
						if($val == "Arriendo Equipos de Datos"){
							$IdServicio = 1;
						}else if($val == "Servicio de Internet"){
							$IdServicio = 2;
						}else if($val == "Servicio de Puertos Públicos"){
							$IdServicio = 3;
						}else if($val == "Servicio de IP Pública"){
							$IdServicio = 4;
						}else if($val == "Servicio de Mantención de Red"){
							$IdServicio = 5;
						}else if($val == "Arriendo de equipos de Telefonía IP"){
							$IdServicio = 6;
						}else{
							$IdServicio = 7;
						}
					}else if($col == 4){
						$Descripcion = $val;
					}else if($col == 5){
						$Valor = $val;
					}
					// $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
					// echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
				}

				$query = " INSERT INTO servicios (Rut, Grupo, TipoFactura, Valor, Descuento, IdServicio, Codigo, Descripcion, IdUsuarioSession, Alias, Estatus, FechaInstalacion, InstaladoPor, Comentario, UsuarioPppoe, Direccion, Latitud, Longitud, Referencia, Contacto, Fono, PosibleEstacion, Equipamiento, SenalTeorica, IdUsuarioAsignado, SenalFinal, EstacionFinal, EstatusFacturacion, CostoInstalacion, CostoInstalacionDescuento, FacturarSinInstalacion, FechaComprometidaInstalacion, FechaFacturacion, FechaUltimoCobro) VALUES ('".$Rut."', '1', 'FSMI', '".$Valor."', '0', '".$IdServicio."', '".$Codigo."', '".$Descripcion."', '".$idUsuario."', '".$Codigo."', '0', NOW(), '', '', '', '', '', '', '', '', '', '', '', '', '0', '', '', '0', '', '0', '0', NOW(),NOW(),NOW())";
				$id = $run->insert($query);

				if(!$id){
					echo 'Error 3';
				}

			}
		}else if($index == 4){
			for ($row = 2; $row <= $highestRow; ++ $row) {
				// echo '<tr>';
				for ($col = 0; $col < $highestColumnIndex; ++ $col) {
					$cell = $worksheet->getCellByColumnAndRow($col, $row);
					$val = $cell->getValue();
					if($col == 0){
						$CodigoCliente = $val;
						if($CodigoCliente){
							$RutDv = explode("-", $val);
							$Rut = $RutDv[0];
							if(isset($RutDv[1])){
								$Dv = $RutDv[1];
							}else{
								$Dv = 0;
							}
						}else{
							continue;
						}
					}else if($col == 2){
						$Codigo = $val;
					}else if($col == 3){
						$IdServicio = 2;
					}else if($col == 4){
						$Descripcion = $val;
					}else if($col == 5){
						$Valor = $val;

						if(!$Valor){
							continue;
						}
					}
					// $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
					// echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
				}

				$query = " INSERT INTO servicios (Rut, Grupo, TipoFactura, Valor, Descuento, IdServicio, Codigo, Descripcion, IdUsuarioSession, Alias, Estatus, FechaInstalacion, InstaladoPor, Comentario, UsuarioPppoe, Direccion, Latitud, Longitud, Referencia, Contacto, Fono, PosibleEstacion, Equipamiento, SenalTeorica, IdUsuarioAsignado, SenalFinal, EstacionFinal, EstatusFacturacion, CostoInstalacion, CostoInstalacionDescuento, FacturarSinInstalacion, FechaComprometidaInstalacion, FechaFacturacion, FechaUltimoCobro) VALUES ('".$Rut."', '1', 'FSMI', '".$Valor."', '0', '".$IdServicio."', '".$Codigo."', '".$Descripcion."', '".$idUsuario."', '".$Codigo."', '0', NOW(), '', '', '', '', '', '', '', '', '', '', '', '', '0', '', '', '0', '', '0', '0', NOW(), NOW(),NOW())";
				$id = $run->insert($query);

				if(!$id){
					echo 'Error 4';
				}
			}
		}else if($index == 5){
			for ($row = 2; $row <= $highestRow; ++ $row) {
				// echo '<tr>';
				for ($col = 0; $col < $highestColumnIndex; ++ $col) {
					$cell = $worksheet->getCellByColumnAndRow($col, $row);
					$val = $cell->getValue();
					if($col == 0){
						$CodigoCliente = $val;
						if($CodigoCliente){
							$RutDv = explode("-", $val);
							$Rut = $RutDv[0];
							if(isset($RutDv[1])){
								$Dv = $RutDv[1];
							}else{
								$Dv = 0;
							}
						}else{
							continue;
						}
					}else if($col == 1){
						$Nombre = $val;
					}else if($col == 2){
						$Direccion = $val;
					}else if($col == 3){
						$Provincia = $val;
					}else if($col == 4){
						$Telefono = $val;
					}
					// $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
					// echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
				}

				$query = "INSERT INTO personaempresa
					(rut, dv, nombre, giro, comuna, provincia, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, IdUsuarioSession, CodigoCliente)
					VALUES
					('".$Rut."', '".$Dv."', '".$Nombre."', '', '".$Provincia."', '".$Provincia."', '".$Direccion."', '', '".$Telefono."', '', '".$Telefono."', '', '1', '".$idUsuario."','".$CodigoCliente."')";
				$id = $run->insert($query);

				if(!$id){
					// $array = array('Rut' => $Rut, 'Dv' => $Dv, 'Nombre' => $Nombre, 'Giro' => $Giro, 'Comuna' => $Comuna, 'Provincia' => $Provincia, 'Direccion' => $Direccion, 'Correo' => $Correo, 'Contacto' => $Contacto, 'Telefono' => $Telefono, 'TipoCliente' => 'Factura');
					// echo '<pre>'; print_r($array); echo '</pre><br><br>';
				}
			}
			// echo '</tr>';
		}
		// echo '</table>';
	}
?>