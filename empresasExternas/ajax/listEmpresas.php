<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$rows = $operation -> select("SELECT IdEmpresaExterna, Nombre, Telefono, Correo FROM empresa_externa");

	$lista = "<table class='table table-striped TableEmpresas'>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Telefono</th>
							<th>Correo</th>
							<th></th>
						</tr>
					</thead>
					<tbody>";

	for ($i=0; $i < count($rows) ; $i++) {
		$lista.= '<tr>
				<td>'.$rows[$i]['Nombre'].'</td>
				<td>'.$rows[$i]['Telefono'].'</td>
				<td>'.$rows[$i]['Correo'].'</td>
				<td style="text-align: right;">
					<a attr="'.$rows[$i]['IdEmpresaExterna'].'" class="btn btn-success edit">Editar</a>
					<button type="button" class="btn btn-danger unlink" attr="'.$rows[$i]['IdEmpresaExterna'].'">Eliminar</button>
				</td>
			</tr>';
	}

	$lista.="</tbody></table>";

	echo $lista;

 ?>