<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$rows = $operation -> select("SELECT IdGrupo, Nombre FROM grupos WHERE IdCedente = '".$_SESSION['cedente']."'");

	$lista = "<table class='table table-striped TableEmpresas'>
					<thead>
						<tr>
							<th>Nombre</th>
							<th></th>
						</tr>
					</thead>
					<tbody>";

	for ($i=0; $i < count($rows) ; $i++) {
		$lista.= '<tr>
				<td>'.$rows[$i]['Nombre'].'</td>
				<td style="text-align: right;">
					<button data-toggle="modal" data-target="#listaGrupo" type="button" class="btn btn-info verGrupo" attr="'.$rows[$i]['IdGrupo'].'">Ver Grupo</button>
					<a attr="'.$rows[$i]['IdGrupo'].'" class="btn btn-success edit">Editar</a>
					<button type="button" class="btn btn-danger unlink" attr="'.$rows[$i]['IdGrupo'].'">Eliminar</button>
				</td>
			</tr>';
	}

	$lista.="</tbody></table>";

	echo $lista;

 ?>