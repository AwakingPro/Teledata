<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "SELECT IdTickets, Origen FROM tickets WHERE IdCliente = '".$_POST['Rut']."'";
	
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='<option value="">Seleccione...</option>';
		for ($i=0; $i < count($data); $i++) {
			$list.= '<option value="'.$data[$i]['IdTickets'].'">'.$data[$i]['IdTickets'].' - '.$data[$i]['Origen'].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>