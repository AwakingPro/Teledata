<?php
	require_once('../../class/methods_global/methods.php');
	$query = "UPDATE tipo_ticket SET Nombre='".$_POST['nombreTipo']."' WHERE IdTipoTicket = ".$_POST['idUpdateTipoTicket'];
	$run = new Method;
	$data = $run->update($query);
	echo $data;
 ?>