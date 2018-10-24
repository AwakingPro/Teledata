<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = 'SELECT
	usuarios.nombre,
	usuarios.usuario,
	usuarios.cargo,
	comentarios_tickets.Comentario,
	comentarios_tickets.Fecha
	FROM
	comentarios_tickets
	INNER JOIN usuarios ON comentarios_tickets.IdUSuario = usuarios.id
	WHERE
	comentarios_tickets.IdTickets = '.$_POST['id'].'
	ORDER BY comentarios_tickets.Fecha DESC';
	$data = $run->select($query);
	if (count($data) > 0) {
		$comentarios ="";
		for ($i=0; $i < count($data); $i++) {
			$comentarios.= '<div class="row">
				<div class="pad-all">
					<div class="media mar-btm">
						<div class="media-left">
							<img src="../img/av1.png" class="img-circle" alt="Avatar" width="35">
						</div>
						<div class="media-body">
							<p class="text-lg text-main text-semibold mar-no">'.$data[$i]['nombre'].' - '.$data[$i]['usuario'].'</p>
							<p>'.$data[$i]['cargo'].' - '.date_format(date_create($data[$i]['Fecha']), 'd/m/Y g:i a').'</p>
						</div>
					</div>
					<blockquote class="bq-sm">'.nl2br($data[$i]['Comentario']).'</blockquote>
				</div>
			</div>';
		}
		echo $comentarios;
	}else{
		echo 'No hay comentarios';
	}
 ?>