<?php
	function listar_archivos($carpeta){
		$lista = "<table class='table table-striped dataTableReporteFacturas'>
					<thead>
						<tr>
							<th>Nombre de Ducumento</th>
							<th></th>
						</tr>
					</thead>
					<tbody>";
		if(is_dir($carpeta)){
			if($dir = opendir($carpeta)){
				while(($archivo = readdir($dir)) !== false){
					if($archivo != '.' && $archivo != '..'){
						$lista.= '<tr>
								<td>'.$archivo.'</td>
								<td style="text-align: right;">
									<a href="ssreportesFacturasMensuales/'.$archivo.'" class="btn btn-success">Descargar</a>
									<button type="button" class="btn btn-danger unlink" attr="'.$archivo.'">Eliminar</button>
								</td>
							</tr>';
					}
				}
				$lista.="</tbody></table>";
				closedir($dir);
				echo $lista;
			}
		}
	}
	echo listar_archivos('../../reportes/reporteFacturasSemestral');
 ?>