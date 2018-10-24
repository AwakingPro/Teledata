<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "UPDATE tipo_ticket SET Nombre='".$_POST['nombreTipo']."' WHERE IdTipoTicket = ".$_POST['idUpdateTipoTicket'];
	$data = $run->update($query);
	echo $data;
 ?>