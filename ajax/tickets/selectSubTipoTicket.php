<?php

	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "SELECT
		subtipo_ticket.IdSubTipoTicket,
		subtipo_ticket.Nombre
	FROM
		subtipo_ticket
	WHERE
		IdTipoTicket ='".$_POST['id']."'";
	
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='<option value="">Seleccione...</option>';
		foreach($data as $subtipo_ticket){
			$list.= '<option value="'.$subtipo_ticket['IdSubTipoTicket'].'">'.$subtipo_ticket['Nombre'].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>