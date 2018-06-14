<?php
    require_once('../../class/methods_global/methods.php');
    $run = new Method;
    $query = "DELETE FROM subtipo_ticket WHERE IdSubTipoTicket = ".$_POST['id'];
	$data = $run->delete($query);
	echo $data;
 ?>