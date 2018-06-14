<?php
	require_once('../../class/methods_global/methods.php');
	$query = "UPDATE subtipo_ticket SET IdTipoTicket='".$_POST['IdTipoTicket']."', Nombre='".$_POST['nombreSubTipo']."' WHERE IdSubTipoTicket = ".$_POST['idUpdateSubtipoTicket'];
	$run = new Method;
	$data = $run->update($query);
	echo $data;
 ?>