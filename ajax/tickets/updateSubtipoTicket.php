<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "UPDATE subtipo_ticket SET IdTipoTicket='".$_POST['IdTipoTicket']."', Nombre='".$_POST['nombreSubTipo']."' WHERE IdSubTipoTicket = ".$_POST['idUpdateSubtipoTicket'];
	$data = $run->update($query);
	echo $data;
 ?>