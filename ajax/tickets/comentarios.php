<?php
	require_once('../../class/methods_global/methods.php');
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
	comentarios_tickets.IdTickets ='.$_POST['id'];
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		$comentarios ="";
		for ($i=0; $i < count($data); $i++) {
			$comentarios.= '<div class="row">
				<div class="pad-all">
					<div class="media mar-btm">
						<div class="media-left">
							<img src="../img/av1.png" class="img-md img-circle" alt="Avatar">
						</div>
						<div class="media-body">
							<p class="text-lg text-main text-semibold mar-no">'.$data[$i]['nombre'].' - '.$data[$i]['usuario'].'</p>
							<p>'.$data[$i]['cargo'].' - '.$data[$i]['Fecha'].'</p>
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