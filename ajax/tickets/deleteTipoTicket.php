<?php
    require_once('../../class/methods_global/methods.php');
    $run = new Method;
	$query = "DELETE FROM tipo_ticket WHERE IdTipoTicket = ".$_POST['id'];
    $data = $run->delete($query);
    $query = "DELETE FROM subtipo_ticket WHERE IdTipoTicket = ".$_POST['id'];
	$data = $run->delete($query);
	echo $data;
 ?>